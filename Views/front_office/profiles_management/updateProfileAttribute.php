<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../Controls/profileController.php';


// Check if profile ID, attribute, and value are set
if (isset($_POST['profile_id'], $_POST['attribute'], $_POST['new_data'])) {
    $profile_id = $_POST['profile_id'];
    $attribute = $_POST['attribute'];
    $value = $_POST['new_data'];

    // Instantiate ProfileC class
    $profileC = new ProfileC();

    // Check if profile ID exists
    if ($profileC->profileExists($profile_id)) {
        // Update profile attribute
        if ($profileC->updateProfileAttribute($profile_id, $attribute, $value)) {
            // Redirect back to previous page
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        } else {
            echo "Failed to update profile attribute.";
        }
    } else {
        echo "Profile with ID $profile_id does not exist.";
    }
} else {
    echo "Invalid request.";
}
?>
