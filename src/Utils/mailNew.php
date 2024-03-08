<?php

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

require "../../PHPMailer/src/PHPMailer.php";
require "../../PHPMailer/src/Exception.php";
require "../../PHPMailer/src/SMTP.php";
function envoyerMail($message)
{
    try {
        // Tentative de création d’une nouvelle instance de la classe PHPMailer
        $mail = new PHPMailer(true);
        $mail->CharSet = "UTF-8";
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        // Informations personnelles
        $mail->Host = "smtp.office365.com";
        $mail->Port = "587";
        $mail->Username = "************";
        $mail->Password = "************";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        // Expéditeur
        $mail->setFrom('***********', '*********');
        // Destinataire dont le nom peut également être indiqué en option
        $mail->addAddress('*********', '*********');
        //  $mail->SMTPDebug = "";



        // Définition du contenu du message
        $message = "
        <h1>Résumé de la demande d'emprunt de matériel :</h1>
        <p><strong>Materiel TT :</strong> " . ($_POST['materiel_tt'] ?? '') . "</p>
        <p><strong>Écran 1 Isiac :</strong> " . ($_POST['ecran1_isiac'] ?? '') . "</p>
        <p><strong>Écran 2 Isiac :</strong> " . ($_POST['ecran2_isiac'] ?? '') . "</p>
        <p><strong>UC Isiac :</strong> " . ($_POST['uc_isiac'] ?? '') . "</p>
        <p><strong>Enregistré dans @G@CI :</strong> " . ($_POST['enregistre_dans_GACI'] ?? '') . "</p>
        <p><strong>Materiel ( Hors TT ) :</strong> " . ($_POST['materiel'] ?? '') . "</p>
        <p><strong>Remis par :</strong> " . ($_POST['remis_par'] ?? '')  . "</p>
        <p><strong>Emprunté par :</strong> " . ($_POST['emprunte_par'] ?? '')  .  "</p>
        <p><strong>Fonction de l'emprunteur :</strong> " . ($_POST['fonction_emprunteur'] ?? '')  . "</p>
        <p><strong>Date d'emprunt :</strong> " . ($_POST['date_emprunt'] ?? '')  . "</p>
        <p><strong>Date de restitution :</strong> " . ($_POST['date_restitution'] ?? '') . "</p>
        <p><strong>Récepteur :</strong> " . ($_POST['recepteur'] ?? '') . "</p>
        <p><strong>Observations :</strong> " . ($_POST['observations'] ?? '') . "</p>
    ";

        // Définition du contenu HTML
        $mail->isHTML(true);
        $mail->Subject = 'Résumé de la demande d\'emprunt de matériel';
        $mail->Body    = $message;
        $mail->AltBody = strip_tags($message);

        // Envoi du message
        $mail->send();
        // Envoi réussi, rediriger vers une autre page
        header("Location: ../Views/insertConfirmView.php");
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi du mail: " . $mail->ErrorInfo;
    }
}
