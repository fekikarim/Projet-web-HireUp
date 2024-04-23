<?php

require_once __DIR__ . '/../../../Controls/job_management/JobC.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add new job
   
    $title = $_POST["job_title"];
    $company = $_POST["company"];
    $location = $_POST["location"];
    $description = $_POST["description"];
    $salary = $_POST["salary"];
    $category = $_POST["category"];

    // Include the controller file
    $jobController = new JobController();
    $job_id=$jobController->generateJobId(7);
    // Call the method to add the profile with profile photo and cover data
    $result = $jobController->createJob($job_id,$title, $company, $location, $description, $salary, $category);

    if ($result !== false) {
        echo $result;
    }
    else{
        echo "check the inputs!";
    }
    // Redirect to profile management page after adding
    header('Location: jobs.php');
    exit();
}
?>