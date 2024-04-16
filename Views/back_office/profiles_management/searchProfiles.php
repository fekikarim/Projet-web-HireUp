<?php
// Include database connection code
require_once $_SERVER['DOCUMENT_ROOT'] . '/HireUp_profile/Controls/profileController.php';

// Check if the search term is provided
if (isset($_GET['query'])) {
    // Get the search query
    $searchTerm = $_GET['query'];

    // Create an instance of the profile controller
    $profileController = new ProfileC();

    // Call the searchProfiles function to retrieve search results
    $profiles = $profileController->searchProfiles($searchTerm);

    // Output the search results as HTML table rows
    foreach ($profiles as $profile) {
        echo '<tr>';
        echo '<td>
                <button type="button" style="font-size: medium;" class="btn btn-primary btn-sm me-2" onclick="window.location.href=\'./updateProfile.php?profile_id=' . $profile['profile_id'] . '\'"><a class="ti ti-edit text-white"></a></button>
                <button type="button" style="font-size: medium;" class="btn btn-danger btn-sm" onclick="window.location.href=\'./deleteProfile.php?profile_id=' . $profile['profile_id'] . '\'"><a class="ti ti-x text-white"></a></button>
              </td>';
        echo '<td>' . (isset($profile['profile_id']) ? $profile['profile_id'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_first_name']) ? $profile['profile_first_name'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_family_name']) ? $profile['profile_family_name'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_userid']) ? $profile['profile_userid'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_phone_number']) ? $profile['profile_phone_number'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_region']) ? $profile['profile_region'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_city']) ? $profile['profile_city'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_bio']) ? $profile['profile_bio'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_current_position']) ? $profile['profile_current_position'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_education']) ? $profile['profile_education'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_subscription']) ? $profile['profile_subscription'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_auth']) ? $profile['profile_auth'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_acc_verif']) ? $profile['profile_acc_verif'] : '') . '</td>';

        echo '</tr>';
    }
}
