<?php

function renderDashboard() {
  include MODEL_PATH . 'reviews.php';
  include MODEL_PATH . 'jobs.php';  
  include MODEL_PATH . 'users.php';  

  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
  }

  $userId = $_SESSION['user_id'];
  $userDetails = getUserById($userId);
  $averageRatings = getAverageRatingsByUserId($userId);

  // Handle null values for ratings (set default values)
  $averageRatings = [
    'avg_communication' => isset($averageRatings['avg_communication']) ? $averageRatings['avg_communication'] : 0,
    'avg_time_management' => isset($averageRatings['avg_time_management']) ? $averageRatings['avg_time_management'] : 0,
    'avg_quality' => isset($averageRatings['avg_quality']) ? $averageRatings['avg_quality'] : 0,
    'avg_professionalism' => isset($averageRatings['avg_professionalism']) ? $averageRatings['avg_professionalism'] : 0,
  ];

  $completedJobs = getJobsByStatus($userId, 'complete');
  $inProgressJobs = getJobsByStatus($userId, 'in-progress');
  $openJobs = getJobsByStatus($userId, 'open');

  // Get reviews for jobs related to the user (contractor or client)
  $reviews = getReviewsByUserId($userId);

  if (empty($reviews)) {
    $resultMessage = "No reviews available for this user.";
  }

  require VIEW_PATH . 'main/dashboard.php';
}

function renderSearch() {
  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
  }

  // Prevent XXS in the search input
  
  if (isset($_POST['searchBtn'])) {
    $search = trim(filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING));
    $searchType = trim(filter_input(INPUT_POST, 'searchType', FILTER_SANITIZE_STRING));

    if ($searchType === 'jobs') {
      require VIEW_PATH . 'jobs/search-jobs.php';
    } elseif ($searchType === 'people') {
      include MODEL_PATH . 'users.php';

      $users = searchPeople(htmlspecialchars($search, ENT_QUOTES, 'UTF-8'));

      require VIEW_PATH . 'users/search-people.php';
    } else {
      include MODEL_PATH . 'jobs.php';

      $jobs = searchJobs(htmlspecialchars($search, ENT_QUOTES, 'UTF-8'));

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
