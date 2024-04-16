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

  <link rel="stylesheet" href="../../back_office/assets/css/phone.css">

  <!-- Add the intlTelInput CSS -->
  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

  <style>
    .logo-img {
      margin: 0 auto;
      /* Center the image horizontally */
      display: block;
      /* Ensure the link occupies full width */
    }

    /* Style for input fields with validation errors */
    .has-error input,
    .has-error select,
    .has-error textarea {
      border-color: #ff0000;
      /* Red border color */
    }

    /* Style for error messages */
    .error-message {
      color: #ff0000;
      /* Red text color */
      font-size: 12px;
      margin-top: 4px;
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
              <form id="profileForm" method="post">
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
                  <!-- Profile Information -->
                  <div class="mb-3">
                    <div class="select-box">
                      <label for="phoneNumber" class="form-label">Phone Number</label>
                      <div class="selected-option">
                        <div>
                          <span class="iconify" data-icon="flag:tn-4x3"></span>
                          <strong>+216</strong>
                        </div>
                        <input type="tel" class="form-control" id="profile_phone_number" name="profile_phone_number" value="<?php echo isset($profile['profile_phone_number']) ? $profile['profile_phone_number'] : ''; ?>" />
                      </div>
                      <div class="options">
                        <input type="text" id="search-box" name="search-box" class="form-control search-box" placeholder="Search Country Name">
                        <ol></ol>
                      </div>
                    </div>
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
                  <button type="submit" id="submit_button" class="btn btn-primary w-100 py-2 fs-4 mb-4 rounded-2">Confirm</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="../../back_office/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../back_office/assets/js/phone.js"></script>

  <script>
    function showStep2() {
      document.getElementById('step1').classList.add('d-none'); // Hide step 1
      document.getElementById('step2').classList.remove('d-none'); // Show step 2
    }



    // Function to enforce the format of phone number input
    function formatPhoneNumber(event) {
      // Get the input value and remove any non-digit characters
      var input = event.target;
      var phoneNumber = input.value.replace(/\D/g, '');

      // Format the phone number with the desired structure
      var formattedNumber = phoneNumber.match(/^(\d{3})(\d{2})(\d{3})$/);
      if (formattedNumber) {
        input.value = formattedNumber[1] + ' ' + formattedNumber[2] + ' ' + formattedNumber[3];
      }
    }

    // Add event listener to enforce the phone number format
    var phoneNumberInput = document.getElementById('profile_phone_number');
    phoneNumberInput.addEventListener('input', formatPhoneNumber);

    //############### CONTROLE DE SAISIE / INPUT CONTROL #########################

    // Initialize input controls when the page loads
    window.addEventListener("load", function() {
      // Initialize input controls
      initializeInputControls();

      // Disable submit button initially
      var submitButton = document.getElementById('submit_button');
      submitButton.disabled = true;
    });

    // Function to initialize input controls
    function initializeInputControls() {
      // Get all input elements
      var inputs = document.querySelectorAll('input, select, textarea');

      // Loop through each input element
      inputs.forEach(function(input) {
        // Add event listener for input change
        input.addEventListener('input', function() {
          validateInput(this); // Validate the input when it changes
          checkAllInputs(); // Check if all inputs are valid
        });

        // Add event listener for mouse enter
        input.addEventListener('mouseenter', function() {
          showNotification(this); // Show notification when mouse enters the input
        });

        // Add event listener for mouse leave
        input.addEventListener('mouseleave', function() {
          hideNotification(); // Hide notification when mouse leaves the input
        });
      });
    }

    // Function to validate input
    function validateInput(input) {
      // Remove any existing error styles
      input.classList.remove('has-error');
      var errorMessage = input.parentElement.querySelector('.error-message');
      if (errorMessage) {
        errorMessage.remove();
      }

      // Perform validation based on input type and rules
      var value = input.value.trim();
      var fieldName = input.id.replace('profile_', '').replace('_', ' ');

      // Validation rules for each input field
      switch (input.id) {
        case 'profile_first_name':
        case 'profile_family_name':
        case 'profile_region':
          if (!value || value.length < 2 || !/^[a-zA-Z ]+$/.test(value)) {
            displayError(input, fieldName + ' must be at least 2 characters and contain only alphabets.');
          }
          break;
        case 'profile_phone_number':
          break;
        case 'profile_city':
        case 'profile_current_position':
        case 'profile_education':
        case 'profile_bio':
          if (!value || value.length < 2) {
            displayError(input, fieldName + ' must be at least 2 characters.');
          }
          break;
          // Add more cases for other input fields as needed
      }
    }


    // Function to display error message and style the input
    function displayError(input, message) {
      // Add has-error class to the parent div
      input.classList.add('has-error');

      // Create error message element
      var errorMessage = document.createElement('div');
      errorMessage.classList.add('error-message');
      errorMessage.textContent = message;

      // Find the closest ancestor with class "mb-3"
      var mb3Div = input.closest('.mb-3');

      // Append error message below the "mb-3" div
      if (mb3Div) {
        mb3Div.appendChild(errorMessage);
      } else {
        // If "mb-3" div is not found, append error message below the input field
        input.parentElement.appendChild(errorMessage);
      }
    }


    // Function to show notification when mouse enters the input
    function showNotification(input) {
      // Check if the input belongs to the profile add form and is not the phone number input
      var parentForm = input.closest('#profileForm');
      if (parentForm) {
        var notification = document.createElement('div');
        notification.textContent = 'Please input ' + input.id.replace('profile_', '').replace('_', ' ') + '.';
        notification.classList.add('input-notification');

        // Get the parent div with class "mb-3" and append the notification
        var parentDiv = input.closest('.mb-3');
        parentDiv.appendChild(notification);
      }
    }



    // Function to hide notification when mouse leaves the input
    function hideNotification() {
      var notifications = document.querySelectorAll('.input-notification');
      notifications.forEach(function(notification) {
        notification.remove();
      });
    }

    // Function to check if all inputs are valid and enable/disable submit button accordingly
    function checkAllInputs() {
      var inputs = document.querySelectorAll('input, select, textarea');
      var isValid = true;

      inputs.forEach(function(input) {
        if (input.classList.contains('has-error')) {
          isValid = false;
        }
      });

      var submitButton = document.getElementById('submit_button');
      submitButton.disabled = !isValid;
    }
  </script>
</body>

</html>