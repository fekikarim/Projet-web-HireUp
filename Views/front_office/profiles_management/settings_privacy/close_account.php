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

                #subtitle,
                #paragraph {
                    font-size: large;
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
                                                <a href="../profile.php?profile_id=<?php echo $profile['profile_id']; ?>" class="d-flex align-items-center gap-2 dropdown-item">
                                                    <i class="ti ti-user fs-6"></i>
                                                    <p class="mb-0 fs-3">My Profile</p>
                                                </a>
                                                <hr>

                                                <h6 class="dropdown-header">Account</h6>
                                                <a href="../profile-settings-privacy.php?profile_id=<?php echo $profile['profile_id']; ?>" class="d-flex align-items-center gap-2 dropdown-item">
                                                    <i class="ti ti-settings fs-6"></i>
                                                    <p class="mb-0 fs-3">Settings & Privacy</p>
                                                </a>
                                                <a href="#" class="d-flex align-items-center gap-2 dropdown-item">
                                                    <i class="ti ti-help fs-6"></i>
                                                    <p class="mb-0 fs-3">Help</p>
                                                </a>
                                                <a href="../language_settings.php?profile_id=<?php echo $profile['profile_id']; ?>"" class="d-flex align-items-center gap-2 dropdown-item">
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
                            <div class="card mb-3">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="mb-0">Close Account</h5>
                                        </div>
                                        <div>
                                            <a href="javascript:history.go(-1);" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="mb-4" id="subtitle"><b><?php echo $profile['profile_first_name']; ?></b>, we’re sorry to see you go</p>
                                    <p class="mb-4" id="paragraph">Are you sure you want to close your account? You’ll lose your connections, messages, endorsements, and recommendations.</p>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationModal">Continue</button>
                                </div>
                            </div>

                            <!-- Confirmation Modal -->
                            <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Before deleting your account:</p>
                                            <p>Your account will be archived for 30 days in the database before it is permanently deleted.</p>
                                            <p>Are you sure you want to proceed?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <a type="button" id="deleteAccountBtn" class="btn btn-danger">Delete Account</a>
                                        </div>
                                    </div>
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
                document.getElementById("deleteAccountBtn").addEventListener("click", function() {            
                    window.location.href = "./delete_account.php?profile_id=<?php echo $profile['profile_id']; ?>";                    
                });
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