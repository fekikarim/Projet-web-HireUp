
<?php

include '../../Controller/art_con_fron.php';
include '../../Model/art.php';



// Création d'une instance du contrôleur des événements
$artt = new artCon("art");

// Création d'une instance de la classe Event
$art = null;

if (
    isset($_POST["titre"]) &&
    isset($_POST["contenu"]) &&
    isset($_POST["auteur"]) &&
    isset($_POST["date_art"])&&
    isset($_POST["categorie"])
) {
    echo("1");
    if (
        !empty($_POST['titre']) &&
        !empty($_POST["contenu"]) &&
        !empty($_POST["auteur"]) &&
        !empty($_POST["date_art"])&&
        !empty($_POST["categorie"])
    ) {
        echo("2");
        $pub = new Pub(
            $pubb->generatepubId(5),
            $_POST['titre'],
            $_POST['contenu'],
            $_POST['auteur'],
            $_POST['date_art'],
            $_POST['categorie']
        );

        # do some checks first
        # check titre existence
        if ($artt->titreExists($art->get_titre())){
            $error_titre= "titre already exists";
            header('Location: about.html?error_titre=' . urlencode($error_titre) . '&titre=' . urlencode($art->get_titre()));
            exit(); // Make sure to stop further execution after redirection
        }

        $artt->addart($art);
        $success_message = "article added successfully!";
        header('Location: about.html?success_global=' . urlencode($success_message) . '&titre=' . urlencode($art->get_titre()));
        exit(); // Make sure to stop further execution after redirection
    } else {
        // returning an error
        $error_message = "Failed to add the PUBLICITE. Please try again later.";
        header('Location: about.html?error_global=' . urlencode($error_message));
        exit(); // Make sure to stop further execution after redirection
    }
}


?>