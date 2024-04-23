<?php
// Include the subscriptionControls.php file
require_once __DIR__ . '/../../../../Controls/subscriptionControls.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Retrieve the form data
    $subscription_id = $_POST['subscription_id'];
    $plan_name = $_POST['plan_name'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $subscription_status = $_POST['subscription_status'];
    $card = $_POST['card'];

    // Create an instance of the SubscriptionControls class
    $subsController = new SubscriptionControls();

    // Create a SubscriptionModel object with the updated data
    $result = $subsController->updateSubscription($subscription_id, $plan_name, $duration, $price, $description, $subscription_status, $card);

    // Check if the update was successful
    if ($result) {
        // Redirect to the profile management page with a success message
        header("Location: ./subscriptionMg.php?update_success=true");
        exit;
    } else {
        // Redirect to the profile management page with an error message
        header("Location: ./subscriptionMg.php?update_error=true");
        exit;
    }
} else {
    // If the request method is not POST, redirect to an error page
    header("Location: ./subscriptionMg.php?post_error=true");
    exit;
}
?>
