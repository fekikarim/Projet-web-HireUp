<?php
require_once __DIR__ . '/../../../../Controls/profileController.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['profile_id'])) {
    // Retrieve the profile information from the form
    $id = $_POST["profile_id"];
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

    // Call the method to update the profile without changing the existing photo and cover
    $profileController->updateProfileWithoutImage($id, $first_name, $family_name, $phone_number, $region, $city, $bio, $current_position, $education, $subscription, $auth, $acc_verif);
    
    // Redirect to profile management page after the update
    header('Location: ../profile-settings-privacy.php?profile_id=' . $id);
    exit();
}
