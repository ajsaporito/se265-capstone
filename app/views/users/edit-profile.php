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
                  <h1 class="oxygen-bold pb-1">Account Settings</h1>
                  <h3 class="fs-6 fw-normal text-secondary m-0">Update your credentials</h3>
                </div>
              </div>
            </div>
            <form id="editProfileForm" method="post">
              <input type="hidden" name="id" id="id" value="<?= $id; ?>">
              <div class="row gy-3 overflow-hidden">
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control shadow-none main-form-input" name="firstName" id="firstName" placeholder="First Name" value="<?= htmlspecialchars($user['first_name']) ?>" autocomplete="">
                    <label for="firstName" class="form-label text-muted">First Name</label>
                    <span style="font-size: 14px;" id="firstNameError" class="text-danger position-absolute m-1 oxygen-light"></span>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control shadow-none main-form-input" name="lastName" id="lastName" placeholder="Last Name" value="<?= htmlspecialchars($user['last_name']) ?>" autocomplete="">
                    <label for="lastName" class="form-label text-muted">Last Name</label>
                    <span style="font-size: 14px;" id="lastNameError" class="text-danger position-absolute m-1 oxygen-light"></span>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control shadow-none main-form-input" name="username" id="username" placeholder="Username" value="<?= htmlspecialchars($user['username']) ?>" autocomplete="">
                    <label for="username" class="form-label text-muted">Username</label>
                    <span style="font-size: 14px;" id="usernameError" class="text-danger position-absolute m-1 oxygen-light"></span>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control shadow-none main-form-input" name="email" id="email" placeholder="Email" value="<?= htmlspecialchars($user['email']) ?>" autocomplete="">
                    <label for="email" class="form-label text-muted">Email</label>
                    <span style="font-size: 14px;" id="emailError" class="text-danger position-absolute m-1 oxygen-light"></span>
                  </div>
                </div>
                <div class="d-flex">
                  <div class="col-6">
                    <a style="background-color: #838383;" href="/se265-capstone/change-password?id=<?= $id; ?>" class="btn rounded-4 text-white mb-4" onmouseover="this.style.background='#8f8f8f'" onmouseout="this.style.background='#838383'">Change Password</a>
                  </div>
                  <div class="col-6">
                    <a style="background-color: red;" href="/se265-capstone/delete-profile?id=<?= $id; ?>" class="btn rounded-4 text-white">Delete Account</a>
                  </div>
                </div>
                <div class="col-12">
                  <div class="row mx-1">
                    <button style="background-color: #6643b5;" class="btn rounded-4 text-white" type="submit" name="updateBtn" onmouseover="this.style.background='#714bc9'" onmouseout="this.style.background='#6643b5'">Update Info</button>
                  </div>
                </div>
                <div class="col-12">
                  <div class="row mx-1">
                    <span class="nav justify-content-center border-bottom mt-2 pb-3 mb-3"></span>
                    <a style="color: #6643b5;" class="text-decoration-none text-center" href="/se265-capstone">Go Back Home</a>
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
<script src="/se265-capstone/assets/js/edit-profile.js"></script>
<?php include PARTIAL_PATH . 'footer.php'; ?>
