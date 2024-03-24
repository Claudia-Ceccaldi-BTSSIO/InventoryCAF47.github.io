<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../Models/materiel.php';
require_once '../Models/databaseConnexion.php';

class ParcController
{
    private $materielModel;

    public function __construct($connection)
    {
        $this->materielModel = new Materiel($connection);
    }

    public function handleRequest()
    {
        try {
            // Vérifier si l'utilisateur est connecté
            require_once('../Utils/session.php');

            // Validation et nettoyage de la variable $_GET['search']
            $search = isset($_GET['search']) ? filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING) : '';

            $materielData = $this->materielModel->searchMateriel($search);

            // Passer $materielData à la vue
            include_once('../Views/parcView.php');
        } catch (Exception $e) {
            // Gérez l'erreur ici
            echo "Erreur : " . $e->getMessage();
        }
    }
}
