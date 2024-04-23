<?php

require_once __DIR__ . '/../../../../Controls/profileController.php';

// Check if the request method is GET and if id_emp is set in the URL
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['profile_id'])) {
    // Retrieve the profilee information from the database
    $id = $_GET['profile_id'];

    // Create an instance of the controller
    $profileController = new ProfileC();

    // Get the profilee details by ID
    $profile = $profileController->getProfileById($id);

    // Check if profile is set and not null
    if ($profile) {
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>

            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title>Settings & Privacy</title>
            <link rel="shortcut icon" type="image/png" href="../../../back_office/assets/images/logos/HireUp_icon.ico" />
            <link rel="stylesheet" href="../assets/css/edit_profile.css" />
            <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css'>

        </head>

        <body>

            <!-- Header Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                <div class="container-fluid">
                    <!-- Logo -->
                    <a class="navbar-brand ms-4" href="../../index.html">
                        <img class="logo-img" alt="HireUp">
                    </a>

                    <!-- Profile Dropdown -->
                    <div class="dropdown ms-auto">
                        <a href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false" class="d-flex align-items-center justify-content-center mx-3" style="height: 100%;">
                            <img src="data:image/jpeg;base64,<?= base64_encode($profile['profile_photo']) ?>" alt="Profile Photo" class="rounded-circle" width="50" height="50">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <h5 class="dropdown-header">Account</h5>
                            <li><a class="dropdown-item" href="../profile.php?profile_id=<?php echo $profile['profile_id'] ?>">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-header" href="#">Try Premium for $0</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../profile-settings-privacy.php?profile_id=<?php echo $profile['profile_id'] ?>">Settings & Privacy</a></li>
                            <li><a class="dropdown-item" href="#">Help</a></li>
                            <li><a class="dropdown-item" href="./language_settings.php?profile_id=<?php echo $profile['profile_id'] ?>">Language</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <h5 class="dropdown-header">Manage</h5>
                            <li><a class="dropdown-item" href="#">Posts & Activity</a></li>
                            <li><a class="dropdown-item" href="#">Jobs</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                    </div>

                </div>
            </nav>
            <!-- End Header Navbar -->

            <hr>
            <hr>
            <hr>

            <div class="container-xl px-4 mt-4">
                <!-- Account page navigation-->
                <nav class="nav nav-borders">
                    <a class="nav-link active ms-0" href="edit-profile.php?profile_id=<?php echo $profile['profile_id'] ?>" target=" __blank">Profile</a>
                    <a class="nav-link" href="./billing-profile.php?profile_id=<?php echo $profile['profile_id'] ?>" target=" __blank">Billing</a>
                    <a class="nav-link" href="./security-profile.php?profile_id=<?php echo $profile['profile_id'] ?>" target=" __blank">Security</a>
                    <a class="nav-link" href="./notifications-profile.php?profile_id=<?php echo $profile['profile_id'] ?>" target=" __blank">Notifications</a>
                </nav>
                <hr class="mt-0 mb-4">
                <div class="row">
                    <div class="col-xl-4">
                        <!-- Profile picture card-->
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header">Profile Picture</div>
                            <div class="card-body text-center">
                                <!-- Profile picture container -->
                                <div class="profile-pic-container mb-3" id="profile_pic_display">
                                    <!-- Output the profile photo with appropriate MIME type -->
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($profile['profile_photo']); ?>" alt="Profile Photo">
                                </div>
                                <!-- Hidden profile photo container -->
                                <div class="hidden-profile-pic-container mb-3" id="hiddenProfilePhotoContainer" style="display: none;">
                                    <img src="#" alt="Hidden Profile Photo" class="hidden-profile-image" id="hiddenProfilePhoto">
                                </div>
                                <!-- Profile picture help block-->
                                <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                                <form id="profileFormPic" action="update-pic.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="profile_id" value="<?php echo $profile['profile_id']; ?>">
                                    <input type="file" class="form-control" id="profile_photo" name="update_profile_photo" hidden="" onchange="handlePhotoChange(event)" accept="image/*">
                                    <label class="btn btn-primary" for="profile_photo">Upload new image</label>
                                    <button type="button" class="btn btn-danger" onclick="removeProfilePhoto()">Remove</button>
                                    <button type="submit" id="submit_button" class="btn btn-success" style="display: none;">Save</button>
                                </form>
                            </div>
                        </div>



                    </div>
                    <div class="col-xl-8">
                        <!-- Account details card-->
                        <div class="card mb-4">
                            <div class="card-header">Account Details</div>
                            <div class="card-body">
                                <form id="profileForm" action="./update.php" method="POST">
                                    <!-- Form Group (username)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputUsername">Username (how your name will appear to other users on the site)</label>
                                        <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value="username">
                                    </div>
                                    <!-- Form Row-->
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (first name)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputFirstName">First name</label>
                                            <input type="text" class="form-control" id="profile_first_name" placeholder="Enter your first name" name="profile_first_name" value="<?php echo isset($profile['profile_first_name']) ? $profile['profile_first_name'] : ''; ?>" required />
                                        </div>
                                        <!-- Form Group (last name)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputLastName">Last name</label>
                                            <input type="text" class="form-control" id="profile_family_name" placeholder="Enter your last name" name="profile_family_name" value="<?php echo isset($profile['profile_family_name']) ? $profile['profile_family_name'] : ''; ?>" required />
                                        </div>
                                    </div>
                                    <!-- Form Group (email address)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                        <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="name@example.com">
                                    </div>
                                    <!-- Form Row-->
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (phone number)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputPhone">Phone number</label>
                                            <input class="form-control" id="inputPhone" type="tel" placeholder="Enter your phone number" value="555-123-4567">
                                        </div>
                                        <!-- Form Group (birthday)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputBirthday">Birthday</label>
                                            <input class="form-control" id="inputBirthday" type="date" name="birthday" placeholder="Enter your birthday">
                                        </div>
                                    </div>
                                    <!-- Form Row -->
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (Current position)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputOrgName">Current position</label>
                                            <input type="text" class="form-control" placeholder="Enter your Current position" id="profile_current_position" name="profile_current_position" value="<?php echo isset($profile['profile_current_position']) ? $profile['profile_current_position'] : ''; ?>" />
                                        </div>
                                        <!-- Form Group (Education)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputLocation">Education</label>
                                            <input type="text" class="form-control" placeholder="Enter your Education" id="profile_education" name="profile_education" value="<?php echo isset($profile['profile_education']) ? $profile['profile_education'] : ''; ?>" />
                                        </div>
                                    </div>

                                    <!-- Save changes button-->
                                    <button class="btn btn-primary" type="submit">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="bg-dark text-center text-white py-3 mt-5">
                <div class="container">
                    <p>&copy; 2024 All rights reserved to <b>be.net</b></p>
                </div>
            </footer>

            <!-- Alert Popup 
            <div class="alert-popup" id="alertPopup">
                <div class="alert-content">
                    <div class="alert-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="alert-message">
                        Profile Picture Updated Successfully
                    </div>
                </div>
                <button class="close-btn" onclick="closeAlertPopup()">Close</button>
            </div>-->

            <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js'></script>

            <script>
                // Function to handle file input change for profile photo
                function handlePhotoChange(event) {
                    const file = event.target.files[0];
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const profilePhoto = document.getElementById('profile_pic_display');
                        const hiddenProfilePhotoContainer = document.getElementById('hiddenProfilePhotoContainer');

                        // Set the source of hidden profile photo
                        document.getElementById('hiddenProfilePhoto').src = e.target.result;

                        // Show the hidden profile photo container and hide the displayed photo
                        profilePhoto.style.display = 'none';
                        hiddenProfilePhotoContainer.style.display = 'block';

                        // Display the save button
                        document.getElementById('submit_button').style.display = 'inline';
                    };

                    reader.readAsDataURL(file);
                }


                function removeProfilePhoto() {
                    // Get the profile photo display element
                    var profilePhotoDisplay = document.getElementById('profile_pic_display');

                    // Get the hidden profile photo container
                    var hiddenProfilePhotoContainer = document.getElementById('hiddenProfilePhotoContainer');

                    // Set the source of the hidden profile photo to the default profile photo
                    document.getElementById('hiddenProfilePhoto').src = "../../assets/images/banner.jpg";

                    // Hide the profile photo display element
                    profilePhotoDisplay.style.display = 'none';

                    // Show the hidden profile photo container
                    hiddenProfilePhotoContainer.style.display = 'block';

                    // Display the save button
                    document.getElementById('submit_button').style.display = 'inline';
                }



                // Function to show the alert popup
                function showAlertPopup() {
                    var alertPopup = document.getElementById('alertPopup');
                    alertPopup.style.display = 'block';
                }

                // Function to close the alert popup
                function closeAlertPopup() {
                    var alertPopup = document.getElementById('alertPopup');
                    alertPopup.style.display = 'none';
                }
            </script>

        </body>

        </html>

<?php
    } else {
        // profilee not found or null, handle this case
        echo "profile not found or null";
    }
} else {
    // Invalid request, handle this case
    echo "Invalid request";
}
?>