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

  require VIEW_PATH . 'jobs/job-info.php';
}
