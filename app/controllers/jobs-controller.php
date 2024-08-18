<?php

function renderJobs() {
include MODEL_PATH . 'jobs.php';

  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
  }

  $jobs = getAllJobs();

  require VIEW_PATH . 'jobs/jobs.php';
}


function renderAddJob() {
  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
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

    if ($job) {
        $title = $job['title'] . ' - Job Details';
    } else {
        header('Location: /se265-capstone/404');
        exit();
    }

    require VIEW_PATH . 'jobs/job-info.php';
 }
}


?>