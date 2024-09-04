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
      /*echo "<script>
          alert('Job Data: " . json_encode($jobData) . "\\nSkills Selected: " . json_encode($skillsSelected) . "');
      </script>";*/
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
          $pay = 'N/A'; // In case job_type is neither 'fixed' nor 'hourly'
      }
    }

    if ($job) {
        $title = $job['title'] . ' - Job Details';
    } else {
        header('Location: /se265-capstone/404');
        exit();
    }

    require VIEW_PATH . 'jobs/job-info.php';
  }
}

//8/25 added for client-open-jobs.php
function renderClientOpenJobs() {
  include MODEL_PATH . 'jobs.php';

  if (!isset($_SESSION['user_id'])) {
      header('Location: /se265-capstone/login');
      exit();
  }

  // Retrieve the job ID from the URL
  $job_id = $_GET['job_id'] ?? 0;

  // Fetch the job details based on the job ID
  $job = getJobById($job_id);
  
  // If the job is not found or doesn't belong to the logged-in user, show an error
  if ($job === false || empty($job) || $job['posted_by'] != $_SESSION['user_id']) {
      echo "Job not found or you don't have permission to view this job.";
      return;
  }

  // Calculate pay based on job type
  if ($job) {
      if ($job['job_type'] === 'fixed') {
          $pay = '$' . number_format($job['budget'], 2);
      } elseif ($job['job_type'] === 'hourly') {
          $pay = '$' . number_format($job['hourly_rate'], 2) . '/hr';
      } else {
          $pay = 'N/A'; // In case job_type is neither 'fixed' nor 'hourly'
      }
  }

  // Fetch the requests related to this job
  $requests = getJobRequestsByJobId($job_id);

  // Pass the job, pay, and requests to the view
  require VIEW_PATH . 'jobs/client-open-jobs.php';
}


//AJAX request to request a job 
/*
function handleJobRequest() {
  include MODEL_PATH . 'jobs.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $job_id = $_POST['job_id'];
      $requested_by = $_POST['requested_by'];

      // Check if the user has already requested this job
      if (!hasUserRequestedJob($requested_by, $job_id)) {
          // Add request to the Requests table
          addJobRequest($job_id, $requested_by);
          echo json_encode(['status' => 'success']);
      } else {
          echo json_encode(['status' => 'already_requested']);
      }
  } else {
      echo json_encode(['status' => 'error']);
  }
  exit();
}
*/

function handleJobRequest() {
  include MODEL_PATH . 'jobs.php';
  global $db;

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $job_id = $_POST['job_id'];
      $requested_by = $_POST['requested_by'];
      $action = $_POST['action'] ?? 'request';  // Determine if the action is to request or accept a job

      if ($action === 'request') {
          // Handle job request submission
          if (!hasUserRequestedJob($requested_by, $job_id)) {
              // Add request to the Requests table
              if (addJobRequest($job_id, $requested_by)) {
                  echo json_encode(['status' => 'success']);
              } else {
                  echo json_encode(['status' => 'error', 'message' => 'Failed to add job request.']);
              }
          } else {
              echo json_encode(['status' => 'already_requested']);
          }
      } elseif ($action === 'accept') {
          // Handle accepting a job request and updating contractor_id
          try {
              $db->beginTransaction();

              // Verify that the requested_by user exists in the Users table
              $stmt = $db->prepare("SELECT COUNT(*) FROM Users WHERE user_id = :requested_by");
              $stmt->execute([':requested_by' => $requested_by]);

              if ($stmt->fetchColumn() == 0) {
                  throw new Exception("User with id $requested_by does not exist.");
              }

              // Update the contractor_id in the Jobs table and move the job to in-progress
              $stmt = $db->prepare("UPDATE Jobs SET contractor_id = :requested_by, status = 'in-progress' WHERE job_id = :job_id");
              $stmt->execute([':requested_by' => $requested_by, ':job_id' => $job_id]);

              // Update the status of the job request to 'accepted'
              $stmt = $db->prepare("UPDATE Requests SET status = 'accepted' WHERE job_id = :job_id AND requested_by = :requested_by");
              $stmt->execute([':job_id' => $job_id, ':requested_by' => $requested_by]);

              $db->commit();

              echo json_encode(['status' => 'success']);
          } catch (Exception $e) {
              $db->rollBack();
              echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
          }
      }
  } else {
      echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
  }
  exit();
}




// For the client to view job requests @ client-opend-jobs
function renderClientJobRequests() {
  include MODEL_PATH . 'jobs.php';
  $client_id = $_SESSION['user_id'];

  $requests = getJobRequestsByClient($client_id);
  var_dump($requests);

  require VIEW_PATH . 'jobs/client-open-jobs.php';
}

function getJobRequestsByClient($client_id) {
  global $db;
  $stmt = $db->prepare("SELECT * FROM Requests JOIN Jobs ON Requests.job_id = Jobs.job_id WHERE Jobs.posted_by = :client_id");
  $stmt->execute([':client_id' => $client_id]);

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


//For Client's completed jobs
function renderClientCompletedJobs () {
  include MODEL_PATH . 'jobs.php';

  if (!isset($_SESSION['user_id'])) {
      header('Location: /se265-capstone/login');
      exit();
  }
  
  // Retrieve the job ID from the URL
  $job_id = $_GET['job_id'] ?? 0;

  // Fetch the job details based on the job ID
  $job = getJobById($job_id);
  
  // If the job is not found or doesn't belong to the logged-in user, show an error
  if ($job === false || empty($job) || $job['posted_by'] != $_SESSION['user_id']) {
      echo "Job not found or you don't have permission to view this job.";
      return;
  }

  // Calculate pay based on job type
  if ($job) {
    if ($job['job_type'] === 'fixed') {
        $pay = '$' . number_format($job['budget'], 2);
    } elseif ($job['job_type'] === 'hourly') {
        $pay = '$' . number_format($job['hourly_rate'], 2) . '/hr';
    } else {
        $pay = 'N/A'; // In case job_type is neither 'fixed' nor 'hourly'
    }
  }

 // Pass the job, pay, and requests to the view
  require VIEW_PATH . 'jobs/client-completed-jobs.php';

}