<?php
session_start();

/*
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}*/

// Check if profile ID is provided in the URL
if (!isset($_GET['profile_id'])) {
    header('Location: ../pages/404.php');
    exit();
}

// Include database connection and profile controller
require_once __DIR__ . '/../../../../Controls/profileController.php';
require_once __DIR__ . '/../../../../Controls/subscriptionControls.php'; // Include SubscriptionControls

// Initialize profile controller
$profileController = new ProfileC();

// Initialize subscription controller
$subscriptionController = new SubscriptionControls();

// Get profile ID from the URL
$profile_id = $_GET['profile_id'];

// Fetch profile data from the database
$profile = $profileController->getProfileById($profile_id);

// Fetch all subscriptions from the database
$subscriptions = $subscriptionController->getAllSubscriptions();

// Check if profile data is retrieved successfully
if (!$profile) {
    header('Location: ../../pages/404.php');
    exit();
}

// Now you can use the fetched $subscriptions array to populate subscription cards in your HTML
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css'>
    <link rel="stylesheet" href="https://cdn.lineicons.com/3.0/lineicons.css">
    <link rel="stylesheet" href="../assets/css/subscriptionCards.css">

    <title>HireUp Subscriptions</title>

    <style>
        /* Style for the fixed-top class when scrolling */
        .navbar.fixed-top-scroll {
            position: sticky;
            top: 0;
            width: 100%;
            z-index: 1000;
            transition: top 0.3s;
        }

        /* Style for the navbar when scrolling */
        .navbar-scroll {
            top: -60px;
            /* Height of the navbar */
        }
    </style>

</head>

<body>
    <!-- Header Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top-scroll">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand ms-4" href="../../index.html">
                <img class="logo-img" alt="HireUp">
            </a>

            <!-- Profile Dropdown -->
            <div class="dropdown ms-auto">
                <a href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false" class="d-flex align-items-center justify-content-center mx-3" style="height: 100%;">
                    <img src="data:image/jpeg;base64,<?= base64_encode($profile['profile_photo']) ?>" alt="Profile Photo" class="rounded-circle" width="50" height="50">
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <h5 class="dropdown-header">Account</h5>
                    <li><a class="dropdown-item" href="../profile.php?profile_id=<?php echo $profile['profile_id'] ?>">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-header" href="./subscriptionCards.php">Try Premium for $0</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="../profile-settings-privacy.php?profile_id=<?php echo $profile['profile_id'] ?>">Settings & Privacy</a></li>
                    <li><a class="dropdown-item" href="#">Help</a></li>
                    <li><a class="dropdown-item" href="#">Language</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <h5 class="dropdown-header">Manage</h5>
                    <li><a class="dropdown-item" href="#">Posts & Activity</a></li>
                    <li><a class="dropdown-item" href="#">Jobs</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Logout</a></li>
                </ul>
            </div>

        </div>
    </nav>
    <!-- End Header Navbar -->



    <section class="price_plan_area mt-4" id="pricing">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-lg-6">
                    <!-- Section Heading-->
                    <div class="section-heading text-center wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <h6>Charting Your Course to Success</h6>
                        <h3>Let's find a way together</h3>
                        <p>Exploring Opportunities Hand in Hand.</p>
                        <div class="line"></div>
                    </div>
                </div>
            </div>
            <div class="container">
                <?php
                // Sort subscriptions by price
                usort($subscriptions, function ($a, $b) {
                    return $a->getPrice() <=> $b->getPrice();
                });

                // Loop through grouped subscriptions
                $groupedSubscriptions = array_chunk($subscriptions, 3);
                foreach ($groupedSubscriptions as $groupIndex => $group) :
                ?>
                    <div class="row justify-content-center">
                        <?php foreach ($group as $subscriptionIndex => $subscription) : ?>
                            <?php
                            // Access properties of SubscriptionModel object
                            $plan_name = $subscription->getPlanName();
                            $description = $subscription->getDescription();
                            $price = $subscription->getPrice();
                            $duration = $subscription->getDuration();
                            $subscription_id = $subscription->getSubscriptionId();
                            $card = $subscription->getCard(); // Get the card attribute

                            // Fetch features for the current subscription
                            $features = $subscriptionController->getSubscriptionFeatures($subscription_id);
                            ?>
                            <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                                <div class="single_price_plan <?php echo strtolower($card); ?> wow fadeInUp" data-wow-delay="0.2s"> <!-- Set the class based on the card attribute -->
                                    <?php if ($subscriptionIndex % 3 === 1) : ?>
                                        <div class="side-shape"><img src="https://bootdey.com/img/popular-pricing.png" alt=""></div>
                                    <?php endif; ?>
                                    <div class="title">
                                        <h3><?php echo $plan_name; ?></h3>
                                        <p style="font-size: medium;"><?php echo $description; ?></p>
                                        <div class="line"></div>
                                    </div>
                                    <div class="price">
                                        <h4><?php echo $price; ?></h4>
                                    </div>
                                    <div class="description">
                                        <p><i class="lni lni-checkmark-circle"></i>Duration: <b><?php echo $duration; ?></b></p>
                                        <p><i class="lni lni-checkmark-circle"></i><b><?php echo $subscriptionIndex % 3 === 0 ? 'Starter Kit' : ($subscriptionIndex % 3 === 1 ? 'Exclusive Access' : 'Unlimited'); ?> Features</b></p>
                                        <?php if (!empty($features)) : ?>
                                            <?php foreach ($features as $feature) : ?>
                                                <p><i class="lni lni-checkmark-circle"></i><?php echo $feature['feature_name']; ?></p>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div><a class="btn btn-<?php echo $subscriptionIndex % 3 === 0 ? 'success' : ($subscriptionIndex % 3 === 1 ? 'warning' : 'info'); ?> btn-2" href="#">Get Started</a></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>


    <!-- Footer -->
    <footer class="bg-dark text-center text-white py-3 mt-4">
        <div class="container">
            <p>&copy; 2024 All rights reserved to <b>be.net</b></p>
        </div>
    </footer>

    <script src='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js'></script>
</body>

</html>