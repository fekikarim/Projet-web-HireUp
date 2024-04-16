<?php
require_once __DIR__ . '/../../../Controls/profileController.php';


if (isset($_GET['profile_id'])) {
    $id = $_GET['profile_id'];

    $profileController = new ProfileC();
    $profileController->deleteProfile($id);

    // Redirection vers ListEmployes.php après la suppression
    header('Location: ../../back_office/profiles_management/profile_management.php');
    exit();
}
?>