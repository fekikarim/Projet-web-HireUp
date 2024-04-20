function verif_users_managemet_inputs(){
    user_name = document.getElementById('user_name').value.trim()
    email = document.getElementById('email').value.trim()
    password = document.getElementById('password').value.trim()
    role = document.getElementById('role').value.trim()


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

     // Validate role
     if (role === "") {
        document.getElementById('roleError').innerText = "Role is required";
        return false;
    } else {
        document.getElementById('roleError').innerText = "";
    }

    return true;

}