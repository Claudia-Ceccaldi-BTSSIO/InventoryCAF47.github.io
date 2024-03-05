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

    <form action="src/Utils/insertMat.php" method="post">

        <!-- Premier encart caché par défaut -->
        <div class="encart encart-hidden" id="premier_encart">
            <h3>Demande de prêt Matériel</h3>
            <div>
                <label for="materiel_tt">Matériel:</label>
                <select name="materiel_tt" id="materiel_tt">
                    <option value="ecran">Ecran</option>
                    <option value="alimentation_uc">Chargeur UC</option>
                    <option value="UC_tt">UC Télétravail</option>
                </select>
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
        <button type="button" onclick="toggleEncart()">Matériel télétravail</button>

        <!-- Deuxième encart -->
        <div class="encart">
            <h3>Demande de prêt Matériel (hors Télétravail)</h3>
            <div>
                <label for="materiel">Matériel:</label>
                <select name="materiel" id="materiel" required>
                    <option value="casque">casque</option>
                    <option value="cle_usb">clé usb</option>
                    <option value="souris">souris</option>
                </select>
            </div>
        </div>

        <!-- Troisième encart -->
        <div class="encart">
            <h3>Autres Informations</h3>

            <div>
                <label for="emprunte_par">Emprunté par:</label>
                <input type="text" id="emprunte_par" name="emprunte_par" required>
            </div>

            <div>
                <label for="fonction_emprunteur">Fonction de l'emprunteur:</label>
                <input type="text" id="fonction_emprunteur" name="fonction_emprunteur" required>
            </div>

            <div>
                <label for="date_emprunt">Date d'emprunt:</label>
                <input type="date" id="date_emprunt" name="date_emprunt" required>
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
