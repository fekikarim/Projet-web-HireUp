<?php
// Include database connection and profile controller
require_once __DIR__ . '/../../../../Controls/profileController.php';

// Check if profile ID is provided
if (!isset($_POST['profile_id'])) {
    // Handle error
    exit();
}

// Check if a file is uploaded
if (isset($_FILES['update_profile_photo']) && $_FILES['update_profile_photo']['error'] === UPLOAD_ERR_OK) {
    // Retrieve profile ID from POST data
    $profile_id = $_POST['profile_id'];

    // Get profile controller instance
    $profileController = new ProfileC();

    // Process the uploaded file
    $file_tmp = $_FILES['update_profile_photo']['tmp_name'];
    $profile_photo_data = file_get_contents($file_tmp);

    // Update profile picture in the database
    $profileController->updateProfilePicture($profile_id, $profile_photo_data);

    $_SESSION['profile_picture_updated'] = true;
}

// Redirect back to the profile page
header('Location: ./edit-profile.php?profile_id=' . $profile_id);
exit();
