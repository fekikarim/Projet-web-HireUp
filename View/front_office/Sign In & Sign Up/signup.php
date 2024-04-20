<?php

include '../../../Controller/user_con.php';
include '../../../Model/user.php';

// Création d'une instance du contrôleur des événements
$userC = new userCon("user");

// Création d'une instance de la classe Event
$user = null;

if (
    isset($_POST["user_name"]) &&
    isset($_POST["user_email"]) &&
    isset($_POST["user_password"])
) {
    if (
        !empty($_POST['user_name']) &&
        !empty($_POST["user_email"]) &&
        !empty($_POST["user_password"])
    ) {
        
        /*$user = new User(
            $userC->generateUserId(5),
            $_POST['user_name'],
            $_POST['user_email'],
            $_POST['user_password'],
            "user",
            "false",
            "false"
        );*/

        $hashed_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);
        
        // get current date
        $currentDate = date("Y-m-d");
        
        $user = new User(
            $userC->generateUserId(5),
            $_POST['user_name'],
            $_POST['user_email'],
            $hashed_password,
            "user",
            "false",
            "false",
            $currentDate
        );


        # do some checks first
        # check user name existence
        if ($userC->userNameExists($user->get_user_name())){
            $error_user_name = "Username already exists";
            header('Location: ../../../View/front_office/Sign In & Sign Up/authentication-register.php?error_user_name=' . urlencode($error_user_name) . '&user_name=' . urlencode($user->get_user_name()) . '&email=' . urlencode($user->get_email()));
            exit(); // Make sure to stop further execution after redirection
        }

        # check email existence
        if ($userC->emailExists($user->get_email())){
            $error_email = "This email is already registered. Would you like to sign in instead?";
            header('Location: ../../../View/front_office/Sign In & Sign Up/authentication-register.php?error_email=' . urlencode($error_email) . '&user_name=' . urlencode($user->get_user_name()) . '&email=' . urlencode($user->get_email()));
            exit(); // Make sure to stop further execution after redirection
        }

        $userC->addUser($user);
        $success_message = "Account created successfully!";
        header('Location: ../../../View/front_office/Sign In & Sign Up/authentication-login.php?success_global=' . urlencode($success_message) . '&user_name_email=' . urlencode($user->get_user_name()));
        exit(); // Make sure to stop further execution after redirection
    } else {
        // returning an error
        $error_message = "Failed to create account. Please try again later.";
        header('Location: ../../../View/front_office/Sign In & Sign Up/authentication-login.php?error_global=' . urlencode($error_message));
        exit(); // Make sure to stop further execution after redirection
    }
}


?>