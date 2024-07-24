<?php
$title = 'Login';
include __DIR__ . '/../partials/header.php';
include __DIR__ . '/../partials/navbar.php';
?>
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
  <?php if (!empty($errorMsg)): ?>
  <p id="errorContainer"><?= $errorMsg; ?></p>
  <?php endif; ?>
  <button type="submit" name="loginBtn">Login</button>
  <p>Don't have an account?
    <a href="/se265-capstone/signup">Sign up here</a>
  </p>
</form>
<script src="/se265-capstone/assets/js/validation/login.js"></script>
<?php include __DIR__ . '/../partials/footer.php'; ?>
