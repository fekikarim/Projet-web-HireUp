<?php
include '../../../Controller/user_con.php';
include '../../../Model/user.php';

// Création d'une instance du contrôleur des événements
$userC = new userCon("user");

if (isset($_GET['id'])){
    $current_id = $_GET['id'];

    $res = $userC->updateUserRole($current_id, "admin");
    if ($res){
        $success_message = "User updated successfully!";
        header('Location: ../../../View/back_office/users managment/users_management.php?success_global=' . urlencode($success_message));
        exit();
    }
    else{
        $error_message = "Failed to update the user. Please try again later.";
        header('Location: ../../../View/back_office/users managment/users_management.php?error_global=' . urlencode($error_message));
        exit();
    }
}
else{
    $error_message = "Failed to update the user. Please try again later.";
    header('Location: ../../../View/back_office/users managment/users_management.php?error_global=' . urlencode($error_message));
    exit();
}


?>