<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="/assets/css/style_register.css">
    <script>
        // Fonction pour afficher ou masquer le champ de code admin en fonction du rôle sélectionné
        function toggleAdminCode() {
            var role = document.getElementById("role").value;
            var adminCodeField = document.getElementById("admin-code");

            if (role === "admin") {
                adminCodeField.style.display = "block";
            } else {
                adminCodeField.style.display = "none";
            }
        }
    </script>
</head>

<body>
    <header><!-- En-tête --></header>
    <nav><!-- Barre de navigation --></nav>
    <main>
        <div class="container">
            <h2>Inscription</h2>
            <form action="../Utils/register.php" method="post">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>

                <label for="role">Rôle :</label>
                <select id="role" name="role" onchange="toggleAdminCode()" required>
                    <option value="user">Utilisateur</option>
                    <option value="admin">Administrateur</option>
                </select>

                <div id="admin-code" style="display: none;">
                    <label for="admin_code">Code d'inscription (Administrateur uniquement) :</label>
                    <input type="text" id="admin_code" name="admin_code">
                </div>

                <input type="submit" name="register" value="S'inscrire">
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