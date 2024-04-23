<?php
require_once __DIR__ . '/../../../../../Controls/subsFeaturesControls.php';

// Check if the request method is GET and if feature_id is set in the URL
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['feature_id'])) {
    // Retrieve the feature information from the database
    $id = $_GET['feature_id'];

    // Create an instance of the controller
    $featController = new SubsFeaturesControls();

    // Get the feature details by ID
    $features = $featController->getFeatureById($id);

    // Check if features are available
    if ($features) {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title>Update Feature</title>
            <link rel="shortcut icon" type="image/png" href="../../../assets/images/logos/HireUp_icon.ico" />
            <link rel="stylesheet" href="../../../assets/css/styles.min.css" />
        </head>

        <body>
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
                                <!-- Sidebar items -->
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
                        <!-- Header content -->
                    </header>
                    <!--  Header End -->
                    <div class="container-fluid">
                        <div class="container-fluid">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title fw-semibold mb-4" style="font-size: xx-large;"><a class="ti ti-edit" style="color: #212529;"></a>Update Feature</h2>
                                    <hr><br>
                                    <!-- Form for updating feature -->
                                    <form id="featForm" action="./update_Feat.php" method="POST">
                                        <div class="mb-3">
                                            <label for="feature_id" class="form-label">Feature ID *</label>
                                            <input type="text" class="form-control" id="feature_id" name="feature_id" value="<?php echo isset($features['feature_id']) ? $features['feature_id'] : ''; ?>" readonly />
                                        </div>
                                        <div class="mb-3">
                                            <label for="feature_name" class="form-label">Feature Name *</label>
                                            <input type="text" class="form-control" id="feature_name" name="feature_name" placeholder="Enter Feature Name" value="<?php echo isset($features['feature_name']) ? $features['feature_name'] : ''; ?>" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Feature Description *</label>
                                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Description"><?php echo isset($features['description']) ? $features['description'] : ''; ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="plan_name" class="form-label">Subscription Feature</label>
                                            <select class="form-select" id="plan_name" name="plan_name" required>
                                                <option value="" selected disabled>Select Subscription Feature</option>
                                                <?php // Get subscription options and set selected option
                                                echo $featController->generateSubsOptionsUpdate(isset($features['subscription_id']) ? $features['subscription_id'] : '');
                                                ?>
                                            </select>
                                        </div>
                                        <!-- Submit Button -->
                                        <button type="submit" id="submit_button" class="btn btn-primary" style="font-size: x-large;">
                                            <a class="ti ti-plus text-white"></a>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scripts -->
            <script src="../../../assets/libs/jquery/dist/jquery.min.js"></script>
            <script src="../../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
            <script src="../../../assets/js/sidebarmenu.js"></script>
            <script src="../../../assets/js/app.min.js"></script>
            <script src="../../../assets/libs/simplebar/dist/simplebar.js"></script>
            <script src="../../../assets/js/finition.js"></script>
        </body>

        </html>
<?php
    } else {
        // Handle case where features are not found or null
        echo "Feature not found or null";
    }
} else {
    // Handle invalid request method or missing feature_id in URL
    echo "Invalid request";
}
?>