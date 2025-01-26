<?php
$title = 'Admin Dashboard';
include PARTIAL_PATH . 'header.php';
include PARTIAL_PATH . 'navbar.php';
?>
<main id="contentContainer" class="flex-grow-1">
  <div class="container py-5 oxygen-regular">
    <h1 class="oxygen-bold mb-4">All Registered Users</h1>
    <?php if (!empty($users)): ?>
      <div class="card-columns">
        <?php foreach ($users as $user): ?>
          <input type="hidden" name="userId" value="<?= $user['user_id']; ?>">
          <div class="card mb-3 user-card">
            <a href="/se265-capstone/user-profile?id=<?= $user['user_id']; ?>" class="stretched-link" ></a>
            <div class="card-body">
              <h5 class="card-title oxygen-bold"><?= htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name']); ?></h5>
              <p class="card-text"><strong>Username:</strong> <?= htmlspecialchars($user['username']); ?></p>
              <p class="card-text"><strong>Email:</strong> <?= htmlspecialchars($user['email']); ?></p>
            </div>
          </div>
          <form method="post">
            <input type="hidden" name="user_id" value="<?= $user['user_id']; ?>">
            <button type="submit" name="deleteBtn" class="btn btn-danger mb-3">Delete</button>
          </form>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="alert alert-warning" role="alert">No users found.</div>
    <?php endif; ?>
  </div>
</main>
<?php include PARTIAL_PATH . 'footer.php'; ?>
