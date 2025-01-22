<?php
$title = 'Admin Dashboard';
include PARTIAL_PATH . 'header.php';
include PARTIAL_PATH . 'navbar.php';
?>
<main id="contentContainer" class="flex-grow-1">
  <div class="container py-5 oxygen-regular">
    <div class="card rounded-4 p-2">
      <div class="card-body mx-2">
        <h1 class="oxygen-bold">Admin Dashboard</h1>
        <div class="oxygen-light d-flex flex-column">
          <a href="/se265-capstone/admin-jobs" style="color: #6643b5;">View All Jobs</a>
          <a href="/se265-capstone/admin-users" style="color: #6643b5;">View All Users</a>
        </div>
      </div>
    </div>
  </div>
</main>
<?php include PARTIAL_PATH . 'footer.php'; ?>
