<?php
$title = 'Edit Profile';
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
                  <h1 class="oxygen-bold pb-1">Change Your Password</h1>
                </div>
              </div>
            </div>
            <form id="changePasswordForm" method="post">
              <div class="row gy-3 overflow-hidden">
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control shadow-none main-form-input <?php echo $currentPasswordErrorClass?>" name="currentPassword" id="currentPassword" placeholder="Current Password" autocomplete="">
                    <label for="currentPassword" class="form-label text-muted">Current Password</label>
                    <?php if (!empty($currentPasswordError)) : ?>
                      <span style="font-size: 14px;" id="currentPasswordError" class="text-danger position-absolute m-1 oxygen-light"><?= $currentPasswordError ?></span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control shadow-none main-form-input <?php echo $newPasswordErrorClass?>" name="newPassword" id="newPassword" placeholder="New Password" autocomplete="">
                    <label for="newPassword" class="form-label text-muted">New Password</label>
                    <?php if (!empty($passwordError)) : ?>
                      <span style="font-size: 14px;" id="passwordError" class="text-danger position-absolute m-1 oxygen-light"><?= $passwordError ?></span>
                    <?php endif; ?>
                    <?php if (!empty($newPasswordError)) : ?>
                      <span style="font-size: 14px;" id="newPasswordError" class="text-danger position-absolute m-1 oxygen-light"><?= $newPasswordError ?></span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating mb-2">
                    <input type="password" class="form-control shadow-none main-form-input <?php echo $confirmPasswordErrorClass?>" name="confirmNewPassword" id="confirmNewPassword" placeholder="Confirm New Password" autocomplete="">
                    <label for="confirmNewPassword" class="form-label text-muted">Confirm New Password</label>
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
                    <button style="background-color: #6643b5;" class="btn rounded-4 text-white" type="submit" name="changePasswordBtn" onmouseover="this.style.background='#714bc9'" onmouseout="this.style.background='#6643b5'">Change Password</button>
                  </div>
                </div>
                <div class="col-12">
                  <div class="row mx-1">
                    <span class="nav justify-content-center border-bottom mt-2 pb-3 mb-3"></span>
                    <a style="color: #6643b5;" class="text-decoration-none text-center" href="/se265-capstone/edit-profile?id=<?= $id; ?>">Back to Profile</a>
                  </div>
                </div>
              </div>
            </form>
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
        $('#currentPassword, #newPassword, #confirmNewPassword').attr('type', 'text');
      } else {
        $('#currentPassword, #newPassword, #confirmNewPassword').attr('type', 'password');
      }
    });
  });
</script>
<?php include PARTIAL_PATH . 'footer.php'; ?>
