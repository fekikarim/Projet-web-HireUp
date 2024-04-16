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
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" type="image/png" href="./assets/img/logos/HireUp_icon.ico" />
  <title>HireUp Profile</title>

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-wFIuokAbM0ICjtRQwL5Gp9hOGJjsdgzKUTIeuztSdIFlhMUJ7vMm++mw0osVzFyFwBjMM3s02j4K8W68Te0rFQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />

  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />

  <link id="pagestyle" href="./assets/css/material-kit.css?v=3.0.4" rel="stylesheet" />

  <script defer data-site="HireUp.tn" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

  <style>
    #full_bg {
      background-image: url("./assets/img/examples/blog2.jpg");
    }

    #blog02 {
      background-image: url("./assets/img/examples/blog2.jpg");
    }

    @media (min-width: 768px) {
      .navbar.navbar-light .nav-link i {
        color: black;
      }
    }

    @media (min-width: 768px) {
      .navbar.navbar-dark .nav-link i {
        color: white;
      }
    }


    /* Center the modal vertically */
    .modal-dialog {
      display: flex;
      align-items: center;
      min-height: calc(100% - 3.5rem);
      /* Adjust according to your header height */
    }

    /* Center the modal horizontally */
    @media (min-width: 768px) {
      .modal-dialog {
        max-width: 80%;
        margin: auto;
      }
    }


    .edit-btn {
      background-color: #f1f1f1;
      border: none;
      border-radius: 50%;
      width: 30px;
      height: 30px;
      padding: 0;
      margin-left: 5px;
    }

    .edit-btn i {
      color: #555;
      font-size: 14px;
      line-height: 30px;
      margin: 0;
    }


    .nav-link {
      color: #40a2d8;
    }

    .nav-link:hover {
      color: lightblue;
    }

    .nav-link:active {
      color: #555;
    }


    /* Style for profile picture container */
    .profile-picture-container {
      width: 200px;
      height: 200px;
      border-radius: 50%;
      overflow: hidden;
      border: 4px solid #fff;
      /* White border */
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      /* Shadow effect */
      margin: auto;
      /* Center the container */
    }

    /* Style for profile cover container */
    .profile-cover-container {
      width: 100%;
      height: 200px;
      /* Adjust height as needed */
      overflow: hidden;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      /* Shadow effect */
    }

    /* Style for profile cover image */
    .profile-cover-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* Style for hidden profile photo and cover container */
    .hidden-profile-pic-container {
      width: 200px;
      height: 200px;
      border-radius: 50%;
      overflow: hidden;
      border: 4px solid #fff;
      /* White border */
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      /* Shadow effect */
      margin: auto;
      /* Center the container */
    }

    /* Style for profile cover container */
    .hidden-profile-cover-container {
      width: 100%;
      height: 200px;
      /* Adjust height as needed */
      overflow: hidden;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      /* Shadow effect */
    }

    /* Style for hidden profile image */
    .hidden-profile-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* Style for input fields with validation errors */
    .has-error input,
    .has-error select,
    .has-error textarea {
      border-color: #ff0000;
      /* Red border color */
    }

    /* Style for error messages */
    .error-message {
      color: #ff0000;
      /* Red text color */
      font-size: 12px;
      margin-top: 4px;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg position-fixed top-0 z-index-3 w-100 shadow-none my-3 navbar-light">
    <div class="container">

      <a title="#" href="../index.html" class="text-nowrap logo-img">
        <img src="./assets/img/logos/HireUp_lightMode.png" alt="" width="175" height="73" />
      </a>

      <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
      </button>
      <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
          <li class="nav-item dropdown">
            <a class="nav-link nav-icon-hover" href="#" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="data:image/jpeg;base64,<?php echo base64_encode($profile['profile_photo']); ?>" alt="Profile Photo" width="50" height="50" class="rounded-circle" />
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="drop2">
              <div class="message-body">
                <h6 class="dropdown-header">Account</h6>
                <a href="./profile.php" class="dropdown-item">
                  My Profile
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="dropdown-header"><a href="">Try Premium for $0</a></h6>
                <a href="./profile-settings-privacy.php?profile_id=<?php echo $profile['profile_id'] ?>" class="dropdown-item">
                  Settings & Privacy
                </a>

                <a href="#" class="dropdown-item">
                  Help
                </a>
                <a href="#" class="dropdown-item">
                  Language
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="dropdown-header">Manage</h6>
                <a href="#" class="dropdown-item">
                  Posts & Activity
                </a>
                <a href="#" class="dropdown-item">
                  Jobs
                </a>
                <div class="dropdown-divider"></div>
                <a href="../../back_office/interface/authentication-login.html" class="dropdown-item">
                  Sign Out
                </a>
              </div>
            </div>
          </li>
        </ul>
      </div>


    </div>
  </nav>


  <!-- Profile cover -->
  <header>
    <div id="profile_cover" class="page-header min-height-400" style="background-image: url('data:image/jpeg;base64,<?php echo base64_encode($profile['profile_cover']); ?>');" loading="lazy">
      <span class="mask bg-gradient-dark opacity-8"></span>
    </div>
  </header>


  <!-- Profile information -->
  <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6 mb-4">
    <!-- Profile content -->
    <section class="py-sm-7 py-5 position-relative">
      <div class="container">
        <div class="row">
          <div class="col-12 mx-auto">
            <!-- Profile photo -->
            <div class="mt-n8 mt-md-n9 text-center">
              <img class="avatar avatar-xxl shadow-xl position-relative z-index-2" src="data:image/jpeg;base64,<?php echo base64_encode($profile['profile_photo']); ?>" alt="Profile Photo" loading="lazy" />
            </div>
            <div class="row py-5">
              <div class="col-lg-7 col-md-7 z-index-2 position-relative px-md-2 px-sm-5 mx-auto">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <!-- Profile name -->
                  <h3 class="mb-0"><?php echo $profile['profile_first_name'] . ' ' . $profile['profile_family_name']; ?></h3>
                  <!-- Profile follow button -->
                  <div class="d-block">
                    <button type="button" class="btn btn-sm btn-outline-info text-nowrap mb-1">Follow</button>
                  </div>
                  <!-- Profile edit button -->
                  <div class="d-block">
                    <button type="button" class="btn btn-sm btn-outline-info text-nowrap mb-0" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
                  </div>
                </div>
                <!-- Profile statistics -->
                <div class="row mb-4">
                  <div class="col-auto">
                    <span class="h6">323</span>
                    <span>Posts</span>
                  </div>
                  <div class="col-auto">
                    <span class="h6">3.5k</span>
                    <span>Followers</span>
                  </div>
                  <div class="col-auto">
                    <span class="h6">260</span>
                    <span>Following</span>
                  </div>
                </div>
                <!-- Profile bio -->
                <p class="text-lg mb-0"><?php echo $profile['profile_bio']; ?>
                  <br>
                  <!-- Button to trigger modal -->
                  <a href="#" class="text-info icon-move-right" data-bs-toggle="modal" data-bs-target="#profileModal">More about me
                    <i class="fas fa-arrow-right text-sm ms-1"></i>
                  </a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- job management blogs will be shows here -->
    <section class="py-3">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h3 class="mb-5">Check my latest blogposts</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3 col-sm-6">
            <div class="card card-plain">
              <div class="card-header p-0 position-relative">
                <a class="d-block blur-shadow-image">
                  <img src="./assets/img/examples/testimonial-6-2.jpg" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg" loading="lazy" />
                </a>
              </div>
              <div class="card-body px-0">
                <h5>
                  <a href="#" class="text-dark font-weight-bold">Rover raised $65 million</a>
                </h5>
                <p>
                  Finding temporary housing for your dog should be as easy as
                  renting an Airbnb. That's the idea behind Rover ...
                </p>
                <a href="javascript:;" class="text-info text-sm icon-move-right">Read More
                  <i class="fas fa-arrow-right text-xs ms-1"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="card card-plain">
              <div class="card-header p-0 position-relative">
                <a class="d-block blur-shadow-image">
                  <img src="./assets/img/examples/testimonial-6-3.jpg" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg" loading="lazy" />
                </a>
              </div>
              <div class="card-body px-0">
                <h5>
                  <a href="#" class="text-dark font-weight-bold">MateLabs machine learning</a>
                </h5>
                <p>
                  If you've ever wanted to train a machine learning model and
                  integrate it with IFTTT, you now can with ...
                </p>
                <a href="#" class="text-info text-sm icon-move-right">Read More
                  <i class="fas fa-arrow-right text-xs ms-1"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="card card-plain">
              <div class="card-header p-0 position-relative">
                <a class="d-block blur-shadow-image">
                  <img src="./assets/img/examples/blog-9-4.jpg" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg" loading="lazy" />
                </a>
              </div>
              <div class="card-body px-0">
                <h5>
                  <a href="#" class="text-dark font-weight-bold">MateLabs machine learning</a>
                </h5>
                <p>
                  If you've ever wanted to train a machine learning model and
                  integrate it with IFTTT, you now can with ...
                </p>
                <a href="#" class="text-info text-sm icon-move-right">Read More
                  <i class="fas fa-arrow-right text-xs ms-1"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-12 col-12">
            <div class="card card-blog card-background cursor-pointer">
              <div id="full_bg" class="full-background" loading="lazy"></div>
              <div class="card-body">
                <div class="content-left text-start my-auto py-4">
                  <h2 class="card-title text-white">Flexible work hours</h2>
                  <p class="card-description text-white">
                    Rather than worrying about switching offices every couple
                    years, you stay in the same place.
                  </p>
                  <a href="javascript:;" class="text-white text-sm icon-move-right">Read More
                    <i class="fas fa-arrow-right text-xs ms-1"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


  <footer class="footer py-5">
    <div class="container z-index-1 position-relative">
      <div class="row">
        <div class="col-lg-4 me-auto mb-lg-0 mb-4 text-lg-start text-center">
          <h6 class="text-dark font-weight-bolder text-uppercase mb-lg-4 mb-3">
            Be.Net
          </h6>
          <ul class="nav flex-row ms-n3 justify-content-lg-start justify-content-center mb-4 mt-sm-0">
            <li class="nav-item">
              <a class="nav-link text-dark opacity-8" href="../index.html" target="_blank">
                Home
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark opacity-8" href="../pages/about.html" target="_blank">
                About
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark opacity-8" href="#" target="_blank">
                Jobs
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark opacity-8" href="../../services2.html" target="_blank">
                About Us
              </a>
            </li>
          </ul>
          <p class="text-sm text-dark opacity-8 mb-0">
            Copyright ©
            <script>
              document.write(new Date().getFullYear());
            </script>
            HireUp by Be.Net.
          </p>
        </div>
        <div class="col-lg-6 ms-auto text-lg-end text-center">
          <p class="mb-5 text-lg text-dark font-weight-bold">
            The reward for getting on the stage is fame. The price of fame is
            you can't get off the stage.
          </p>
          <a title="#" href="https://www.facebook.com/profile.php?id=61557532202485" class="text-dark me-xl-4 me-4 opacity-5">
            <span class="fab fa-facebook"></span>
          </a>
          <a title="#" href="https://www.instagram.com/hire.up.tn/" class="text-dark me-xl-4 me-4 opacity-5">
            <span class="fab fa-instagram"></span>
          </a>
          <a title="#" href="#" class="text-dark me-xl-4 me-4 opacity-5">
            <span class="fab fa-google"></span>
          </a>
          <a title="#" href="javascript:;" class="text-dark opacity-5">
            <span class="fab fa-github"></span>
          </a>
        </div>
      </div>
    </div>
  </footer>


  <!-- Modal -->
  <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #40a2d8;">
          <h5 class="modal-title text-white" id="profileModalLabel">Profile Information</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs mb-3" id="profileTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="about-tab" data-bs-toggle="tab" data-bs-target="#about" type="button" role="tab" aria-controls="about" aria-selected="true">About</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="followers-tab" data-bs-toggle="tab" data-bs-target="#followers" type="button" role="tab" aria-controls="followers" aria-selected="false">Followers</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="following-tab" data-bs-toggle="tab" data-bs-target="#following" type="button" role="tab" aria-controls="following" aria-selected="false">Following</button>
            </li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <!-- About tab -->
            <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
              <div class="row">
                <!-- Left column for Overview -->
                <div class="col-md-6">
                  <h5>Overview</h5>
                  <hr>

                  <p><strong>Region:</strong> <span id="regionText"><?php echo $profile['profile_region']; ?></span> <button class="edit-btn" onclick="editAttribute('region')"><i class="fas fa-edit"></i></button></p>
                  <div id="regionInput" style="display: none;">
                    <form action="./updateProfile.php" method="post">
                      <input type="hidden" name="profile_id" value="<?php echo $profile['profile_id']; ?>">
                      <input type="hidden" name="attribute" value="region">
                      <input type="text" id="regionValue" name="new_data" value="<?php echo $profile['profile_region']; ?>">
                      <button type="submit" id="submit_button">Confirm</button>
                      <button type="button" onclick="cancelEdit('region')">Cancel</button>
                    </form>
                  </div>
                  <!-- City attribute -->
                  <p><strong>City:</strong> <span id="cityText"><?php echo $profile['profile_city']; ?></span> <button class="edit-btn" onclick="editAttribute('city')"><i class="fas fa-edit"></i></button></p>
                  <div id="cityInput" style="display: none;">
                    <form action="./updateProfile.php" method="post">
                      <input type="hidden" name="profile_id" value="<?php echo $profile_id; ?>">
                      <input type="hidden" name="attribute" value="city">
                      <input type="text" id="cityValue" name="new_data" value="<?php echo $profile['profile_city']; ?>">
                      <button type="submit">Confirm</button>
                      <button type="button" onclick="cancelEdit('city')">Cancel</button>
                    </form>
                  </div>

                  <!-- Bio attribute -->
                  <p><strong>Bio:</strong> <span id="bioText"><?php echo $profile['profile_bio']; ?></span> <button class="edit-btn" onclick="editAttribute('bio')"><i class="fas fa-edit"></i></button></p>
                  <div id="bioInput" style="display: none;">
                    <form action="./updateProfile.php" method="post">
                      <input type="hidden" name="profile_id" value="<?php echo $profile_id; ?>">
                      <input type="hidden" name="attribute" value="bio">
                      <textarea id="bioValue" name="new_data"><?php echo $profile['profile_bio']; ?></textarea>
                      <button type="submit">Confirm</button>
                      <button type="button" onclick="cancelEdit('bio')">Cancel</button>
                    </form>
                  </div>

                  <!-- Current Position attribute -->
                  <p><strong>Current Position:</strong> <span id="positionText"><?php echo $profile['profile_current_position']; ?></span> <button class="edit-btn" onclick="editAttribute('position')"><i class="fas fa-edit"></i></button></p>
                  <div id="positionInput" style="display: none;">
                    <form action="./updateProfile.php" method="post">
                      <input type="hidden" name="profile_id" value="<?php echo $profile_id; ?>">
                      <input type="hidden" name="attribute" value="current_position">
                      <input type="text" id="positionValue" name="new_data" value="<?php echo $profile['profile_current_position']; ?>">
                      <button type="submit">Confirm</button>
                      <button type="button" onclick="cancelEdit('position')">Cancel</button>
                    </form>
                  </div>

                  <p><strong>Education:</strong> <span id="educationText"><?php echo $profile['profile_education']; ?></span> <button class="edit-btn" onclick="editAttribute('education')"><i class="fas fa-edit"></i></button></p>
                  <div id="educationInput" style="display: none;">
                    <form action="./updateProfile.php" method="post">
                      <input type="hidden" name="profile_id" value="<?php echo $profile_id; ?>">
                      <input type="hidden" name="attribute" value="education">
                      <input type="text" id="educationValue" name="new_data" value="<?php echo $profile['profile_education']; ?>">
                      <button type="submit">Confirm</button>
                      <button type="button" onclick="cancelEdit('education')">Cancel</button>
                    </form>
                  </div>
                  <p><strong>Subscription:</strong> <span id="profile_subscription"><?php echo $profile['profile_subscription']; ?></span> <button class="edit-btn" data-attribute="profile_subscription"><i class="fas fa-edit"></i></button></p>
                </div>
                <!-- Right column for Contact and Basic Info -->
                <div class="col-md-6">
                  <h5>Contact and Basic Info</h5>
                  <hr>
                  <p><strong><u>Contact info</u></strong></p>
                  <p><strong>Phone Number:</strong> <?php echo $profile['profile_phone_number']; ?><button class="edit-btn" data-attribute="profile_phone_number"><i class="fas fa-edit"></i></button></p>
                  <p><strong>Email:</strong> <?php echo "from user management" ?></p>
                  <br>
                  <p><strong><u>Websites and Social Links</u></strong></p>
                  <p><strong>Profile Link:</strong> <a id="profileLink" href="http://localhost/HireUp_profile/Views/front_office/profiles_management/profile.php?profile_id=<?php echo $profile['profile_id']; ?>">localhost/HireUp_profile/Views/front_office/profiles_management/profile.php?profile_id=<?php echo $profile['profile_id']; ?></a> <span id="copyLink" class="copy-icon" style="cursor: pointer;"><i class="far fa-copy"></i></span></p>
                  <!-- Add links to websites and social links here -->
                  <br>
                  <p><strong><u>Basic Info</u></strong></p>
                  <!-- Gender attribute -->
                  <p><strong>Gender:</strong> <span id="genderText"><?php echo "profile['profile_gender'];" ?></span> <button class="edit-btn" onclick="editAttribute('gender')"><i class="fas fa-edit"></i></button></p>
                  <div id="genderInput" style="display: none;">
                    <form action="./updateProfile.php" method="post">
                      <input type="hidden" name="profile_id" value="<?php echo $profile_id; ?>">
                      <input type="hidden" name="attribute" value="gender">
                      <input type="text" id="genderValue" name="new_data" value="<?php echo "profile['profile_gender'];" ?>">
                      <button type="submit">Confirm</button>
                      <button type="button" onclick="cancelEdit('gender')">Cancel</button>
                    </form>
                  </div>

                  <!-- Birthday attribute -->
                  <p><strong>Birthday:</strong> <span id="birthdayText"><?php echo "profile['profile_birthday'];" ?></span> <button class="edit-btn" onclick="editAttribute('birthday')"><i class="fas fa-edit"></i></button></p>
                  <div id="birthdayInput" style="display: none;">
                    <form action="./updateProfile.php" method="post">
                      <input type="hidden" name="profile_id" value="<?php echo $profile_id; ?>">
                      <input type="hidden" name="attribute" value="birthday">
                      <input type="text" id="birthdayValue" name="new_data" value="<?php echo "profile['profile_birthday'];" ?>">
                      <button type="submit">Confirm</button>
                      <button type="button" onclick="cancelEdit('birthday')">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <!-- Followers tab -->
            <div class="tab-pane fade" id="followers" role="tabpanel" aria-labelledby="followers-tab">
              <!-- Display followers information here -->
            </div>
            <!-- Following tab -->
            <div class="tab-pane fade" id="following" role="tabpanel" aria-labelledby="following-tab">
              <!-- Display following information here -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!-- Edit Profile Modal -->
  <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="profileForm" action="./update.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" class="form-control" id="profile_id" name="update_profile_id" value="<?php echo isset($profile['profile_id']) ? $profile['profile_id'] : ''; ?>" readonly />
            <!-- Profile picture container -->
            <div class="profile-picture-container" id="profile_pic_display">
              <!-- Output the profile photo with appropriate MIME type -->
              <img src="data:image/jpeg;base64,<?php echo base64_encode($profile['profile_photo']); ?>" alt="Profile Photo" class="img-fluid">
              <input type="file">
            </div>

            <!-- Hidden profile photo container -->
            <div class="hidden-profile-pic-container" id="hiddenProfilePhotoContainer" style="display: none;">
              <img src="#" alt="Hidden Profile Photo" class="hidden-profile-image" id="hiddenProfilePhoto">
            </div>

            <!-- Add input field for profile photo -->
            <div class="mb-3">
              <label for="profile photo" class="form-label">Choose New Profile Photo</label>
              <input type="file" class="form-control" id="profile_photo" name="update_profile_photo" onchange="handlePhotoChange(event)" accept="image/*">
            </div><br>
            <hr>

            <!-- Hidden profile cover container -->
            <div class="hidden-profile-cover-container" id="hiddenProfileCoverContainer" style="display: none;">
              <img src="#" alt="Hidden Profile Cover" class="hidden-profile-image" id="hiddenProfileCover">
            </div>

            <!-- Profile cover container -->
            <div class="profile-cover-container" id="profile_cover_display">
              <!-- Output the profile cover with appropriate MIME type -->
              <img src="data:image/jpeg;base64,<?php echo base64_encode($profile['profile_cover']); ?>" alt="Profile Cover" class="img-fluid profile-cover-image">
            </div><br>

            <!-- Add input field for profile cover -->
            <div class="mb-3">
              <label for="profile cover" class="form-label">Choose New Profile Cover</label>
              <input type="file" class="form-control" id="profile_cover" name="update_profile_cover" onchange="handleCoverChange(event)" accept="image/*">
            </div><br>
            <!-- First Name -->
            <div class="mb-3">
              <label for="firstName" class="form-label">First Name</label>
              <input type="text" class="form-control" id="profile_first_name" name="update_profile_first_name" value="<?php echo isset($profile['profile_first_name']) ? $profile['profile_first_name'] : ''; ?>" required />
            </div>
            <!-- Last Name -->
            <div class="mb-3">
              <label for="lastName" class="form-label">Last Name</label>
              <input type="text" class="form-control" id="profile_family_name" name="update_profile_family_name" value="<?php echo isset($profile['profile_family_name']) ? $profile['profile_family_name'] : ''; ?>" required />
            </div>
            <!-- Bio -->
            <div class="mb-3">
              <label for="bio" class="form-label">Bio</label>
              <textarea class="form-control" rows="3" id="profile_bio" name="update_profile_bio"><?php echo isset($profile['profile_bio']) ? $profile['profile_bio'] : ''; ?></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="submit_button" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>




  <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
  <script src="./assets/js/material-kit.min.js?v=3.0.4" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>


  <script>
    function editAttribute(attribute) {
      // Hide text and show input field
      document.getElementById(attribute + 'Text').style.display = 'none';
      document.getElementById(attribute + 'Input').style.display = 'block';
    }


    function cancelEdit(attribute) {
      // Hide input field
      document.getElementById(attribute + 'Input').style.display = 'none';

      // Show text
      document.getElementById(attribute + 'Text').style.display = 'inline';
    }




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


    // Add event listener to copy link to clipboard when copy icon is clicked
    document.getElementById('copyLink').addEventListener('click', function() {
      var profileLink = document.getElementById('profileLink');
      var tempInput = document.createElement('input');
      tempInput.value = profileLink.href;
      document.body.appendChild(tempInput);
      tempInput.select();
      document.execCommand('copy');
      document.body.removeChild(tempInput);
      alert('Profile link copied to clipboard!');
    });


    //############### CONTROLE DE SAISIE / INPUT CONTROL #########################

    // Initialize input controls when the page loads
    window.addEventListener("load", function() {
      // Initialize input controls
      initializeInputControls();
      initializeInputControls2();

      // Disable submit button initially
      var submitButton = document.getElementById('submit_button');
      submitButton.disabled = true;

      // Disable submit button initially
      var submitButton = document.getElementById('saveChangesButton');
      submitButton.disabled = true;
    });

    // Function to initialize input controls
    function initializeInputControls() {
      // Get all input elements
      var inputs = document.querySelectorAll('input, select, textarea');

      // Loop through each input element
      inputs.forEach(function(input) {
        // Add event listener for input change
        input.addEventListener('input', function() {
          validateInput(this); // Validate the input when it changes
          checkAllInputs(); // Check if all inputs are valid
        });

        // Add event listener for mouse enter
        input.addEventListener('mouseenter', function() {
          showNotification(this); // Show notification when mouse enters the input
        });

        // Add event listener for mouse leave
        input.addEventListener('mouseleave', function() {
          hideNotification(); // Hide notification when mouse leaves the input
        });
      });
    }

    // Function to validate input
    function validateInput(input) {
      // Remove any existing error styles
      input.classList.remove('has-error');
      var errorMessage = input.parentElement.querySelector('.error-message');
      if (errorMessage) {
        errorMessage.remove();
      }

      // Perform validation based on input type and rules
      var value = input.value.trim();
      var fieldName = input.id.replace('profile_', '').replace('_', ' ');

      // Validation rules for each input field
      switch (input.id) {
        case 'profile_first_name':
        case 'profile_family_name':
        case 'profile_region':
          if (!value || value.length < 2 || !/^[a-zA-Z ]+$/.test(value)) {
            displayError(input, fieldName + ' must be at least 2 characters and contain only alphabets.');
          }
          break;
        case 'profile_phone_number':
          break;
        case 'profile_city':
        case 'profile_current_position':
        case 'profile_education':
        case 'profile_bio':
          if (!value || value.length < 2) {
            displayError(input, fieldName + ' must be at least 2 characters.');
          }
          break;
          // Add more cases for other input fields as needed
      }
    }


    // Function to display error message and style the input
    function displayError(input, message) {
      // Add has-error class to the parent div
      input.classList.add('has-error');

      // Create error message element
      var errorMessage = document.createElement('div');
      errorMessage.classList.add('error-message');
      errorMessage.textContent = message;

      // Find the closest ancestor with class "mb-3"
      var mb3Div = input.closest('.mb-3');

      // Append error message below the "mb-3" div
      if (mb3Div) {
        mb3Div.appendChild(errorMessage);
      } else {
        // If "mb-3" div is not found, append error message below the input field
        input.parentElement.appendChild(errorMessage);
      }
    }


    // Function to show notification when mouse enters the input
    function showNotification(input) {
      // Check if the input belongs to the profile add form and is not the phone number input
      var parentForm = input.closest('#profileForm');
      if (parentForm) {
        var notification = document.createElement('div');
        notification.textContent = 'Please input ' + input.id.replace('profile_', '').replace('_', ' ') + '.';
        notification.classList.add('input-notification');

        // Get the parent div with class "mb-3" and append the notification
        var parentDiv = input.closest('.mb-3');
        parentDiv.appendChild(notification);
      }
    }



    // Function to hide notification when mouse leaves the input
    function hideNotification() {
      var notifications = document.querySelectorAll('.input-notification');
      notifications.forEach(function(notification) {
        notification.remove();
      });
    }

    // Function to check if all inputs are valid and enable/disable submit button accordingly
    function checkAllInputs() {
      var inputs = document.querySelectorAll('input, select, textarea');
      var isValid = true;

      inputs.forEach(function(input) {
        if (input.classList.contains('has-error')) {
          isValid = false;
        }
      });

      var submitButton = document.getElementById('submit_button');
      submitButton.disabled = !isValid;

      var submitButton = document.getElementById('saveChangesButton');
      submitButton.disabled = !isValid;
    }


    //######################################################################################


    // Function to initialize input controls
    function initializeInputControls2() {
      // Get all input elements
      var inputs = document.querySelectorAll('input, select, textarea');

      // Loop through each input element
      inputs.forEach(function(input) {
        // Add event listener for input change
        input.addEventListener('input', function() {
          validateInput2(this); // Validate the input when it changes
          checkAllInputs(); // Check if all inputs are valid
        });
      });
    }

    // Function to validate input
    function validateInput2(input) {
      // Remove any existing error styles
      input.classList.remove('has-error');
      var errorMessage = input.parentElement.querySelector('.error-message');
      if (errorMessage) {
        errorMessage.remove();
      }

      // Perform validation based on input type and rules
      var value = input.value.trim();
      var fieldName = input.id.replace('profile_', '').replace('_', ' ');

      // Validation rules for each input field
      switch (input.id) {
        case 'profile_first_name':
        case 'profile_family_name':
        case 'regionValue':
          if (!value || value.length < 2 || !/^[a-zA-Z ]+$/.test(value)) {
            displayError2(input, fieldName + ' must be at least 2 characters and contain only alphabets.');
          }
          break;
        case 'profile_phone_number':
          break;
        case 'cityValue':
        case 'positionValue':
        case 'educationValue':
        case 'bioValue':
          if (!value || value.length < 2) {
            displayError2(input, fieldName + ' must be at least 2 characters.');
          }
          break;
          // Add more cases for other input fields as needed
      }
    }

    // Function to display error message and style the input
    function displayError2(input, message) {
      // Add has-error class to the parent div
      input.classList.add('has-error');

      // Create error message element
      var errorMessage = document.createElement('div');
      errorMessage.classList.add('error-message');
      errorMessage.textContent = message;

      // Find the closest ancestor with class "mb-3"
      var mb3Div = input.closest('.mb-3');

      // Append error message below the "mb-3" div
      if (mb3Div) {
        mb3Div.appendChild(errorMessage);
      } else {
        // If "mb-3" div is not found, append error message below the input field
        input.parentElement.appendChild(errorMessage);
      }
    }
  </script>


</body>

</html>