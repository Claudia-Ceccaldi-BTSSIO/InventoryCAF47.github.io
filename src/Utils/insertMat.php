<?php
// Assurez-vous que ces chemins sont corrects selon la structure de votre projet
require_once '../Models/databaseConnexion.php';
include 'mailNew.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $materiel_tt = $_POST['materiel_tt'];
    $ecran1_isiac = $_POST['ecran1_isiac'];
    $ecran2_isiac = $_POST['ecran2_isiac'];
    $uc_isiac = $_POST['uc_isiac'];
    $enregistre_dans_GACI = isset($_POST['enregistre_dans_GACI']) ? 1 : 0;
    $materiel = $_POST['materiel'];
    $remis_par = $_POST['remis_par'];
    $emprunte_par = $_POST['emprunte_par'];
    $fonction_emprunteur = $_POST['fonction_emprunteur'];
    $date_emprunt = $_POST['date_emprunt'];
    $date_restitution = $_POST['date_restitution'];
    $recepteur = $_POST['recepteur'];
    $observations = $_POST['observations'];

    // Appel de la fonction pour envoyer l'e-mail
    $emailSent = envoyerMail(
        "Résumé de la demande d'emprunt de matériel",
        $materiel_tt,
        $ecran1_isiac,
        $ecran2_isiac,
        $uc_isiac,
        $enregistre_dans_GACI,
        $materiel,
        $remis_par,
        $emprunte_par,
        $fonction_emprunteur,
        $date_emprunt,
        $date_restitution,
        $recepteur,
        $observations
    );

    // Connexion à la base de données
    $dbInstance = DatabaseConnection::getInstance();
    $connexion = $dbInstance->getConnection();

    // Préparation de la requête SQL
    $stmt = $connexion->prepare("INSERT INTO AttestationsMateriel (materiel_tt, ecran1_isiac, ecran2_isiac, uc_isiac, enregistre_dans_GACI, materiel,
     remis_par, emprunte_par, fonction_emprunteur, date_emprunt, date_restitution, recepteur, observations) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )");

    // Liaison des paramètres
    $stmt->bind_param(
        "sssissssssssss",
        $materiel_tt,
        $ecran1_isiac,
        $ecran2_isiac,
        $uc_isiac,
        $enregistre_dans_GACI,
        $materiel,
        $remis_par,
        $emprunte_par,
        $fonction_emprunteur,
        $date_emprunt,
        $date_restitution,
        $recepteur,
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
