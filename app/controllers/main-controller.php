<?php

function renderDashboard() {
  include MODEL_PATH . 'reviews.php';

  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
  }

  $userId = $_SESSION['user_id'];
  $jobId = getJobId($userId);
  $reviews = [];

  if ($jobId === $userId) {
    // Fetch reviews with user validation
    $reviews = GetReviewsByJobId($jobId, $logged_in_user_id);

    if (empty($reviews)) {
        $resultMessage = "You do not have access to this job or there are no reviews.";
    }
  } else {
      $resultMessage = "Invalid job ID";
  }
  /*var_dump($job_id);
  var_dump($logged_in_user_id);
  var_dump($reviews); */

  require VIEW_PATH . 'main/dashboard.php';
}

function renderSearch() {
  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
  }
  
  if (isset($_POST['search'])) {
    $search = $_POST['search'];
    echo $search;
  }
}

function renderAbout() {
  require VIEW_PATH . 'static/about.php';
}

function renderContact() {
  require VIEW_PATH . 'static/contact.php';
}
