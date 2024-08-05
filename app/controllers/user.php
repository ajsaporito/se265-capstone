<?php

function renderLogin() {
  include MODEL_PATH . 'users.php';

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

  require VIEW_PATH . 'user/login.php';
}

function renderSignUp() {
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
}

function renderLogout() {
  session_unset();
  session_destroy();
  header('Location: /se265-capstone/login');
}

function renderEditProfile() {
  include MODEL_PATH . 'users.php';

  require VIEW_PATH . 'user/edit-profile.php';
}

function renderVerifyEmail() {
  include MODEL_PATH . 'users.php';

  require VIEW_PATH . 'user/verify-email.php';
}