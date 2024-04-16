<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HireUp Dashboard</title>
    <link rel="shortcut icon" type="../../../assets/image/png" href="../../../assets/images/logos/HireUp_icon.ico" />
    <link rel="stylesheet" href="../../../assets/css/styles.min.css" />

    <link rel="stylesheet" href="../../../assets/css/search_bar_style.css" />

    <style>
        .logo-img {
            margin: 0 auto;
            /* Center the image horizontally */
            display: block;
            /* Ensure the link occupies full width */
            padding-top: 5%;
        }
    </style>
</head>

<?php

include '../../../Controller/reclamation_con.php';
include '../../../Model/reclamation.php';

// Création d'une instance du contrôleur des événements
$recC = new recCon("reclamations");

// Création d'une instance de la classe Event
$reclamation = null;

if (isset($_GET['id'])){
    $current_id = $_GET['id'];
}


if (
    isset($_POST["sujet"]) &&
    isset($_POST["description"]) &&
    isset($_POST["date_creation"]) &&
    isset($_POST["status"]) &&
    isset($_POST["id_user"])
) {
    if (
        !empty($_POST['sujet']) &&
        !empty($_POST["description"]) &&
        !empty($_POST["date_creation"]) &&
        !empty($_POST["status"]) &&
        !empty($_POST["id_user"])
    ) {
       
        $reclamation = new Reclamation(
            $current_id,
            $_POST['sujet'],
            $_POST['description'],
            $_POST['date_creation'],
            $_POST['status'],
            $_POST['id_user']
        );

        $recC->updateRec($reclamation, $current_id);
        $success_message = "Reclamation Updated successfully!";
        header('Location: ../../../View\back_office\reclamations managment\recs_management.php?success_global=' . urlencode($success_message));
    } else {
        $error = "Missing information";
    }
} elseif (isset($_GET['id'])) {
    $current_id = $_GET['id'];
    $reclamation = $recC->getRec($current_id);
}





?>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        
        <?php include('../../../View/back_office/dashboard_side_bar.php') ?>

        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">

                    <!--  login place -->
                    <?php #include('../../../View/back_office/header_bar.php') ?>
            
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">Reclamations Management</h5>
                            <!-- Form for adding new job -->
                            <form action="" method="post">
                                <!-- job Information -->
                                <div class="mb-3">
                                    <label for="sujet" class="form-label">Subject</label>
                                    <input type="text" class="form-control" value="<?= $reclamation['sujet']; ?>" id="sujet" name="sujet"
                                        placeholder="Enter the subject" required>
                                    <div id="sujet_error" style="color: red;"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" class="form-control" value="<?= $reclamation['description']; ?>" id="description" name="description"
                                        placeholder="Enter the description" required>
                                    <div id="description_error" style="color: red;"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="date_creation" class="form-label">Creation Date</label>
                                    <input type="date" class="form-control" id="date_creation" value="<?= $reclamation['date_creation']; ?>" name="date_creation" placeholder="Enter the creation date"
                                        required>
                                    <div id="date_creation_error" style="color: red;"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="" <?= ($reclamation['statut'] == '') ? 'selected' : ''; ?> selected disabled>Select a status</option>
                                        <option value="pending request" <?= ($reclamation['statut'] == 'pending request') ? 'selected' : ''; ?> >Pending Request</option>
                                        <option value="in progress" <?= ($reclamation['statut'] == 'in progress') ? 'selected' : ''; ?> >In Progress</option>
                                        <option value="solved" <?= ($reclamation['statut'] == 'solved') ? 'selected' : ''; ?> >Solved</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                    <div id="status_error" style="color: red;"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="id_user" class="form-label">User ID</label>
                                    <input type="text" class="form-control" value="<?= $reclamation['id_user']; ?>" id="id_user" name="id_user" placeholder="Enter the user id"
                                        required>
                                    <div id="id_user_error" style="color: red;"></div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary" onclick="return verif_reclamation_managemet_inputs()">Update Reclamation</button>

                                <div class="mb-3" id="error_global" style="color: red; text-align: center;"></div>
                                <div class="mb-3" id="success_global" style="color: green; text-align: center;"></div>

                            </form>
                        </div>
                    </div>
                </div>

                
            </div>



        </div>
    </div>

    <script src="https://kit.fontawesome.com/86ecaa3fdb.js" crossorigin="anonymous"></script>
    <script src="../../../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/js/sidebarmenu.js"></script>
    <script src="../../../assets/js/app.min.js"></script>
    <script src="../../../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../../../View/back_office/reclamations managment/recs_management_js.js"></script>

    <!-- php error check -->
  <?php

    //global error
    if (isset($_GET['error_global'])) {
        // Retrieve and sanitize the error message
        $error = htmlspecialchars($_GET['error_global']);
        // Inject the error message into the div element
        echo ("<script>document.getElementById('error_global').innerText = '$error';</script>");
    }
  
    //global success
    if (isset($_GET['success_global'])) {
        // Retrieve and sanitize the error message
        $error = htmlspecialchars($_GET['success_global']);
        // Inject the error message into the div element
        echo ("<script>document.getElementById('success_global').innerText = '$error';</script>");
    }

    // fill forms if data exists
    // search by
    if (isset($_GET['sl_search_type'])) {
        // Retrieve and sanitize the error message
        $search_by = htmlspecialchars($_GET['sl_search_type']);
        // Inject the error message into the div element
        echo ("<script>document.getElementById('sl_search_type').value = '$search_by';</script>");
      }
    
      // search inp
      if (isset($_GET['search_inp'])) {
        // Retrieve and sanitize the error message
        $keyword = htmlspecialchars($_GET['search_inp']);
        // Inject the error message into the div element
        echo ("<script>document.getElementById('search_inp').value = '$keyword';</script>");
      }
  
      // role
      if (isset($_GET['sl_role'])) {
        // Retrieve and sanitize the error message
        $role = htmlspecialchars($_GET['sl_role']);
        // Inject the error message into the div element
        echo ("<script>document.getElementById('sl_role').value = '$role';</script>");
      }

      // verified
      if (isset($_GET['sl_verified'])) {
        // Retrieve and sanitize the error message
        $verified = htmlspecialchars($_GET['sl_verified']);
        // Inject the error message into the div element
        echo ("<script>document.getElementById('sl_verified').value = '$verified';</script>");
      }

      // banned
      if (isset($_GET['sl_banned'])) {
        // Retrieve and sanitize the error message
        $banned = htmlspecialchars($_GET['sl_banned']);
        // Inject the error message into the div element
        echo ("<script>document.getElementById('sl_banned').value = '$banned';</script>");
      }

  ?>

</body>

</html>