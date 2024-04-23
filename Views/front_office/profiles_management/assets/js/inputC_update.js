var fnameError = document.getElementById('fname_error');
var lnameError = document.getElementById('lname_error');
var posError = document.getElementById('pos_error');
var eduError = document.getElementById('edu_error');
var regionError = document.getElementById('region_error');
var cityError = document.getElementById('city_error');
//var genderError = document.getElementById('gender_error');
//var bdayError = document.getElementById('bday_error');
var bioError = document.getElementById('bio_error');

var submitError = document.getElementById('submit_error');

function validateFName(){
    var fname = document.getElementById('profile_first_name').value;

    if(fname.length == 0){
        fnameError.innerHTML = 'First Name is required.';
        return false;
    }
    if(fname.length < 2){
        fnameError.innerHTML = 'First Name must be at least 2 characters.';
        return false;
    }
    if(!/^[a-zA-Z ]+$/.test(fname)){
        fnameError.innerHTML = 'First Name contain only alphabets.';
        return false;
    }
    fnameError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validateLName(){
    var lname = document.getElementById('profile_family_name').value;

    if(lname.length == 0){
        lnameError.innerHTML = 'Family Name is required.';
        return false;
    }
    if(lname.length < 2){
        lnameError.innerHTML = 'Family Name must be at least 2 characters.';
        return false;
    }
    if(!/^[a-zA-Z ]+$/.test(lname)){
        lnameError.innerHTML = 'Family Name contain only alphabets.';
        return false;
    }
    lnameError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validatePos(){
    var pos = document.getElementById('profile_current_position').value;

    if(pos.length == 0){
        posError.innerHTML = 'Current Position is required.';
        return false;
    }
    if(pos.length < 2){
        posError.innerHTML = 'Current Position must be at least 2 characters.';
        return false;
    }

    posError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validateEdu(){
    var edu = document.getElementById('profile_education').value;

    if(edu.length == 0){
        eduError.innerHTML = 'Education is required.';
        return false;
    }
    if(edu.length < 2){
        eduError.innerHTML = 'Education must be at least 2 characters.';
        return false;
    }
    eduError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validateRegion(){
    var region = document.getElementById('profile_region').value;

    if(region.length == 0){
        regionError.innerHTML = 'Region is required.';
        return false;
    }
    if(region.length < 2){
        regionError.innerHTML = 'Region must be at least 2 characters.';
        return false;
    }
    if(!/^[a-zA-Z ]+$/.test(region)){
        regionError.innerHTML = 'Region contain only alphabets.';
        return false;
    }
    regionError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validateCity(){
    var city = document.getElementById('profile_city').value;

    if(city.length == 0){
        cityError.innerHTML = 'City is required.';
        return false;
    }
    if(city.length < 2){
        cityError.innerHTML = 'City must be at least 2 characters.';
        return false;
    }
    cityError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validateBio() {
    var bio = document.getElementById('profile_bio').value;
    var maxLength = 150;
    var charactersRemaining = maxLength - bio.length;

    if(bio.length == 0){
        bioError.innerHTML = 'Bio is required.';
        return false;
    }
    if (bio.length < 2){
        bioError.innerHTML = 'Bio must be at least 2 characters.';
        return false;
    }   
    if(charactersRemaining >= 0 && bio.length >= 2){
        bioError.innerHTML = charactersRemaining + ' characters remaining';
        return true;
    } 
    else {
        bioError.innerHTML = 'Profile Bio should not exceed 150 characters';
        return false;
    }
}



function validateForm(){
    if(!validateFName() || !validateLName() || !validatePos() || !validateEdu() || !validateRegion() || !validateCity() || !validateBio()){
        submitError.innerHTML = 'Please fix error to submit.';
        return false;
    }
}