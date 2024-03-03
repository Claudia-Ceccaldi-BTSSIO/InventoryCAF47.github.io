<?php

require_once '../src/Models/databaseConnexion.php';

// Création d'une instance de connexion à la base de données
$dbConnection = DatabaseConnection::getInstance()->getConnection();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application CAF du Lot-et-Garonne</title>
    <base href="http://localhost/projetcaf/">
    <link rel="stylesheet" href="public/assets/css/style_index.css?v=1"><!--le ?v=1 force le navigateur à charger la dernière version !-->
</head>

<body style="background-image: url('http://localhost/projetcaf/public/assets/images/femmepc.jpg'); background-size: cover; 
background-position: left ; background-repeat: no-repeat; background-attachment: fixed;">

    <div class="container">
        <div class="hello">
            <h1>Bienvenue sur l'application de la CAF
                <br>du Lot-et-Garonne
            </h1>
            <h2>Inventaire du Matériel Nomade</h2>
        </div>

        <div class="button-container">
            <a href="src/Views/loginView.php" class="btn">Connexion</a>
        </div>
    </div>

</body>
<footer>
    <button class="welcome-container btn-zoom" onclick="window.location.href='src/Views/attestMatView.php'">
        <h2>
            Attestation de Mise à disposition de Matériel Nomade
        </h2>
    </button>

</footer>

</html>
