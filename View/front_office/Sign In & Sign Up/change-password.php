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
                <form method="post" action="change_password_action.php">
                  <div class="mb-4">
                    <label for="user_password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="user_password" name="user_password">
                    <div id="user_password_error" style="color: red;"></div>
                  </div>
                  <div class="mb-4">
                    <label for="user_con_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="user_con_password" name="user_con_password">
                    <div id="user_con_password_error" style="color: red;"></div>
                  </div>
                  <input type="submit" id="verif_btn" name="verif reset code" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" value="Change Password" onclick="return change_password_verif();">
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
    // user name/email
    if (isset($_GET['error_verif_code'])) {
        // Retrieve and sanitize the error message
        $error = htmlspecialchars($_GET['error_verif_code']);
        // Inject the error message into the div element
        echo ("<script>document.getElementById('reset_code_error').innerText = '$error';</script>");
    }
    
  ?>
  
</body>

</html>