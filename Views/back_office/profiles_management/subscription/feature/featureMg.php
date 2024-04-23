<?php

require_once __DIR__ . '/../../../../../Controls/subscriptionControls.php';
require_once __DIR__ . '/../../../../../Controls/subsFeaturesControls.php';

$subsController = new SubscriptionControls();

$feat = new SubsFeaturesControls();

//test
$test = '924714';

$Subscriptions = $subsController->getAllSubscriptions();
$Features = $feat->getAllFeatures();
$Subs_options = $feat->generateSubsOptions();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>HireUp Dashboard</title>
    <link rel="shortcut icon" type="image/png" href="../../../assets/images/logos/HireUp_icon.ico" />
    <link rel="stylesheet" id="stylesheet" href="../../../assets/css/styles.min.css" />

    <link rel="stylesheet" href="../../../assets/css/phone.css">

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

        #featuresModalBody p {
            font-size: large;
        }
    </style>
</head>

<body>
    <script>
        //toggle add subs form
        function toggleFormVisibility() {
            var form = document.getElementById('addFeatForm');
            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }
    </script>

    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a title="#" href="../../../index.html" class="text-nowrap logo-img">
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
                            <a class="sidebar-link" href="../../../index.html" aria-expanded="false">
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
                            <a class="sidebar-link" href="../../../interface/job_management.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user"></i>
                                </span>
                                <span class="hide-menu">User</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="../../profile_management.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user-circle"></i>
                                </span>
                                <span class="hide-menu">Profile</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="../../../interface/job_management.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-tie"></i>
                                </span>
                                <span class="hide-menu">Jobs</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="../../../interface/job_management.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-message"></i>
                                </span>
                                <span class="hide-menu">Messages</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="../../../interface/job_management.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Article</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="../../../interface/job_management.html" aria-expanded="false">
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
                            <a class="sidebar-link" href="../../../interface/authentication-login.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-login"></i>
                                </span>
                                <span class="hide-menu">Login</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="../../../interface/authentication-register.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user-plus"></i>
                                </span>
                                <span class="hide-menu">Register</span>
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
                                    <img src="../../../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle" />
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="../../../../front_office/profiles_management/profile.php?profile_id=<?php echo $test ?>" class="d-flex align-items-center gap-2 dropdown-item">
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
                                        <a href="../../interface/authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
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
                            <h2 class="card-title fw-semibold mb-4" style="font-size: xx-large;">Features Management</h2>
                            <hr><br>

                            <!-- Button with an icon and a form below it -->
                            <button type="button" id="toggleFormButton" class="btn btn-primary mb-3" style="font-size: large;" onclick="toggleFormVisibility()">
                                <i class="ti ti-user-plus me-2"></i>Add Feature
                            </button>
                            <br>
                            <hr>
                            <div id="addFeatForm" style="display: none;">
                                <!-- Form for adding new subscription -->
                                <form id="featForm" action="./addFeat.php" method="POST">
                                    <!-- Login Information -->
                                    <div class="mb-3">
                                        <label for="feature_name" class="form-label">Feature Name *</label>
                                        <input type="text" class="form-control" id="feature_name" name="feature_name" placeholder="Enter Feature Name" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Feature Description *</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Description"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="plan_name" class="form-label">Subscription Feature</label>
                                        <select class="form-select" id="plan_name" name="plan_name" required>
                                            <option value="" selected disabled>Select Subscription Feature</option>
                                            <?php echo $Subs_options; ?>
                                        </select>
                                    </div>
                                    <br>

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
                                    <input type="text" class="form-control mb-3" id="searchInput" placeholder="Search Subscriptions...">
                                </div>
                                <div class="col-md-6 text-end">
                                    <!-- Filter button -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sortModal">Filter</button>
                                </div>
                            </div>
                            <hr>

                            <!-- Table for displaying existing subscriptions -->

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
                                                <h6 class="fw-semibold mb-0">Subscription</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Name</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Description</h6>
                                            </th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody id="featTableBody">
                                        <?php foreach ($Features as $Feat) : ?>
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <button type="button" style="font-size: medium;" class="btn btn-primary btn-sm me-2" onclick="window.location.href='./updateFeat.php?feature_id=<?php echo $Feat['feature_id']; ?>'"><a class="ti ti-edit text-white"></a></button>
                                                    <button type="button" style="font-size: medium;" class="btn btn-danger btn-sm" onclick="window.location.href='./deleteFeat.php?feature_id=<?php echo $Feat['feature_id']; ?>'"><a class="ti ti-x text-white"></a></button>
                                                </td>

                                                <td><?php echo isset($Feat['feature_id']) ? $Feat['feature_id'] : ''; ?></td>
                                                <td><?php echo isset($Feat['subscription_id']) ? $Feat['subscription_id'] : ''; ?></td>
                                                <td><?php echo isset($Feat['feature_name']) ? $Feat['feature_name'] : ''; ?></td>
                                                <td><?php echo isset($Feat['description']) ? $Feat['description'] : ''; ?></td>

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
                                <h5 class="modal-title" id="sortModalLabel">Filter subscriptions</h5>
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

    <script src="../../../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/js/sidebarmenu.js"></script>
    <script src="../../../assets/js/app.min.js"></script>
    <script src="../../../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../../../assets/js/finition.js"></script>


    <script>
        // Listen for changes in the search input field
        document.getElementById('searchInput').addEventListener('input', function() {
            // Get the search query
            var query = this.value.trim();

            // Send the query to the server
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Update the table with the search results
                    document.getElementById('featTableBody').innerHTML = this.responseText;
                }
            };
            xhttp.open('GET', 'searchFeat.php?query=' + query, true);
            xhttp.send();
        });

    </script>

</body>

</html>