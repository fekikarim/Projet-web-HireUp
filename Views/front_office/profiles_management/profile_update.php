<?php
session_start();

/*
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}*/

// Check if profile ID is provided in the URL
if (!isset($_GET['profile_id'])) {
    header('Location: ../pages/404.php');
    exit();
}

// Include database connection and profile controller
require_once __DIR__ . '/../../../Controls/profileController.php';


// Initialize profile controller
$profileController = new ProfileC();

// Get profile ID from the URL
$profile_id = $_GET['profile_id'];

// Fetch profile data from the database
$profile = $profileController->getProfileById($profile_id);

// Check if profile data is retrieved successfully
if (!$profile) {
    header('Location: ../pages/404.php');
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../assets/images/HireUp_icon.ico" />
    <title>Profile Details</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css'>
    <link rel="stylesheet" href="./assets/css/profile_update_style.css">

</head>

<body>

    <!-- Header Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand ms-4" href="../index.html">
                <img class="logo-img" alt="HireUp">
            </a>

            <!-- Profile Dropdown -->
            <div class="dropdown ms-auto">
                <a href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false" class="d-flex align-items-center justify-content-center mx-3" style="height: 100%;">
                    <img src="data:image/jpeg;base64,<?= base64_encode($profile['profile_photo']) ?>" alt="Profile Photo" class="rounded-circle" width="50" height="50">
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <h5 class="dropdown-header">Account</h5>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-header" href="#">Try Premium for $0</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Settings & Privacy</a></li>
                    <li><a class="dropdown-item" href="#">Help</a></li>
                    <li><a class="dropdown-item" href="#">Language</a></li>
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

    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Page title -->
                <div class="my-5">
                    <h3>My Profile</h3>
                    <hr>
                </div>
                <!-- Form START -->
                <form class="file-upload" id="profileForm" action="./update.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" id="profile_id" name="profile_id" value="<?php echo isset($profile['profile_id']) ? $profile['profile_id'] : ''; ?>" readonly />
                    <div class="row mb-5 gx-5">
                        <!-- Contact detail -->
                        <div class="col-xxl-8 mb-5 mb-xxl-0">
                            <div class="bg-secondary-soft px-4 py-5 rounded">
                                <div class="row g-3">
                                    <h4 class="mb-4 mt-0">Contact detail</h4>
                                    <!-- First Name -->
                                    <div class="col-md-6">
                                        <label for="firstName" class="form-label">First Name *</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" onkeyup="validateFName()" id="profile_first_name" name="profile_first_name" value="<?php echo isset($profile['profile_first_name']) ? $profile['profile_first_name'] : ''; ?>" />
                                            <span id="fname_error"></span>
                                        </div>
                                    </div>
                                    <!-- Last Name -->
                                    <div class="col-md-6">
                                        <label for="familyName" class="form-label">Family Name *</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" onkeyup="validateLName()" id="profile_family_name" name="profile_family_name" value="<?php echo isset($profile['profile_family_name']) ? $profile['profile_family_name'] : ''; ?>" />
                                            <span id="lname_error"></span>
                                        </div>
                                    </div>
                                    <!-- Current position -->
                                    <div class="col-md-6">
                                        <label class="form-label">Current position *</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" onkeyup="validatePos()" id="profile_current_position" name="profile_current_position" value="<?php echo isset($profile['profile_current_position']) ? $profile['profile_current_position'] : ''; ?>" />
                                            <span id="pos_error"></span>
                                        </div>
                                    </div>
                                    <!-- Education -->
                                    <div class="col-md-6">
                                        <label class="form-label">Education *</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" onkeyup="validateEdu()" id="profile_education" name="profile_education" value="<?php echo isset($profile['profile_education']) ? $profile['profile_education'] : ''; ?>" />
                                            <span id="edu_error"></span>
                                        </div>
                                    </div>
                                    <!-- Region -->
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">Region *</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" onkeyup="validateRegion()" id="profile_region" name="profile_region" value="<?php echo isset($profile['profile_region']) ? $profile['profile_region'] : ''; ?>" />
                                            <span id="region_error"></span>
                                        </div>
                                    </div>
                                    <!-- Ville -->
                                    <div class="col-md-6">
                                        <label class="form-label">City *</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" onkeyup="validateCity()" id="profile_city" name="profile_city" value="<?php echo isset($profile['profile_city']) ? $profile['profile_city'] : ''; ?>" />
                                            <span id="city_error"></span>
                                        </div>
                                    </div>

                                    <!-- Gender 
                                    <div class="col-md-6">
                                        <label class="form-label">Gender *</label>
                                        <input type="text" class="form-control" onkeyup="validateGender()" id="genderValue" name="new_data" value="<?php echo "profile['profile_gender'];" ?>">
                                        <span id="gender_error"></span>
                                    </div>-->
                                    <!-- Birdhday 
                                    <div class="col-md-6">
                                        <label class="form-label">Birdhday *</label>
                                        <input type="text" class="form-control" onkeyup="validateBDay()" id="birthdayValue" name="new_data" value="<?php echo "profile['profile_birthday'];" ?>">
                                        <span id="bday_error"></span>
                                    </div>-->
                                    <!-- Bio -->
                                    <div class="col-md-6 w-100">
                                        <label class="form-label">Bio *</label>
                                        <div class="position-relative">
                                            <textarea class="form-control" rows="3" onkeyup="validateBio()" id="profile_bio" name="profile_bio"><?php echo isset($profile['profile_bio']) ? $profile['profile_bio'] : ''; ?></textarea>
                                            <span id="bio_error"></span>
                                        </div>
                                    </div>
                                </div> <!-- Row END -->
                            </div>
                        </div>
                        <!-- Upload profile -->
                        <div class="col-xxl-4">
                            <div class="bg-secondary-soft px-4 py-5 rounded">
                                <div class="row g-3">
                                    <h4 class="mb-4 mt-0">Upload your profile photo</h4>
                                    <div class="text-center">
                                        <!-- Profile picture container -->
                                        <div class="profile-pic-container mb-3" id="profile_pic_display">
                                            <!-- Output the profile photo with appropriate MIME type -->
                                            <div class="profile-photo-wrapper">
                                                <img src="data:image/jpeg;base64,<?php echo base64_encode($profile['profile_photo']); ?>" alt="Profile Photo">
                                            </div>
                                        </div>

                                        <!-- Hidden profile photo container -->
                                        <div class="hidden-profile-pic-container mb-3" id="hiddenProfilePhotoContainer" style="display: none;">
                                            <img src="#" alt="Hidden Profile Photo" class="hidden-profile-image" id="hiddenProfilePhoto">
                                        </div>
                                        <!-- Button -->
                                        <input type="file" class="form-control" id="profile_photo" name="update_profile_photo" hidden="" onchange="handlePhotoChange(event)" accept="image/*">
                                        <label class="btn btn-success-soft btn-block" for="profile_photo">Upload</label>
                                        <button type="button" class="btn btn-danger-soft" onclick="removeProfilePhoto()">Remove</button>
                                        <!-- Content -->
                                        <p class="text-muted mt-3 mb-0"><span class="me-1">Note:</span>Minimum size 300px x 300px</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Row END -->
                    <!-- Social media detail
                            <div class="row mb-5 gx-5">
                                <div class="col-xxl-6 mb-5 mb-xxl-0">
                                    <div class="bg-secondary-soft px-4 py-5 rounded">
                                        <div class="row g-3">
                                            <h4 class="mb-4 mt-0">Social media detail</h4>
                                            Facebook 
                                            <div class="col-md-6">
                                                <label class="form-label"><i class="fab fa-fw fa-facebook me-2 text-facebook"></i>Facebook *</label>
                                                <input type="text" class="form-control" placeholder="" aria-label="Facebook" value="">
                                            </div>
                                            Instragram 
                                            <div class="col-md-6">
                                                <label class="form-label"><i class="fab fa-fw fa-instagram text-instagram me-2"></i>Instagram *</label>
                                                <input type="text" class="form-control" placeholder="" aria-label="Instragram" value="">
                                            </div>
                                            Dribble 
                                            <div class="col-md-6">
                                                <label class="form-label"><i class="fas fa-fw fa-basketball-ball text-dribbble me-2"></i>Dribble *</label>
                                                <input type="text" class="form-control" placeholder="" aria-label="Dribble" value="">
                                            </div>
                                            Pinterest 
                                            <div class="col-md-6">
                                                <label class="form-label"><i class="fab fa-fw fa-pinterest text-pinterest"></i>Pinterest *</label>
                                                <input type="text" class="form-control" placeholder="" aria-label="Pinterest" value="">
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                         Row END 
                    -->

                    <!-- Upload your profile cover -->
                    <div class="col mb-5">
                        <div class="bg-secondary-soft px-4 py-5 rounded">
                            <div class="row g-3">
                                <h4 class="my-4">Upload your profile cover</h4>
                                <div class="text-center">
                                    <!-- Image upload -->
                                    <div class="profile-cover-container w-100 mb-3" id="profile_cover_display">
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($profile['profile_cover']); ?>" alt="Profile Cover" class="profile-cover-image">
                                    </div>
                                    <!-- Hidden profile cover container -->
                                    <div class="hidden-profile-cover-container w-100 mb-3" id="hiddenProfileCoverContainer" style="display: none;">
                                        <img src="#" alt="Hidden Profile Cover" class="hidden-profile-cover" id="hiddenProfileCover">
                                    </div>
                                    <!-- Button -->
                                    <input type="file" class="form-control" id="profile_cover" name="update_profile_cover" onchange="handleCoverChange(event)" accept="image/*" hidden="">
                                    <label class="btn btn-success-soft btn-block" for="profile_cover">Upload</label>
                                    <button type="button" class="btn btn-danger-soft" onclick="removeProfileCover()">Remove</button>
                                    <!-- Content -->
                                    <p class="text-muted mt-3 mb-0"><span class="me-1">Note:</span>Minimum size 1352px x 300px</p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div> <!-- Row END -->
            <br>
            <hr>
            <br>
            <!-- button -->
            <div class="gap-3 d-md-flex justify-content-center text-center">
                <button type="button" class="btn btn-info btn-lg"><a href="javascript:history.go(-1);">Cancel</a></button>
                <button onclick="return validateForm()" id="submit_button" class="btn btn-primary btn-lg">Update profile</button>
            </div>
            <span id="submit_error" class="text-center mt-4"></span>
            </form> <!-- Form END -->
        </div>
    </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-center text-white py-3 mt-4">
        <div class="container">
            <p>&copy; 2024 All rights reserved to <b>be.net</b></p>
        </div>
    </footer>

    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js'></script>
    <script src="./assets/js/inputC_update.js"></script>

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
            };

            reader.readAsDataURL(file);
        }


        // Function to handle file input change for profile cover
        function handleCoverChange(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const profileCover = document.getElementById('profile_cover_display');
                const hiddenProfileCoverContainer = document.getElementById('hiddenProfileCoverContainer');

                // Set the source of hidden profile cover
                document.getElementById('hiddenProfileCover').src = e.target.result;

                // Show the hidden profile cover container and hide the displayed cover
                profileCover.style.display = 'none';
                hiddenProfileCoverContainer.style.display = 'block';
            };

            reader.readAsDataURL(file);
        }


        function removeProfilePhoto() {
            // Get the profile photo display element
            var profilePhotoDisplay = document.getElementById('profile_pic_display');

            // Get the hidden profile photo container
            var hiddenProfilePhotoContainer = document.getElementById('hiddenProfilePhotoContainer');

            // Set the source of the hidden profile photo to the default profile photo
            document.getElementById('hiddenProfilePhoto').src = "../assets/images/banner.jpg";

            // Hide the profile photo display element
            profilePhotoDisplay.style.display = 'none';

            // Show the hidden profile photo container
            hiddenProfilePhotoContainer.style.display = 'block';
        }


        function removeProfileCover() {
            // Get the profile cover display element
            var profileCoverDisplay = document.getElementById('profile_cover_display');

            // Get the hidden profile cover container
            var hiddenProfileCoverContainer = document.getElementById('hiddenProfileCoverContainer');

            // Set the source of the hidden profile cover to the default cover photo
            document.getElementById('hiddenProfileCover').src = "./assets/img/default_cover.png";

            // Hide the profile cover display element
            profileCoverDisplay.style.display = 'none';

            // Show the hidden profile cover container
            hiddenProfileCoverContainer.style.display = 'block';
        }
    </script>

</body>

</html>