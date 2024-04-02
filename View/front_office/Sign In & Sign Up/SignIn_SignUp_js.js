function sign_up_verif(){

    user_name = document.getElementById('user_name').value
    email = document.getElementById('user_email').value
    password = document.getElementById('user_password').value
    con_password = document.getElementById('user_con_password').value


    // Regular expression for validating username
    var usernameRegex = /^[a-zA-Z0-9_]+$/;

    // Validate username
    if (!usernameRegex.test(user_name)) {
        document.getElementById('user_name_error').innerText = "Username can only contain letters, numbers, and underscores";
        return false;
    } else {
        document.getElementById('user_name_error').innerText = "";
    }

    // Regular expression for validating email address
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Validate email
    if (!emailRegex.test(email)) {
        document.getElementById('user_email_error').innerText = "Invalid email format";
        return false;
    } else {
        document.getElementById('user_email_error').innerText = "";
    }

    // Regular expression for validating password format (at least 8 characters, at least one uppercase letter, at least one lowercase letter, and at least one number)
    var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

     // Validate password
     if (!passwordRegex.test(password)) {
        document.getElementById('user_password_error').innerText = "Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one number";
        return false;
    } else {
        document.getElementById('user_password_error').innerText = "";
    }

     // Validate con password
     if (password !== con_password) {
        document.getElementById('user_con_password_error').innerText = "Passwords do not match";
        return false;
    } else {
        document.getElementById('user_con_password_error').innerText = "";
    }

    return true

}

function isEmailOrUserName(input){

    // Check if the input matches the email format
    if (/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\b/i.test(input)) {
        console.log("Input is an email address.");
        return "email"
    } else {
        // Check if the input contains only letters, numbers, and underscores (assuming it's a username)
        if (/^[a-zA-Z0-9_]+$/.test(input)) {
            console.log("Input is a username.");
            return "user name"
        } else {
            console.log("Input is neither an email or a valid username.");
            return "none"
        }
    }

}

function sign_in_verif(){

    var user_name_email = document.getElementById('user_name').value;
    var password = document.getElementById('user_password').value;


    if (isEmailOrUserName(user_name_email) == "none") {
        document.getElementById('user_name_error').innerText = "Input is neither an email or a valid username. (Username can only contain letters, numbers, and underscores)";
        return false;
    } else {
        document.getElementById('user_name_error').innerText = "";
    }

    // Regular expression for validating password format (at least 8 characters, at least one uppercase letter, at least one lowercase letter, and at least one number)
    var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

     // Validate password
     if (!passwordRegex.test(password)) {
        document.getElementById('user_password_error').innerText = "Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one number.";
        return false;
    } else {
        document.getElementById('user_password_error').innerText = "";
    }

    return true

}

function forgot_password_verif(){
    var user_name_email = document.getElementById('user_name').value;

    if (isEmailOrUserName(user_name_email) == "none") {
        document.getElementById('user_name_error').innerText = "Input is neither an email or a valid username. (Username can only contain letters, numbers, and underscores)";
        return false;
    } else {
        document.getElementById('user_name_error').innerText = "";
    }

    return true

}

function reset_code_verif(){
    var reset_code = document.getElementById('reset_code_inp').value.trim();
    var codePattern = /^\d{5}$/;
    
    if (!codePattern.test(reset_code)) {
        document.getElementById('reset_code_error').innerText = "Verification code must contain exactly 5 digits.";
        return false;
    } else {
        document.getElementById('reset_code_error').innerText = "";
    }

    return true
}

function change_password_verif(){

    password = document.getElementById('user_password').value
    con_password = document.getElementById('user_con_password').value

    // Regular expression for validating password format (at least 8 characters, at least one uppercase letter, at least one lowercase letter, and at least one number)
    var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

     // Validate password
     if (!passwordRegex.test(password)) {
        document.getElementById('user_password_error').innerText = "Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one number";
        return false;
    } else {
        document.getElementById('user_password_error').innerText = "";
    }

     // Validate con password
     if (password !== con_password) {
        document.getElementById('user_con_password_error').innerText = "Passwords do not match";
        return false;
    } else {
        document.getElementById('user_con_password_error').innerText = "";
    }

    return true
}

