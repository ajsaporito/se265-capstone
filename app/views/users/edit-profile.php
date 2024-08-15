<?php
$title = 'Edit Profile';
include PARTIAL_PATH . 'header.php';
include PARTIAL_PATH . 'navbar.php';
?>
<main id="contentContainer" class="flex-grow-1">
  <div class="container py-5 oxygen-regular">
      <h1 style="margin-bottom: 2rem;" class="oxygen-bold">Account Settings</h1>
      <div class="card">
        <div class="card-body">
          <tr>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </div>
        <tbody>
          <tr>
            <td>
              <input value="<?= htmlspecialchars($user['first_name']) ?>">
            </td>
            <td>
              <input value="<?= htmlspecialchars($user['last_name']) ?>">
            </td>
          </tr>
          <tr>
            <td>
              <input value="<?= htmlspecialchars($user['username']) ?>">
            </td>
            <td>
              <input value="<?= htmlspecialchars($user['email']) ?>">
            </td>
          </tr>
          <tr>
            <td>
              <input value="" placeholder="********">
            </td>
          </tr>
        </tbody>
      </div>
    <a href="/se265-capstone/delete-profile?id=<?= $id; ?>" class="btn btn-danger">Delete Profile</a>
  </div>
</main>
<?php include PARTIAL_PATH . 'footer.php'; ?>
