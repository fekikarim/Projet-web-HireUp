<?php
// Include the controller file
require_once __DIR__ . '/../../../Controls/job_management/JobC.php';

// Create an instance of JobController
$jobController = new JobController();

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["action"] == "update") {
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
      echo $result;
      header("Location: jobs.php");
      exit();
    }
  } elseif ($_POST["action"] == "delete" && isset($_POST["job_id"])) {
    // Delete job
    $job_id = $_POST["job_id"];
    $deleted = $jobController->deleteJob($job_id);
    if ($deleted) {
      echo "Job deleted successfully.";
      header("Location: jobs.php");
      exit();
    } else {
      echo "Error deleting job.";
    }
  }
}


// Fetch all jobs
$jobs = $jobController->getAllJobsWithCategory();
$id_category_options = $jobController->generateCategoryOptions();

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>HireUp</title>
  <meta charset="utf-8" />
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

  <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/css/animations.css" />
  <link rel="stylesheet" href="../assets/css/font-awesome.css" />
  <link rel="stylesheet" href="../assets/css/main.css" class="color-switcher-link" />
  <script src="../assets/js/vendor/modernizr-2.6.2.min.js"></script>

  <link href="../assets/images/HireUp_icon.ico" rel="icon">

  <style>
    /* Popup modal styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 9999;
      /* Ensure it overlays other content */
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.5);
      /* Semi-transparent background */
    }

    .valid-message {
      color: #aaa;
    }

    .modal-content {
      background-color: #fefefe;
      margin: auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      max-width: 1000px;
      /* Limit maximum width */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      /* Add shadow for depth */
      z-index: 99999;
      /* Ensure it overlays other content */
    }

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

    /* Adjustments to the main content when modal is open */
    .modal-open {
      overflow: hidden;
      /* Prevent scrolling */
    }
  </style>

</head>

<body>
  <div class="preloader">
    <div class="preloader_image"></div>
  </div>



  <!-- wrappers for visual page editor and boxed version of template -->
  <div id="canvas">
    <div id="box_wrapper">
      <!-- template sections -->

      <!--topline section visible only on small screens|-->

      <section class="page_toplogo ls s-py-15 text-center">
        <div class="container-fluid">
          <div class="row align-items-center">
            <div class="col-lg-4">
              <div class="d-lg-flex justify-content-lg-end align-items-lg-center">
                <span class="social-icons top">
                  <a href="https://www.facebook.com/profile.php?id=61557532202485" class="fa fa-facebook" title="facebook"></a>
                  <a href="https://www.instagram.com/hire.up.tn/" class="fa fa-instagram" title="instagram"></a>
                  <a href="#" class="fa fa-google" title="google"></a>
                  <a href="#" class="fa fa-linkedin" title="linkedin"></a>
                  <a href="#" class="fa fa-pinterest-p" title="linkedin"></a>
                </span>
              </div>
            </div>
            <div class="col-lg-4 text-center">
              <div class="text-center">
                <div class="header_logo_center">
                  <a href="../index.php" class="logo">
                    <span class="logo_text">Hire</span>
                    <img src="../assets/images/HireUp_logo.png" alt="" />
                    <span class="logo_subtext">Up</span>
                  </a>
                </div>
                <!-- eof .header_left_logo -->
              </div>
            </div>
            <div class="col-lg-4">
              <button class="btn-outline-darkgrey d-none d-lg-block">
                Looking for Staff?
              </button>
            </div>
          </div>
        </div>
      </section>

      <!-- header with single Bootstrap column only for navigation and includes. Used with topline and toplogo sections. Menu toggler must be in toplogo section -->
      <header class="page_header ls s-bordertop nav-narrow justify-nav-center text-center">
        <div class="container-fluid">
          <div class="row align-items-center">
            <div class="col-xl-12">
              <div class="nav-wrap">
                <!-- main nav start -->
                <nav class="top-nav">
                  <ul class="nav sf-menu">
                    <li class="active">
                      <a href="./index.php">Homepage</a>
                    </li>

                    <li>
                      <a href="../../back_office/profiles_management/profile_management.php">Profile</a>
                    </li>
                    <!-- eof pages -->

                    <li>
                      <a href="../../back_office/job_management.php">Job</a>
                    </li>

                    <li>
                      <a href="../../back_office/index.html">FeedBack</a>
                    </li>

                    <!-- blog -->
                    <li>
                      <a href="../pages/blog-left.html">Blog</a>
                    </li>
                    <!-- eof blog -->

                    <!-- contacts -->
                    <li>
                      <a href="">Contacts</a>
                    </li>
                    <!-- eof contacts -->

                    <li>
                      <a href="./about.html">About</a>
                    </li>

                  </ul>
                </nav>
                <!-- eof main nav -->
              </div>
            </div>
          </div>
        </div>

        <!-- header toggler -->

        <span class="toggle_menu">
          <span></span>
        </span>
      </header>



      <section class="page_title cs gradientvertical-background s-py-25">
        <div class="container">
          <div class="row">
            <div class="divider-50"></div>

            <div class="col-md-12 text-center">
              <h1 class="">Jobs</h1>
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="../index.html">Home</a>
                </li>

                <li class="breadcrumb-item active">Jobs</li>
              </ol>
            </div>

            <div class="divider-50"></div>
          </div>
        </div>
      </section>

      <section class="ls s-py-50 s-py-50">
        <div class="container">
          <div class="d-none d-lg-block divider-110"></div>

          <div class="row">
            <div class="col-lg-12 blog_slider">
              <section class="page_slider">
                <div class="flexslider" data-dots="true" data-nav="false">
                  <ul class="slides blog-slides">
                    <li class="cover-image ds s-overlay">
                      <img src="../assets/images/img_01.jpg" alt="" />
                      <div class="container">
                        <div class="row">
                          <div class="col-md-12 text-center">
                            <div class="blog intro_layers_wrapper">
                              <div class="intro_layers">
                                <div class="intro_layer" data-animation="slideUp">
                                  <h4>Welcome to</h4>
                                  <h2 class="text-uppercase">
                                    HireUp
                                  </h2>
                                </div>
                              </div>
                              <!-- eof .intro_layers -->
                            </div>
                            <!-- eof .intro_layers_wrapper -->
                          </div>
                          <!-- eof .col-* -->
                        </div>
                        <!-- eof .row -->
                      </div>
                      <!-- eof .container -->
                    </li>

                    <li class="cover-image ds s-overlay">
                      <img src="../assets/images/img_04.jpg" alt="" />
                      <div class="container">
                        <div class="row">
                          <div class="col-md-12 text-center">
                            <div class="blog intro_layers_wrapper">
                              <div class="intro_layers">
                                <div class="intro_layer" data-animation="pullDown">
                                  <h4>Receiving</h4>
                                </div>
                                <div class="intro_layer" data-animation="pullUp">
                                  <h2 class="text-uppercase">A Job Offer</h2>
                                </div>
                              </div>
                              <!-- eof .intro_layers -->
                            </div>
                            <!-- eof .intro_layers_wrapper -->
                          </div>
                          <!-- eof .col-* -->
                        </div>
                        <!-- eof .row -->
                      </div>
                      <!-- eof .container -->
                    </li>

                    <li class="cover-image ds s-overlay">
                      <img src="../assets/images/img_03.jpg" alt="" />
                      <div class="container">
                        <div class="row">
                          <div class="col-md-12 text-center">
                            <div class="blog intro_layers_wrapper intro_text_bottom">
                              <div class="intro_layers">
                                <div class="intro_layer" data-animation="slideLeft">
                                  <h4>Keep in touch</h4>
                                </div>
                                <div class="intro_layer" data-animation="slideRight">
                                  <h2 class="text-uppercase">Stay Updated</h2>
                                </div>
                              </div>
                              <!-- eof .intro_layers -->
                            </div>
                            <!-- eof .intro_layers_wrapper -->
                          </div>
                          <!-- eof .col-* -->
                        </div>
                        <!-- eof .row -->
                      </div>
                      <!-- eof .container -->
                    </li>
                  </ul>
                </div>
                <!-- eof flexslider -->
              </section>
            </div>
          </div>

          <!-- Create Job Form -->
          <div class="container mb-5">
            <div class="row">
              <div class="col-md-12">
                <h2>Add New Job</h2>
                <form id="createJobForm" method="post" action="addJob.php">
                  <!-- Input fields for job details -->

                  <div class="form-group">
                    <label for="job_title">Job Title</label>
                    <input type="text" class="form-control" id="job_title" name="job_title">
                    <span id="job_title_error" class="text-danger"></span> <!-- Error message placeholder -->
                  </div>
                  <div class="form-group">
                    <label for="company">Company</label>
                    <input type="text" class="form-control" id="company" name="company">
                    <span id="job_company_error" class="text-danger"></span> <!-- Error message placeholder -->
                  </div>
                  <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" id="location" name="location">
                    <span id="job_location_error" class="text-danger"></span> <!-- Error message placeholder -->
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    <span id="job_desc_error" class="text-danger"></span> <!-- Error message placeholder -->
                  </div>
                  <div class="form-group">
                    <label for="salary">Salary</label>
                    <input type="text" class="form-control" id="salary" name="salary">
                    <span id="job_salary_error" class="text-danger"></span> <!-- Error message placeholder -->
                  </div>
                  <div class="form-group">
                    <label for="category" class="form-label">Category *</label>
                    <select class="form-select" id="category" name="category" required>
                      <option value="" selected disabled>Select Category</option>
                      <?php echo $id_category_options; ?>
                    </select>
                    <span id="job_category_error" class="text-danger"></span>
                  </div>

                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>

          <!-- Popup Form for Editing Job -->
          <div id="updateJobModal" class="modal">
            <div class="modal-content">
              <span class="close">&times;</span>
              <h2>Edit Job</h2>
              <form id="updateJobForm" method="post">
                <!-- Form fields for updating job details -->
                <input type="hidden" name="action" value="update">
                <div class="form-group">
                  <label for="update_job_id">Job ID *</label>
                  <input type="text" class="form-control" id="update_job_id" name="job_id" readonly>

                </div>
                <div class="form-group">
                  <label for="update_job_title">Job Title:</label>
                  <input type="text" id="update_job_title" name="job_title" class="form-control">
                  <span id="update_job_title_error" class="text-danger"></span> <!-- Error message placeholder -->

                </div>
                <div class="form-group">
                  <label for="update_company">Company:</label>
                  <input type="text" id="update_company" name="company" class="form-control">
                  <span id="update_company_error" class="text-danger"></span> <!-- Error message placeholder -->
                </div>
                <div class="form-group">
                  <label for="update_location">Location:</label>
                  <input type="text" id="update_location" name="location" class="form-control">
                  <span id="update_location_error" class="text-danger"></span> <!-- Error message placeholder -->
                </div>
                <div class="form-group">
                  <label for="update_description">Description:</label>
                  <textarea id="update_description" name="description" class="form-control" rows="4"></textarea>
                  <span id="update_description_error" class="text-danger"></span> <!-- Error message placeholder -->
                </div>
                <div class="form-group">
                  <label for="update_salary">Salary:</label>
                  <input type="text" id="update_salary" name="salary" class="form-control">
                  <span id="update_salary_error" class="text-danger"></span> <!-- Error message placeholder -->
                </div>
                <div class="form-group">
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

          <div class="container">
            <div class="row c-gutter-60 mt-20">
              <main class="col-lg-7 col-xl-8 order-lg-2">
                <!-- Front-end code to display dynamically fetched jobs -->

                <!-- Display each job as an article -->
                <?php foreach ($jobs as $job) : ?>
                  <article class="text-center text-md-left vertical-item content-padding bordered post type-post status-publish format-standard has-post-thumbnail sticky position-relative">
                    <!-- Dropdown menu -->
                    <div class="dropdow mr-3" style="position: absolute; top: 10px; right: 10px;">
                      <span class="dropdown" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer; color: #000; font-size: 35px;">...</span>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <button class="dropdown-item edit-btn" data-job-id="<?= $job['id'] ?>" data-job-title="<?= $job['title'] ?>" data-company="<?= $job['company'] ?>" data-location="<?= $job['location'] ?>" data-description="<?= $job['description'] ?>" data-salary="<?= $job['salary'] ?>" data-category="<?= $job['category_name'] ?>">Edit</button>
                        <form method="post" style="display:inline;">
                          <input type="hidden" name="action" value="delete">
                          <input type="hidden" name="job_id" value="<?= $job['id'] ?>">
                          <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this job?')">Delete</button>
                        </form>
                      </div>
                    </div>

                    <!-- Job content -->
                    <div class="item-content">
                      <header class="entry-header">
                        <h3 class="entry-title">
                          <a href="#link" rel="bookmark">
                            <?= $job['title']; ?>
                          </a>
                        </h3>
                      </header>
                      <!-- Job description -->
                      <div class="entry-content">
                        <p>
                          <?= $job['description']; ?>
                        </p>
                      </div>
                      <!-- Job attributes -->
                      <div class="entry-footer">
                        <i class="color-main fa fa-user"></i>
                        <a href="#"> <?= $job['company']; ?> </a>
                        <i class="color-main fa fa-calendar"></i>
                        <a href="#"> <?= $job['date_posted']; ?> </a>
                        <i class="color-main fa fa-map"></i>
                        <a href="#"> <?= $job['location']; ?> </a>
                        <i class="color-main fa fa-money"></i>
                        <a href="#"> <?= $job['salary']; ?> </a>
                        <i class="color-main fa fa-tag"></i>
                        <a href="#"> <?= $job['category_name']; ?> </a> <!-- Display category here -->
                      </div>
                    </div>
                    <!-- .item-content -->
                  </article>
                <?php endforeach; ?>



                <article class="cover-image ds s-overlay post type-post status-publish format-status has-post-thumbnail">
                  <div class="post-thumbnail">
                    <img src="../assets/images/blog-2.jpg" alt="" />
                  </div>
                  <!-- .post-thumbnail -->
                  <header class="entry-header">
                    <img src="../assets/images/testimonial.jpg" class="avatar" alt="" />
                    <div class="entry-meta">
                      <h6>Status</h6>
                      <a class="url" href="blog-left.html">June 7, 2017</a>
                    </div>
                  </header>
                  <h3 class="entry-title">Post format: Status</h3>
                </article>
                <!-- #post-## -->

                <nav class="ls navigation pagination" role="navigation">
                  <h2 class="screen-reader-text">Posts navigation</h2>
                  <div class="nav-links">
                    <a class="prev page-numbers" href="blog-left.html">
                      <i class="fa fa-chevron-left"></i>
                      <span class="screen-reader-text">Previous page</span>
                    </a>
                    <a class="page-numbers" href="blog-left.html">
                      <span class="meta-nav screen-reader-text">Page </span>
                      1
                    </a>
                    <span class="page-numbers current">
                      <span class="meta-nav screen-reader-text">Page </span>
                      2
                    </span>
                    <a class="page-numbers" href="blog-left.html">
                      <span class="meta-nav screen-reader-text">Page </span>
                      3
                    </a>
                    <a class="next page-numbers" href="blog-left.html">
                      <span class="screen-reader-text">Next page</span>
                      <i class="fa fa-chevron-right"></i>
                    </a>
                  </div>
                </nav>
              </main>

              <aside class="col-lg-5 col-xl-4 order-lg-1">
                <div class="widget-title widget_apsc_widget">
                  <h3>Get In Touch</h3>
                  <div class="apsc-icons-wrapper clearfix apsc-theme-4">
                    <div class="apsc-each-profile">
                      <a class="apsc-facebook-icon clearfix" href="https://www.facebook.com/profile.php?id=61557532202485">
                        <div class="apsc-inner-block">
                          <span class="social-icon">
                            <i class="fa fa-facebook apsc-facebook"></i>
                            <span class="media-name">Facebook</span>
                          </span>
                          <span class="apsc-count">35</span>
                          <span class="apsc-media-type">Fans</span>
                        </div>
                      </a>
                    </div>
                    <div class="apsc-each-profile">
                      <a class="apsc-instagram-icon clearfix" href="https://www.instagram.com/hire.up.tn/">
                        <div class="apsc-inner-block">
                          <span class="social-icon">
                            <i class="fa fa-instagram apsc-instagram"></i>
                            <span class="media-name">Instagram</span>
                          </span>
                          <span class="apsc-count">0</span>
                          <span class="apsc-media-type">Followers</span>
                        </div>
                      </a>
                    </div>
                    <div class="apsc-each-profile">
                      <a class="apsc-google-plus-icon clearfix" href="#">
                        <div class="apsc-inner-block">
                          <span class="social-icon">
                            <i class="apsc-google fa fa-google"></i>
                            <span class="media-name">google+</span>
                          </span>
                          <span class="apsc-count">0</span>
                          <span class="apsc-media-type">Followers</span>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>

                <div class="widget-title widget_mailchimp mt-50">
                  <h3>Newsletter</h3>
                  <form class="signup" action="http://webdesign-finder.com/html/invenir-consult/" method="get">
                    <div class="form-group mt-0">
                      <input name="email" type="email" class="mailchimp_email form-control" placeholder="Email Address" />
                    </div>
                    <p>
                      Enter your email address here always to be updated. We
                      promise not to spam!
                    </p>
                  </form>
                </div>

                <div class="widget widget_recent_posts mt-50">
                  <h3>flickr widget</h3>
                  <div class="widget widget_flickr">
                    <ul class="flickr_ul"></ul>
                  </div>
                </div>

                <div class="widget widget_recent_posts mt-50">
                  <h3>Recent Posts</h3>
                  <ul class="media-list darklinks">
                    <li class="media">
                      <a title="#" class="media-left" href="#">
                        <img src="../assets/images/widget_02.jpg" alt="" />
                      </a>
                      <div class="media-body">
                        <h4>
                          <a href="#">Modernising our Talent Programmes</a>
                        </h4>
                        <p>
                          <i class="color-main fa fa-calendar"></i>
                          August 11, 2017
                        </p>
                      </div>
                    </li>

                    <li class="media">
                      <a title="#" class="media-left" href="#">
                        <img src="../assets/images/widget_01.jpg" alt="" />
                      </a>
                      <div class="media-body">
                        <h4>
                          <a href="#">Franki goes to… The Philippines & Indonesia</a>
                        </h4>
                        <p>
                          <i class="color-main fa fa-calendar"></i>
                          August 7, 2017
                        </p>
                      </div>
                    </li>

                    <li class="media">
                      <a title="#" class="media-left" href="#">
                        <img src="../assets/images/widget_03.jpg" alt="" />
                      </a>
                      <div class="media-body">
                        <h4>
                          <a href="#">Getting More For Your Money</a>
                        </h4>
                        <p>
                          <i class="color-main fa fa-calendar"></i>
                          August 6, 2017
                        </p>
                      </div>
                    </li>
                  </ul>
                </div>

                <div class="widget-title widget_search mt-50">
                  <h3>Search on Website</h3>
                  <form method="get" class="searchform" action="http://webdesign-finder.com/html/invenir-consult/">
                    <div class="form-group">
                      <label class="sr-only" for="widget-search">Search for:</label>
                      <input id="widget-search" type="text" value="" name="search" class="form-control" placeholder="Search Keyword" />
                    </div>
                  </form>
                </div>
              </aside>

              <div class="d-none d-lg-block divider-110"></div>
            </div>
          </div>
        </div>
      </section>

      <footer class="page_footer ds s-py-sm-20 s-pt-md-75 s-pb-md-50 s-py-lg-130 c-gutter-60 pb-20 half-section">
        <div class="container">
          <div class="row">
            <div class="footer col-md-4 text-center animate" data-animation="fadeInUp">
              <div class="footer widget text-center">
                <h3 class="widget-title title-menu">Explore</h3>
                <ul class="footer-menu">
                  <li>
                    <a href="#">Job Search</a>
                  </li>
                  <li class="menu1">
                    <a>Consultants</a>
                  </li>
                  <li>
                    <a href="#">Reviews</a>
                  </li>
                  <li class="menu1">
                    <a>Insights</a>
                  </li>
                  <li>
                    <a href="#">Survey</a>
                  </li>
                  <li class="menu1">
                    <a>Careers</a>
                  </li>
                  <li class="border-bottom-0">
                    <a href="#">Contact</a>
                  </li>
                  <li class="menu1 border-bottom-0">
                    <a>About</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="footer col-md-4 text-center animate" data-animation="fadeInUp">
              <div class="text-center">
                <div class="header_logo_center footer-logo-ds">
                  <a href="../index.html" class="logo">
                    <span class="logo_text">Hire</span>
                    <img src="../assets/images/light_logo.png" alt="" />
                    <span class="logo_subtext">Up</span>
                  </a>
                </div>
                <!-- eof .header_left_logo -->
              </div>
              <div class="widget pt-20">
                Duis autem vel eum iriure dolor in hendrerit in vulputate
                velit esse molestie consequat, vel illum dolore eu feugiat
                nulla.
              </div>
              <div class="widget">
                <div class="media">
                  <i class="mx-10 color-main fa fa-map-marker"></i>
                  4518 Spirit Drive, Deland, FL 32720
                </div>

                <div class="media">
                  <i class="mx-10 color-main fa fa-phone"></i>
                  101 123 456 789
                </div>

                <div class="media text-center link">
                  <i class="mx-10 text-center color-main fa fa-envelope"></i>
                  <a href="#">example@example.com</a>
                </div>
              </div>

              <div class="author-social">
                <a title="#" href="https://www.facebook.com/profile.php?id=61557532202485" class="fa fa-facebook color-bg-icon rounded-icon"></a>
                <a title="#" href="https://www.instagram.com/hire.up.tn/" class="fa fa-instagram color-bg-icon rounded-icon"></a>
                <a title="#" href="#" class="fa fa-google color-bg-icon rounded-icon"></a>
              </div>
            </div>
            <div class="footer col-md-4 text-center animate" data-animation="fadeInUp">
              <div class="widget widget_mailchimp">
                <h3 class="widget-title">Newsletter</h3>

                <p>
                  Enter your email address here always to be updated. We
                  promise not to spam!
                </p>

                <form class="signup">
                  <label for="mailchimp_email">
                    <span class="screen-reader-text">Subscribe:</span>
                  </label>

                  <input id="mailchimp_email" name="email" type="email" class="form-control mailchimp_email" placeholder="Email Address" />

                  <button type="submit" class="search-submit">
                    Subscribe
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </footer>

    </div>
    <!-- eof #box_wrapper -->
  </div>
  <!-- eof #canvas -->

  <script src="../assets/js/compressed.js"></script>
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/scripts.js"></script>

  <!-- add JS -->

  <script>
    document.getElementById("createJobForm").addEventListener("submit", function(event) {
      // Reset previous error messages
      document.getElementById("job_title_error").textContent = ""; // Reset error message for job title
      document.getElementById("job_company_error").textContent = ""; // Reset error message for company
      document.getElementById("job_location_error").textContent = ""; // Reset error message for location
      document.getElementById("job_desc_error").textContent = ""; // Reset error message for description
      document.getElementById("job_salary_error").textContent = ""; // Reset error message for salary

      // Get input values
      var jobTitle = document.getElementById("job_title").value.trim();
      var company = document.getElementById("company").value.trim();
      var location = document.getElementById("location").value.trim();
      var description = document.getElementById("description").value.trim();
      var salary = document.getElementById("salary").value.trim();

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

      // Prevent form submission if there's an error message
      if (errorMessage !== "") {
        event.preventDefault();
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
        var inputs = document.querySelectorAll("#createJobForm input");
        var allPopulated = true;
        inputs.forEach(function(input) {
          if (input.value.trim() === "") {
            allPopulated = false;
          }
        });
        return allPopulated;
      }

      // Function to enable/disable submit button based on input fields
      function toggleSubmitButton() {
        var submitButton = document.querySelector("#createJobForm button[type='submit']");
        submitButton.disabled = !checkInputFields();
      }

      // Listen for input event on each input field
      var inputs = document.querySelectorAll("#createJobForm input");
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
      document.getElementById("update_category_error").textContent = "";
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
      if (category === "") {
        errorMessage = "Category is required."; // Set common error message
        displayError("update_category_error", errorMessage, true); // Display error message
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