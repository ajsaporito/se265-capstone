<?php
$title = 'Change Password';
include PARTIAL_PATH . 'header.php';
include PARTIAL_PATH . 'navbar.php';
?>
<main id="contentContainer" class="flex-grow-1 mx-2 p-2">
  <div id="cards" class="py-5 mx-4">
    <div class="form-floating mb-3">
      <input type="password" class="form-control shadow-none main-form-input" name="currentPassword" id="currentPassword" placeholder="currentPassword" autocomplete="">
      <label for="currentPassword" class="form-label text-muted">Current Password</label>
      <span style="font-size: 14px;" id="currentPasswordError" class="text-danger position-absolute m-1 oxygen-light"></span>
    </div>
    <div class="form-floating mb-3">
      <input type="password" class="form-control shadow-none main-form-input" name="newPassword" id="newPassword" placeholder="New Password" autocomplete="">
      <label for="newPassword" class="form-label text-muted">New Password</label>
      <span style="font-size: 14px;" id="newPasswordError" class="text-danger position-absolute m-1 oxygen-light"></span>
    </div>
    <div class="form-floating mb-2">
      <input type="password" class="form-control shadow-none main-form-input" name="confirmNewPassword" id="confirmNewPassword" placeholder="Confirm Password" autocomplete="">
      <label for="confirmNewpassword" class="form-label text-muted">Confirm New Password</label>
      <span style="font-size: 14px;" id="confirmNewPasswordError" class="text-danger position-absolute m-1 oxygen-light"></span>
    </div>
    <div class="col-12 oxygen-light">
      <div class="form-check my-2">
        <input class="shadow-none" type="checkbox" name="showPassword" id="showPassword">
        <label class="form-check-label text-secondary" for="showPassword">
          Show Password
        </label>
      </div>
    </div>
  </div>
</main>
<?php include PARTIAL_PATH . 'footer.php'; ?>
