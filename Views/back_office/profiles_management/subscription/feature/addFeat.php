<?php
// Include the subscriptionControls.php file
require_once __DIR__ . '/../../../../../Controls/subsFeaturesControls.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $plan_name = $_POST['plan_name'];
    $feature_name = $_POST['feature_name'];
    $description = $_POST['description'];

    // Create an instance of the SubscriptionControls class
    $featController = new SubsFeaturesControls();

    // Fetch subscription_id based on plan_name
    $subscription_id = $featController->getSubscriptionIdByPlanName($plan_name);

    if ($subscription_id) {
        // Create a feature with the obtained subscription_id
        $result = $featController->createFeature($subscription_id, $feature_name, $description);

        // Check if the creation was successful
        if ($result) {
            // Redirect to the feature management page with a success message
            header("Location: ./featureMg.php?creation_success=true");
            exit;
        } else {
            // Redirect to the feature management page with an error message
            header("Location: ./featureMg.php?creation_error=true");
            exit;
        }
    } else {
        // If no subscription_id found for the given plan_name, redirect with an error message
        header("Location: ./featureMg.php?subscription_not_found=true");
        exit;
    }
} else {
    // If the request method is not POST, redirect to an error page
    header("Location: ./featureMg.php?post_error=true");
    exit;
}
?>
