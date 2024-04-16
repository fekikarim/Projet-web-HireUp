function verif_art_manage_inputs() {
    var titre = document.getElementById('titre').value.trim();
    var contenu = document.getElementById('contenu').value.trim();
    var auteur = document.getElementById('auteur').value.trim();
    var date_art = document.getElementById('date_art').value.trim();
    var categorie = document.getElementById('categorie').value.trim();

    // Validation des champs
    var chaine = /^[a-zA-Z_ ]+$/;

    // Validate titre
    if (titre === "") {
        document.getElementById('titre_error').innerText = "Le titre est requis";
        return false;
    } else {
        document.getElementById('titre_error').innerText = "";
    }
    // Validate contenu (peut être vide si l'article est une image)
    if (contenu === "" && !document.getElementById('image').checked) {
        document.getElementById('contenu_error').innerText = "Le contenu est requis";
        return false;
    } else {
        document.getElementById('contenu_error').innerText = "";
    }
    // Validate auteur
    if (auteur === "") {
        document.getElementById('auteur_error').innerText = "L'auteur est requis";
        return false;
    } else {
        document.getElementById('auteur_error').innerText = "";
    }
    // Validate date_art
    if (date_art === "") {
        document.getElementById('date_art_error').innerText = "La date est requise";
        return false;
    } else {
        document.getElementById('date_art_error').innerText = "";
    }
    // Validate categorie
    if (categorie === "") {
        document.getElementById('categorie_error').innerText = "La catégorie est requise";
        return false;
    } else {
        document.getElementById('categorie_error').innerText = "";
    }

    return true;
}
