<?php
session_start();

/*
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}*/

// Check if profile ID is provided in the URL and is a positive integer
if (!isset($_GET['profile_id'])) {
    // Display a friendly message or redirect the user to a proper error page
    exit("Invalid profile ID provided");
}

// Include database connection and profile controller
require_once __DIR__ . '/../../../Controls/profileController.php';


// Initialize profile controller
$profileController = new ProfileC();

// Get profile ID from the URL
$profile_id = $_GET['profile_id'];

// Fetch profile data from the database
$profile = $profileController->getProfileById($profile_id);



// Check if profile data is retrieved successfully
if (!$profile) {
    // Display a friendly message or redirect the user to a proper error page
    exit("Profile data not found");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Settings & Privacy</title>
    <link rel="shortcut icon" type="image/png" href="../../back_office/assets/images/logos/HireUp_icon.ico" />
    <link rel="stylesheet" href="../../back_office/assets/css/styles.min.css" />

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
                    <a title="#" href="../../back_office/index.html" class="text-nowrap logo-img">
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

            <div class="container-fluid">
                <div class="container-fluid">
                    <!-- Cards start here -->
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Profile Information</h5>
                                    <hr>
                                    <button type="button" class="card-btn" onclick="redirectToProfileEdit()">Edit all profile details</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Display</h5>
                                    <hr>
                                    <button type="button" class="card-btn" onclick="redirectToAppearence()">Dark mode</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">General Preferences</h5>
                                    <hr>
                                    <button type="button" class="card-btn" onclick="redirectToLanguage()">Language</button>
                                    <button type="button" class="card-btn">Content language</button>
                                    <button type="button" class="card-btn">Sound effects</button>
                                    <button type="button" class="card-btn">Showing profile photos</button>
                                    <button type="button" class="card-btn">Feed preferences</button>
                                    <button type="button" class="card-btn">People you unfollowed</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Syncing Options</h5>
                                    <hr>
                                    <button type="button" class="card-btn">Sync calendar</button>
                                    <button type="button" class="card-btn">Sync contacts</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Subscriptions & Payments</h5>
                                    <hr>
                                    <button type="button" class="card-btn" onclick="redirectToSubs()">Upgrade for Free</button>
                                    <button type="button" class="card-btn" onclick="redirectToBilling()">View purchase history</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Account Management</h5>
                                    <hr>
                                    <button type="button" class="card-btn">Hibernate account</button>
                                    <button type="button" class="card-btn" onclick="redirectToProfileClose()">Close account</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of cards -->
                </div>
            </div>

        </div>

    </div>

    <script src="../../back_office/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../../back_office/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../back_office/assets/js/sidebarmenu.js"></script>
    <script src="../../back_office/assets/js/app.min.js"></script>
    <script src="../../back_office/assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../../back_office/assets/js/finition.js"></script>


    <script>
        function redirectToProfileEdit() {
            var profileId = getProfileIdFromUrl();
            var url = "./settings_privacy/edit-profile.php?profile_id=" + profileId;
            window.location.href = url;
        }

        function redirectToProfileClose() {
            var profileId = getProfileIdFromUrl();
            var url = "./settings_privacy/close_account.php?profile_id=" + profileId;
            window.location.href = url;
        }

        function redirectToLanguage() {
            var profileId = getProfileIdFromUrl();
            var url = "./settings_privacy/language_settings.php?profile_id=" + profileId;
            window.location.href = url;
        }

        function redirectToAppearence() {
            var profileId = getProfileIdFromUrl();
            var url = "./settings_privacy/appearance_settings.php?profile_id=" + profileId;
            window.location.href = url;
        }

        function redirectToSubs(){
            var profileId = getProfileIdFromUrl();
            var url = "./subscription/subscriptionCards.php?profile_id=" + profileId;
            window.location.href = url;
        }

        function redirectToBilling(){
            var profileId = getProfileIdFromUrl();
            var url = "./profile_billing.php?profile_id=" + profileId;
            window.location.href = url;
        }

        function getProfileIdFromUrl() {
            // Get the current URL
            var url = window.location.href;
            // Extract the profile_id parameter value from the URL
            var profileId = url.split('profile_id=')[1];
            // Return the extracted profile ID
            return profileId;
        }
    </script>

</body>

</html>