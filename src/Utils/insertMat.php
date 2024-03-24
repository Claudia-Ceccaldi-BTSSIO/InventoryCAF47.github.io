<?php
// Assurez-vous que ces chemins sont corrects selon la structure de votre projet
require_once '../Models/databaseConnexion.php';
include 'mailNew.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $materiel_tt = empty($_POST['materiel_tt']) ? 'none' : $_POST['materiel_tt'];

    // Vérifiez si le champ "Matériel de Télétravail" est vide ou non
    if (!empty($_POST['materiel_tt'])) {
        // Si le champ n'est pas vide, utilisez la fonction implode()
        $materiel_tt = implode(',', $_POST['materiel_tt']);
    } else {
        // Si le champ est vide, définissez une valeur par défaut
        $materiel_tt = 'none';
    }

    // Vérifiez si le champ "Matériel Hors Télétravail" est vide ou non
    if (!empty($_POST['materiel'])) {
        // Si le champ n'est pas vide, utilisez la fonction implode()
        $materiel = implode(',', $_POST['materiel']);
    } else {
        // Si le champ est vide, définissez une valeur par
        $materiel = 'none';
    }

    $emprunte_par = $_POST['emprunte_par'];
    $fonction_emprunteur = $_POST['fonction_emprunteur'];
    $date_emprunt = $_POST['date_emprunt'];
    $observations = empty($_POST['observations']) ? 'none' : $_POST['observations'];

    // Appel de la fonction pour envoyer l'e-mail
    $emailSent = envoyerMail(
        "Résumé de la demande d'emprunt de matériel",
        $materiel_tt,
        $materiel,
        $emprunte_par,
        $fonction_emprunteur,
        $date_emprunt,
        $observations
    );

    // Connexion à la base de données
    $dbInstance = DatabaseConnection::getInstance();
    $connexion = $dbInstance->getConnection();

    // Préparation de la requête SQL
    $stmt = $connexion->prepare("INSERT INTO AttestationsMateriel (materiel_tt, materiel, emprunte_par, fonction_emprunteur, date_emprunt, observations) VALUES (?, ?, ?, ?, ?, ?)");

    // Liaison des paramètres
    $stmt->bind_param(
        "ssssss",
        $materiel_tt,
        $materiel,
        $emprunte_par,
        $fonction_emprunteur,
        $date_emprunt,
        $observations
    );

    // Exécution de la requête
    if ($stmt->execute() && $emailSent) {
        // Redirection vers la page de confirmation
        header("Location: ../Views/insertConfirmView.php");
        exit;
    } else {
        echo "Erreur lors de l'enregistrement ou de l'envoi de l'e-mail.";
    }

    // Fermeture du statement
    $stmt->close();
}
