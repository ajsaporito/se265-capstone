<?php

function renderLogin() {
  include MODEL_PATH . 'users.php';

  if (isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone');
    exit();
  } 

  if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = logIn($username, $password);

    // Log user in and start session if credentials are correct
    if ($result['success']) {
      $userId = getUserId($username);
      $_SESSION['user_id'] = $userId;
      echo json_encode(['success' => true, 'message' => '']);
    } else {
      // If invalid credentials, return error in JSON format back to AJAX request
      if ($result['message'] == 'Username not found') {
        echo json_encode(['success' => false, 'usernameError' => 'Username not found', 'passwordError' => '']);
      } elseif ($result['message'] == 'Incorrect password') {
        echo json_encode(['success' => false, 'usernameError' => '', 'passwordError' => 'Incorrect password']);
      }
    }
    exit();
  }

  require VIEW_PATH . 'users/login.php';
}


function renderSignUp() {
  include MODEL_PATH . 'users.php';

  if (isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone');
    exit();
  }

  // Create new user and log them in when form hits the server
  // Fields are validated in the front end before this point
  if (isset($_POST['signUpBtn'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
  
    signUp($firstName, $lastName, $username, $email, $password);
    $userId = getUserId($username);
    $_SESSION['user_id'] = $userId;
    header('Location: /se265-capstone');
    exit();
  } 

  require VIEW_PATH . 'users/signup.php';
}

// AJAX request 
function renderCheckSignUp() {
  include MODEL_PATH . 'users.php';

  if (isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone');
    exit();
  }

  $username = $_POST['username'];
  $email = $_POST['email'];

  // Check if username and email are already taken
  $usernameTaken = userExistsByUsername($username);
  $emailTaken = userExistsByEmail($email);

  $response = array('success' => true);

  // Return error in JSON format back to AJAX request
  if (!$usernameTaken['success']) {
    $response['success'] = false;
    $response['usernameError'] = $usernameTaken['message'];
  }

  if (!$emailTaken['success']) {
    $response['success'] = false;
    $response['emailError'] = $emailTaken['message'];
  }

  echo json_encode($response);
}

function renderLogout() {
  session_unset();
  session_destroy();
  header('Location: /se265-capstone/login');
  exit();
}

function renderPeople() {
  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
  }

  // Include the model file to access the getAllUsers function
  include MODEL_PATH . 'users.php';

  // Fetch all users from the database
  $users = getAllUsers();

  require VIEW_PATH . 'users/people.php';
}

function renderEditProfile() {
  include MODEL_PATH . 'users.php';

  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
  }

  if ($_GET['id'] != $_SESSION['user_id']) {
    header('Location: /se265-capstone');
    exit();
  }

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $users = getUserRecord($id);

    $firstName = $users['first_name'];
    $lastName = $users['last_name'];
    $username = $users['username'];
    $email = $users['email'];
    $password = $users['password'];
  }

  require VIEW_PATH . 'users/edit-profile.php';
}

function renderDeleteProfile() {
  include MODEL_PATH . 'users.php';

  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
  }

  if ($_GET['id'] != $_SESSION['user_id']) {
    header('Location: /se265-capstone');
    exit();
  }

  if (isset($_GET['id'])) {
    deleteUser($id);
    $id = $_GET['id'];
   

    session_unset();
    session_destroy();
    header('Location: /se265-capstone/login');
    exit();
  }
}

function renderPublicProfile () {
  include MODEL_PATH . 'users.php';

  if (isset($_GET['id'])){
    $userId = $_GET['id'];
    $user = getUserById($userId);

    if($user) {
      //pass the user data to view page
      require VIEW_PATH . 'main/public-profile.php';
    } else {
      header('Location: /se265-capstone/404');
      exit();
    }
  }
  else {
    header('Location: /se265-capstone/404');
    echo "no id";
    exit();
  }
}