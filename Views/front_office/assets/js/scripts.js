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
      const id = this.getAttribute("data-job-id");
      const title = this.getAttribute("data-job-title");
      const company = this.getAttribute("data-company");
      const location = this.getAttribute("data-location");
      const description = this.getAttribute("data-description");
      const salary = this.getAttribute("data-salary");
      const datePosted = this.getAttribute("data-date-posted");

      // Populate update form inputs with job details
      document.getElementById("update_job_id").value = id;
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

// Function to populate the update form with job details
function populateUpdateForm(
  id,
  title,
  company,
  location,
  description,
  salary,
  datePosted
) {
  document.getElementById("update_job_id").value = id;
  document.getElementById("update_job_title").value = title;
  document.getElementById("update_company").value = company;
  document.getElementById("update_location").value = location;
  document.getElementById("update_description").value = description;
  document.getElementById("update_salary").value = salary;
  document.getElementById("update_date_posted").value = datePosted;
}

// When the user clicks on the edit button, open the modal
editButtons.forEach(function (button) {
  button.onclick = function () {
    modal.style.display = "block";
    modal.style.display = "flex";
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
  document.getElementById("updateJobForm").reset();
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};
