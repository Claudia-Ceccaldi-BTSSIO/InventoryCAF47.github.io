<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('../Utils/errors.php');
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

    public function handleRegister()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
            try {
                $username = $this->cleanInput($_POST["username"]);
                $password = $this->cleanInput($_POST["password"]);
                $role = $this->cleanInput($_POST["role"]);

                // Vérifier si l'utilisateur existe déjà
                $sql_check_user = "SELECT id_user FROM Users WHERE username = ?";
                $stmt_check_user = $this->connexion->prepare($sql_check_user);
                $stmt_check_user->bind_param("s", $username);
                $stmt_check_user->execute();
                $result_check_user = $stmt_check_user->get_result();

                if ($result_check_user->num_rows > 0) {
                    throw new Exception("L'utilisateur existe déjà.");
                }

                // Vérifier si l'utilisateur est un administrateur et s'il a fourni le bon code d'inscription
                if ($role == 'admin' && !$this->verifyAdminCode()) {
                    throw new Exception("Code d'inscription administrateur incorrect.");
                }

                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Insertion de l'utilisateur dans la base de données
                $sql_insert_user = "INSERT INTO Users (username, password_hash, role) VALUES (?, ?, ?)";
                $stmt_insert_user = $this->connexion->prepare($sql_insert_user);
                $stmt_insert_user->bind_param("sss", $username, $hashed_password, $role);
                $stmt_insert_user->execute();
                $stmt_insert_user->close();

                // Redirection vers la page de connexion après l'inscription réussie
                header("Location: ../Views/loginView.php");
                exit();
            } catch (Exception $e) {
                // Enregistrez les erreurs dans un journal d'audit plutôt que de les afficher directement à l'utilisateur
                error_log("Erreur lors de l'inscription : " . $e->getMessage());

                // Stockez le message d'erreur dans la session
                $_SESSION['error_message'] = $e->getMessage();

                // Redirection vers la page d'inscription en cas d'échec
                header("Location: ../Views/registerView.php");
                exit();
            }
        }
    }

    public function handleLogin()
    {
        try {
            $username = $this->cleanInput($_POST["id_user"]);
            $password = $this->cleanInput($_POST["password"]);

            // Utilisez une requête préparée pour éviter les injections SQL
            $sql = "SELECT id_user, username, password_hash FROM Users WHERE username = ?";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                if (password_verify($password, $row['password_hash'])) {
                    session_regenerate_id(true); // Régénère l'ID de session
                    $_SESSION['id_user'] = $row['id_user'];

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

    private function verifyAdminCode()
    {
        // Vérifiez si le code d'inscription fourni correspond au code administrateur dans la base de données
        $code = $this->cleanInput($_POST["admin_code"]); // Assurez-vous d'avoir un champ dans le formulaire pour le code d'inscription admin
        $sql = "SELECT COUNT(*) AS count FROM Users WHERE registration_code = ?";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bind_param("s", $code);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row['count'] == 1) {
            return true;
        } else {
            // Redirigez l'utilisateur vers la page d'inscription avec un message d'erreur si le code est incorrect
            $_SESSION['error_message'] = "Code d'inscription administrateur incorrect.";
            header("Location: ../Views/registerView.php");
            exit();
        }
    }
}
