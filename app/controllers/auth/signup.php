<?php

include __DIR__ . '\..\..\models\users.php';

$errorMsg = '';

if (isset($_POST['signUpBtn'])) {
  if ($errorCt == 0) {
    session_start();
    $_SESSION['user'] = $username;

    $password = sha1($password);
    signUp($username, $email, $password);
    header('Location: /se265-capstone/verify-email');
  }
}
require 'app/views/auth/signup.php';
