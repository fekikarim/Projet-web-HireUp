function verif_reclamation_managemet_inputs(){

    sujet = document.getElementById('sujet').value.trim()
    description = document.getElementById('description').value.trim()
    date_creation = document.getElementById('date_creation').value.trim()
    statut = document.getElementById('status').value.trim()
    user_id = document.getElementById('id_user').value.trim()


    // sujet
    if (sujet == ""){
        document.getElementById('sujet_error').innerText = "Subject can't be empty";
        return false;
    } else {
        document.getElementById('sujet_error').innerText = "";
    }

    // description
    if (description == ""){
        document.getElementById('description_error').innerText = "Description can't be empty";
        return false;
    } else {
        document.getElementById('description_error').innerText = "";
    }

    // date_creation
    if (date_creation == ""){
        document.getElementById('date_creation_error').innerText = "Date can't be empty";
        return false;
    } else {
        document.getElementById('date_creation_error').innerText = "";
    }

    // date_creation
    if (statut == ""){
        document.getElementById('status_error').innerText = "Date can't be empty";
        return false;
    } else {
        document.getElementById('status_error').innerText = "";
    }

    // user id
    // Regular expression for validating username
    var useridRegex = /^[0-9]+$/;

    // Validate username
    if (!useridRegex.test(user_id)) {
        document.getElementById('id_user_error').innerText = "ID user can only contain numbers";
        return false;
    } else {
        document.getElementById('id_user_error').innerText = "";
    }

    
    return true;
 

}

function verif_reclamation_managemet_inputs_front(){

    sujet = document.getElementById('sujet').value.trim()
    description = document.getElementById('description').value.trim()
    user_id = document.getElementById('id_user').value.trim()


    // sujet
    if (sujet == ""){
        document.getElementById('sujet_error').innerText = "Subject can't be empty";
        return false;
    } else {
        document.getElementById('sujet_error').innerText = "";
    }

    // description
    if (description == ""){
        document.getElementById('description_error').innerText = "Description can't be empty";
        return false;
    } else {
        document.getElementById('description_error').innerText = "";
    }


    // user id
    // Regular expression for validating username
    var useridRegex = /^[0-9]+$/;

    // Validate user id
    if (!useridRegex.test(user_id)) {
        document.getElementById('id_user_error').innerText = "ID user can only contain numbers";
        return false;
    } else {
        document.getElementById('id_user_error').innerText = "";
    }

    
    return true;
 

}
