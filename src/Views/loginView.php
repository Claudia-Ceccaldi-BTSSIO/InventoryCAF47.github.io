<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="/assets/css/style_login.css?v=1">
</head>

<body>
    <header><!-- En-tête --></header>
    <nav><!-- Barre de navigation --></nav>
    </style>
    <main>
        <div class="container">
            <h2>Connexion</h2>
            <!-- Affiche le formulaire de connexion ici -->
            <form action="login.php" method="post">
                <label for="id_user_login">Identifiant :</label>
                <input type="text" id="id_user_login" name="id_user" required>
                <label for="password_login">Mot de passe :</label>
                <input type="password" id="password_login" name="password" required>
                <input type="submit" name="login" value="Se connecter">
            </form>
            <div class="error_message" role="alert">
                <?php
                if (isset($_SESSION['error_message'])) {
                    echo $_SESSION['error_message'];
                    unset($_SESSION['error_message']);
                }
                ?>
            </div>

        </div>

    </main>
    <footer><!-- Pied de page --></footer>
</body>

</html>