<?php
include '../../../Controller/art_con.php';
include '../../../Model/art.php';

// Création d'une instance du contrôleur des événements
$artt = new artCon("art");

if (isset($_GET['id'])){
    $current_id = $_GET['id'];

    $res = $artt->deleteart($current_id);

    if ($res){
        $success_message = "art deleted successfully!";
        header('Location: ../../../View/back_office/art managment/art_management.php?success_global=' . urlencode($success_message));
        exit();
    }
    else{
        $error_message = "Failed to delete the art. Please try again later.";
       header('Location: ../../../View/back_office/art managment/art_management.php?error_global=' . urlencode($error_message));
        exit();
    }
}
else{
    $error_message = "Failed to delete the art. Please try again later.";
    header('Location: ../../../View/back_office/art managment/art_management.php?error_global=' . urlencode($error_message));
    exit();
}


?>