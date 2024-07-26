<?php

include __DIR__ . '\..\..\models\users.php';

$errorCt = 0;
$errorMsg = '';

if (isset($_POST['signUpBtn'])) {
  $username = $_POST['username'];
  $_SESSION['user'] = $username;
  $email = $_POST['email'];
  $password = $_POST['password'];
  signUp($username, $email, $password);
}

require 'app/views/auth/signup.php';
