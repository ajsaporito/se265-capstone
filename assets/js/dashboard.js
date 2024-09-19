$(document).on('click', '.mark-completed-btn', function () {
  let jobId = $(this).data('job-id'); // Get the job ID from the button's data attribute

  $.ajax({
    type: 'POST',
    url: '/se265-capstone/mark-job-complete',
    data: { job_id: jobId },
    success: function (response) {
      try {
        // Parse the response if it's not an object already
        if (typeof response !== 'object') {
          response = JSON.parse(response);
        }
        if (response.status === 'success') {
            alert('Job marked as completed successfully!');
            location.reload(); // Reload the page or update the UI as needed
        } else {
            alert('There was an error marking the job as completed: ' + response.message);
        }
      } catch (e) {
        console.error('Error parsing response: ', e);
        alert('There was an error processing the response.');
      }
    }, error: function (xhr, status, error) {
      console.error('XHR Error:', xhr, status, error);
      alert('An error occurred while processing the request.');
    }
  });
});

// Toggle Logic for Job Sections
$(document).ready(function () {
  // Toggle logic for Completed Jobs
  $("#completed-jobs-section .job-card:nth-child(n+4)").hide(); // Hide all but the first 3 jobs
  $("#toggle-completed-jobs").click(function () {
    let jobSection = $("#completed-jobs-section .job-list");
    let btnText = $(this);

    if (jobSection.find(".job-card:hidden").length > 0) {
      jobSection.find(".job-card").slideDown();
      btnText.text("Show Less");
    } else {
      jobSection.find(".job-card:nth-child(n+4)").slideUp();
      btnText.text("Show More");
    }
  });

  // Toggle logic for Open Jobs
  $("#open-jobs-section .job-card:nth-child(n+4)").hide(); // Hide all but the first 3 jobs
  $("#toggle-open-jobs").click(function () {
    let jobSection = $("#open-jobs-section .job-list");
    let btnText = $(this);

    if (jobSection.find(".job-card:hidden").length > 0) {
      jobSection.find(".job-card").slideDown();
      btnText.text("Show Less");
    } else {
      jobSection.find(".job-card:nth-child(n+4)").slideUp();
      btnText.text("Show More");
    }
  });

  // Toggle logic for In-Progress Jobs
  $("#in-progress-jobs-section .job-card:nth-child(n+4)").hide(); // Hide all but the first 3 jobs
  $("#toggle-in-progress-jobs").click(function () {
    let jobSection = $("#in-progress-jobs-section .job-list");
    let btnText = $(this);

    if (jobSection.find(".job-card:hidden").length > 0) {
      jobSection.find(".job-card").slideDown();
      btnText.text("Show Less");
    } else {
      jobSection.find(".job-card:nth-child(n+4)").slideUp();
      btnText.text("Show More");
    }
  });

  // Toggle logic for Job Feedback
  $("#feedback-section .job-card:nth-child(n+4)").hide(); // Hide all but the first 3 feedback items
  $("#toggle-feedback").click(function () {
    let feedbackSection = $("#feedback-section .job-list");
    let btnText = $(this);
    
    if (feedbackSection.find(".job-card:hidden").length > 0) {
      feedbackSection.find(".job-card").slideDown();
      btnText.text("Show Less");
    } else {
      feedbackSection.find(".job-card:nth-child(n+4)").slideUp();
      btnText.text("Show More");
    }
  });
});

// Delete Job Button Logic
$(document).on('click', '.delete-job-btn', function (e) {
  e.stopPropagation(); // Stop the click event from bubbling up to the card's stretched link
  let jobId = $(this).data('job-id');

  if (confirm("Are you sure you want to delete this job?")) {
    $.ajax({
      type: 'POST',
      url: '/se265-capstone/delete-job', // The route that handles the deletion
      data: { job_id: jobId },
      success: function (response) {
        try {
          if (typeof response !== 'object') {
            response = JSON.parse(response);
          }
          if (response.status === 'success') {
            alert('Job deleted successfully!');
            location.reload(); // Reload the page or update the UI as needed
          } else {
            alert('There was an error deleting the job: ' + response.message);
          }
        } catch (e) {
          console.error('Error parsing response: ', e);
          alert('There was an error processing the response.');
        }
      }, error: function (xhr, status, error) {
        console.error('XHR Error:', xhr, status, error);
        alert('An error occurred while processing the request.');
      }
    });
  }
});
