<?php

include MODEL_PATH . 'users.php';

if (isset($_POST['signUpBtn'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  signUp($username, $email, $password);
  $_SESSION['user'] = $username;
  header('Location: /se265-capstone/verify-email');
} else {
  $username = '';
  $email = '';
  $password = '';
}

require VIEW_PATH . 'user/signup.php';
