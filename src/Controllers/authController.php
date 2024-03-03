<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// echo "Le fichier authController.php est chargé.";
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Inclure le fichier de configuration avec les constantes de messages d'erreur
require_once('../Utils/errors.php');

// Inclure le fichier databaseConnexion.php
require_once('../Models/databaseConnexion.php');

class AuthController
{
    private $connexion;

    public function __construct($connexion)
    {
        $this->connexion = $connexion;
    }

    private function cleanInput($data)
    {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }

    public function handlePostRequests()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
            $this->handleLogin();
        }
    }

    public function handleLogin()
    {
        try {
            $id_user = $this->cleanInput($_POST["id_user"]);
            $password = $this->cleanInput($_POST["password"]);

            // Utilisez une requête préparée pour éviter les injections SQL
            $sql = "SELECT id_user, password_hash FROM Users WHERE id_user = ?";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bind_param("s", $id_user);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                if (password_verify($password, $row['password_hash'])) {
                    session_regenerate_id(true); // Régénère l'ID de session
                    $_SESSION['id_user'] = $id_user;

                    // Redirigez l'utilisateur vers la page précédente s'il y en a une, sinon vers parcView.php
                    $redirect = isset($_SESSION['redirect']) ? $_SESSION['redirect'] : 'parcView.php';
                    unset($_SESSION['redirect']); // Nettoyez la redirection

                    header("Location: $redirect");
                    exit();
                } else {
                    throw new Exception(ERROR_INVALID_PASSWORD);
                }
            } else {
                throw new Exception(ERROR_USERNAME_NOT_FOUND);
            }

            $stmt->close();
        } catch (Exception $e) {
            // Enregistrez les erreurs dans un journal d'audit plutôt que de les afficher directement à l'utilisateur
            error_log("Erreur d'authentification : " . $e->getMessage());

            // Stockez le message d'erreur dans la session
            $_SESSION['error_message'] = $e->getMessage();

            // Redirigez l'utilisateur vers la page de connexion
            header("Location: ../Views/loginView.php");
            exit();
        }
    }
}
