// Get the modal
var modal = document.getElementById("updateJobModal");

// Get the button that opens the modal
var editButtons = document.querySelectorAll(".edit-btn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// JavaScript to handle edit button click event
document.addEventListener("DOMContentLoaded", function () {
  const editButtons = document.querySelectorAll(".edit-btn");

  editButtons.forEach((button) => {
    button.addEventListener("click", function () {
      // Get job details from data attributes
      const title = this.getAttribute("data-job-title");
      const company = this.getAttribute("data-company");
      const location = this.getAttribute("data-location");
      const description = this.getAttribute("data-description");
      const salary = this.getAttribute("data-salary");
      const datePosted = this.getAttribute("data-date-posted");

      // Populate update form inputs with job details
      document.getElementById("update_job_title").value = title;
      document.getElementById("update_company").value = company;
      document.getElementById("update_location").value = location;
      document.getElementById("update_description").value = description;
      document.getElementById("update_salary").value = salary;
      document.getElementById("update_date_posted").value = datePosted;

      // Show the update form modal
      document.getElementById("updateModal").style.display = "block";
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  // Get the modal
  var modal = document.getElementById("updateJobModal");

  // Get the close button
  var span = document.getElementsByClassName("close")[0];

  // Get the form
  var form = document.getElementById("updateJobForm");

  // Add event listener for form submission
  form.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the form from submitting

    // Get form data
    var formData = new FormData(form);

    // Send form data to the server using fetch
    fetch("your_update_job_endpoint.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        console.log(data); // Handle response from the server
        modal.style.display = "none"; // Hide the modal
        location.reload(); // Reload the page to update the job list
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });

  // Add event listener for close button click
  span.onclick = function () {
    modal.style.display = "none";
  };

  // Add event listener for cancel button click
  document.querySelector(".cancel-btn").onclick = function () {
    modal.style.display = "none";
  };

  // Add event listener for clicking outside the modal
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
});

// When the user clicks on the edit button, open the modal
editButtons.forEach(function (button) {
  button.onclick = function () {
    modal.style.display = "block";
    // Populate form fields with job details here using JavaScript
  };
});

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
  modal.style.display = "none";
};

// When the user clicks on cancel button, close the modal
document.querySelector(".cancel-btn").onclick = function () {
  modal.style.display = "none";
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};
