<?php
require_once __DIR__ . '/../../../../../Controls/subsFeaturesControls.php';


if (isset($_GET['feature_id'])) {
    $id = $_GET['feature_id'];

    $featController = new SubsFeaturesControls();
    $featController->deleteFeature($id);

    // Redirection vers ListEmployes.php après la suppression
    header('Location: ./featureMg.php');
    exit();
}
?>