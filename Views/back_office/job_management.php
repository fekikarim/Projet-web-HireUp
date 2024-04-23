<?php

require_once __DIR__ . '../../../Controls/job_management/JobC.php';

// Include the controller file
$jobController = new JobController();

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["action"] == "add") {
        // Add new job
        $title = $_POST["job_title"];
        $company = $_POST["company"];
        $location = $_POST["location"];
        $description = $_POST["description"];
        $salary = $_POST["salary"];
        $category = $_POST["category"];
        $job_id = $jobController->generateJobId(7);
        // Only echo the result if the job creation is successful
        $result = $jobController->createJob($job_id, $title, $company, $location, $description, $salary, $category);
        if ($result !== false) {
            // Redirect to prevent form resubmission
            header("Location: {$_SERVER['REQUEST_URI']}");
            exit;
        }
    } elseif ($_POST["action"] == "update") {
        // Update existing job
        $job_id = $_POST["job_id"];
        $title = $_POST["job_title"];
        $company = $_POST["company"];
        $location = $_POST["location"];
        $description = $_POST["description"];
        $salary = $_POST["salary"];
        $category = $_POST["category"];
        // Only echo the result if the job update is successful
        $result = $jobController->updateJob($job_id, $title, $company, $location, $description, $salary, $category);

        if ($result !== false) {
            // Redirect to prevent form resubmission

            header("Location: {$_SERVER['REQUEST_URI']}");
            exit;
        }
    } elseif ($_POST["action"] == "delete" && isset($_POST["job_id"])) {
        // Delete job
        $job_id = $_POST["job_id"];
        $deleted = $jobController->deleteJob($job_id);
        if ($deleted) {
            echo "Job deleted successfully.";
        } else {
            echo "Error deleting job.";
        }
    }
}

// Fetch all jobs
$jobs = $jobController->getAllJobsWithCategory();
$id_category_options = $jobController->generateCategoryOptions();

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HireUp Dashboard</title>
    <link rel="shortcut icon" type="image/png" href="./assets/images/logos/HireUp_icon.ico" />
    <link rel="stylesheet" href="./assets/css/styles.min.css" />

    <style>
        /*
        .currency-input {
            position: relative;
            display: inline-block;
        }
        
        #currencySelect {
            position: absolute;
            top: 100%;
            left: 0;
            display: none;
            min-width: 150px;
            padding: 5px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-top: none;
        }
        
        #currencySelect.active {
            display: block;
        }
        */
        .logo-img {
            margin: 0 auto;
            /* Center the image horizontally */
            display: block;
            /* Ensure the link occupies full width */
            padding-top: 5%;
        }

        /* CSS for the popup form */
        .modal {
            display: none;
            /* Hide the modal by default */
            position: fixed;
            /* Stay in place */
            z-index: 1000;
            /* Ensure the modal appears above other elements */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scrolling if needed */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black with opacity */
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            max-width: 80%;
            /* Set a maximum width */
        }

        /* Media query for smaller screens */
        @media only screen and (max-width: 768px) {
            .modal-content {
                max-width: 90%;
                /* Adjust maximum width for smaller screens */
            }
        }


        /* Close button style */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Ensure the modal appears above the header */
        .app-header {
            z-index: 999;
            /* Ensure the header appears above the modal */
        }

        #scrollToTopBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
    </style>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a title="#" href="./index.php" class="text-nowrap logo-img">
                        <img src="./assets/images/logos/HireUp_lightMode.png" alt="" width="175" height="73">
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./index.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">MENU</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="#" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user"></i>
                                </span>
                                <span class="hide-menu">User</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="#" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user-circle"></i>
                                </span>
                                <span class="hide-menu">Profile</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./job_management.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-tie"></i>
                                </span>
                                <span class="hide-menu">Jobs</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="#" aria-expanded="false">
                                <span>
                                    <i class="ti ti-message"></i>
                                </span>
                                <span class="hide-menu">Messages</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="#" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Article</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="#" aria-expanded="false">
                                <span>
                                    <i class="ti ti-analyze"></i>
                                </span>
                                <span class="hide-menu">FeedBack</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">AUTH</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="#" aria-expanded="false">
                                <span>
                                    <i class="ti ti-login"></i>
                                </span>
                                <span class="hide-menu">Login</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="#" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user-plus"></i>
                                </span>
                                <span class="hide-menu">Register</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a title="#" class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="#">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a title="#" class="nav-link nav-icon-hover" href="javascript:void(0)">
                                <i class="ti ti-bell-ringing"></i>
                                <div class="notification bg-primary rounded-circle"></div>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

                            <li class="nav-item dropdown">
                                <a title="#" class="nav-link nav-icon-hover" href="#" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="./assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle" />
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="../../../front_office/profiles_management/profile.php?profile_id=<?php echo $test ?>" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a>
                                        <a href="#" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">My Account</p>
                                        </a>
                                        <a href="#" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-list-check fs-6"></i>
                                            <p class="mb-0 fs-3">My Task</p>
                                        </a>
                                        <a class="d-flex align-items-center gap-2 dropdown-item" href="#">
                                            <i class="ti ti-settings fs-6"></i>
                                            <p class="mb-0 fs-3">Settings</p>
                                        </a>
                                        <a href="">
                                            <label class="d-flex align-items-center gap-2 dropdown-item" for="darkModeToggle">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="darkModeToggle">
                                                </div>
                                                <p class="mb-0 fs-3">Appearance</p>
                                            </label>
                                        </a>
                                        <a href="#" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <h1>Job Management</h1>
                            <hr> <br>
                            <h2>Add Job</h2><br>
                            <!-- Form for adding new job -->
                            <form id="addJobForm" method="post">
                                <input type="hidden" name="action" value="add">
                                <div class="mb-3">
                                    <label for="job_title" class="form-label">Job Title *</label>
                                    <input type="text" class="form-control" id="job_title" name="job_title" placeholder="Enter Job Title">
                                    <span id="job_title_error" class="text-danger"></span> <!-- Error message placeholder -->
                                </div>
                                <div class="mb-3">
                                    <label for="company" class="form-label">Company *</label>
                                    <input type="text" class="form-control" id="company" name="company" placeholder="Enter company">
                                    <span id="job_company_error" class="text-danger"></span> <!-- Error message placeholder -->
                                </div>
                                <div class="mb-3">
                                    <label for="location" class="form-label">Location *</label>
                                    <input type="text" class="form-control" id="location" name="location" placeholder="Enter location">
                                    <span id="job_location_error" class="text-danger"></span> <!-- Error message placeholder -->
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description *</label>
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter description">
                                    <span id="job_desc_error" class="text-danger"></span> <!-- Error message placeholder -->
                                </div>
                                <div class="currency-input mb-3">
                                    <label for="salary" class="form-label">Salary *</label>
                                    <input type="text" class="form-control" id="salary" name="salary" placeholder="Enter salary">
                                    <!--<select name="currency" id="currencySelect"></select>-->
                                    <span id="job_salary_error" class="text-danger"></span> <!-- Error message placeholder -->
                                </div>

                                <div class="currency-input mb-3">
                                    <label for="category" class="form-label">Category *</label>
                                    <select class="form-select" id="category" name="category" required>
                                        <option value="" selected disabled>Select Category</option>
                                        <?php echo $id_category_options; ?>
                                    </select>


                                    <span id="job_category_error" class="text-danger"></span>
                                </div>

                                <button type="submit" class="btn btn-primary">Add Job</button>
                            </form>
                        </div>
                    </div>


                    <!-- Popup Form for Updating Job -->
                    <div id="updateJobModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h2><a class="ti ti-edit" style="color: white;"></a> Update Job</h2>
                            <hr><br>
                            <form id="updateJobForm" method="post">
                                <input type="hidden" name="action" value="update">
                                <div class="mb-3">
                                    <label for="update_job_id" class="form-label">Job ID *</label>
                                    <input type="text" class="form-control" id="update_job_id" name="job_id" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="update_job_title" class="form-label">Job Title *</label>
                                    <input type="text" class="form-control" id="update_job_title" name="job_title" placeholder="Enter Job Title">

                                    <span id="update_job_title_error" class="text-danger"></span> <!-- Error message placeholder -->
                                </div>
                                <div class="mb-3">
                                    <label for="update_company" class="form-label">Company *</label>
                                    <input type="text" class="form-control" id="update_company" name="company" placeholder="Enter company">
                                    <span id="update_company_error" class="text-danger"></span> <!-- Error message placeholder -->

                                </div>
                                <div class="mb-3">
                                    <label for="update_location" class="form-label">Location *</label>
                                    <input type="text" class="form-control" id="update_location" name="location" placeholder="Enter location">
                                    <span id="update_location_error" class="text-danger"></span> <!-- Error message placeholder -->
                                </div>
                                <div class="mb-3">
                                    <label for="update_description" class="form-label">Description *</label>
                                    <input type="text" class="form-control" id="update_description" name="description" placeholder="Enter description">
                                    <span id="update_description_error" class="text-danger"></span> <!-- Error message placeholder -->

                                </div>
                                <div class="mb-3">
                                    <label for="update_salary" class="form-label">Salary *</label>
                                    <input type="text" class="form-control" id="update_salary" name="salary" placeholder="Enter salary">
                                    <span id="update_salary_error" class="text-danger"></span> <!-- Error message placeholder -->

                                </div>


                                <div class="currency-input mb-3">
                                    <label for="update_category" class="form-label">Category *</label>
                                    <select class="form-select" id="update_category" name="category">
                                        <option value="" selected disabled>Select Category</option>
                                        <?php echo $id_category_options; ?>
                                    </select>
                                    <span id="update_category_error" class="text-danger"></span> <!-- Error message placeholder -->

                                </div>
                                <button type="submit" class="btn btn-primary" id="updateJobBtn">Update Job</button>
                                <button type="button" class="btn btn-secondary cancel-btn" id="cancelUpdateBtn">Cancel</button>
                            </form>
                        </div>
                    </div>



                </div>
            </div>

            <button type="button" class="btn btn-success btn-sm me-2" id="scrollToTopBtn" style="font-size: large;"><a class="ti ti-arrow-up text-white"></a></button>

            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <a class="btn btn-primary" href="./categorie.php"><i class="ti ti-pin text-white"></i>Category Management</a>
                            </div>
                        </div>
                        <!-- Table for displaying existing jobs -->
                        <div class="table-responsive">
                            <!-- Table for displaying existing jobs -->
                            <table class="table text-nowrap mb-0 align-middle" id="jobs-table">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">ID</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Job Title</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Company</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Location</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Salary</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Description </h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Date Posted </h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">category </h6>
                                        </th>

                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Actions</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($jobs as $job) : ?>
                                        <tr>
                                            <td><?= $job['id'] ?></td>
                                            <td><?= $job['title'] ?></td>
                                            <td><?= $job['company'] ?></td>
                                            <td><?= $job['location'] ?></td>
                                            <td><?= $job['salary'] ?></td>
                                            <td><?= $job['description'] ?></td>
                                            <td><?= $job['date_posted'] ?></td>
                                            <td><?= $job['category_name'] ?></td>
                                            <td>
                                                <button class="btn btn-warning btn-sm edit-btn" data-job-id="<?= $job['id'] ?>" data-job-title="<?= $job['title'] ?>" data-company="<?= $job['company'] ?>" data-location="<?= $job['location'] ?>" data-description="<?= $job['description'] ?>" data-salary="<?= $job['salary'] ?>" data-category="<?= $job['category_name'] ?>">Edit</button>
                                                <form method="post" style="display:inline;">
                                                    <input type="hidden" name="action" value="delete">
                                                    <input type="hidden" name="job_id" value="<?= $job['id'] ?>">
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this job?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="./script.js"></script>

    <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/sidebarmenu.js"></script>
    <script src="./assets/js/app.min.js"></script>
    <script src="./assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="./assets/js/finition.js"></script>

    <!-- pop up JS -->
    <script>
        // Get the modal
        var modal = document.getElementById("updateJobModal");

        // Get the button that opens the modal
        var editButtons = document.querySelectorAll(".edit-btn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // JavaScript to handle edit button click event
        document.addEventListener("DOMContentLoaded", function() {
            const editButtons = document.querySelectorAll(".edit-btn");

            editButtons.forEach((button) => {
                button.addEventListener("click", function() {
                    // Get job details from data attributes
                    const id = this.getAttribute("data-job-id");
                    const title = this.getAttribute("data-job-title");
                    const company = this.getAttribute("data-company");
                    const location = this.getAttribute("data-location");
                    const description = this.getAttribute("data-description");
                    const salary = this.getAttribute("data-salary");
                    const category = this.getAttribute("data-category");
                    // Populate update form inputs with job details
                    console.log(category);
                    console.log("hello");
                    populateUpdateForm(id, title, company, location, description, salary, category);
                    // Show the update form modal
                    document.getElementById("updateModal").style.display = "block";
                });
            });
        });



        // Function to populate the update form with job details
        function populateUpdateForm(id, title, company, location, description, salary, category) {
            console.log(category);
            console.log("hiiiiiii");

            document.getElementById("update_job_id").value = id;
            document.getElementById("update_job_title").value = title;
            document.getElementById("update_company").value = company;
            document.getElementById("update_location").value = location;
            document.getElementById("update_description").value = description;
            document.getElementById("update_salary").value = salary;
            document.getElementById("update_category").value = category;
        }


        // When the user clicks on the edit button, open the modal
        editButtons.forEach(function(button) {
            button.onclick = function() {
                modal.style.display = "block";
                modal.style.display = "flex";
                // Populate form fields with job details here using JavaScript
            };
        });

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        };

        // When the user clicks on cancel button, close the modal
        document.querySelector(".cancel-btn").onclick = function() {
            modal.style.display = "none";
            document.getElementById("updateJobForm").reset();
        };

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    </script>
    <!-- add JS -->

    <script>
        document.getElementById("addJobForm").addEventListener("submit", function(event) {
            // Reset previous error messages
            document.getElementById("job_title_error").textContent = ""; // Reset error message for job title
            document.getElementById("job_company_error").textContent = ""; // Reset error message for company
            document.getElementById("job_location_error").textContent = ""; // Reset error message for location
            document.getElementById("job_desc_error").textContent = ""; // Reset error message for description
            document.getElementById("job_salary_error").textContent = ""; // Reset error message for salary
            document.getElementById("job_category_error").textContent = ""; // Reset error message for salary
            // Get input values
            var jobTitle = document.getElementById("job_title").value.trim();
            var company = document.getElementById("company").value.trim();
            var location = document.getElementById("location").value.trim();
            var description = document.getElementById("description").value.trim();
            var salary = document.getElementById("salary").value.trim();
            var category = document.getElementById("category").value.trim();
            // Variable to store the common error message
            var errorMessage = "";



            // Validate job title (characters only)
            if (!/^[a-zA-Z\s]+$/.test(jobTitle)) {
                errorMessage = "Job title must contain only characters."; // Set common error message
                displayError("job_title_error", errorMessage, true); // Display error message
            }

            // Check if salary is not empty and contains only numbers
            if (!/^\d+(\.\d+)?$/.test(salary)) {
                errorMessage = "Salary must be a number."; // Set common error message
                displayError("job_salary_error", errorMessage, true); // Display error message
            }

            // Check if any input field is empty
            if (jobId === "") {
                errorMessage = "Job ID is required."; // Set common error message
                displayError("job_id_error", errorMessage, true); // Display error message
            }

            // Check if any input field is empty
            if (jobTitle === "") {
                errorMessage = "Job title is required."; // Set common error message
                displayError("job_title_error", errorMessage, true); // Display error message
            }

            // Check if any input field is empty
            if (company === "") {
                errorMessage = "Company is required."; // Set common error message
                displayError("job_company_error", errorMessage, true); // Display error message
            }

            // Check if any input field is empty
            if (location === "") {
                errorMessage = "Location is required."; // Set common error message
                displayError("job_location_error", errorMessage, true); // Display error message
            }

            // Check if any input field is empty
            if (description === "") {
                errorMessage = "Description is required."; // Set common error message
                displayError("job_desc_error", errorMessage, true); // Display error message
            }

            // Check if any input field is empty
            if (salary === "") {
                errorMessage = "Salary is required."; // Set common error message
                displayError("job_salary_error", errorMessage, true); // Display error message
            }

            // If there are no errors, submit the form
            if (errorMessage === "") {
                this.submit(); // Submit the form
            }
        });



        // Listen for input event on job title field
        document.getElementById("job_title").addEventListener("input", function(event) {
            var jobTitle = this.value.trim(); // Get value of job title field

            // Validate job title format (characters only)
            if (jobTitle === "") {
                displayError("job_title_error", "Title is required.", true); // Display error message for empty job title
            } else if (/^[a-zA-Z\s]+$/.test(jobTitle)) {
                displayError("job_title_error", "Valid Job Title", false); // Display valid message for job title
            } else {
                displayError("job_title_error", "Job title must contain only characters.", true); // Display error message for invalid job title
            }
        });

        // Listen for input event on job salary field
        document.getElementById("salary").addEventListener("input", function(event) {
            var jobSalary = this.value.trim(); // Get value of job salary field

            // Validate if salary is empty
            if (jobSalary === "") {
                displayError("job_salary_error", "Salary is required.", true); // Display error message for empty salary
            } else if (/^\d+(\.\d+)?$/.test(jobSalary)) {
                displayError("job_salary_error", "Valid Job Salary", false); // Display valid message for salary
            } else {
                displayError("job_salary_error", "Salary must be a number.", true); // Display error message for invalid salary format
            }
        });

        // Listen for input event on company field
        document.getElementById("company").addEventListener("input", function(event) {
            var company = this.value.trim(); // Get value of company field

            // Validate if company is empty
            if (company === "") {
                displayError("job_company_error", "Company is required.", true); // Display error message for empty company
            } else {
                displayError("job_company_error", "Valid company", false); // Display valid message for company
            }
        });

        // Listen for input event on location field
        document.getElementById("location").addEventListener("input", function(event) {
            var location = this.value.trim(); // Get value of location field

            // Validate if location is empty
            if (location === "") {
                displayError("job_location_error", "Location is required.", true); // Display error message for empty location
            } else {
                displayError("job_location_error", "Valid location", false); // Display valid message for location
            }
        });

        // Listen for input event on description field
        document.getElementById("description").addEventListener("input", function(event) {
            var description = this.value.trim(); // Get value of description field

            // Validate if description is empty
            if (description === "") {
                displayError("job_desc_error", "Description is required.", true); // Display error message for empty description
            } else {
                displayError("job_desc_error", "Valid description", false); // Display valid message for description
            }
        });

        // Listen for input event on category field
        document.getElementById("category").addEventListener("change", function(event) {
            var category = this.value.trim(); // Get value of category field

            // Validate if category is selected
            if (category === "") {
                displayError("job_category_error", "Category is required.", true); // Display error message for empty category
            } else {
                displayError("job_category_error", "Valid category", false); // Display valid message for category
            }
        });





        // Listen for input event on each input field and category field
        var inputs = document.querySelectorAll("#addJobForm input, #category");
        inputs.forEach(function(input) {
            input.addEventListener("input", function() {
                toggleSubmitButton();
            });
        });




        // Function to display error message
        function displayError(elementId, errorMessage, isError) {
            var errorElement = document.getElementById(elementId);
            errorElement.textContent = errorMessage;
            errorElement.classList.toggle("text-danger", isError);
            errorElement.classList.toggle("text-success", !isError);
        }


        document.addEventListener("DOMContentLoaded", function() {
            // Function to check if all input fields are populated
            function checkInputFields() {
                var inputs = document.querySelectorAll("#addJobForm input, #category");
                var allPopulated = true;
                inputs.forEach(function(input) {
                    if (input.tagName.toLowerCase() === "input" && input.value.trim() === "") {
                        allPopulated = false;
                    }
                    if (input.tagName.toLowerCase() === "select" && input.value === "") {
                        allPopulated = false;
                    }
                });
                return allPopulated;
            }

            // Function to enable/disable submit button based on input fields
            function toggleSubmitButton() {
                var submitButton = document.querySelector("#addJobForm button[type='submit']");
                submitButton.disabled = !checkInputFields();
            }

            // Listen for input event on each input field
            var inputs = document.querySelectorAll("#addJobForm input, #category");
            inputs.forEach(function(input) {
                input.addEventListener("input", function() {
                    toggleSubmitButton();
                });
            });

            // Initial call to toggleSubmitButton to set initial state
            toggleSubmitButton();
        });
    </script>

    <!-- update JS -->
    <script>
        document.getElementById("updateJobForm").addEventListener("submit", function(event) {
            // Reset previous error messages

            document.getElementById("update_job_title_error").textContent = ""; // Reset error message for job title
            document.getElementById("update_company_error").textContent = ""; // Reset error message for company
            document.getElementById("update_location_error").textContent = ""; // Reset error message for location
            document.getElementById("update_description_error").textContent = ""; // Reset error message for description
            document.getElementById("update_salary_error").textContent = ""; // Reset error message for salary
            document.getElementById("update_category_error").textContent = ""; // Reset error message for salary
            // Reset other error messages for additional fields

            // Get input values

            var jobTitle = document.getElementById("update_job_title").value.trim();
            var company = document.getElementById("update_company").value.trim();
            var location = document.getElementById("update_location").value.trim();
            var description = document.getElementById("update_description").value.trim();
            var salary = document.getElementById("update_salary").value.trim();
            var category = document.getElementById("update_category").value.trim();
            // Get values for other input fields

            // Variable to store the common error message
            var errorMessage = "";



            // Validate job title (characters only)
            if (!/^[a-zA-Z\s]+$/.test(jobTitle)) {
                errorMessage = "Job title must contain only characters."; // Set common error message
                displayError("update_job_title_error", errorMessage, true); // Display error message
            }
            // Check if salary is not empty and contains only numbers
            if (!/^\d+(\.\d+)?$/.test(salary)) {
                errorMessage = "Salary must be a number."; // Set common error message
                displayError("update_salary_error", errorMessage, true); // Display error message
            }
            // Check if any input field is empty
            if (jobTitle === "") {
                errorMessage = "Job title is required."; // Set common error message
                displayError("update_job_title_error", errorMessage, true); // Display error message
            }

            // Check if any input field is empty
            if (company === "") {
                errorMessage = "Company is required."; // Set common error message
                displayError("update_company_error", errorMessage, true); // Display error message
            }

            // Check if any input field is empty
            if (location === "") {
                errorMessage = "Location is required."; // Set common error message
                displayError("update_location_error", errorMessage, true); // Display error message
            }

            // Check if any input field is empty
            if (description === "") {
                errorMessage = "Description is required."; // Set common error message
                displayError("update_description_error", errorMessage, true); // Display error message
            }
            // Check if any input field is empty
            if (salary === "") {
                errorMessage = "Salary is required."; // Set common error message
                displayError("update_salary_error", errorMessage, true); // Display error message
            }

            // Display error message for other fields

            // Prevent form submission if there's an error message
            if (errorMessage !== "") {
                event.preventDefault();
            }
        });



        // Listen for input event on job title field
        document.getElementById("update_job_title").addEventListener("input", function(event) {
            var jobTitle = this.value.trim(); // Get value of job title field
            var jobTitleError = document.getElementById("update_job_title_error"); // Get error message element

            // Validate job title format (characters only)
            if (jobTitle === "") {
                displayError("update_job_title_error", "Title is required.", true); // Display error message for empty job title
            } else if (/^[a-zA-Z\s]+$/.test(jobTitle)) {
                displayError("update_job_title_error", "Valid Job Title", false); // Display valid message for job title
            } else {
                displayError("update_job_title_error", "Job title must contain only characters.", true); // Display error message for invalid job title
            }
        });

        // Listen for input event on job salary field
        document.getElementById("update_salary").addEventListener("input", function(event) {
            var jobSalary = this.value.trim(); // Get value of job salary field
            var jobSalaryError = document.getElementById("update_salary_error"); // Get error message element

            // Validate if salary is empty
            if (jobSalary === "") {
                displayError("update_salary_error", "Salary is required.", true); // Display error message for empty salary
            } else if (/^\d+(\.\d+)?$/.test(jobSalary)) {
                displayError("update_salary_error", "Valid Job Salary", false); // Display valid message for salary
            } else {
                displayError("update_salary_error", "Salary must be a number.", true); // Display error message for invalid salary format
            }
        });

        // Listen for input event on company field
        document.getElementById("update_company").addEventListener("input", function(event) {
            var company = this.value.trim(); // Get value of company field
            var companyError = document.getElementById("update_company_error"); // Get error message element

            // Validate if company is empty
            if (company === "") {
                displayError("update_company_error", "Company is required.", true); // Display error message for empty company
            } else {
                displayError("update_company_error", "Valid company", false); // Display valid message for company
            }
        });

        // Listen for input event on location field
        document.getElementById("update_location").addEventListener("input", function(event) {
            var location = this.value.trim(); // Get value of location field
            var locationError = document.getElementById("update_location_error"); // Get error message element

            // Validate if location is empty
            if (location === "") {
                displayError("update_location_error", "Location is required.", true); // Display error message for empty location
            } else {
                displayError("update_location_error", "Valid location", false); // Display valid message for location
            }
        });

        // Listen for input event on description field
        document.getElementById("update_description").addEventListener("input", function(event) {
            var description = this.value.trim(); // Get value of description field
            var descriptionError = document.getElementById("update_description_error"); // Get error message element

            // Validate if description is empty
            if (description === "") {
                displayError("update_description_error", "Description is required.", true); // Display error message for empty description
            } else {
                displayError("update_description_error", "Valid description", false); // Display valid message for description
            }
        });

        // Listen for input event on category field
        document.getElementById("update_category").addEventListener("change", function(event) {
            var category = this.value.trim(); // Get value of category field

            // Validate if category is selected
            if (category === "") {
                displayError("update_category_error", "Category is required.", true); // Display error message for empty category
            } else {
                displayError("update_category_error", "Valid category", false); // Display valid message for category
            }
        });


        // Listen for input event on each input field and category field
        var inputs = document.querySelectorAll("#updateJobForm input, #update_category");
        inputs.forEach(function(input) {
            input.addEventListener("input", function() {
                toggleSubmitButton();
            });
        });

        // Function to display error message
        function displayError(elementId, errorMessage, isError) {
            var errorElement = document.getElementById(elementId);
            errorElement.textContent = errorMessage;
            errorElement.classList.toggle("text-danger", isError);
            errorElement.classList.toggle("text-success", !isError);
        }
    </script>


</body>

</html>