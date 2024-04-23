<?php
// Include database connection code
require_once __DIR__ . '/../../../../../Controls/subsFeaturesControls.php';

// Check if the search term is provided
if (isset($_GET['query'])) {
    // Get the search query
    $searchTerm = $_GET['query'];

    // Create an instance of the feature controller
    $featController = new SubsFeaturesControls();

    // Call the searchFeatures function to retrieve search results
    $features = $featController->searchFeatures($searchTerm);

    // Output the search results as HTML table rows
    foreach ($features as $feature) {
        echo '<tr>';
        echo '<td>
                <button type="button" style="font-size: medium;" class="btn btn-primary btn-sm me-2" onclick="window.location.href=\'./updateFeat.php?feature_id=' . $feature['feature_id'] . '\'"><a class="ti ti-edit text-white"></a></button>
                <button type="button" style="font-size: medium;" class="btn btn-danger btn-sm" onclick="window.location.href=\'./deleteFeat.php?feature_id=' . $feature['feature_id'] . '\'"><a class="ti ti-x text-white"></a></button>
              </td>';
        echo '<td>' . (isset($feature['feature_id']) ? $feature['feature_id'] : '') . '</td>';
        echo '<td>' . (isset($feature['subscription_id']) ? $feature['subscription_id'] : '') . '</td>';
        echo '<td>' . (isset($feature['feature_name']) ? $feature['feature_name'] : '') . '</td>';
        echo '<td>' . (isset($feature['description']) ? $feature['description'] : '') . '</td>';
        echo '</tr>';
    }
}
