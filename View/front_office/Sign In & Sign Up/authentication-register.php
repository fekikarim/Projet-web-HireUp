<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HireUp Dashboard</title>
  <link rel="shortcut icon" type="image/png" href="../../../assets/images/logos/HireUp_icon.ico" />
  <link rel="stylesheet" href="../../../assets/css/styles.min.css" />

  <style>
    .logo-img {
      margin: 0 auto; /* Center the image horizontally */
      display: block; /* Ensure the link occupies full width */
    }
  </style>

</head>

<?php

include '../../../Controller/user_con.php';
include '../../../Model/user.php';

// Création d'une instance du contrôleur des événements
$userC = new userCon("user");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//MARK: important cz it checks if the user_id is set or not
if(isset($_SESSION['user id'])) {
    $user_id = htmlspecialchars($_SESSION['user id']);

    $user_banned = $userC->get_user_banned_by_id($user_id);

    if ($user_banned == "false"){

        $user_verified = $userC->get_user_verified_by_id($user_id);

        if ($user_verified == "true"){
            echo("Your verified ");
            echo("Welcome user id : " . $user_id);

            #header('Location: ../../../View/front_office/Sign In & Sign Up/authentication-login.php');
        }
        else{
            header('Location: ../../../View/front_office/Sign In & Sign Up/verify-account.php');
        }
    
    }
    else{
      header('Location: ../../../View/front_office/Sign In & Sign Up/banned.php');
    }

}

?>

<body>

  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a title="#" href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="../../../assets/images/logos/HireUp_lightMode.png" alt="" width="175" height="73">
                </a>
                <p class="text-center">Your Social Campaigns</p>
                <form method="post" action="./signup.php">
                  <div class="mb-3">
                    <label for="user_name" class="form-label">User Name</label>
                    <input type="text" class="form-control" id="user_name" name="user_name" aria-describedby="textHelp">
                    <div id="user_name_error" style="color: red;"></div>
                  </div>
                  <div class="mb-3">
                    <label for="user_email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="user_email" name="user_email" aria-describedby="emailHelp">
                    <div id="user_email_error" style="color: red;"></div>
                  </div>
                  <div class="mb-4">
                    <label for="user_password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="user_password" name="user_password">
                    <div id="user_password_error" style="color: red;"></div>
                  </div>
                  <div class="mb-4">
                    <label for="user_con_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="user_con_password" name="user_con_password">
                    <div id="user_con_password_error" style="color: red;"></div>
                  </div>
                  <input type="submit" id="login_btn" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" value="Sign Up" onclick="return sign_up_verif()">
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                    <a class="text-primary fw-bold ms-2" href="./authentication-login.php">Sign In</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../../../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  
  <script src="./SignIn_SignUp_js.js"></script>

  <!-- php error check -->
  <?php
    // Check if there's an error message in the URL
    // user name
    if (isset($_GET['error_user_name'])) {
        // Retrieve and sanitize the error message
        $error = htmlspecialchars($_GET['error_user_name']);
        // Inject the error message into the div element
        echo ("<script>document.getElementById('user_name_error').innerText = '$error';</script>");
    }

    // email
    if (isset($_GET['error_email'])) {
      // Retrieve and sanitize the error message
      $error = htmlspecialchars($_GET['error_email']);
      // Inject the error message into the div element
      echo "<script>document.getElementById('user_email_error').innerText = '$error';</script>";
    }

    // fill forms if data exists
    // user name
    if (isset($_GET['user_name'])) {
      // Retrieve and sanitize the error message
      $user_name = htmlspecialchars($_GET['user_name']);
      // Inject the error message into the div element
      echo ("<script>document.getElementById('user_name').value = '$user_name';</script>");
    }

    // email
    if (isset($_GET['email'])) {
      // Retrieve and sanitize the error message
      $email = htmlspecialchars($_GET['email']);
      // Inject the error message into the div element
      echo ("<script>document.getElementById('user_email').value = '$email';</script>");
    }
  ?>

</body>

</html>