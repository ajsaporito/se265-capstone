<?php

function renderJobs() {
  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
  }



  require VIEW_PATH . 'main/jobs.php';
}

function renderAddJob() {
  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
  }

  require VIEW_PATH . 'main/add-job.php';
}
