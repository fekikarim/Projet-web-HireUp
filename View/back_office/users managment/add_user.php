<?php

include '../../../Controller/user_con.php';
include '../../../Model/user.php';

// Création d'une instance du contrôleur des événements
$userC = new userCon("user");

// Création d'une instance de la classe Event
$user = null;

if (
    isset($_POST["user_name"]) &&
    isset($_POST["email"]) &&
    isset($_POST["password"]) &&
    isset($_POST["role"])
) {
    if (
        !empty($_POST['user_name']) &&
        !empty($_POST["email"]) &&
        !empty($_POST["password"]) &&
        !empty($_POST["role"])
    ) {
        
        $user = new User(
            $userC->generateUserId(5),
            $_POST['user_name'],
            $_POST['email'],
            $_POST['password'],
            $_POST['role'],
            "false",
            "false"
        );

        # do some checks first
        # check user name existence
        if ($userC->userNameExists($user->get_user_name())){
            $error_user_name = "Username already exists";
            header('Location: ../../../View/back_office/users managment/users_management.php?error_user_name=' . urlencode($error_user_name) . '&user_name=' . urlencode($user->get_user_name()) . '&email=' . urlencode($user->get_email()));
            exit(); // Make sure to stop further execution after redirection
        }

        # check email existence
        if ($userC->emailExists($user->get_email())){
            $error_email = "This email is already registered. Would you like to sign in instead?";
            header('Location: ../../../View/back_office/users managment/users_management.php?error_email=' . urlencode($error_email) . '&user_name=' . urlencode($user->get_user_name()) . '&email=' . urlencode($user->get_email()));
            exit(); // Make sure to stop further execution after redirection
        }

        $userC->addUser($user);
        $success_message = "User added successfully!";
        header('Location: ../../../View/back_office/users managment/users_management.php?success_global=' . urlencode($success_message) . '&user_name_email=' . urlencode($user->get_user_name()));
        exit(); // Make sure to stop further execution after redirection
    } else {
        // returning an error
        $error_message = "Failed to add the user. Please try again later.";
        header('Location: ../../../View/back_office/users managment/users_management.php?error_global=' . urlencode($error_message));
        exit(); // Make sure to stop further execution after redirection
    }
}


?>