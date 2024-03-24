<?php

// Vérifier si une session PHP est déjà active, sinon en démarrer une
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_user'])) {
    // Si l'utilisateur n'est pas connecté et n'est pas sur la page 'loginView.php' ou 'registerView.php',
    // rediriger vers la page de connexion
    if (basename($_SERVER['PHP_SELF']) != 'loginView.php' && basename($_SERVER['PHP_SELF']) != 'registerView.php') {
        header("Location: ../Views/loginView.php");
        exit;
    } else {
        // Si l'utilisateur n'est pas connecté mais est sur 'loginView.php' ou 'registerView.php', pas besoin de rediriger
        // mais vous pouvez afficher un message approprié si nécessaire
    }
}
