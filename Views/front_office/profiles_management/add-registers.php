<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/HireUp_profile/Controls/profileController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the profile information from the form
    $first_name = $_POST["profile_first_name"];
    $family_name = $_POST["profile_family_name"];
    $phone_number = $_POST["profile_phone_number"];
    $region = $_POST["profile_region"];
    $city = $_POST["profile_city"];
    $bio = "";
    $current_position = $_POST["profile_current_position"];
    $education = $_POST["profile_education"];
    $subscription = $_POST["profile_subscription"];
    $auth = "";
    $acc_verif = "";
    $profile_photo_data = "";
    $profile_cover_data = "";

    // Create an instance of the controller
    $profileController = new ProfileC();

    // Generate profile ID
    $profile_id = $profileController->generateProfileId(6); // 6 is the length of the profile ID
    $userid = $profileController->generateProfileUserId(6); // 6 is the length of the profile ID


    $profileController->addProfile($profile_id, $first_name, $family_name, $userid, $phone_number, $region, $city, $bio, $current_position, $education, $subscription, $auth, $acc_verif, $profile_photo_data, $profile_cover_data);

    // Redirect to profile management page after the update
    header('Location: profile.php?profile_id=' . $id);
    exit();
}
