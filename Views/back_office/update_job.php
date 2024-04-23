<?php
// Include the JobController
require_once __DIR__ . '../../Controls/job_management/JobC.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_job_id"])) {
    // Get job ID and new information from form
    $jobId = $_POST["update_job_id"];
    $title = $_POST["update_job_title"];
    $company = $_POST["update_company"];
    $location = $_POST["update_location"];
    $description = $_POST["update_description"];
    $salary = $_POST["update_salary"];
    $category = $_POST["update_category"];
    // Create an instance of JobController
    $jobController = new JobController();

    // Update the job information
    $result = $jobController->updateJob($jobId, $title, $company, $location, $description, $salary,$category);

    // Check if the update was successful
    if ($result) {
        // Redirect back to job management page or display a success message
        header("Location: job_management.php");
        exit();
    } else {
        // Handle update failure
        // Redirect back to job management page or display an error message
        header("Location: job_management.php?error=update_failed");
        exit();
    }
} else {
    // Handle invalid form submission
    // Redirect back to job management page or display an error message
    header("Location: job_management.php?error=invalid_submission");
    exit();
}
?>
