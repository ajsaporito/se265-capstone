<?php

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

$title = 'Login';
include PARTIAL_PATH . 'header.php';
?>
<main class="flex-grow-1">
  <div class="container py-5">
    <form id="loginForm" method="post">
      <label for="username">Username</label>
      <input type="text" name="username" id="username" value="<?= $username; ?>" placeholder="Username">
      <br>
      <label for="email">Email</label>
      <input type="text" name="email" id="email" value="<?= $email; ?>" placeholder="email@example.com">
      <br>
      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="••••••••••">
      <br>
      <button type="submit" name="loginBtn">Login</button>
      <p id="errorContainer"></p>
      <p>Don't have an account? Sign up
        <a href="/se265-capstone/signup">here</a>
      </p>
    </form>
  </div>
</main>
<?php include PARTIAL_PATH . 'footer.php'; ?>
