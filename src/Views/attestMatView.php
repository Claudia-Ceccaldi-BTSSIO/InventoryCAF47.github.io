<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'Attestation de Matériel Nomade</title>
    <base href="http://localhost/projetcaf/">
    <link rel="stylesheet" href="public/assets/css/style_attMat.css">
    <style>
        /* Style pour cacher le premier encart par défaut */
        .encart-hidden {
            display: none;
        }
    </style>
</head>

<body>
    <h2>Formulaire d'Attestation de Matériel Nomade</h2>

    <form action="src/Utils/insertMat.php" method="post">

        <!-- Premier encart caché par défaut -->
        <div class="encart encart-hidden" id="premier_encart">
            <h3>Demande de prêt Matériel TT</h3>
            <div>
                <label for="materiel_tt">Materiel TT:</label>
                <input type="text" id="materiel_tt" name="materiel_tt">
            </div>
            <div>
                <label for="ecran1_isiac">Isiac Écran 1:</label>
                <input type="text" id="ecran1_isiac" name="ecran1_isiac">
            </div>

            <div>
                <label for="ecran2_isiac">Isiac Écran 2:</label>
                <input type="text" id="ecran2_isiac" name="ecran2_isiac">
            </div>

            <div>
                <label for="uc_isiac">Isiac UC:</label>
                <input type="text" id="uc_isiac" name="uc_isiac">
            </div>

            <div>
                <label for="enregistre_dans_GACI">Enregistré dans @G@CI:</label>
                <input type="checkbox" id="enregistre_dans_GACI" name="enregistre_dans_GACI">
            </div>
        </div>

        <!-- Bouton pour basculer la visibilité -->
        <button type="button" onclick="toggleEncart()">Basculer la visibilité du premier encart</button>

        <!-- Deuxième encart -->
        <div class="encart">
            <h3>Demande de prêt Matériel (hors Télétravail)</h3>
            <div>
                <label for="materiel">Matériel:</label>
                <input type="text" id="materiel" name="materiel" required>
            </div>

        </div>
        <!-- Troisième encart -->
        <div class="encart">
            <h3>Autres Informations</h3>
            <div>
                <label for="remis_par">Remis par:</label>
                <input type="text" id="remis_par" name="remis_par" required>
            </div>

            <div>
                <label for="emprunte_par">Emprunté par:</label>
                <input type="text" id="emprunte_par" name="emprunte_par" required>
            </div>

            <div>
                <label for="fonction">Fonction de l'emprunteur:</label>
                <input type="text" id="fonction_emprunteur" name="fonction_emprunteur" required>
            </div>

            <div>
                <label for="date_emprunt">Date d'emprunt:</label>
                <input type="date" id="date_emprunt" name="date_emprunt" required>
            </div>

            <div>
                <label for="date_restitution">Date de restitution:</label>
                <input type="date" id="date_restitution" name="date_restitution" required>
            </div>

            <div>
                <label for="recepteur">Récepteur:</label>
                <input type="text" id="recepteur" name="recepteur" required>
            </div>

            <div>
                <label for="observations">Observations:</label>
                <textarea id="observations" name="observations" required></textarea>
            </div>
        </div>

        <div>
            <input type="submit" value="Soumettre">
        </div>
    </form>

    <script>
        function toggleEncart() {
            var encart = document.getElementById('premier_encart');
            encart.style.display = (encart.style.display === 'none') ? 'block' : 'none';
        }
    </script>
</body>

</html>