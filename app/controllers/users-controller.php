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

function renderFindPeople() {
  include MODEL_PATH . 'users.php';

  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
  }

  $users = getAllUsers();

  require VIEW_PATH . 'users/find-people.php';
}

/*function renderUserProfile () {
  include MODEL_PATH . 'users.php';

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

  require VIEW_PATH . 'users/user-profile.php';
}*/
/*
function renderUserProfile() {
  include MODEL_PATH . 'users.php';

  if (isset($_GET['id'])) {
      $userId = $_GET['id'];
      $user = getUserById($userId);
     // var_dump($userId);
    if ($user) {
      // Fetch completed jobs for this user
      $completedJobs = getCompletedJobsByUserId($userId);
      foreach ($completedJobs as $index => $job) {
        $reviews = getReviewsByJobId($job['job_id']);
        $completedJobs[$index]['reviews'] = $reviews;
        //Debugging to ensure each job gets the correct reviews associated:
        //echo "Job ID: {$job['job_id']} - Reviews: " . print_r($reviews, true) . "\n";
      }
    }
  } 
    require VIEW_PATH . 'users/user-profile.php';
}
*/

function renderUserProfile() {
  include MODEL_PATH . 'users.php';
  include MODEL_PATH . 'reviews.php'; // Ensure this is included to access the reviews functions

  if (isset($_GET['id'])) {
      $userId = $_GET['id'];
      $user = getUserById($userId);

      if ($user) {
          // Fetch completed jobs for this user
          $completedJobs = getCompletedJobsByUserId($userId);

          foreach ($completedJobs as $index => $job) {
              // Fetch reviews associated with each job
              $reviews = getReviewsByJobId($job['job_id']);
              $completedJobs[$index]['reviews'] = $reviews;
          }

          // Fetch the overall average ratings for the user
          $averageRatings = getAverageRatingsByUserId($userId);

          // Handle null values for ratings (set default values)
          $averageRatings = [
              'avg_communication' => isset($averageRatings['avg_communication']) ? $averageRatings['avg_communication'] : 0,
              'avg_time_management' => isset($averageRatings['avg_time_management']) ? $averageRatings['avg_time_management'] : 0,
              'avg_quality' => isset($averageRatings['avg_quality']) ? $averageRatings['avg_quality'] : 0,
              'avg_professionalism' => isset($averageRatings['avg_professionalism']) ? $averageRatings['avg_professionalism'] : 0,
          ];

          // Fetch all individual reviews for the user
          $userReviews = getReviewsByUserId($userId);

          // Pass data to the view
          require VIEW_PATH . 'users/user-profile.php';
      } else {
          echo "User not found.";
      }
  } else {
      echo "No user ID provided.";
  }
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

  if (isset($_POST['updateBtn'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    var_dump($firstName, $lastName, $username, $email);
    //updateProfile($id, $firstName, $lastName, $username, $email);
    //header('Location: /se265-capstone');
  }

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

function renderChangePassword() {
  include MODEL_PATH . 'users.php';

  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
  }

  if (isset($_POST['changePasswordBtn'])) {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    // Call function

    // Redirect back to dashboard after
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
    deleteUser($id);
    $id = $_GET['id'];

    session_unset();
    session_destroy();
    header('Location: /se265-capstone/login');
    exit();
  }
}

