<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HireUp Dashboard</title>
  <link rel="shortcut icon" type="image/png" href="../../assets/images/logos/HireUp_icon.ico" />
  <link rel="stylesheet" href="../../assets/css/styles.min.css" />

  <style>
    .logo-img {
      margin: 0 auto; /* Center the image horizontally */
      display: block; /* Ensure the link occupies full width */

    }
  </style>

</head>

<?php

include '../../Controller/user_con.php';

  $error_msg = "";
  $success_msg = "";
  // user name/email
  if (isset($_GET['user_name_email'])) {

    // Retrieve and sanitize the error message
    $user_name_email = htmlspecialchars($_GET['user_name_email']);
    
    $userC = new userCon("user");
    $mail_sent_res = $userC->send_password_reset_code($user_name_email);

    if ($mail_sent_res == "wrong email"){
      $error_user_name_email = "This email is not registered. Would you like to sign up instead?";
      header('Location: ../../View/Sign In & Sign Up/authentication-login.php?error_user_name_email=' . urlencode($error_user_name_email) . '&user_name_email=' . urlencode($user_name_email));
      exit(); // Make sure to stop further execution after redirection
    }
    elseif ($mail_sent_res == "wrong user name"){
        $error_user_name_email = "This username is not registered. Would you like to sign up instead?";
        header('Location: ../../View/Sign In & Sign Up/authentication-login.php?error_user_name_email=' . urlencode($error_user_name_email) . '&user_name_email=' . urlencode($user_name_email));
        exit(); // Make sure to stop further execution after redirection
    }
    elseif ($mail_sent_res == "done"){
      $success_msg = "Email sent successfully!";
    }
    else {
      $error_msg = "Failed to send email. Please try again later.";
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
                  <img src="../../assets/images/logos/HireUp_lightMode.png" alt="" width="175" height="73">
                </a>
                <p class="text-center">Your Social Campaigns</p>
                <form method="post" action="verif_code.php?user_name_email=<?php echo htmlspecialchars($_GET['user_name_email']); ?>">
                  <div class="mb-3">
                    <label for="reset_code_inp" class="form-label">Verification Code</label>
                    <input type="text" class="form-control" id="reset_code_inp" name="reset_code_inp" aria-describedby="emailHelp">
                    <div id="reset_code_error" style="color: red;"></div>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <a class="text-primary fw-bold" href="#" onclick="window.location.reload();">Resend Code ?</a>
                  </div>
                  <input type="submit" id="verif_btn" name="verif reset code" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" value="Submit" onclick="return reset_code_verif();">
                  <div class="mb-3" id="error_global" style="color: red; text-align: center;"><?php echo($error_msg) ?></div>
                  <div class="mb-3" id="success_global" style="color: green; text-align: center;"><?php echo($success_msg) ?></div>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Not You?</p>
                    <a class="text-primary fw-bold ms-2" href="./authentication-register.php">Create an account</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <script src="./SignIn_SignUp_js.js"></script>

  <!-- php error check -->
  <?php
    // Check if there's an error message in the URL
    // user name/email
    if (isset($_GET['error_verif_code'])) {
        // Retrieve and sanitize the error message
        $error = htmlspecialchars($_GET['error_verif_code']);
        // Inject the error message into the div element
        echo ("<script>document.getElementById('reset_code_error').innerText = '$error';</script>");
    }

    //global error
    if (isset($_GET['error_global'])) {
      // Retrieve and sanitize the error message
      $error = htmlspecialchars($_GET['error_global']);
      // Inject the error message into the div element
      echo ("<script>document.getElementById('error_global').innerText = '$error';</script>");
    }

    //global success
    if (isset($_GET['success_global'])) {
      // Retrieve and sanitize the error message
      $error = htmlspecialchars($_GET['success_global']);
      // Inject the error message into the div element
      echo ("<script>document.getElementById('success_global').innerText = '$error';</script>");
    }
    
  ?>
  
</body>

</html>