<?php
require_once __DIR__ . '/../../../../Controls/profileController.php';


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
            <title>Settings & Privacy</title>
            <link rel="shortcut icon" type="image/png" href="../../../back_office/assets/images/logos/HireUp_icon.ico" />
            <link rel="stylesheet" href="../../../back_office/assets/css/styles.min.css" />

            <style>
                .card-btn {
                    background-color: transparent;
                    border: none;
                    outline: none;
                    cursor: pointer;
                    padding: 0;
                    margin-bottom: 5px;
                    width: 100%;
                    text-align: left;
                    font-size: 1rem;
                    color: inherit;
                }

                .card-btn:hover {
                    background-color: #f0f0f0;
                    /* Gray color on hover */
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
                            <a title="#" href="../../../back_office/index.html" class="text-nowrap logo-img">
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
                                    <span class="hide-menu">Settings</span>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link active" href="./profile-settings-privacy.php?profile_id=<?php echo $profile['profile_id']; ?>" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-user"></i>
                                        </span>
                                        <span class="hide-menu">Account Preferences</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="../../back_office/interface/job_management.html" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-lock"></i>
                                        </span>
                                        <span class="hide-menu">Sign In & Security</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="profile_management.php" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-eye"></i>
                                        </span>
                                        <span class="hide-menu">Visibility</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="../interface/job_management.html" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-shield"></i>
                                        </span>
                                        <span class="hide-menu">Data Privacy</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="../interface/job_management.html" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-layout-board"></i>
                                        </span>
                                        <span class="hide-menu">Advertising Data</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="../interface/job_management.html" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-bell-ringing"></i>
                                        </span>
                                        <span class="hide-menu">Notification</span>
                                    </a>
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

                            <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                                    <li class="nav-item dropdown">
                                        <a title="#" class="nav-link nav-icon-hover" href="#" id="drop2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="data:image/jpeg;base64,<?php echo base64_encode($profile['profile_photo']); ?>" alt="Profile Photo" width="35" height="35" class="rounded-circle" />
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                            <div class="message-body">
                                                <a href="./profile.php?profile_id=<?php echo $profile['profile_id']; ?>" class="d-flex align-items-center gap-2 dropdown-item">
                                                    <i class="ti ti-user fs-6"></i>
                                                    <p class="mb-0 fs-3">My Profile</p>
                                                </a>
                                                <hr>

                                                <h6 class="dropdown-header">Account</h6>
                                                <a href="./profile-settings-privacy.php?profile_id=<?php echo $profile['profile_id']; ?>" class="d-flex align-items-center gap-2 dropdown-item">
                                                    <i class="ti ti-settings fs-6"></i>
                                                    <p class="mb-0 fs-3">Settings & Privacy</p>
                                                </a>
                                                <a href="#" class="d-flex align-items-center gap-2 dropdown-item">
                                                    <i class="ti ti-help fs-6"></i>
                                                    <p class="mb-0 fs-3">Help</p>
                                                </a>
                                                <a href="#" class="d-flex align-items-center gap-2 dropdown-item">
                                                    <i class="ti ti-language fs-6"></i>
                                                    <p class="mb-0 fs-3">Language</p>
                                                </a>
                                                <hr>

                                                <h6 class="dropdown-header">Manage</h6>
                                                <a href="#" class="d-flex align-items-center gap-2 dropdown-item">
                                                    <i class="ti ti-activity fs-6"></i>
                                                    <p class="mb-0 fs-3">Posts & Activity</p>
                                                </a>
                                                <a href="#" class="d-flex align-items-center gap-2 dropdown-item">
                                                    <i class="ti ti-tie fs-6"></i>
                                                    <p class="mb-0 fs-3">Jobs</p>
                                                </a>
                                                <hr>

                                                <a href="../../back_office/interface/authentication-login.html" class="d-flex align-items-center gap-2 dropdown-item">
                                                    <i class="ti ti-logout fs-6"></i>
                                                    <p class="mb-0 fs-3">Sign Out</p>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                    </header>
                    <!--  Header End -->
                    <div class="container-fluid">
                        <div class="container-fluid">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title fw-semibold mb-4" style="font-size: xx-large;"><a class="ti ti-edit" style="color: #212529;"></a>Update Profile</h2>
                                    <hr><br>
                                    <!-- Form for adding new profile -->
                                    <form id="profileForm" action="./update.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" class="form-control" id="profile_id" name="profile_id" value="<?php echo isset($profile['profile_id']) ? $profile['profile_id'] : ''; ?>" readonly />
                                        <input type="hidden" class="form-control" id="profile_phone_number" name="profile_phone_number" value="<?php echo isset($profile['profile_phone_number']) ? $profile['profile_phone_number'] : ''; ?>" readonly />
                                        <input type="hidden" class="form-control" id="profile_subscription" name="profile_subscription" value="<?php echo isset($profile['profile_subscription']) ? $profile['profile_subscription'] : ''; ?>" readonly />
                                        <input type="hidden" class="form-control" id="profile_auth" name="profile_auth" value="<?php echo isset($profile['profile_auth']) ? $profile['profile_auth'] : ''; ?>" readonly />
                                        <input type="hidden" class="form-control" id="profile_acc_verif" name="profile_acc_verif" value="<?php echo isset($profile['profile_acc_verif']) ? $profile['profile_acc_verif'] : ''; ?>" readonly />

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
                                        </div><br>
                                        <hr>

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

            <script src="../../../back_office/assets/libs/jquery/dist/jquery.min.js"></script>
            <script src="../../../back_office/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
            <script src="../../../back_office/assets/js/sidebarmenu.js"></script>
            <script src="../../../back_office/assets/js/app.min.js"></script>
            <script src="../../../back_office/assets/libs/simplebar/dist/simplebar.js"></script>
            <script src="../../../back_office/assets/js/finition.js"></script>
            <script src="../../../theme.js"></script>

            <script>
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
                        case 'profile_city':
                        case 'profile_current_position':
                        case 'profile_education':
                            if (value.length < 2 || !/^[a-zA-Z ]+$/.test(value)) {
                                displayError(input, fieldName + ' must be at least 2 characters and contain only alphabets.');
                            }
                            break;
                        case 'profile_phone_number':
                            // Validation for phone number (you can add your specific validation logic here)
                            break;
                        case 'profile_bio':
                            if (value.length < 2) {
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