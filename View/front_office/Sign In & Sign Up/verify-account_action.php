<?php

include '../../../Controller/user_con.php';

// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

    $current_reset_code = trim($_POST['reset_code_inp']);

    // Retrieve and sanitize the error message
    $real_reset_code = htmlspecialchars($_SESSION['reset code']);
    #echo("gfg");
    // Clear the error message from the session after displaying it
    if ($current_reset_code == $real_reset_code){
        unset($_SESSION['reset code']);

        $userC = new userCon("user");
        $user_id = $_SESSION['user id']; // Set the user id in the session
        echo($user_id);

        $user_name_email = $userC->get_user_username_by_id($user_id);

        $userC->updateUserVerified($user_id, "true");
        header('Location: ../../../View/front_office/Sign In & Sign Up/authentication-login.php?user_name_email=' . urlencode($user_name_email));
        exit();
    }
    else{  
        unset($_SESSION['reset code']);
        $error_wrong_verification_code = "Incorrect verification code. Please try again.";
        header('Location: ../../../View/front_office/Sign In & Sign Up/forgot-password.php?error_verif_code=' . urlencode($error_wrong_verification_code) . '&user_name_email=' . urlencode($user_name_email));
        exit(); // Make sure to stop further execution after redirection
    }
    



?>