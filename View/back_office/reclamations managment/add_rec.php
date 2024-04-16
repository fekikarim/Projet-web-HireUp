<?php

include '../../../Controller/reclamation_con.php';
include '../../../Model/reclamation.php';

// Création d'une instance du contrôleur des événements
$recC = new recCon("reclamations");

// Création d'une instance de la classe Event
$reclamation = null;

if (
    isset($_POST["sujet"]) &&
    isset($_POST["description"]) &&
    isset($_POST["date_creation"]) &&
    isset($_POST["status"]) &&
    isset($_POST["id_user"])
) {
    if (
        !empty($_POST['sujet']) &&
        !empty($_POST["description"]) &&
        !empty($_POST["date_creation"]) &&
        !empty($_POST["status"]) &&
        !empty($_POST["id_user"])
    ) {
        
        $reclamation = new Reclamation(
            $recC->generateRecId(5),
            $_POST['sujet'],
            $_POST['description'],
            $_POST['date_creation'],
            $_POST['status'],
            $_POST['id_user']
        );        

        $recC->addRec($reclamation);
        $success_message = "User added successfully!";
        header('Location: ../../../View/back_office/reclamations managment/recs_management.php?success_global=' . urlencode($success_message));
        exit(); // Make sure to stop further execution after redirection
    } else {
        // returning an error
        $error_message = "Failed to add the user. Please try again later.";
        header('Location: ../../../View/back_office/reclamations managment/recs_management.php?error_global=' . urlencode($error_message));
        exit(); // Make sure to stop further execution after redirection
    }
}


?>