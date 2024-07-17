<?php

$uri = rtrim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');

$routes = [
  '/se265-capstone' => 'app/controllers/home.php',
  '/se265-capstone/home' => 'app/controllers/home.php',
  '/se265-capstone/about' => 'app/controllers/about.php',
  '/se265-capstone/contact' => 'app/controllers/contact.php',
];

if (array_key_exists($uri, $routes)) {
  require $routes[$uri];
} else {
  require 'app/views/404.php';
} ?>
