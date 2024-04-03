<?php

require_once './src/Models/databaseConnexion.php';

// Création d'une instance de connexion à la base de données
$dbConnection = DatabaseConnection::getInstance()->getConnection();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application CAF du Lot-et-Garonne</title>
    <link rel="stylesheet" href="assets/css/style_index.css?v=1"><!--le ?v=1 force le navigateur à charger la dernière version !-->
</head>

<body style="background-image: url('assets/images/femmepc.jpg'); background-size: cover; 
background-position: left ; background-repeat: no-repeat; background-attachment: fixed;">

    <div class="container">
        <div class="hello">
            <h1>Bienvenue sur l'application de la CAF
                <br>du Lot-et-Garonne
            </h1></div>
            
        </div>

        <div class="button-container">
            <a href="src/Views/loginView.php" class="btn">Connexion</a>
        </div>
        <!-- Bouton d'inscription -->
        <div class="inscription-container">
            <a href="src/Views/registerView.php" class="inscription-btn">Inscription</a>
        </div>

    

</body>
<footer>
    <button class="welcome-container btn-zoom" onclick="window.location.href='src/Views/attestMatView.php'">
        <h2>
            Demande de prêt de matériel informatique 
        </h2>
    </button>

</footer>

</html>