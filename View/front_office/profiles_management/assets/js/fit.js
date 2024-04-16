document.addEventListener("DOMContentLoaded", function() {
    var navbar = document.querySelector('.navbar');
    var logo = document.getElementById('logo');
    var icons = document.querySelectorAll('.nav-link i');

    function toggleNavbarColor() {
        if (navbar.classList.contains('navbar-light')) {
            logo.src = "../assets/img/logos/HireUp_lightMode.png";
            icons.forEach(function(icon) {
                icon.style.color = "black";
            });
        } else {
            logo.src = "../assets/img/logos/HireUp_darkMode.png";
            icons.forEach(function(icon) {
                icon.style.color = "white";
            });
        }
    }

    // Initial call to set the initial state
    toggleNavbarColor();

    // Listen for changes in navbar classes
    var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.attributeName === 'class') {
                toggleNavbarColor();
            }
        });
    });

    observer.observe(navbar, {
        attributes: true
    });
});
