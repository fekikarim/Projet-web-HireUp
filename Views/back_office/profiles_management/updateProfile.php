<?php
require_once __DIR__ . '/../../../Controls/profileController.php';


// Check if the request method is GET and if id_emp is set in the URL
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['profile_id'])) {
  // Retrieve the profilee information from the database
  $id = $_GET['profile_id'];

  // Create an instance of the controller
  $profileController = new ProfileC();

  // Get the profilee details by ID
  $profile = $profileController->getProfileById($id);

  // Check if profile is set and not null
  if ($profile) {
    // profilee details are available, proceed with displaying the form
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>Update Profile</title>
      <link rel="shortcut icon" type="image/png" href="../assets/images/logos/HireUp_icon.ico" />
      <link rel="stylesheet" href="../assets/css/styles.min.css" />

      <style>
        /* Style for profile picture container */
        .profile-picture-container {
          width: 200px;
          height: 200px;
          border-radius: 50%;
          overflow: hidden;
          border: 4px solid #fff;
          /* White border */
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          /* Shadow effect */
          margin: auto;
          /* Center the container */
        }

        /* Style for profile cover container */
        .profile-cover-container {
          width: 100%;
          height: 200px;
          /* Adjust height as needed */
          overflow: hidden;
          border-radius: 10px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          /* Shadow effect */
        }

        /* Style for profile cover image */
        .profile-cover-image {
          width: 100%;
          height: 100%;
          object-fit: cover;
        }

        /* Style for hidden profile photo and cover container */
        .hidden-profile-pic-container {
          width: 200px;
          height: 200px;
          border-radius: 50%;
          overflow: hidden;
          border: 4px solid #fff;
          /* White border */
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          /* Shadow effect */
          margin: auto;
          /* Center the container */
        }

        /* Style for profile cover container */
        .hidden-profile-cover-container {
          width: 100%;
          height: 200px;
          /* Adjust height as needed */
          overflow: hidden;
          border-radius: 10px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          /* Shadow effect */
        }

        /* Style for hidden profile image */
        .hidden-profile-image {
          width: 100%;
          height: 100%;
          object-fit: cover;
        }
      </style>
    </head>

    <body>
      <!--  Body Wrapper -->
      <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
          <!-- Sidebar scroll-->
          <div>
            <div class="brand-logo d-flex align-items-center justify-content-between">
              <a title="#" href="../index.html" class="text-nowrap logo-img">
                <img class="logo-img" alt="" />
              </a>
              <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
              </div>
            </div>

            <!-- Sidebar navigation-->
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
              <ul id="sidebarnav">
                <li class="nav-small-cap">
                  <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                  <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="../index.html" aria-expanded="false">
                    <span>
                      <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Dashboard</span>
                  </a>
                </li>
                <li class="nav-small-cap">
                  <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                  <span class="hide-menu">MENU</span>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="../interface/job_management.html" aria-expanded="false">
                    <span>
                      <i class="ti ti-user"></i>
                    </span>
                    <span class="hide-menu">User</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="profile_management.php" aria-expanded="false">
                    <span>
                      <i class="ti ti-user-circle"></i>
                    </span>
                    <span class="hide-menu">Profile</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="../interface/job_management.html" aria-expanded="false">
                    <span>
                      <i class="ti ti-tie"></i>
                    </span>
                    <span class="hide-menu">Jobs</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="../interface/job_management.html" aria-expanded="false">
                    <span>
                      <i class="ti ti-message"></i>
                    </span>
                    <span class="hide-menu">Messages</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="../interface/job_management.html" aria-expanded="false">
                    <span>
                      <i class="ti ti-article"></i>
                    </span>
                    <span class="hide-menu">Article</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="../interface/job_management.html" aria-expanded="false">
                    <span>
                      <i class="ti ti-analyze"></i>
                    </span>
                    <span class="hide-menu">FeedBack</span>
                  </a>
                </li>
                <li class="nav-small-cap">
                  <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                  <span class="hide-menu">AUTH</span>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="../interface/authentication-login.html" aria-expanded="false">
                    <span>
                      <i class="ti ti-login"></i>
                    </span>
                    <span class="hide-menu">Login</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="../interface/authentication-register.html" aria-expanded="false">
                    <span>
                      <i class="ti ti-user-plus"></i>
                    </span>
                    <span class="hide-menu">Register</span>
                  </a>
                </li>
                <li class="nav-small-cap">
                  <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                  <span class="hide-menu">EXTRA</span>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="../interface/job_management.html" aria-expanded="false">
                    <span>
                      <i class="ti ti-mood-happy"></i>
                    </span>
                    <span class="hide-menu">Icons</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="../interface/job_management.html" aria-expanded="false">
                    <span>
                      <i class="ti ti-aperture"></i>
                    </span>
                    <span class="hide-menu">Sample Page</span>
                  </a>
                </li>
              </ul>
            </nav>
            <!-- End Sidebar navigation -->
          </div>
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
          <!--  Header Start -->
          <header class="app-header">
            <nav class="navbar navbar-expand-lg navbar-light">
              <ul class="navbar-nav">
                <li class="nav-item d-block d-xl-none">
                  <a title="#" class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                  </a>
                </li>
                <li class="nav-item">
                  <a title="#" class="nav-link nav-icon-hover" href="javascript:void(0)">
                    <i class="ti ti-bell-ringing"></i>
                    <div class="notification bg-primary rounded-circle"></div>
                  </a>
                </li>
              </ul>
              <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                  <a title="#" href="profile_management.php" target="_blank" class="btn btn-primary">Profile Management</a>
                  <li class="nav-item dropdown">
                    <a title="#" class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                      <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                      <div class="message-body">
                        <a href="#" class="d-flex align-items-center gap-2 dropdown-item">
                          <i class="ti ti-user fs-6"></i>
                          <p class="mb-0 fs-3">My Profile</p>
                        </a>
                        <a href="#" class="d-flex align-items-center gap-2 dropdown-item">
                          <i class="ti ti-mail fs-6"></i>
                          <p class="mb-0 fs-3">My Account</p>
                        </a>
                        <a href="#" class="d-flex align-items-center gap-2 dropdown-item">
                          <i class="ti ti-list-check fs-6"></i>
                          <p class="mb-0 fs-3">My Task</p>
                        </a>
                        <a class="d-flex align-items-center gap-2 dropdown-item" href="#">
                          <i class="ti ti-settings fs-6"></i>
                          <p class="mb-0 fs-3">Settings</p>
                        </a>
                        <a href="">
                          <label class="d-flex align-items-center gap-2 dropdown-item" for="darkModeToggle">
                            <div class="form-check form-switch">
                              <input class="form-check-input" type="checkbox" id="darkModeToggle">
                            </div>
                            <p class="mb-0 fs-3">Appearance</p>
                          </label>
                        </a>
                        <a href="../interface/authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </nav>
          </header>
          <!--  Header End -->
          <div class="container-fluid">
            <div class="container-fluid">
              <div class="card">
                <div class="card-body">
                  <h2 class="card-title fw-semibold mb-4" style="font-size: xx-large;"><a class="ti ti-edit" style="color: #212529;"></a>Update Profile</h2>
                  <hr><br>
                  <!-- Form for adding new profile -->
                  <form id="profileForm" action="update.php" method="POST" enctype="multipart/form-data">
                    <!-- Login Information -->
                    <div class="mb-3">
                      <label for="firstName" class="form-label">Profile ID *</label>
                      <input type="text" class="form-control" id="profile_id" name="profile_id" value="<?php echo isset($profile['profile_id']) ? $profile['profile_id'] : ''; ?>" readonly />
                    </div>
                    <div class="mb-3">
                      <label for="firstName" class="form-label">First Name *</label>
                      <input type="text" class="form-control" id="profile_first_name" name="profile_first_name" value="<?php echo isset($profile['profile_first_name']) ? $profile['profile_first_name'] : ''; ?>" required />
                    </div>
                    <div class="mb-3">
                      <label for="familyName" class="form-label">Family Name *</label>
                      <input type="text" class="form-control" id="profile_family_name" name="profile_family_name" value="<?php echo isset($profile['profile_family_name']) ? $profile['profile_family_name'] : ''; ?>" required />
                    </div>

                    <!-- Profile Information -->
                    <div class="mb-3">
                      <label for="phoneNumber" class="form-label">Phone Number</label>
                      <input type="tel" class="form-control" id="profile_phone_number" name="profile_phone_number" value="<?php echo isset($profile['profile_phone_number']) ? $profile['profile_phone_number'] : ''; ?>" />
                    </div>
                    <div class="mb-3">
                      <label for="country" class="form-label">Country/Region</label>
                      <input type="text" class="form-control" id="profile_region" name="profile_region" value="<?php echo isset($profile['profile_region']) ? $profile['profile_region'] : ''; ?>" />
                    </div>
                    <div class="mb-3">
                      <label for="city" class="form-label">City</label>
                      <input type="text" class="form-control" id="profile_city" name="profile_city" value="<?php echo isset($profile['profile_city']) ? $profile['profile_city'] : ''; ?>" />
                    </div>
                    <div class="mb-3">
                      <label for="bio" class="form-label">Bio</label>
                      <textarea class="form-control" rows="3" id="profile_bio" name="profile_bio"><?php echo isset($profile['profile_bio']) ? $profile['profile_bio'] : ''; ?></textarea>
                    </div>
                    <div class="mb-3">
                      <label for="currentPosition" class="form-label">Current Position</label>
                      <input type="text" class="form-control" id="profile_current_position" name="profile_current_position" value="<?php echo isset($profile['profile_current_position']) ? $profile['profile_current_position'] : ''; ?>" />
                    </div>
                    <div class="mb-3">
                      <label for="education" class="form-label">Education</label>
                      <input type="text" class="form-control" id="profile_education" name="profile_education" value="<?php echo isset($profile['profile_education']) ? $profile['profile_education'] : ''; ?>" />
                    </div>
                    <div class="mb-3">
                      <label for="subscription" class="form-label">Subscription</label>
                      <select class="form-select" id="profile_subscription" name="profile_subscription" required>
                        <option value="">Select Subscription status</option>
                        <option value="Basic" <?php echo isset($profile['profile_subscription']) && strtolower($profile['profile_subscription']) === 'basic' ? 'selected' : ''; ?>>Basic</option>
                        <option value="Advanced" <?php echo isset($profile['profile_subscription']) && strtolower($profile['profile_subscription']) === 'advanced' ? 'selected' : ''; ?>>Advanced</option>
                        <option value="Premium" <?php echo isset($profile['profile_subscription']) && strtolower($profile['profile_subscription']) === 'premium' ? 'selected' : ''; ?>>Premium</option>
                      </select>
                    </div>

                    <div class="mb-3">
                      <label for="authType" class="form-label">Authentication Type *</label>
                      <select id="profile_auth" name="profile_auth" class="form-select" required>
                        <option value="">Select verification Type</option>
                        <option value="Login Credentials" <?php echo isset($profile['profile_auth']) && strtolower($profile['profile_auth']) === 'login credentials' ? 'selected' : ''; ?>>Login Credentials</option>
                        <option value="Social Login" <?php echo isset($profile['profile_auth']) && strtolower($profile['profile_auth']) === 'social login' ? 'selected' : ''; ?>>Social Login</option>
                        <option value="Multi-Factor Authentication (MFA)" <?php echo isset($profile['profile_auth']) && strtolower(str_replace(['-', '(', ')'], '', $profile['profile_auth'])) === 'multifactor authentication mfa' ? 'selected' : ''; ?>>Multi-Factor Authentication (MFA)</option>

                      </select>
                    </div>

                    <div class="mb-3">
                      <label for="accountVerification" class="form-label">Account Verification *</label>
                      <select class="form-select" id="profile_acc_verif" name="profile_acc_verif" required>
                        <option value="">Select verification status</option>
                        <option value="Verified" <?php echo isset($profile['profile_acc_verif']) && strtolower($profile['profile_acc_verif']) === 'verified' ? 'selected' : ''; ?>>Verified</option>
                        <option value="Pending" <?php echo isset($profile['profile_acc_verif']) && strtolower($profile['profile_acc_verif']) === 'pending' ? 'selected' : ''; ?>>Pending</option>
                        <option value="Rejected" <?php echo isset($profile['profile_acc_verif']) && strtolower($profile['profile_acc_verif']) === 'rejected' ? 'selected' : ''; ?>>Rejected</option>
                      </select>
                    </div><br>
                    <hr>


                    <!-- Profile picture container -->
                    <div class="profile-picture-container" id="profile_pic_display">
                      <!-- Output the profile photo with appropriate MIME type -->
                      <img src="data:image/jpeg;base64,<?php echo base64_encode($profile['profile_photo']); ?>" alt="Profile Photo" class="img-fluid">
                    </div>

                    <!-- Hidden profile photo container -->
                    <div class="hidden-profile-pic-container" id="hiddenProfilePhotoContainer" style="display: none;">
                      <img src="#" alt="Hidden Profile Photo" class="hidden-profile-image" id="hiddenProfilePhoto">
                    </div>

                    <!-- Add input field for profile photo -->
                    <div class="mb-3">
                      <label for="profile photo" class="form-label">Choose New Profile Photo</label>
                      <input type="file" class="form-control" id="profile_photo" name="profile_photo" onchange="handlePhotoChange(event)" accept="image/*">
                    </div><br>
                    <hr>

                    <!-- Hidden profile cover container -->
                    <div class="hidden-profile-cover-container" id="hiddenProfileCoverContainer" style="display: none;">
                      <img src="#" alt="Hidden Profile Cover" class="hidden-profile-image" id="hiddenProfileCover">
                    </div>

                    <!-- Profile cover container -->
                    <div class="profile-cover-container" id="profile_cover_display">
                      <!-- Output the profile cover with appropriate MIME type -->
                      <img src="data:image/jpeg;base64,<?php echo base64_encode($profile['profile_cover']); ?>" alt="Profile Cover" class="img-fluid profile-cover-image">
                    </div><br>

                    <!-- Add input field for profile cover -->
                    <div class="mb-3">
                      <label for="profile cover" class="form-label">Choose New Profile Cover</label>
                      <input type="file" class="form-control" id="profile_cover" name="profile_cover" onchange="handleCoverChange(event)" accept="image/*">
                    </div><br>


                    <!-- Submit Button -->
                    <button type="submit" id="submit_button" class="btn btn-primary">
                      Update Profile
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
      <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <script src="../assets/js/sidebarmenu.js"></script>
      <script src="../assets/js/app.min.js"></script>
      <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
      <script src="../assets/js/finition.js"></script>

      <!-- JavaScript to handle file input change events -->
      <script>
        // Function to handle file input change for profile photo
        function handlePhotoChange(event) {
          const file = event.target.files[0];
          const reader = new FileReader();

          reader.onload = function(e) {
            const profilePhoto = document.getElementById('profile_pic_display');
            const hiddenProfilePhotoContainer = document.getElementById('hiddenProfilePhotoContainer');

            // Set the source of hidden profile photo
            document.getElementById('hiddenProfilePhoto').src = e.target.result;

            // Show the hidden profile photo container and hide the displayed photo
            profilePhoto.style.display = 'none';
            hiddenProfilePhotoContainer.style.display = 'block';
          };

          reader.readAsDataURL(file);
        }

        // Function to handle file input change for profile cover
        function handleCoverChange(event) {
          const file = event.target.files[0];
          const reader = new FileReader();

          reader.onload = function(e) {
            const profileCover = document.getElementById('profile_cover_display');
            const hiddenProfileCoverContainer = document.getElementById('hiddenProfileCoverContainer');

            // Set the source of hidden profile cover
            document.getElementById('hiddenProfileCover').src = e.target.result;

            // Show the hidden profile cover container and hide the displayed cover
            profileCover.style.display = 'none';
            hiddenProfileCoverContainer.style.display = 'block';
          };

          reader.readAsDataURL(file);
        }




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
              // Validation for phone number (you can add your specific validation logic here)
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

          // Append error message below the input field
          input.parentElement.appendChild(errorMessage);
        }

        // Function to show notification when mouse enters the input
        function showNotification(input) {
          // Check if the input belongs to the profile add form
          var parentForm = input.closest('#profileForm');
          if (parentForm) {
            var notification = document.createElement('div');
            notification.textContent = 'Please input ' + input.id.replace('profile_', '').replace('_', ' ') + '.';
            notification.classList.add('input-notification');
            input.parentElement.appendChild(notification);
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

<?php
  } else {
    // profilee not found or null, handle this case
    echo "profile not found or null";
  }
} else {
  // Invalid request, handle this case
  echo "Invalid request";
}
?>