<?php

include __DIR__ . '\..\..\models\users.php';

if (isset($_POST['signUpBtn'])) {
  $errorMsg = '';
  $errorCt = 0;

  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (userExists($username, $email)) {
    $errorMsg = 'Username or email already exists.';
    $errorCt++;
    // TODO need to get rid of this error msg if front end validation is triggered again
  } else {
    //signUp($username, $email, $password);
    $_SESSION['user'] = $username;
    header('Location: /se265-capstone/verify-email');
  }
} else {
  $username = '';
  $email = '';
  $password = '';
}

require 'app/views/auth/signup.php';
