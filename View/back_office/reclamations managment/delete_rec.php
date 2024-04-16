<?php
include '../../../Controller/reclamation_con.php';
include '../../../Model/reclamation.php';

// Création d'une instance du contrôleur des événements
$recC = new recCon("reclamations");

if (isset($_GET['id'])){
    $current_id = $_GET['id'];

    $res = $recC->deleteRec($current_id);

    if ($res){
        $success_message = "Reclamation deleted successfully!";
        header('Location: ../../../View/back_office/reclamations managment/recs_management.php?success_global=' . urlencode($success_message));
        exit();
    }
    else{
        $error_message = "Failed to delete the Reclamation. Please try again later.";
        header('Location: ../../../View/back_office/reclamations managment/recs_management.php?error_global=' . urlencode($error_message));
        exit();
    }
}
else{
    $error_message = "Failed to delete the Reclamation. Please try again later.";
    header('Location: ../../../View/back_office/reclamations managment/recs_management.php?error_global=' . urlencode($error_message));
    exit();
}


?>