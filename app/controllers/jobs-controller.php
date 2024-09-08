<?php

function renderJobs() {
  include MODEL_PATH . 'jobs.php';

  if (!isset($_SESSION['user_id'])) {
      header('Location: /se265-capstone/login');
      exit();
  }

  // Fetch only open jobs
  $jobs = getJobsByStatus($_SESSION['user_id'], 'open');

  require VIEW_PATH . 'jobs/jobs.php';
}

/*
function renderAddJob() {
  include MODEL_PATH . 'jobs.php';

  // Redirect to login if the user is not logged in
  if (!isset($_SESSION['user_id'])) {
      header('Location: /se265-capstone/login');
      exit();
  }

  // Fetch skills to populate the skills dropdown in the form
  $skills = getAllSkills();

  // Check if the form is submitted via AJAX
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
      // Initialize response and errors array
      $response = [];
      $errors = [];

      // Validate the form data
      if (empty($_POST['title'])) {
          $errors['titleError'] = 'Job title is required.';
      }

      if (empty($_POST['location'])) {
          $errors['locationError'] = 'Location is required.';
      }

      if (empty($_POST['description'])) {
          $errors['descriptionError'] = 'Description is required.';
      }

      if (empty($_POST['job_type'])) {
          $errors['job_typeError'] = 'Job type is required.';
      }

      if ($_POST['job_type'] === 'fixed' && empty($_POST['budget'])) {
          $errors['budgetError'] = 'Budget is required for fixed jobs.';
      }

      if ($_POST['job_type'] === 'hourly') {
          if (empty($_POST['hourly_rate'])) {
              $errors['hourlyRateError'] = 'Hourly rate is required for hourly jobs.';
          }

          if (empty($_POST['estimated_hours_per_week'])) {
              $errors['estimatedHoursError'] = 'Estimated hours per week are required for hourly jobs.';
          }
      }

      // If validation passes, save the job data
      if (empty($errors)) {
          // Collect the job data from the form
          $jobData = [
              'posted_by' => $_SESSION['user_id'],
              'title' => $_POST['title'],
              'location' => $_POST['location'],
              'description' => $_POST['description'],
              'budget' => ($_POST['job_type'] == 'fixed' && !empty($_POST['budget'])) ? $_POST['budget'] : null,
              'status' => 'open',
              'job_type' => $_POST['job_type'],
              'hourly_rate' => ($_POST['job_type'] == 'hourly' && !empty($_POST['hourly_rate'])) ? $_POST['hourly_rate'] : null,
              'estimated_hours_per_week' => (!empty($_POST['estimated_hours_per_week']) && $_POST['job_type'] == 'hourly') ? $_POST['estimated_hours_per_week'] : null,
              'estimated_completion_date' => isset($_POST['estimated_completion_date']) ? $_POST['estimated_completion_date'] : null,
          ];

          // Get selected skills
          $skillsSelected = isset($_POST['skills']) ? $_POST['skills'] : [];

          // Save the job along with the associated skills
          saveJobWithSkills($jobData, $skillsSelected);

          // Return success response
          $response['success'] = true;
      } else {
          // Return validation errors
          $response['success'] = false;
          $response = array_merge($response, $errors);
      }

      // Return the JSON response
      echo json_encode($response);
      exit(); // Ensure no further code is executed
  }

  // Render the Add Job form view for GET request
  require VIEW_PATH . 'jobs/add-job.php';
}

*/
function renderAddJob() {
  include MODEL_PATH . 'jobs.php';
  if (!isset($_SESSION['user_id'])) {
      header('Location: /se265-capstone/login');
      exit();
  }

  // Fetch skills to populate the skills dropdown in the form
  $skills = getAllSkills();

  // Check if the form is submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Collect the job data from the form
      $jobData = [
          'posted_by' => $_SESSION['user_id'],
          'title' => $_POST['title'],
          'location' => $_POST['location'],
          'description' => $_POST['description'],
          'budget' => ($_POST['job_type'] == 'fixed' && !empty($_POST['budget'])) ? $_POST['budget'] : null,
          'status' => 'open',
          'job_type' => $_POST['job_type'],
          'hourly_rate' => ($_POST['job_type'] == 'hourly' && !empty($_POST['hourly_rate'])) ? $_POST['hourly_rate'] : null,
          'estimated_hours_per_week' => (!empty($_POST['estimated_hours_per_week']) && $_POST['job_type'] == 'hourly') ? $_POST['estimated_hours_per_week'] : null,
          'estimated_completion_date' => isset($_POST['estimated_completion_date']) ? $_POST['estimated_completion_date'] : null,
      ];

      // Get selected skills
      $skillsSelected = isset($_POST['skills']) ? $_POST['skills'] : [];

      // Debugging output as an alert
      echo "<script>
          alert('Job Data: " . json_encode($jobData) . "\\nSkills Selected: " . json_encode($skillsSelected) . "');
      </script>";
      //exit();
      // Save the job along with the associated skills

      
      saveJobWithSkills($jobData, $skillsSelected);

      // Redirect to a confirmation page or job list
      header('Location: /se265-capstone/jobs');
      exit();
  }

  require VIEW_PATH . 'jobs/add-job.php';
}


//Job-info.php
function renderJobInfo() {
  include MODEL_PATH . 'jobs.php';
  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
  }

  if (isset($_GET['id'])) {
    $jobId = $_GET['id'];
    $job = getJobById($jobId);

    if ($job) {
      // Determine the pay based on job type
      if ($job['job_type'] == 'fixed') {
        $pay = '$' . number_format($job['budget'], 2);
      } elseif ($job['job_type'] == 'hourly') {
        $pay = '$' . number_format($job['hourly_rate'], 2) . '/hr';
      } else {
        $pay = 'N/A';
      }
    }
  }

    require VIEW_PATH . 'jobs/job-info.php';
 }
}


?>