var dropdown = document.querySelector(".dropdown-toggle");
var dropdownMenu = document.querySelector(".dropdown-menu");

dropdown.addEventListener("click", function () {
  dropdownMenu.classList.toggle("show");
});

// Close the dropdown menu when clicking outside
window.addEventListener("click", function (e) {
  if (!dropdown.contains(e.target)) {
    dropdownMenu.classList.remove("show");
  }
});

// Get the modal
var modal = document.getElementById("createPostModal");

// Get the input field
var inputField = document.getElementById("createPostInput");

// Function to open the create post modal
function openCreatePostModal() {
  var modal = document.getElementById("createPostModal");
  modal.style.display = "block";
  document.body.style.overflow = "hidden"; // Disable scrolling
}

function closeCreatePostModal() {
  var modal = document.getElementById("createPostModal");
  modal.style.display = "none";
  document.body.style.overflow = "auto"; // Enable scrolling
}

// When the user clicks on the input field, open the modal
inputField.onclick = function () {
  openCreatePostModal();
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};
