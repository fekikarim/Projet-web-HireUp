<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/HireUp_profile/Controls/profileController.php';

// Create an instance of the EmployeC class
$profileController = new ProfileC();

//tset
$test = '056972';

// Call the method to fetch the employees' data
$profiles = $profileController->listProfile();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>HireUp Dashboard</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/HireUp_icon.ico" />
  <link rel="stylesheet" id="styleshee  t" href="../assets/css/styles.min.css" />

  <link rel="stylesheet" href="../assets/css/phone.css">

  <!-- Add the intlTelInput CSS -->
  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

  <style>
    #scrollToTopBtn {
      display: none;
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 1000;
      opacity: 0;
      transition: opacity 0.3s ease;
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

    /* Add any additional styles for dark mode here */
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
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a title="#" class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="#">
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

              <li class="nav-item dropdown">
                <a title="#" class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle" />
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="../../front_office/profiles_management/profile.php?profile_id=<?php echo $test ?>" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
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
                    <a href="./authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
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
              <h2 class="card-title fw-semibold mb-4" style="font-size: xx-large;">Profile Management</h2>
              <hr><br>

              <!-- Button with an icon and a form below it -->
              <button id="toggleFormButton" class="btn btn-primary mb-3" style="font-size: large;">
                <i class="ti ti-user-plus me-2"></i>Add Profile
              </button><br>
              <hr>
              <div id="addProfileForm" style="display: none;">
                <!-- Form for adding new profile -->
                <form id="profileForm" action="addProfile.php" method="POST" enctype="multipart/form-data">
                  <!-- Login Information -->
                  <div class="mb-3">
                    <label for="firstName" class="form-label">First Name *</label>
                    <input type="text" class="form-control" id="profile_first_name" name="profile_first_name" placeholder="Enter first name" required />
                  </div>
                  <div class="mb-3">
                    <label for="familyName" class="form-label">Family Name *</label>
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
                    <label for="country" class="form-label">Country/Region</label>
                    <input type="text" class="form-control" id="profile_region" name="profile_region" placeholder="Enter country/region" />
                  </div>
                  <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="profile_city" name="profile_city" placeholder="Enter city" />
                  </div>
                  <div class="mb-3">
                    <label for="bio" class="form-label">Bio</label>
                    <textarea class="form-control" id="profile_bio" name="profile_bio" rows="3" placeholder="Enter bio"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="currentPosition" class="form-label">Current Position</label>
                    <input type="text" class="form-control" id="profile_current_position" name="profile_current_position" placeholder="Enter current position" />
                  </div>
                  <div class="mb-3">
                    <label for="education" class="form-label">Education</label>
                    <input type="text" class="form-control" id="profile_education" name="profile_education" placeholder="Enter education" />
                  </div>
                  <div class="mb-3">
                    <label for="subscription" class="form-label">Subscription</label>
                    <select class="form-select" id="profile_subscription" name="profile_subscription" required>
                      <option value="">Select Subscription status</option>
                      <option value="basic">Basic</option>
                      <option value="advenced">Advenced</option>
                      <option value="premium">Premium</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="authType" class="form-label">Authentication Type *</label>
                    <select class="form-select" id="profile_auth" name="profile_auth" required>
                      <option value="">Select verification Type</option>
                      <option value="login">Login Credentials</option>
                      <option value="social">Social Login</option>
                      <option value="multi">
                        Multi-Factor Authentication (MFA)
                      </option>
                    </select>
                  </div>

                  <!-- Admin Information -->
                  <div class="mb-3">
                    <label for="accountVerification" class="form-label">Account Verification *</label>
                    <select class="form-select" id="profile_acc_verif" name="profile_acc_verif" required>
                      <option value="">Select verification status</option>
                      <option value="verified">Verified</option>
                      <option value="pending">Pending</option>
                      <option value="rejected">Rejected</option>
                    </select>
                  </div>

                  <!-- Profile Photo -->
                  <div class="mb-3">
                    <label for="profile_photo" class="form-label">Profile Photo</label>
                    <input type="file" class="form-control" id="profile_photo" name="profile_photo" accept="image/*" />
                  </div>

                  <!-- Profile Cover Photo -->
                  <div class="mb-3">
                    <label for="profile_cover" class="form-label">Profile Cover Photo</label>
                    <input type="file" class="form-control" id="profile_cover" name="profile_cover" accept="image/*" />
                  </div><br>

                  <!-- Submit Button -->
                  <button type="submit" id="submit_button" class="btn btn-primary" style="font-size: x-large;">
                    <a class="ti ti-plus text-white"></a>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <button type="button" class="btn btn-success btn-sm me-2" id="scrollToTopBtn" style="font-size: large;"><a class="ti ti-arrow-up text-white"></a></button>

        <div class="container-fluid">
          <div class="card">
            <div class="card-body">

              <div class="row">
                <div class="col-md-6">
                  <!-- Search bar -->
                  <input type="text" class="form-control mb-3" id="searchInput" placeholder="Search profile...">
                </div>
                <div class="col-md-6 text-end">
                  <!-- Filter button -->
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sortModal">Filter</button>
                </div>
              </div>
              <hr>

              <!-- Table for displaying existing profiles -->

              <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                  <thead class="text-dark fs-4">
                    <tr>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Actions</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">ID</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">First Name</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Family Name</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Userid</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Phone Number</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Region</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">City</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Bio</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Current Position</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Education</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Subscription</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Authentication Type</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Account Verification</h6>
                      </th>
                    </tr>
                  </thead>
                  <tbody id="profileTableBody">
                    <?php foreach ($profiles as $profile) : ?>
                      <tr>
                        <td class="border-bottom-0">
                          <button type="button" style="font-size: medium;" class="btn btn-primary btn-sm me-2" onclick="window.location.href='./updateProfile.php?profile_id=<?php echo $profile['profile_id']; ?>'"><a class="ti ti-edit text-white"></a></button>
                          <button type="button" style="font-size: medium;" class="btn btn-danger btn-sm" onclick="window.location.href='./deleteProfile.php?profile_id=<?php echo $profile['profile_id']; ?>'"><a class="ti ti-x text-white"></a></button>
                        </td>
                        <td><?php echo isset($profile['profile_id']) ? $profile['profile_id'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_first_name']) ? $profile['profile_first_name'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_family_name']) ? $profile['profile_family_name'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_userid']) ? $profile['profile_userid'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_phone_number']) ? $profile['profile_phone_number'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_region']) ? $profile['profile_region'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_city']) ? $profile['profile_city'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_bio']) ? $profile['profile_bio'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_current_position']) ? $profile['profile_current_position'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_education']) ? $profile['profile_education'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_subscription']) ? $profile['profile_subscription'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_auth']) ? $profile['profile_auth'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_acc_verif']) ? $profile['profile_acc_verif'] : ''; ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>

        <!-- Filter Modal -->
        <div class="modal fade" id="sortModal" tabindex="-1" aria-labelledby="sortModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="sortModalLabel">Filter Profiles</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Subscription options -->
                <div class="mb-3">
                  <h6>Subscription</h6>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="basic" id="subscriptionBasic">
                    <label class="form-check-label" for="subscriptionBasic">
                      Basic
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="advanced" id="subscriptionAdvanced">
                    <label class="form-check-label" for="subscriptionAdvanced">
                      Advanced
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="premium" id="subscriptionPremium">
                    <label class="form-check-label" for="subscriptionPremium">
                      Premium
                    </label>
                  </div>
                </div>
                <!-- Authentication Type options -->
                <div class="mb-3">
                  <h6>Authentication Type</h6>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="login" id="authTypeLogin">
                    <label class="form-check-label" for="authTypeLogin">
                      Login Credentials
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="social" id="authTypeSocial">
                    <label class="form-check-label" for="authTypeSocial">
                      Social Login
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="multi" id="authTypeMulti">
                    <label class="form-check-label" for="authTypeMulti">
                      Multi-Factor Authentication (MFA)
                    </label>
                  </div>
                </div>
                <!-- Account Verification options -->
                <div class="mb-3">
                  <h6>Account Verification</h6>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="verified" id="accountVerified">
                    <label class="form-check-label" for="accountVerified">
                      Verified
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="notverified" id="accountNotVerified">
                    <label class="form-check-label" for="accountNotVerified">
                      Not Verified
                    </label>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Confirm</button>
              </div>
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
  <script src="../assets/js/phone.js"></script>


  <script>
    document.getElementById('toggleFormButton').addEventListener('click', function() {
      var form = document.getElementById('addProfileForm');
      if (form.style.display === 'none') {
        form.style.display = 'block';
      } else {
        form.style.display = 'none';
      }
    });

    // Listen for changes in the search input field
    document.getElementById('searchInput').addEventListener('input', function() {
      // Get the search query
      var query = this.value.trim();

      // Send the query to the server
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          // Update the table with the search results
          document.getElementById('profileTableBody').innerHTML = this.responseText;
        }
      };
      xhttp.open('GET', 'searchProfiles.php?query=' + query, true);
      xhttp.send();
    });


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