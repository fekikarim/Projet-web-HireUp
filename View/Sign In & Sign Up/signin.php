<?php

include '../../Controller/user_con.php';
include '../../Model/user.php';

// Création d'une instance du contrôleur des événements
$userC = new userCon("user");

if (
    isset($_POST["user_name"]) &&
    isset($_POST["user_password"])
) {
    if (
        !empty($_POST['user_name']) &&
        !empty($_POST["user_password"])
    ) {
        
        $user_name_email = $_POST["user_name"];
        $password = $_POST["user_password"];

        if ($userC->isEmailOrUserName($user_name_email) == "email"){
            $res = $userC->verifLoginInfosByEmail($user_name_email, $password);
        }
        elseif ($userC->isEmailOrUserName($user_name_email) == "user name"){
            $res = $userC->verifLoginInfosByUserName($user_name_email, $password);
        }

        if ($res == "wrong email"){
            $error_user_name_email = "This email is not registered. Would you like to sign up instead?";
            header('Location: ../../View/Sign In & Sign Up/authentication-login.php?error_user_name_email=' . urlencode($error_user_name_email) . '&user_name_email=' . urlencode($user_name_email));
            exit(); // Make sure to stop further execution after redirection
        }
        elseif ($res == "wrong user name"){
            $error_user_name_email = "This username is not registered. Would you like to sign up instead?";
            header('Location: ../../View/Sign In & Sign Up/authentication-login.php?error_user_name_email=' . urlencode($error_user_name_email) . '&user_name_email=' . urlencode($user_name_email));
            exit(); // Make sure to stop further execution after redirection
        }

        elseif ($res == "wrong password"){
            $error_password = "Incorrect password. Please try again.";
            header('Location: ../../View/Sign In & Sign Up/authentication-login.php?error_password=' . urlencode($error_password) . '&user_name_email=' . urlencode($user_name_email));
            exit(); // Make sure to stop further execution after redirection
        }

        else{
            echo("Welcome user id : " . $res);
        }
 
    }
}


?>