<?php
require_once __DIR__ . '/../../../../Controls/subscriptionControls.php';


// Check if the request method is GET and if id_emp is set in the URL
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['subscription_id'])) {
    // Retrieve the subscriptions information from the database
    $id = $_GET['subscription_id'];

    // Create an instance of the controller
    $subsController = new SubscriptionControls();

    // Get the subscriptions details by ID
    $subscriptions = $subsController->getSubscriptionById($id);

    // Check if profile is set and not null
    if ($subscriptions) {
        // subscriptions details are available, proceed with displaying the form
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title>Update Profile</title>
            <link rel="shortcut icon" type="image/png" href="../../assets/images/logos/HireUp_icon.ico" />
            <link rel="stylesheet" href="../../assets/css/styles.min.css" />

        </head>

        <body>
            <!--  Body Wrapper -->
            <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
                <!-- Sidebar Start -->
                <aside class="left-sidebar">
                    <!-- Sidebar scroll-->
                    <div>
                        <div class="brand-logo d-flex align-items-center justify-content-between">
                            <a title="#" href="../../index.html" class="text-nowrap logo-img">
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
                                    <a class="sidebar-link" href="../../index.html" aria-expanded="false">
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
                                    <a class="sidebar-link" href="../../interface/job_management.html" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-user"></i>
                                        </span>
                                        <span class="hide-menu">User</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="../profile_management.php" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-user-circle"></i>
                                        </span>
                                        <span class="hide-menu">Profile</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="../../interface/job_management.html" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-tie"></i>
                                        </span>
                                        <span class="hide-menu">Jobs</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="../../interface/job_management.html" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-message"></i>
                                        </span>
                                        <span class="hide-menu">Messages</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="../../interface/job_management.html" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-article"></i>
                                        </span>
                                        <span class="hide-menu">Article</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="../../interface/job_management.html" aria-expanded="false">
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
                                    <a class="sidebar-link" href="../../interface/authentication-login.html" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-login"></i>
                                        </span>
                                        <span class="hide-menu">Login</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="../../interface/authentication-register.html" aria-expanded="false">
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
                                            <img src="../../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle" />
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
                                    <h2 class="card-title fw-semibold mb-4" style="font-size: xx-large;"><a class="ti ti-edit" style="color: #212529;"></a>Update <?php echo $subscriptions['plan_name'] ?> Subscription</h2>
                                    <hr><br>
                                    <!-- Form for adding new subscription -->
                                    <form id="subsForm" action="./update_Subs.php" method="POST">
                                        <!-- Login Information -->
                                        <div class="mb-3">
                                            <label for="subscription_id" class="form-label">Subscription ID *</label>
                                            <input type="text" class="form-control" id="subscription_id" name="subscription_id" value="<?php echo isset($subscriptions['subscription_id']) ? $subscriptions['subscription_id'] : ''; ?>" readonly />
                                        </div>
                                        <div class="mb-3">
                                            <label for="plan_name" class="form-label">Plan Name *</label>
                                            <input type="text" class="form-control" id="plan_name" name="plan_name" placeholder="Enter Plan Name" value="<?php echo isset($subscriptions['plan_name']) ? $subscriptions['plan_name'] : ''; ?>" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="duration" class="form-label">Duration *</label>
                                            <input type="text" class="form-control" id="duration" name="duration" placeholder="Enter Duration" value="<?php echo isset($subscriptions['duration']) ? $subscriptions['duration'] : ''; ?>" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Price</label>
                                            <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price" value="<?php echo isset($subscriptions['price']) ? $subscriptions['price'] : ''; ?>" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="card" class="form-label">Card Type</label>
                                            <select class="form-select" id="card" name="card">
                                                <option value="" selected disabled>Select Card Type</option>
                                                <option value="basic" <?php echo isset($subscriptions['card']) && strtolower($subscriptions['card']) === 'basic' ? 'selected' : ''; ?>>Basic</option>
                                                <option value="advanced" <?php echo isset($subscriptions['card']) && strtolower($subscriptions['card']) === 'advanced' ? 'selected' : ''; ?>>Advanced</option>
                                                <option value="premium" <?php echo isset($subscriptions['card']) && strtolower($subscriptions['card']) === 'premium' ? 'selected' : ''; ?>>Premium</option>
                                                <option value="limited" <?php echo isset($subscriptions['card']) && strtolower($subscriptions['card']) === 'limited' ? 'selected' : ''; ?>>Limited</option>
                                                <option value="sale" <?php echo isset($subscriptions['card']) && strtolower($subscriptions['card']) === 'sale' ? 'selected' : ''; ?>>Sale</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="subscription_status" class="form-label">Status</label>
                                            <select class="form-select" id="subscription_status" name="subscription_status">
                                                <option value="" selected disabled>Select Status</option>
                                                <option value="active" <?php echo isset($subscriptions['subscription_status']) && strtolower($subscriptions['subscription_status']) === 'active' ? 'selected' : ''; ?>>Active</option>
                                                <option value="inactive" <?php echo isset($subscriptions['subscription_status']) && strtolower($subscriptions['subscription_status']) === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                                <option value="pending" <?php echo isset($subscriptions['subscription_status']) && strtolower($subscriptions['subscription_status']) === 'pending' ? 'selected' : ''; ?>>Pending</option>
                                                <option value="expired" <?php echo isset($subscriptions['subscription_status']) && strtolower($subscriptions['subscription_status']) === 'expired' ? 'selected' : ''; ?>>Expired</option>
                                                <option value="suspended" <?php echo isset($subscriptions['subscription_status']) && strtolower($subscriptions['subscription_status']) === 'suspended' ? 'selected' : ''; ?>>Suspended</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="3"><?php echo isset($subscriptions['description']) ? $subscriptions['description'] : ''; ?></textarea>
                                        </div><br>


                                        <!-- Submit Button -->
                                        <button type="submit" id="submit_button" class="btn btn-primary" style="font-size: x-large;">
                                            <span class="ti ti-plus text-white"></span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
            <script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
            <script src="../../assets/js/sidebarmenu.js"></script>
            <script src="../../assets/js/app.min.js"></script>
            <script src="../../assets/libs/simplebar/dist/simplebar.js"></script>
            <script src="../../assets/js/finition.js"></script>

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