<?php

function renderLogin() {
  include MODEL_PATH . 'users.php';

  if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = logIn($username, $password);

    if ($result['success']) {
      $_SESSION['user'] = $username;
      echo json_encode(['success' => true, 'message' => 'Login successful']);
    } else {
      if ($result['message'] == 'Username not found') {
        echo json_encode(['success' => false, 'usernameError' => 'Username not found', 'passwordError' => '']);
      } elseif ($result['message'] == 'Incorrect password') {
        echo json_encode(['success' => false, 'usernameError' => '', 'passwordError' => 'Incorrect password']);
      }
    }
    exit();
  }
  include VIEW_PATH . 'user/login.php';
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
    $_SESSION['user'] = $username;
    header('Location: /se265-capstone');
    exit();
  } 

  require VIEW_PATH . 'user/signup.php';
}

function renderLogout() {
  session_unset();
  session_destroy();
  header('Location: /se265-capstone/login');
  exit();
}

function renderEditProfile() {
  if (!isset($_SESSION['user'])) {
    header('Location: /se265-capstone/login');
    exit();
  }

  include MODEL_PATH . 'users.php';

  require VIEW_PATH . 'user/edit-profile.php';
}
