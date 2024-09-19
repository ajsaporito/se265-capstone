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

  require VIEW_PATH . 'users/signup.php';
}

function renderSubmitSignUp() {
  include MODEL_PATH . 'users.php';

  if (isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone');
    exit();
  }

  if (isset($_GET['firstName']) &&
      isset($_GET['lastName']) &&
      isset($_GET['username']) &&
      isset($_GET['email']) &&
      isset($_GET['password'])) {
    $firstName = $_GET['firstName'];
    $lastName = $_GET['lastName'];
    $username = $_GET['username'];
    $email = $_GET['email'];
    $password = $_GET['password'];

    signUp($firstName, $lastName, $username, $email, $password);
    $userId = getUserId($username);
    $_SESSION['user_id'] = $userId;

    header('Location: /se265-capstone');
    exit();
  } else {
    header('Location: /se265-capstone/signup');
    exit();
  }
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

function renderFindPeople() {
  include MODEL_PATH . 'users.php';

  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
  }

  $users = getAllUsers();

  require VIEW_PATH . 'users/find-people.php';
}

function renderUserProfile () {
  include MODEL_PATH . 'users.php';
  include MODEL_PATH . 'reviews.php';

  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
  }

  if (!isset($_GET['id']) || !userExistsById($_GET['id'])) {
    header('Location: /se265-capstone/find-people');
    exit();
  }

  $userId = filter_input(INPUT_GET, 'id');
  $user = getUserById($userId);
  $completedJobs = getCompletedJobsByUserId($userId);

  foreach ($completedJobs as $index => $job) {
    $reviews = getReviewsByJobId($job['job_id']);
    $completedJobs[$index]['reviews'] = $reviews;
  }

  $averageRatings = getAverageRatingsByUserId($userId);

  // Handle null values for ratings (set default values)
  $averageRatings = [
    'avg_communication' => isset($averageRatings['avg_communication']) ? $averageRatings['avg_communication'] : 0,
    'avg_time_management' => isset($averageRatings['avg_time_management']) ? $averageRatings['avg_time_management'] : 0,
    'avg_quality' => isset($averageRatings['avg_quality']) ? $averageRatings['avg_quality'] : 0,
    'avg_professionalism' => isset($averageRatings['avg_professionalism']) ? $averageRatings['avg_professionalism'] : 0,
  ];

  $userReviews = getReviewsByUserId($userId);

  require VIEW_PATH . 'users/user-profile.php';
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

  $id = $_GET['id'];
  $user = getUserRecord($id);

  require VIEW_PATH . 'users/edit-profile.php';
}

// AJAX call
function renderCheckEditProfile() {
  include MODEL_PATH . 'users.php';

  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
  }

  $username = $_POST['username'];
  $email = $_POST['email'];

  // Check if username and email are already taken
  $usernameTaken = userExistsByUsernameEdit($username, $_SESSION['user_id']);
  $emailTaken = userExistsByEmailEdit($email, $_SESSION['user_id']);

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

function renderSubmitEditProfile() {
  include MODEL_PATH . 'users.php';

  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
  }

  if (isset($_GET['id']) &&
      isset($_GET['firstName']) &&
      isset($_GET['lastName']) &&
      isset($_GET['username']) &&
      isset($_GET['email'])) {
    $id = $_GET['id'];
    $firstName = $_GET['firstName'];
    $lastName = $_GET['lastName'];
    $username = $_GET['username'];
    $email = $_GET['email'];

    updateProfile($id, $firstName, $lastName, $username, $email);
    header('Location: /se265-capstone');
    exit();
  } else {
    header('Location: /se265-capstone/edit-profile');
    exit();
  }
}

function renderChangePassword() {
  include MODEL_PATH . 'users.php';

  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
  }

  if ($_GET['id'] != $_SESSION['user_id']) {
    header('Location: /se265-capstone');
    exit();
  }

  $id = $_GET['id'];
  $user = getUserRecord($id);

  if (isset($_POST['changePasswordBtn'])) {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    if (!password_verify($currentPassword, $user['password'])) {
      $currentPasswordError = 'Incorrect password';
      $currentPasswordErrorClass = 'signup-input-error';
    }

    if (empty($currentPasswordError) && $newPassword !== $confirmNewPassword) {
      $passwordError = 'Passwords do not match';
      $passwordErrorClass = 'signup-input-error';
    }

    if (empty($currentPasswordError) && empty($passwordError)) {
      $passwordPattern = '/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/';
      if (!preg_match($passwordPattern, $newPassword)) {
        $newPasswordError = 'Password must be at least 8 characters long, include at least one number and one special character';
        $newPasswordErrorClass = 'signup-input-error';
      }
    }

    if (empty($currentPasswordError) && empty($passwordError) && empty($newPasswordError)) {
      changePassword($id, $newPassword);
      header('Location: /se265-capstone');
      exit();
    }
  }

  require VIEW_PATH . 'users/change-password.php';
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
    $id = $_GET['id'];
    deleteUser($id);

    session_unset();
    session_destroy();
    header('Location: /se265-capstone/login');
    exit();
  }
}
