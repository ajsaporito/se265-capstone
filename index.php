<?php
include __DIR__ . '\app\config\debug.php';
include __DIR__ . '\app\config\config.php';

session_start();
checkInactivity();

$uri = rtrim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');

$routes = [
  '/se265-capstone' => 'main-controller@renderDashboard',
  '/se265-capstone/jobs' => 'main-controller@renderJobs',
  '/se265-capstone/people' => 'main-controller@renderPeople',
  '/se265-capstone/search' => 'main-controller@renderSearch',
  '/se265-capstone/about' => 'main-controller@renderAbout',
  '/se265-capstone/contact' => 'main-controller@renderContact',

  '/se265-capstone/login' => 'users-controller@renderLogin',
  '/se265-capstone/signup' => 'users-controller@renderSignup',
  '/se265-capstone/logout' => 'users-controller@renderLogout',
  '/se265-capstone/edit-profile' => 'users-controller@renderEditProfile',
];

try {
  if (array_key_exists($uri, $routes)) {
    $route = $routes[$uri];
    if (strpos($route, '@')) {
      list($controller, $function) = explode('@', $route);
      $controllerPath = 'app/controllers/' . $controller . '.php';
      if (file_exists($controllerPath)) {
        require $controllerPath;
        $function();
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
