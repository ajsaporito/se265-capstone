<?php
$title = 'Login';
include PARTIAL_PATH . 'header.php';
include PARTIAL_PATH . 'navbar.php';
?>
<main id="contentContainer" class="flex-grow-1 mx-2 p-2">
  <div class="py-5 mx-4 oxygen-regular">
    <div class="row justify-content-center">
      <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
        <div class="card border-0 shadow-sm rounded-4 p-3">
          <div class="card-body p-3 p-md-4">
            <div class="row">
              <div class="col-12">
                <div class="mb-4">
                  <h1 class="oxygen-bold pb-1">Login</h1>
                  <h3 class="fs-6 fw-normal text-secondary m-0">Welcome back</h3>
                </div>
              </div>
            </div>
            <form id="loginForm" method="post">
              <div class="row gy-3 overflow-hidden">
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control shadow-none main-form-input" name="username" id="username" placeholder="Username" value="<?= $username ?>" autocomplete="">
                    <label for="username" class="form-label text-muted">Username</label>
                    <span style="font-size: 14px;" id="usernameError" class="text-danger position-absolute m-1 oxygen-light"></span>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control shadow-none main-form-input" name="password" id="password" placeholder="Password" autocomplete="">
                    <label for="password" class="form-label text-muted">Password</label>
                    <span style="font-size: 14px;" id="passwordError" class="text-danger position-absolute m-1 oxygen-light"></span>
                  </div>
                </div>
                <div class="col-12 oxygen-light">
                  <div class="form-check my-2">
                    <input class="shadow-none" type="checkbox" name="showPassword" id="showPassword">
                    <label class="form-check-label text-secondary" for="showPassword">
                      Show Password
                    </label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="row mx-1">
                    <button style="background-color: #6643b5;" class="btn rounded-4 text-white" type="submit" name="loginBtn" onmouseover="this.style.background='#714bc9'" onmouseout="this.style.background='#6643b5'">Login</button>
                  </div>
                </div>
              </div>
            </form>
            <div class="row oxygen-light">
              <div class="col-12">
                <span class="nav justify-content-center border-bottom mt-2 pb-3 mb-3"></span>
                <p class="m-0 text-secondary text-center">Don't have an account? Sign up
                  <a style="color: #6643b5;" class="text-decoration-none" href="/se265-capstone/signup"><b>here</b></a>
                </p>
              </div>
            </div>
            <div id="errorContainer">
              <?php if (isset($errorMsg)): ?>
                <p class="text-danger"><?=$errorMsg ?></p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
  $(document).ready(function() {
    $('#showPassword').change(function() {
      if ($(this).is(':checked')) {
        $('#password, #confirmPassword').attr('type', 'text');
      } else {
        $('#password, #confirmPassword').attr('type', 'password');
      }
    });
  });
</script>
<?php include PARTIAL_PATH . 'footer.php'; ?>
