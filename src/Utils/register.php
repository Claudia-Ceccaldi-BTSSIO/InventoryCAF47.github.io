<?php
session_start();

require_once '../Models/databaseConnexion.php';
require_once '../Controllers/authController.php';

$db = DatabaseConnection::getInstance()->getConnection();
$authController = new AuthController($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $authController->handleRegister();
}
function clean_input($data)
{
    // Fonction pour nettoyer les données entrantes
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

try {
    // Utilisation de la classe DatabaseConnection pour obtenir la connexion
    $dbInstance = DatabaseConnection::getInstance();
    $connexion = $dbInstance->getConnection();

    // Récupérer les données soumises via la méthode POST
    $validation_compte_user = isset($_POST['validation_compte_user']) ? clean_input($_POST['validation_compte_user']) : '';
    // Préparation de la requête SQL pour insérer les données
    $stmt = $connexion->prepare("INSERT INTO Users (validation_compte_user) VALUES (?)");
    if (!$stmt) {
        throw new Exception("Erreur de préparation de la requête : " . $connexion->error);
    }

    // Liaison des paramètres pour la requête
    $stmt->bind_param("s", $validation_compte_user);

    // Exécution de la requête
    if ($stmt->execute()) {
        // Redirection vers une autre page si nécessaire
        header("Location: ../Views/parcView.php");
        exit;
    } else {
        throw new Exception("Erreur : " . $stmt->error);
    }

    // Fermeture du statement et de la connexion
    $stmt->close();
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
