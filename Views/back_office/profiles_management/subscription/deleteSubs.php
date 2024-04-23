<?php
require_once __DIR__ . '/../../../../Controls/subscriptionControls.php';


if (isset($_GET['subscription_id'])) {
    $id = $_GET['subscription_id'];

    $subsController = new SubscriptionControls();
    $subsController->deleteSubscription($id);

    // Redirection vers ListEmployes.php après la suppression
    header('Location: ./subscriptionMg.php');
    exit();
}
?>