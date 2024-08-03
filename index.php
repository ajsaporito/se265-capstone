<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include __DIR__ . '\app\config\paths.php';

$uri = rtrim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');

$routes = [
  // User 
  '/se265-capstone/login' => 'app/controllers/user/login.php',
  '/se265-capstone/signup' => 'app/controllers/user/signup.php',
  '/se265-capstone/check-user' => 'app/controllers/user/check-user.php',
  '/se265-capstone/verify-email' => 'app/controllers/user/verify-email.php',
  '/se265-capstone/logout' => 'app/controllers/user/logout.php',
  // Home and main pages
  '/se265-capstone' => 'app/controllers/home.php',
  // Static pages
  '/se265-capstone/about' => 'app/views/static/about.php',
  '/se265-capstone/contact' => 'app/views/static/contact.php',
];

if (array_key_exists($uri, $routes)) {
  require $routes[$uri];
} else {
  require 'app/views/static/404.php';
}
