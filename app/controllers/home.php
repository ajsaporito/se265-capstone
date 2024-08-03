<?php

if (!isset($_SESSION['user'])) {
  header('Location: /se265-capstone/login');
  exit();
}

require 'app/views/home.php';
