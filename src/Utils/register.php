<?php
session_start();

require_once '../Models/databaseConnexion.php';
require_once '../Controllers/authController.php';

$db = DatabaseConnection::getInstance()->getConnection();
$authController = new AuthController($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $authController->handleRegister();
}
