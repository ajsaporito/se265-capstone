<?php
$title = 'Sign Up';
include __DIR__ . '/../partials/header.php';
include __DIR__ . '/../partials/navbar.php';
?>
<form id="signUpForm" method="post">
  <label for="username">Username</label>
  <input type="text" name="username" id="username" placeholder="Username">
  <br>
  <label for="email">Email</label>
  <input type="text" name="email" id="email" placeholder="email@example.com">
  <br>
  <label for="password">Password</label>
  <input type="password" id="password" name="password" placeholder="••••••••••">
  <br>
  <p id="errorContainer"></p>
  <button type="submit" name="signUpBtn">Sign Up</button>
  <p>Already have an account?
    <a href="/se265-capstone">Log in here</a>
  </p>
</form>
<script src="/se265-capstone/assets/js/validation/signup.js"></script>
<?php include __DIR__ . '/../partials/footer.php'; ?>
