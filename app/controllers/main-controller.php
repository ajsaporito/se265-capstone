<?php

function renderDashboard() {
  include MODEL_PATH . 'reviews.php';
  include MODEL_PATH . 'jobs.php';  
  include MODEL_PATH . 'users.php';  

  // Check if the user is logged in
  if (!isset($_SESSION['user_id'])) {
      header('Location: /se265-capstone/login');
      exit();
  }

  // Get logged-in user's ID
  $userId = $_SESSION['user_id'];


  // Fetch user details (name and email)
  $userDetails = getUserById($userId);
  // Fetch average ratings for the user
  $averageRatings = getAverageRatingsByUserId($userId);
  // Fetch job-related data
  $completedJobs = getJobsByStatus($userId, 'complete');
  $inProgressJobs = getJobsByStatus($userId, 'in-progress');
  $openJobs = getJobsByStatus($userId, 'open');

  // Fetch reviews for jobs related to the user (contractor or client)
  $reviews = getReviewsByUserId($userId);  // Get all reviews for the logged-in user

  // Check if any reviews exist
  if (empty($reviews)) {
      $resultMessage = "No reviews available for this user.";
  }

  // Pass the data to the view
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
