<?php
$title = 'Sign Up';
include __DIR__ . '/../partials/header.php';
include __DIR__ . '/../partials/navbar.php';
?>
<main class="flex-grow-1">
  <div class="container py-5">
    <form id="signUpForm" method="post">
      <label for="username">Username</label>
      <input type="text" name="username" id="username" placeholder="Username" value="<?=$username ?>" autocomplete="">
      <br>
      <label for="email">Email</label>
      <input type="text" name="email" id="email" placeholder="email@example.com" value="<?=$email ?>" autocomplete="">
      <br>
      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="••••••••" value="<?=$password ?>" autocomplete="">
      <br>
      <label for="confirmPassword">Confirm Password</label>
      <input type="password" id="confirmPassword" name="confirmPassword" value="<?=$password ?>" placeholder="••••••••" autocomplete="">
      <br>
      <input type="checkbox" id="togglePassword"> Show Password
      <br>
      <button type="submit" name="signUpBtn">Sign Up</button>
    </form>
    <p id="errorContainer"></p>
    <?php if (isset($errorMsg)) : ?>
      <p class="text-danger"><?=$errorMsg ?></p>
    <?php endif; ?>
    <p>Already have an account? Log in
      <a href="/se265-capstone">here</a>
    </p>
  </div>
</main>
<script>
  $(document).ready(function() {
    $('#togglePassword').change(function() {
      if ($(this).is(':checked')) {
        $('#password, #confirmPassword').attr('type', 'text');
      } else {
        $('#password, #confirmPassword').attr('type', 'password');
      }
    });
  });
</script>
<script src="/se265-capstone/assets/js/signup.js"></script>
<?php include __DIR__ . '/../partials/footer.php'; ?>
