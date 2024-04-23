<?php
require_once __DIR__ . '/../../../Controls/profileController.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['profile_id'])) {
    // Retrieve the profile information from the form
    $id = $_POST["profile_id"];    
    $first_name = $_POST["profile_first_name"];
    $family_name = $_POST["profile_family_name"];
    $region = $_POST["profile_region"];
    $city = $_POST["profile_city"];
    $bio = $_POST["profile_bio"];
    $current_position = $_POST["profile_current_position"];
    $education = $_POST["profile_education"];

    // Create an instance of the controller
    $profileController = new ProfileC();

    // Check if both new profile photo and cover are uploaded
    if (
        !empty($_FILES['update_profile_photo']['name']) && $_FILES['update_profile_photo']['error'] === 0 &&
        !empty($_FILES['update_profile_cover']['name']) && $_FILES['update_profile_cover']['error'] === 0
    ) {

        // New profile photo is uploaded, process the update with the new photo
        $profile_photo_tmp_name = $_FILES['update_profile_photo']['tmp_name'];
        $profile_photo_data = file_get_contents($profile_photo_tmp_name);

        // New profile cover is uploaded, process the update with the new cover
        $profile_cover_tmp_name = $_FILES['update_profile_cover']['tmp_name'];
        $profile_cover_data = file_get_contents($profile_cover_tmp_name);

        // Call the method to update the profile with new photo and cover
        $profileController->updateProfileDetailsImage($id, $first_name, $family_name, $region, $city, $bio, $current_position, $education, $profile_photo_data, $profile_cover_data);
    }
    // Check if only new profile photo is uploaded
    elseif (!empty($_FILES['update_profile_photo']['name']) && $_FILES['update_profile_photo']['error'] === 0) {
        // New profile photo is uploaded, process the update with the new photo
        $profile_photo_tmp_name = $_FILES['update_profile_photo']['tmp_name'];
        $profile_photo_data = file_get_contents($profile_photo_tmp_name);

        // Call the method to update only the profile picture
        $profileController->updateProfilePicture($id, $profile_photo_data);

        // Call the method to update the profile without changing the existing cover
        $profileController->updateProfileDetailsWithoutImage($id, $first_name, $family_name, $region, $city, $bio, $current_position, $education);
    }
    // Check if only new profile cover is uploaded
    elseif (!empty($_FILES['update_profile_cover']['name']) && $_FILES['update_profile_cover']['error'] === 0) {
        // New profile cover is uploaded, process the update with the new cover
        $profile_cover_tmp_name = $_FILES['update_profile_cover']['tmp_name'];
        $profile_cover_data = file_get_contents($profile_cover_tmp_name);

        // Call the method to update only the profile cover
        $profileController->updateProfileCover($id, $profile_cover_data);

        // Call the method to update the profile without changing the existing photo
        $profileController->updateProfileDetailsWithoutImage($id, $first_name, $family_name, $region, $city, $bio, $current_position, $education);
    }
    // If no new photo or cover is uploaded
    else {
        // Call the method to update the profile without changing the existing photo and cover
        $profileController->updateProfileDetailsWithoutImage($id, $first_name, $family_name, $region, $city, $bio, $current_position, $education);
    }

    // Redirect to profile management page after the update
    header('Location: profile.php?profile_id=' . $id);
    exit();
}
