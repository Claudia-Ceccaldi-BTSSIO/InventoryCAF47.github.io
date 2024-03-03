<?php
session_start(); // Démarrer la session

require_once '../Models/databaseConnexion.php';
require_once '../Controllers/authController.php';

$db = DatabaseConnection::getInstance()->getConnection();
$authController = new AuthController($db);

// Si le formulaire de connexion a été soumis, gérer la requête POST.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $authController->handlePostRequests();
}

// // Code pour vérifier l'authentification ici, si l'utilisateur n'est pas reconnu
// $error_message = "";
// if (!$authController->handleLogin()) {
//     $error_message = "Identifiant ou mot de passe incorrect.";
//     $_SESSION['error_message'] = $error_message;
//     header("Location: loginView.php?error=1");
//     exit;
// }

// Inclure la vue de connexion
include '../Views/loginView.php';
