
<?php

include '../../../Controller/pub_con.php';
include '../../../Model/pub.php';

// Création d'une instance du contrôleur des événements
$pubb = new pubCon("pub");

// Création d'une instance de la classe Event
$pub = null;

if (
    isset($_POST["titre"]) &&
    isset($_POST["contenu"]) &&
    isset($_POST["objectif"]) &&
    isset($_POST["dure"])&&
    isset($_POST["budget"])
) {
    echo("1");
    if (
        !empty($_POST['titre']) &&
        !empty($_POST["contenu"]) &&
        !empty($_POST["objectif"]) &&
        !empty($_POST["dure"])&&
        !empty($_POST["budget"])
    ) {
        echo("2");
        $pub = new Pub(
            $pubb->generatepubId(5),
            $_POST['titre'],
            $_POST['contenu'],
            $_POST['objectif'],
            $_POST['dure'],
            $_POST['budget']
        );

        # do some checks first
        # check titre existence
        if ($pubb->titreExists($pub->get_titre())){
            $error_titre= "titre already exists";
            header('Location: ../../../View/back_office/add managment/pub_management.php?error_titre=' . urlencode($error_titre) . '&titre=' . urlencode($pub->get_titre()));
            exit(); // Make sure to stop further execution after redirection
        }

        $pubb->addpub($pub);
        $success_message = "pub added successfully!";
        header('Location: ../../../View/back_office/ads managment/pub_management.php?success_global=' . urlencode($success_message) . '&titre=' . urlencode($pub->get_titre()));
        exit(); // Make sure to stop further execution after redirection
    } else {
        // returning an error
        $error_message = "Failed to add the PUBLICITE. Please try again later.";
        header('Location: ../../../View/back_office/ads managment/pub_management.php?error_global=' . urlencode($error_message));
        exit(); // Make sure to stop further execution after redirection
    }
}


?>