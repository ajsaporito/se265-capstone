<?php

function renderLogin() {
  include MODEL_PATH . 'users.php';

  $errorMsg = '';

  if (isset($_POST['loginBtn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $user = logIn($username, $password);

    if (count($user) > 0) {
      $_SESSION['user'] = $username;
      header('Location: /se265-capstone');
    } else {
      $errorMsg = 'Invalid username or password. Please try again.';
    }
  } else {
    $username = '';
    $password = '';
  }

  require VIEW_PATH . 'user/login.php';
}

function renderSignUp() {
  include MODEL_PATH . 'users.php';

  if (isset($_POST['signUpBtn'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
  
    signUp($firstName, $lastName, $username, $email, $password);
    session_start();
    $_SESSION['username'] = $username;
    header('Location: /se265-capstone');
  } else {
    $firstName = '';
    $lastName = '';
    $username = '';
    $email = '';
  }

  require VIEW_PATH . 'user/signup.php';
}

function renderLogout() {
  session_unset();
  session_destroy();
  header('Location: /se265-capstone/login');
}

function renderEditProfile() {
  if (!isset($_SESSION['user'])) {
    header('Location: /se265-capstone/login');
  }

  include MODEL_PATH . 'users.php';

  echo $_SESSION['user'];

  require VIEW_PATH . 'user/edit-profile.php';
}
