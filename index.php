<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include __DIR__ . '\app\config\functions.php';
include __DIR__ . '\app\config\paths.php';

session_start();
checkInactivity();

$uri = rtrim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');

$routes = [
  '/se265-capstone' => 'main-controller@renderDashboard',
  '/se265-capstone/search' => 'main-controller@renderSearch',
  '/se265-capstone/about' => 'main-controller@renderAbout',
  '/se265-capstone/contact' => 'main-controller@renderContact',
  '/se265-capstone/prototype' => 'main-controller@renderPrototype',

  '/se265-capstone/login' => 'users-controller@renderLogin',
  '/se265-capstone/signup' => 'users-controller@renderSignup',
  '/se265-capstone/check-signup' => 'users-controller@renderCheckSignup',
  '/se265-capstone/submit-signup' => 'users-controller@renderSubmitSignup',
  '/se265-capstone/logout' => 'users-controller@renderLogout',
  '/se265-capstone/find-people' => 'users-controller@renderFindPeople',
  '/se265-capstone/user-profile' => 'users-controller@renderUserProfile',
  '/se265-capstone/edit-profile' => 'users-controller@renderEditProfile',
  '/se265-capstone/check-edit-profile' => 'users-controller@renderCheckEditProfile',
  '/se265-capstone/submit-edit-profile' => 'users-controller@renderSubmitEditProfile',
  '/se265-capstone/change-password' => 'users-controller@renderChangePassword',

  '/se265-capstone/jobs' => 'jobs-controller@renderJobs',
  '/se265-capstone/add-job' => 'jobs-controller@renderAddJob',
  '/se265-capstone/job-info' => 'jobs-controller@renderJobInfo',
  '/se265-capstone/request-job' => 'jobs-controller@handleJobRequest',
  '/se265-capstone/client-open-jobs' => 'jobs-controller@renderClientOpenJobs',
  '/se265-capstone/delete-job' => 'jobs-controller@deleteJob',
  '/se265-capstone/handle-job-request' => 'jobs-controller@handleJobRequest',
  '/se265-capstone/client-completed-jobs' => 'jobs-controller@renderClientCompletedJobs',
  '/se265-capstone/mark-job-complete' => 'jobs-controller@markJobComplete',
  
  '/se265-capstone/add-review' => 'jobs-controller@renderAddReview',
];

try {
  if (array_key_exists($uri, $routes)) {
    $route = $routes[$uri];
    if (strpos($route, '@')) {
      list($controller, $function) = explode('@', $route);
      $controllerPath = 'app/controllers/' . $controller . '.php';
      if (file_exists($controllerPath)) {
        require $controllerPath;
        $function($_GET);
      } 
    }
  } else {
    http_response_code(404);
    require VIEW_PATH . 'static/404.php';
  }
} catch (Exception $e) {
  http_response_code(500);
  echo $e->getMessage();
} 
