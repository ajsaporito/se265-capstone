<?php
include __DIR__ . '\app\config\debug.php';
include __DIR__ . '\app\config\paths.php';

$uri = rtrim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');

$routes = [
  '/se265-capstone' => 'main@renderDashboard',
  '/se265-capstone/jobs' => 'main@renderJobs',
  '/se265-capstone/people' => 'main@renderPeople',
  '/se265-capstone/search' => 'main@renderSearch',
  '/se265-capstone/about' => 'main@renderAbout',
  '/se265-capstone/contact' => 'main@renderContact',

  '/se265-capstone/login' => 'user@renderLogin',
  '/se265-capstone/signup' => 'user@renderSignup',
  '/se265-capstone/logout' => 'user@renderLogout',
  '/se265-capstone/edit-profile' => 'user@renderEditProfile',
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
