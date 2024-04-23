<?php
// Include database connection code
require_once __DIR__ . '/../../../../Controls/subscriptionControls.php';


// Check if the search term is provided
if (isset($_GET['query'])) {
    // Get the search query
    $searchTerm = $_GET['query'];

    // Create an instance of the profile controller
    $SubscriptionControls = new SubscriptionControls();

    // Call the searchProfiles function to retrieve search results
    $subscriptions = $SubscriptionControls->searchSubscription($searchTerm);

    // Output the search results as HTML table rows
    foreach ($subscriptions as $subscription) {
        echo '<tr>';
        echo '<td>
                <button type="button" style="font-size: medium;" class="btn btn-primary btn-sm me-2" onclick="window.location.href=\'./updateSubs.php?subscription_id=' . $subscription['subscription_id'] . '\'"><a class="ti ti-edit text-white"></a></button>
                <button type="button" style="font-size: medium;" class="btn btn-danger btn-sm" onclick="window.location.href=\'./deleteSubs.php?subscription_id=' . $subscription['subscription_id'] . '\'"><a class="ti ti-x text-white"></a></button>
              </td>';
        echo '<td>
                <button type="button" class="btn btn-success btn-sm" onclick="showFeaturesModal('. $subscription['plan_name'] .')">
                    <i class="ti ti-icons text-white"></i>
                </button>
              </td>';
        echo '<td>' . (isset($subscription['subscription_id']) ? $subscription['subscription_id'] : '') . '</td>';
        echo '<td>' . (isset($subscription['plan_name']) ? $subscription['plan_name'] : '') . '</td>';
        echo '<td>' . (isset($subscription['duration']) ? $subscription['duration'] : '') . '</td>';
        echo '<td>' . (isset($subscription['price']) ? $subscription['price'] : '') . '</td>';
        echo '<td>' . (isset($subscription['subscription_status']) ? $subscription['subscription_status'] : '') . '</td>';
        echo '<td>' . (isset($subscription['card']) ? $subscription['card'] : '') . '</td>';
        echo '<td>' . (isset($subscription['description']) ? $subscription['description'] : '') . '</td>';

        echo '</tr>';
    }
}
