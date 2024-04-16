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

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['search_inp'])){
    $clickedBtn = $_GET['search_btn'];
    if ($clickedBtn == "search"){
        echo "no sort";
        $keyword = trim($_GET['search_inp']);
        $search_by = trim($_GET['sl_search_type']);
        $role = trim($_GET['sl_role']);
        $verified = trim($_GET['sl_verified']);
        $banned = trim($_GET['sl_banned']);


        // Récupération de la liste des événements
        if (str_replace(' ', '', $keyword) == '') {
            if ( ($role == "none") && ($verified == "none") && ($banned == "none")){
                $users = $userC->listUsers();
            }
            else{
                $users = $userC->searchUser($search_by, $keyword, $role, $verified, $banned);
            }
        }
        else{
            $users = $userC->searchUser($search_by, $keyword, $role, $verified, $banned);
        }
    }
    elseif ($clickedBtn == "sort"){
        echo "sort";
        $keyword = trim($_GET['search_inp']);
        $search_by = trim($_GET['sl_search_type']);
        $role = trim($_GET['sl_role']);
        $verified = trim($_GET['sl_verified']);
        $banned = trim($_GET['sl_banned']);
    
    
        // Récupération de la liste des événements
        if (str_replace(' ', '', $keyword) == '') {
            if ( ($role == "none") && ($verified == "none") && ($banned == "none")){
                $users = $userC->sortUser($search_by);
            }
            else{
                $users = $userC->searchUserSorted($search_by, $keyword, $role, $verified, $banned);
            }
        }
        else{
            $users = $userC->searchUserSorted($search_by, $keyword, $role, $verified, $banned);
        }
    }
    else{
        $users = $userC->listUsers();
    }
}
else{
    $recs = $recC->listRect();
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
                            <form action="./add_rec.php" method="post">
                                <!-- job Information -->
                                <div class="mb-3">
                                    <label for="sujet" class="form-label">Subject</label>
                                    <input type="text" class="form-control" id="sujet" name="sujet"
                                        placeholder="Enter the subject" required>
                                    <div id="sujet_error" style="color: red;"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="description" name="description"
                                        placeholder="Enter the description" required>
                                    <div id="description_error" style="color: red;"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="date_creation" class="form-label">Creation DSate</label>
                                    <input type="date" class="form-control" id="date_creation" name="date_creation" placeholder="Enter the creation date"
                                        required>
                                    <div id="date_creation_error" style="color: red;"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="" selected disabled>Select a status</option>
                                        <option value="pending request">Pending Request</option>
                                        <option value="in progress">In Progress</option>
                                        <option value="solved">Solved</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                    <div id="status_error" style="color: red;"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="id_user" class="form-label">User ID</label>
                                    <input type="text" class="form-control" id="id_user" name="id_user" placeholder="Enter the user id"
                                        required>
                                    <div id="id_user_error" style="color: red;"></div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary" onclick="return verif_reclamation_managemet_inputs_front()">Add Reclamation</button>

                                <div class="mb-3" id="error_global" style="color: red; text-align: center;"></div>
                                <div class="mb-3" id="success_global" style="color: green; text-align: center;"></div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <!-- Table for displaying existing jobs -->
                            <div class="table-responsive">

                                <div>
                                    <form action="" method="">
                                        <div class="mb-3">
                                            
                                            <div class="search-container">
                                                <div class="search-by">
                                                    <label for="search_type">Search By:</label>
                                                    <select class="form-select" id="sl_search_type" name="sl_search_type">
                                                        <option value="everything">Everything</option>
                                                        <option value="id">ID</option>
                                                        <option value="user_name">Username</option>
                                                        <option value="email">Email</option>
                                                    </select>
                                                </div>
                                                <div class="search-input">
                                                    <label for="search_inp">Search:</label>
                                                    <input type="text" class="form-control" id="search_inp" name="search_inp" placeholder="Search">
                                                </div>

                                                <div>
                                                    <label for="search_btn"></label> <br>
                                                    <button type="submit" class="btn btn-primary" id="search_btn" name="search_btn" value="search">Search</button>
                                                    <button type="submit" class="btn btn-primary" id="search_btn" name="search_btn" value="sort">Sort</button>
                                                </div>

                                            </div>

                                            <div id="search_error" style="color: red;"></div>

                                        </div>
                                </form>

                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">ID</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Subject</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Description</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Creation Date</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Status</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">User ID</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Actions</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- job rows will be dynamically added here -->
                                        <!-- Example row (replace with dynamic data from database) -->
                                        <?php
                                            foreach ($recs as $rec) {
                                        ?>
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"><?= $rec['id']; ?></h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"><?= $rec['sujet']; ?></h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"><?= $rec['description']; ?></h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"><?= $rec['date_creation']; ?></h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <?php if ($rec['statut'] == "pending request"): ?>
                                                    <h6 class="fw-semibold mb-0"><i class="fa-solid fa-circle-xmark" style="color: red;"></i></h6>
                                                <?php elseif ($rec['statut'] == "in progress"): ?>
                                                    <h6 class="fw-semibold mb-0"><i class="fa-solid fa-clock" style="color: yellow;"></i></h6>
                                                <?php else: ?>
                                                    <h6 class="fw-semibold mb-0"><i class="fa-solid fa-circle-check" style="color: green;"></i></h6>
                                                <?php endif; ?>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"><?= $rec['id_user']; ?></h6>
                                            </td>
                                            
                                            <td class="border-bottom-0">
                                                <button type="button" class="btn btn-primary btn-sm me-2" onclick="window.location.href = './update_rec.php?id=<?= $rec['id']; ?>';">Update</button>
                                                <button type="button" class="btn btn-danger btn-sm me-2" onclick="window.location.href = './delete_rec.php?id=<?= $rec['id']; ?>';">Delete</button>
                                            </td>
                                        </tr>

                                        <?php
                                            }
                                        ?>
                                        <!-- Add more rows dynamically here -->
                                    </tbody>
                                </table>
                            </div>
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