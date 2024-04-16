<?php
require_once __DIR__ . '/../../../Controls/profileController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the profile information from the form
    $first_name = $_POST["profile_first_name"];
    $family_name = $_POST["profile_family_name"];
    $phone_number = $_POST["profile_phone_number"];
    $region = $_POST["profile_region"];
    $city = $_POST["profile_city"];
    $bio = $_POST["profile_bio"];
    $current_position = $_POST["profile_current_position"];
    $education = $_POST["profile_education"];
    $subscription = $_POST["profile_subscription"];
    $auth = $_POST["profile_auth"];
    $acc_verif = $_POST["profile_acc_verif"];

    // Create an instance of the controller
    $profileController = new ProfileC();

    // Generate profile ID
    $profile_id = $profileController->generateProfileId(6); // 6 is the length of the profile ID
    $userid = $profileController->generateProfileUserId(6); // 6 is the length of the profile ID

    // Check if the file inputs are set and not empty
    if (!empty($_FILES['profile_photo']['name']) && !empty($_FILES['profile_cover']['name'])) {
        // Get profile photo and cover data
        $profile_photo_tmp_name = $_FILES['profile_photo']['tmp_name'];
        $profile_photo_data = file_get_contents($profile_photo_tmp_name);

        $profile_cover_tmp_name = $_FILES['profile_cover']['tmp_name'];
        $profile_cover_data = file_get_contents($profile_cover_tmp_name);

        // Call the method to add the profile with profile photo and cover data
        $profileController->addProfile($profile_id, $first_name, $family_name, $userid, $phone_number, $region, $city, $bio, $current_position, $education, $subscription, $auth, $acc_verif, $profile_photo_data, $profile_cover_data);

        // Redirect to profile management page after adding
        header('Location: profile_management.php');
        exit();
    } else {
        echo "Please select a photo and cover image.";
    }
}
?>
