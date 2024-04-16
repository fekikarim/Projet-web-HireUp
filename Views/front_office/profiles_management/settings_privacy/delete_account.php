<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/HireUp_profile/Controls/profileController.php';

if (isset($_GET['profile_id'])) {
    $id = $_GET['profile_id'];

    $profileController = new ProfileC();
    $profileController->deleteProfile($id);

    // Redirect to a confirmation page or perform any other action
    header('Location: ../../index.html');
    exit();
}
?>
