<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'Attestation de Matériel Nomade</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vuetify/2.6.1/vuetify.min.css">
    <style>
        /* Réinitialisation des styles de base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Styles globaux */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        #form-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            width: 100%;
        }

        #form-container h2 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-row {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .checkbox-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
        }

        .checkbox-item input[type="checkbox"] {
            margin-right: 5px;
        }

        .checkbox-container>.checkbox-item {
            width: 50%;
        }

        /* Media query pour rendre le formulaire responsive */
        @media only screen and (max-width: 600px) {
            #form-container {
                padding: 10px;
            }
            
            input[type="submit"] {
                padding: 8px;
            }
        }
    </style>

</head>

<body>
    <div id="form-container">
        <h2>Demande de prêt de Matériel informatique</h2>
        <form action="../Utils/insertMat.php" method="post">
            <div class="form-row">
                <!-- Champ caché pour l'identifiant id_materiel -->
                <input type="hidden" id="id_materiel" name="id_materiel" value="<!-- Valeur de l'identifiant récupérée dynamiquement -->">
                <div class="form-row">
                    <label for="emprunte_par">Emprunté par:</label>
                    <input type="text" id="emprunte_par" name="emprunte_par" required>
                </div>
                <label for="type_materiel">Type de Matériel:</label>
                <select name="type_materiel[]" id="type_materiel" multiple>
                    <option value="Clé USB">Clé USB</option>
                    <option value="Clé WIFI">Clé WIFI</option>
                    <option value="Casque Audio">Casque Audio</option>
                    <option value="Souris Filaire">Souris Filaire</option>
                    <option value="Souris Ergonomique">Souris Ergonomique</option>
                    <option value="Clavier Filaire">Clavier Filaire</option>
                    <option value="Clavier Bluetooth">Clavier Bluetooth</option>
                </select>
            </div>

            <div class="form-row">
                <label for="fonction_emprunteur">Fonction de l'emprunteur:</label>
                <select name="fonction_emprunteur" id="fonction_emprunteur" required>
                    <option value="Cadre">Cadre</option>
                    <option value="Agent">Agent</option>
                    <option value="Comptable">Comptable </option>
                </select>
            </div>
            <div class="form-row">
                <label for="date_emprunt">Date d'emprunt:</label>
                <input type="date" id="date_emprunt" name="date_emprunt" required>
            </div>
            <div class="form-row">
                <label for="observations">Observations:</label>
                <textarea id="observations" name="observations" required></textarea>
            </div>
            <div class="form-row">
                <input type="submit" value="Soumettre">
            </div>
        </form>
    </div>
</body>

</html>
