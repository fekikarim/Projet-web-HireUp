<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/HireUp_profile/Controls/profileController.php';

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "add") {
  // Retrieve the profile information from the form
  $first_name = isset($_POST["profile_first_name"]) ? $_POST["profile_first_name"] : "";
  $family_name = isset($_POST["profile_family_name"]) ? $_POST["profile_family_name"] : "";
  $phone_number = isset($_POST["profile_phone_number"]) ? $_POST["profile_phone_number"] : "";
  $region = isset($_POST["profile_region"]) ? $_POST["profile_region"] : "";
  $city = isset($_POST["profile_city"]) ? $_POST["profile_city"] : "";
  $bio = "";
  $current_position = isset($_POST["profile_current_position"]) ? $_POST["profile_current_position"] : "";
  $education = isset($_POST["profile_education"]) ? $_POST["profile_education"] : "";
  $subscription = isset($_POST["profile_subscription"]) ? $_POST["profile_subscription"] : "";
  $auth = "";
  $acc_verif = "";
  $profile_photo_data = "";
  $profile_cover_data = "";

  // Create an instance of the controller
  $profileController = new ProfileC();

  // Generate profile ID
  $profile_id = $profileController->generateProfileId(6); // 6 is the length of the profile ID
  $userid = $profileController->generateProfileUserId(6); // 6 is the length of the profile ID

  // Add profile
  $result = $profileController->addProfile($profile_id, $first_name, $family_name, $userid, $phone_number, $region, $city, $bio, $current_position, $education, $subscription, $auth, $acc_verif, $profile_photo_data, $profile_cover_data);

  if ($result !== false) {
    // Redirect to profile page with profile ID as query parameter
    header('Location: profile.php?profile_id=' . $profile_id);
    exit();
  }
}
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile Register</title>
  <link rel="shortcut icon" type="image/png" href="../../back_office/assets/images/logos/HireUp_icon.ico" />
  <link rel="stylesheet" href="../../back_office/assets/css/styles.min.css" />

  <style>
    .logo-img {
      margin: 0 auto;
      /* Center the image horizontally */
      display: block;
      /* Ensure the link occupies full width */
    }
  </style>

</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-4">
            <div class="card mb-0">
              <a title="#" href="../../back_office/index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                <img src="../../back_office/assets/images/logos/HireUp_lightMode.png" alt="" width="175" height="73">
              </a>
              <form id="step1Form" method="post">
                <div class="card-body" id="step1">
                  <p class="text-center"><b>Step 1 of 2</b>: Personal Information</p>
                  <input type="hidden" name="action" value="add">
                  <div class="mb-3">
                    <label for="profile_first_name" class="form-label">First Name *</label>
                    <input type="text" class="form-control" id="profile_first_name" name="profile_first_name" placeholder="Enter first name" required />
                  </div>
                  <div class="mb-3">
                    <label for="profile_family_name" class="form-label">Family Name *</label>
                    <input type="text" class="form-control" id="profile_family_name" name="profile_family_name" placeholder="Enter family name" required />
                  </div>
                  <div class="mb-3">
                    <label for="profile_phone_number" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="profile_phone_number" name="profile_phone_number" placeholder="Enter phone number" />
                  </div>
                  <div class="mb-3">
                    <label for="profile_region" class="form-label">Country/Region</label>
                    <input type="text" class="form-control" id="profile_region" name="profile_region" placeholder="Enter country/region" />
                  </div>
                  <div class="mb-3">
                    <label for="profile_city" class="form-label">City</label>
                    <input type="text" class="form-control" id="profile_city" name="profile_city" placeholder="Enter city" />
                  </div>
                  <button type="button" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" onclick="showStep2()">Continue</button>
                </div>
                <div class="card-body d-none" id="step2">
                  <p class="text-center"><b>Step 2 of 2</b>: Additional Information</p>
                  <input type="hidden" name="action" value="add">
                  <div class="mb-3">
                    <label for="profile_current_position" class="form-label">Current Position</label>
                    <input type="text" class="form-control" id="profile_current_position" name="profile_current_position" placeholder="Enter current position" />
                  </div>
                  <div class="mb-3">
                    <label for="profile_education" class="form-label">Education</label>
                    <input type="text" class="form-control" id="profile_education" name="profile_education" placeholder="Enter education" />
                  </div>
                  <div class="mb-3">
                    <label for="profile_subscription" class="form-label">Subscription</label>
                    <select class="form-select" id="profile_subscription" name="profile_subscription" required>
                      <option value="">Select Subscription status</option>
                      <option value="basic">Basic</option>
                      <option value="advanced">Advanced</option>
                      <option value="premium">Premium</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-2 fs-4 mb-4 rounded-2">Confirm</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="../../back_office/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function showStep2() {
      document.getElementById('step1').classList.add('d-none'); // Hide step 1
      document.getElementById('step2').classList.remove('d-none'); // Show step 2
    }
  </script>
</body>

</html>