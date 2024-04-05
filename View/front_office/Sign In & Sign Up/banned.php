<!DOCTYPE html>
<html lang="en">
  <head>
    <title>HireUp</title>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <link rel="stylesheet" href="../../../front office assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../front office assets/css/animations.css" />
    <link rel="stylesheet" href="../../../front office assets/css/font-awesome.css" />
    <link rel="stylesheet" href="../../../front office assets/css/main.css" class="color-switcher-link" />
    <script src="../../../front office assets/js/vendor/modernizr-2.6.2.min.js"></script>

    <link href="../../../front office assets/images/HireUp_icon.ico" rel="icon">
    
  </head>

<?php

include '../../../Controller/user_con.php';
include '../../../Model/user.php';

// Création d'une instance du contrôleur des événements
$userC = new userCon("user");

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

?>

  <body>
    <div class="preloader">
      <div class="preloader_image"></div>
    </div>

    <!-- search modal -->
    <div
      class="modal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="search_modal"
      id="search_modal"
    >
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
      >
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="widget widget_search">
        <form
          method="get"
          class="searchform search-form"
          action="http://webdesign-finder.com/"
        >
          <div class="form-group">
            <input
              type="text"
              value=""
              name="search"
              class="form-control"
              placeholder="Search keyword"
              id="modal-search-input"
            />
          </div>
          <button type="submit" class="btn">Search</button>
        </form>
      </div>
    </div>

    <!-- wrappers for visual page editor and boxed version of template -->
    <div id="canvas">
      <div id="box_wrapper">
        <!-- template sections -->

        <!--eof topline-->

        <section class="page_toplogo ls s-py-15 text-center">
          <div class="container-fluid">
            <div class="row align-items-center">
              <div class="col-lg-4">
                <div
                class="d-lg-flex justify-content-lg-end align-items-lg-center"
                >
                <span class="social-icons top">
                    <a
                      href="https://www.facebook.com/profile.php?id=61557532202485"
                      class="fa fa-facebook"
                      title="facebook"
                    ></a>
                    <a
                      href="https://www.instagram.com/hire.up.tn/"
                      class="fa fa-instagram"
                      title="instagram"
                    ></a>
                    <a href="#" class="fa fa-google" title="google"></a>
                    <a href="#" class="fa fa-linkedin" title="linkedin"></a>
                    <a href="#" class="fa fa-pinterest-p" title="linkedin"></a>
                  </span>
                </div>
              </div>
              <div class="col-lg-4 text-center">
                <div class="text-center">
                  <div class="header_logo_center">
                    <a href="index.html" class="logo">
                      <span class="logo_text">Hire</span>
                      <img src="../../../front office assets/images/HireUp_logo.png" alt="" />
                      <span class="logo_subtext">Up</span>
                    </a>
                  </div>
                  <!-- eof .header_left_logo -->
                </div>
              </div>
              <div class="col-lg-4">
        
                <!--  login place -->
                <?php include('../../../View/back_office/header_bar.php') ?>
                
                <button class="btn-outline-darkgrey d-none d-lg-block">
                  Looking for Staff?
                </button>
              </div>
            </div>
          </div>
        </section>

        <section class="s-pt-75 s-pb-100 error-404 not-found page_404">
          <div class="container">
            <div class="row">
              <div class="d-none d-lg-block divider-60"></div>

              <div class="col-sm-12 text-center">
                <header class="page-header highlight">
                  <h3>Banned!</h3>
                  <p class="text-uppercase">Sorry, your account has been banned.</p>
                  <h6>If you believe this is an error, please contact support.</h6>
              </header>

                <!-- .page-header -->

                <div class="page-content">
                  <div id="search-404" class="widget widget_search">
                    <form role="search" method="get" class="search-form">
                      <p>
                        <a href="#" class="btn btn-outline-darkgrey">Contact Support</a>
                      </p>
                    </form>
                  </div>
                </div>
                <!-- .page-content -->
              </div>
            </div>
          </div>
        </section>
      </div>
      <!-- eof #box_wrapper -->
    </div>
    <!-- eof #canvas -->

    <script src="../../../front office assets/js/compressed.js"></script>
    <script src="../../../front office assets/js/main.js"></script>
  </body>
</html>
