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

  // Handle null values for ratings (set default values)
  $averageRatings = [
      'avg_communication' => isset($averageRatings['avg_communication']) ? $averageRatings['avg_communication'] : 0,
      'avg_time_management' => isset($averageRatings['avg_time_management']) ? $averageRatings['avg_time_management'] : 0,
      'avg_quality' => isset($averageRatings['avg_quality']) ? $averageRatings['avg_quality'] : 0,
      'avg_professionalism' => isset($averageRatings['avg_professionalism']) ? $averageRatings['avg_professionalism'] : 0,
  ];

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
  
  if (isset($_POST['searchBtn'])) {
    $search = $_POST['search'];
    $searchType = $_POST['searchType'];

    if ($searchType === 'jobs') {
      require VIEW_PATH . 'jobs/search-jobs.php';
    } elseif ($searchType === 'people') {
      include MODEL_PATH . 'users.php';

      $users = searchPeople($search);

      require VIEW_PATH . 'users/search-people.php';
    } else {
      include MODEL_PATH . 'jobs.php';

      $jobs = searchJobs($search);

      require VIEW_PATH . 'jobs/search-jobs.php';
    }
  } else {
    header('Location: /se265-capstone');
    exit();
  }
}

function renderAbout() {
  require VIEW_PATH . 'static/about.php';
}

function renderContact() {
  require VIEW_PATH . 'static/contact.php';
}

function renderPrototype() {
  require VIEW_PATH . 'static/prototype.php';
}
