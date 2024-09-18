<?php

function renderJobs() {
  include MODEL_PATH . 'jobs.php';

  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
  }

  // Fetch only open jobs
  $jobs = getAllOpenJobs();

  require VIEW_PATH . 'jobs/jobs.php';
}

function renderAddJob() {
  include MODEL_PATH . 'jobs.php';
  
  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
  }

  $location = 'Select State';
  $jobType = 'Select Job Type';
  $titleError = $locationError = $descriptionError = $jobTypeError = $dateError = $budgetError = $hourlyRateError = $hoursPerWeekError = '';
  $titleErrorClass = $locationErrorClass = $descriptionErrorClass = $jobTypeErrorClass = $dateErrorClass = $budgetErrorClass = $hourlyRateErrorClass = $hoursPerWeekErrorClass = '';

  $skills = getAllSkills();
  $skillsSelected = isset($_POST['skills']) ? $_POST['skills'] : [];

  if (isset($_POST['addJobBtn'])) {
    $errorCt = 0;

    $jobTitle = trim($_POST['title']);
    $location = $_POST['location'];
    $description = trim($_POST['description']);
    $jobType = $_POST['job_type'];
    $date = $_POST['estimated_completion_date'];
    $budget = $_POST['budget'];
    $hourlyRate = $_POST['hourly_rate'];
    $hoursPerWeek = $_POST['estimated_hours_per_week'];

    if (strlen($jobTitle) < 5) {
      $titleError = "Title must be at least 5 characters long";
      $titleErrorClass = 'signup-input-error';
      $errorCt++;
    }

    if ($location == 'Select State') {
      $locationError = "Please select a location";
      $locationErrorClass = 'signup-input-error';
      $location = 'Select State';
      $errorCt++;
    }

    if (strlen($description) < 10) {
      $descriptionError = "Description must be at least 10 characters long";
      $descriptionErrorClass = 'signup-input-error';
      $errorCt++;
    }

    if ($jobType == 'Select Job Type') {
      $jobTypeError = "Please select a job type";
      $jobTypeErrorClass = 'signup-input-error';
      $jobType = 'Select Job Type';
      $errorCt++;
    }

    if ($date < date('Y-m-d')) {
      $dateError = "Date must be in the future";
      $dateErrorClass = 'signup-input-error';
      $errorCt++;
    }

    if ($budget < 1 && $jobType == 'Fixed') {
      $budgetError = "Budget must be at least $1";
      $budgetErrorClass = 'signup-input-error';
      $errorCt++;
    }

    if ($hourlyRate < 1 && $jobType == 'Hourly') {
      $hourlyRateError = "Hourly rate must be at least $1";
      $hourlyRateErrorClass = 'signup-input-error';
      $errorCt++;
    }

    if ($hoursPerWeek < 1 && $jobType == 'Hourly') {
      $hoursPerWeekError = "Estimated hours per week must be at least 1";
      $hoursPerWeekErrorClass = 'signup-input-error';
      $errorCt++;
    }

    if (empty($skillsSelected)) {
      $skillsError = "Please select at least one skill";
      $skillsErrorClass = 'signup-input-error';
      $errorCt++;
    }

    if ($errorCt == 0) {
      $jobData = [
        'posted_by' => $_SESSION['user_id'],
        'title' => $_POST['title'],
        'location' => $_POST['location'],
        'description' => $_POST['description'],
        'budget' => ($_POST['job_type'] == 'Fixed' && !empty($_POST['budget'])) ? $_POST['budget'] : null,
        'status' => 'open',
        'job_type' => $_POST['job_type'],
        'hourly_rate' => ($_POST['job_type'] == 'Hourly' && !empty($_POST['hourly_rate'])) ? $_POST['hourly_rate'] : null,
        'estimated_hours_per_week' => (!empty($_POST['estimated_hours_per_week']) && $_POST['job_type'] == 'hourly') ? $_POST['estimated_hours_per_week'] : null,
        'estimated_completion_date' => isset($_POST['estimated_completion_date']) ? $_POST['estimated_completion_date'] : null,
      ];

      saveJobWithSkills($jobData, $skillsSelected);
      header('Location: /se265-capstone/jobs');
      exit();
    }
  } else {
    $jobTitle = '';
    $location = 'Select State';
    $description = '';
    $jobType = 'Select Job Type';
    $date = '';
    $budget = '';
    $hourlyRate = '';
    $hoursPerWeek = '';
  }

  require VIEW_PATH . 'jobs/add-job.php';
}

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
  }

  require VIEW_PATH . 'jobs/job-info.php';
}

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

  $requests = getJobRequestsByJobId($job_id);

  require VIEW_PATH . 'jobs/client-open-jobs.php';
}

//New Ajax request to request a job or accept a job request
function handleJobRequest() {
  include MODEL_PATH . 'jobs.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_id = $_POST['job_id'];
    $requested_by = $_POST['requested_by'];
    $jobs = getJobById($job_id);
    $posted_by = $jobs['posted_by'];

    // Determine if the action is to request or accept a job
    $action = $_POST['action'] ?? 'request';

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
      acceptJobRequest($job_id, $requested_by);
    }
  } else {
    header('Location: /se265-capstone');
  }
  exit();
}

// For the client to view job requests @ client-opend-jobs
function renderClientJobRequests() {
  include MODEL_PATH . 'jobs.php';

  $client_id = $_SESSION['user_id'];
  $requests = getJobRequestsByClient($client_id);

  require VIEW_PATH . 'jobs/client-open-jobs.php';
}

//For Client's completed jobs
function renderClientCompletedJobs () {
  include MODEL_PATH . 'jobs.php';
  include MODEL_PATH . 'users.php';

  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
  }
  
  // Retrieve the job ID from the URL
  $job_id = $_GET['job_id'] ?? 0;

  // Fetch the job details based on the job ID
  $job = getJobById($job_id);
  
  // If the job is not found or doesn't belong to the logged-in user, show an error
  if ($job === false || empty($job) || $job['posted_by']) {
    header('Location: /se265-capstone');
    exit();
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

  $contractor = getUserById($job['contractor_id']);

  require VIEW_PATH . 'jobs/client-completed-jobs.php';
}

function markJobComplete() {
  include MODEL_PATH . 'jobs.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_id = $_POST['job_id'];
    markJobAsCompleted($job_id);
  } else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
  }
  exit();
}

function deleteJob() {
  include MODEL_PATH . 'jobs.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_id = $_POST['job_id'];
    deleteOpenJob($job_id);
  } else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
  }
  exit();
}

function renderAddReview() {
  include MODEL_PATH . 'reviews.php';

  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
  }

  $professionalism = $quality = $timeManagement = $communication = $comments = '';

  if (isset($_GET['id'])) {
    $contractorId = $_GET['id'];
  } else {
    header('Location: /se265-capstone');
    exit();
  }

  if (isset($_POST['addReviewBtn'])) {
    if (isset($_POST['professionalism']) &&
        isset($_POST['quality']) &&
        isset($_POST['timeManagement']) &&
        isset($_POST['communication'])) {

      $reviewerId = $_SESSION['user_id'];
      $professionalism = $_POST['professionalism'];
      $quality = $_POST['quality'];
      $timeManagement = $_POST['timeManagement'];
      $communication = $_POST['communication'];
      $comments = $_POST['comments'];
    } else {
      $professionalism = $quality = $timeManagement = $communication = '';
    }

    if (empty($professionalism) || empty($quality) || empty($timeManagement) || empty($communication)) {
      $errorMsg = 'Please rate all the skills.';
    } else {
      addReview($reviewerId, $contractorId, $professionalism, $quality, $timeManagement, $communication, $comments);
      header('Location: /se265-capstone');
      exit();
    }
  }

  require VIEW_PATH . 'jobs/add-review.php';
}
