<?php
include '../../../Controller/pub_con.php';
include '../../../Model/pub.php';

// Création d'une instance du contrôleur des événements
$pubb = new pubCon("pub");

if (isset($_GET['id'])){
    $current_id = $_GET['id'];

    $res = $pubb->deletepub($current_id);

    if ($res){
        $success_message = "pub deleted successfully!";
        header('Location: ../../../View/back_office/ads managment/pub_management.php?success_global=' . urlencode($success_message));
        exit();
    }
    else{
        $error_message = "Failed to delete the pub. Please try again later.";
       header('Location: ../../../View/back_office/ads managment/pub_management.php?error_global=' . urlencode($error_message));
        exit();
    }
}
else{
    $error_message = "Failed to delete the pub. Please try again later.";
    header('Location: ../../../View/back_office/ads managment/pub_management.php?error_global=' . urlencode($error_message));
    exit();
}


?>