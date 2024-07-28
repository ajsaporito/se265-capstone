<?php

include __DIR__ . '\..\..\models\users.php';

$errorMsg = '';

if (isset($_POST['loginBtn'])) {
  $username = filter_input(INPUT_POST, 'username');
  $email = filter_input(INPUT_POST, 'email');
  $password = filter_input(INPUT_POST, 'password');
  $user = logIn($username, $email, $password);

  if (count($user) > 0) {
    session_start();
    $_SESSION['user'] = $username;
    header('Location: /se265-capstone');
  } else {
    $errorMsg = 'Invalid username, email, or password. Please try again.';
  }
} else {
  $username = '';
  $email = '';
  $password = '';
}

require 'app/views/auth/login.php';
