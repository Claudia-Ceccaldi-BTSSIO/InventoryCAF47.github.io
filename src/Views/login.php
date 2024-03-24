<?php
session_start(); // Démarrer la session

require_once '../Models/databaseConnexion.php';
require_once '../Controllers/authController.php';

$db = DatabaseConnection::getInstance()->getConnection();
$authController = new AuthController($db);

// Si le formulaire de connexion a été soumis, gérer la requête POST.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Utilisez handleLogin() à la place de handlePostRequests()
    $authController->handleLogin();
}

// Inclure la vue de connexion
include '../Views/loginView.php';
