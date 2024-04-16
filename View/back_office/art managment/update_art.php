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
include '../../../Controller/art_con.php';
include '../../../Model/art.php';

// Création d'une instance du contrôleur des événements
$artt = new artCon("arts");

// Création d'une instance de la classe Event
$art = null;

if (isset($_GET['id'])){
    $current_id = $_GET['id'];
}

if (
    isset($_POST["titre"]) &&
    isset($_POST["contenu"]) &&
    isset($_POST["auteur"])&&
    isset($_POST["date_art"])&&
    isset($_POST["categorie"])
) {
    if (
        !empty($_POST['titre']) &&
        !empty($_POST["contenu"]) &&
        !empty($_POST["auteur"]) &&
        !empty($_POST["date_art"]) &&
        !empty($_POST["categorie"])
    ) {
       
        $art = new art(
            $current_id,
            $_POST['titre'],
            $_POST['contenu'],
            $_POST['auteur'],
            $_POST['date_art'],
            $_POST['categorie']
        );

        $artt->updateart($art, $current_id);
        header('Location:../../../View/back_office/art managment/art_management.php');
    } else {
        $error = "Missing information";
    }
} elseif (isset($_GET['id'])) {
    $current_id = $_GET['id'];
    $art = $artt->getart($current_id);
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
                 <?php// include('../../../View/back_office/header_bar.php') ?>  
            
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">article Management</h5>
                            <!-- Form for adding new job -->
                            <form action="" method="post">
                                <!-- job Information -->
                                <div class="mb-3">
                                    <label for="titre" class="form-label">titre</label>
                                    <input type="text" class="form-control" value="<?= $art['titre']; ?>" id="titre" name="titre"
                                        placeholder="Enter the titre" required>
                                    <div id="titre_error" style="color: red;"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="contenu" class="form-label">contenu</label>
                                    <input type="text" class="form-control" value="<?= $art['contenu']; ?>" id="contenu" name="contenu"
                                        placeholder="Enter the contenu" required>
                                    <div id="contenu_error" style="color: red;"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="objectif" class="form-label">auteur</label>
                                    <input type="text" class="form-control" value="<?= $art['auteur']; ?>" id="auteur" name="auteur" placeholder="Enter the auteur"
                                        required>
                                    <div id="objectif_error" style="color: red;"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="dure" class="form-label">date art</label>
                                    <input type="date" class="form-control" value="<?= $art['date_art']; ?>" id="date_art" name="date_art" placeholder="Enter the date"
                                        required>
                                    <div id="dure_error" style="color: red;"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="budget" class="form-label">categorie</label>
                                    <input type="text" class="form-control" value="<?= $art['categorie']; ?>" id="categorie" name="categorie" placeholder="Enter the categorie"
                                        required>
                                    <div id="categorie_error" style="color: red;"></div>
                                </div>
                                


                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary" onclick="return verif_art_manaet_inputs()">Update art</button>

                                <div class="mb-3" id="error_global" style="color: red; text-align: center;"></div>
                                <div class="mb-3" id="success_global" style="color: green; text-align: center;"></div>

                            </form>
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
    <script src="../../../View/back_office/ads managment/pub_management_js.js"></script>


</body>

</html>
