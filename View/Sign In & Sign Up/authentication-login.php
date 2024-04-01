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
                <form method="post" action="../Sign In & Sign Up/signin.php">
                  <div class="mb-3">
                    <label for="user_name" class="form-label">User Name/Email</label>
                    <input type="text" class="form-control" id="user_name" name="user_name" aria-describedby="emailHelp">
                    <div id="user_name_error" style="color: red;"></div>
                  </div>
                  <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="user_password" name="user_password">
                    <div id="user_password_error" style="color: red;"></div>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Remeber this Device
                      </label>
                    </div>
                    <a id="forgotPasswordLink" class="text-primary fw-bold" href="./forgot-password.php?user_name_email=" onclick="this.href += encodeURIComponent(document.getElementById('user_name').value); return forgot_password_verif();">Forgot Password ?</a>
                  </div>
                  <input type="submit" id="login_btn" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" value="Sign In" onclick="return sign_in_verif()">
                  <div class="mb-3" id="error_global" style="color: red; text-align: center;"></div>
                  <div class="mb-3" id="success_global" style="color: green; text-align: center;"></div>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">New to Modernize?</p>
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
  <script src="../../assets/libs/jquery/dist/jquery.min.js"></>
  <script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <script src="./SignIn_SignUp_js.js"></script>

  <!-- php error check -->
  <?php
    // Check if there's an error message in the URL
    // user name/email
    if (isset($_GET['error_user_name_email'])) {
        // Retrieve and sanitize the error message
        $error = htmlspecialchars($_GET['error_user_name_email']);
        // Inject the error message into the div element
        echo ("<script>document.getElementById('user_name_error').innerText = '$error';</script>");
    }

    // password
    if (isset($_GET['error_password'])) {
      // Retrieve and sanitize the error message
      $error = htmlspecialchars($_GET['error_password']);
      // Inject the error message into the div element
      echo ("<script>document.getElementById('user_password_error').innerText = '$error';</script>");
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

    // fill forms if data exists
    // user name/email
    if (isset($_GET['user_name_email'])) {
      // Retrieve and sanitize the error message
      $user_name_email = htmlspecialchars($_GET['user_name_email']);
      // Inject the error message into the div element
      echo ("<script>document.getElementById('user_name').value = '$user_name_email';</script>");
    }
    
  ?>
  
</body>

</html>