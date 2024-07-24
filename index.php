<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$uri = rtrim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');

$routes = [
  // Login and signup 
  '/se265-capstone' => 'app/controllers/auth/login.php',
  '/se265-capstone/signup' => 'app/controllers/auth/signup.php',
  '/se265-capstone/verify-email' => 'app/controllers/auth/verify-email.php',
  '/se265-capstone/logout' => 'app/controllers/auth/logout.php',
  // Home and main pages
  '/se265-capstone/home' => 'app/controllers/home.php',
  // Static pages
  '/se265-capstone/about' => 'app/views/static/about.php',
  '/se265-capstone/contact' => 'app/views/static/contact.php',
];

if (array_key_exists($uri, $routes)) {
  require $routes[$uri];
} else {
  require 'app/views/static/404.php';
}
