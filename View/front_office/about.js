function verif_inputs(){
    titre = document.getElementById('titre').value.trim()
    contenu = document.getElementById('contenu').value.trim()
    objectif = document.getElementById('objectif').value.trim()
    dure = document.getElementById('dure').value.trim()
    budget = document.getElementById('budget').value.trim()


    // Regular expression for validating des champs
    var chaine = /^[a-zA-Z_ ]+$/;
    
    var entier = /^\d+$/;


    // Validate titre
    if (!chaine.test(titre)) {
        document.getElementById('titre_error').innerText = "titre can only contain letters";
        return false;
    } else {
        document.getElementById('titre_error').innerText = "";
    }
    // Validate contenu
    if (!chaine.test(contenu)) {
        document.getElementById('contenu_error').innerText = "contenu can only contain letters";
        return false;
    } else {
        document.getElementById('contenu_error').innerText = "";
    }
    // Validate objectif
    if (!chaine.test(objectif)) {
        document.getElementById('objectif_error').innerText = "objectif can only contain letters";
        return false;
    } else {
        document.getElementById('objectif_error').innerText = "";
    }
    // Validate dure
    if (!entier.test(dure)) {
        document.getElementById('dure_error').innerText = "dure can only contain une dure";
        return false;
    } else {
        document.getElementById('dure_error').innerText = "";
    }
    // Validate budget
    if (!entier.test(budget)) {
        document.getElementById('budget_error').innerText = "budget can only contain entier";
        return false;
    } else {
        document.getElementById('budget_error').innerText = "";
    }

    
    return true;

}