
<?php

include '../../../Controller/art_con.php';
include '../../../Model/art.php';

// Création d'une instance du contrôleur des événements
$artt= new artCon("art");

// Création d'une instance de la classe Event
//utilisée pour vérifier si une variable est définie et n'est pas nulle. Elle retourne true si la variable est définie et a une valeur autre que null, sinon elle retourne false.
$art = null;

if (
    isset($_POST["titre"]) &&
    isset($_POST["contenu"]) &&
    isset($_POST["auteur"]) &&
    isset($_POST["date_art"])&&
    isset($_POST["categorie"])
) {
    //empty() en PHP est utilisée pour vérifier si une variable est vide.
    if (
        !empty($_POST['titre']) &&
        !empty($_POST["contenu"]) &&
        !empty($_POST["auteur"]) &&
        !empty($_POST["date_art"])&&
        !empty($_POST["categorie"])
    ) {
        
        $art = new art(
            $artt->generateartId(5),
            $_POST['titre'],
            $_POST['contenu'],
            $_POST['auteur'],
            $_POST['date_art'],
            $_POST['categorie']
        );

        $artt->addart($art);
        $success_message = "article added successfully!";
        header('Location: ../../../View/back_office/art managment/art_management.php?success_global=' . urlencode($success_message) . '&titre=' . urlencode($art->get_titre()));
        echo("aaaa");
        exit(); // Make sure to stop further execution after redirection
    } else {
        echo("ghgfffh");
        // returning an error
        $error_message = "Failed to add the article. Please try again later.";
       header('Location: ../../../View/back_office/art managment/art_management.php?error_global=' . urlencode($error_message));
        exit(); // Make sure to stop further execution after redirection
    }
}
else{
    echo("ghgh");
}


?>