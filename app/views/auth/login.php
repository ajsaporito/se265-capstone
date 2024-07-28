<?php
$title = 'Login';
include __DIR__ . '/../partials/header.php';
include __DIR__ . '/../partials/navbar.php';
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
<?php include __DIR__ . '/../partials/footer.php'; ?>
