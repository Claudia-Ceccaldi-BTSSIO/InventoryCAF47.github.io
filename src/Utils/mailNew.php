<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../../PHPMailer/src/PHPMailer.php";
require "../../PHPMailer/src/Exception.php";
require "../../PHPMailer/src/SMTP.php";

function envoyerMail(
    $subject,
    $materiel_tt,
    $materiel,
    $emprunte_par,
    $fonction_emprunteur,
    $date_emprunt,
    $observations
) {
    try {
        // Tentative de création d’une nouvelle instance de la classe PHPMailer
        $mail = new PHPMailer(true);
        $mail->CharSet = "UTF-8";
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        // Informations personnelles
        $mail->Host = "smtp.office365.com";
        $mail->Port = "587";
        $mail->Username = "********";
        $mail->Password = "*******";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        // Expéditeur
        $mail->setFrom('******', '******');
        // Destinataire dont le nom peut également être indiqué en option
        $mail->addAddress('*******', '*******');
        //  $mail->SMTPDebug = "";

        // Définition du contenu du message
        $message = "
        <h1>$subject</h1>
        <p><strong>Materiel de Télétravail :</strong> $materiel_tt</p>
        <p><strong>Materiel Hors Télétravail :</strong> $materiel</p>
        <p><strong>Emprunté par :</strong> $emprunte_par</p>
        <p><strong>Fonction de l'emprunteur :</strong> $fonction_emprunteur</p>
        <p><strong>Date d'emprunt :</strong> $date_emprunt</p>
        <p><strong>Observations :</strong> $observations</p>
    ";

        // Définition du contenu HTML
        $mail->isHTML(true);
        $mail->Subject = $subject;
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
