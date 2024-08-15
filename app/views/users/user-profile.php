<?php
$title = htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name']) . "'s Profile";
include PARTIAL_PATH . 'header.php';
include PARTIAL_PATH . 'navbar.php';
?>
<main id="contentContainer" class="flex-grow-1">
  <div class="container py-5">
    <div class="row">
      <!-- Profile Information Card -->
      <div class="col-md-4">
        <div class="card mb-3">
          <div class="card-body text-center">
            <h5 class="card-title"><?= htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name']); ?></h5>
            <p class="card-text"><?= htmlspecialchars($user['email']); ?></p>
            <hr>
            <h6>My Ratings</h6>
            <ul class="list-unstyled">
              <li>Communication: ★★★★☆</li>
              <li>Time Management: ★★★★☆</li>
              <li>Quality: ★★★★★</li>
              <li>Professionalism: ★★★★★</li>
            </ul>
          </div>
        </div>
      </div>
      <!-- Jobs Completed Card -->
      <div class="col-md-8">
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Jobs Completed</h5>
            <hr>
            <!-- Repeat this block for each job -->
            <div class="jobs-completed mb-4">
              <h6>Business Website</h6>
              <small>Date completed: 01-Jan-2023</small>
              <p class="mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam fermentum dolor purus...</p>
              <ul class="list-unstyled">
                <li>Communication: ★★★★☆</li>
                <li>Time Management: ★★★★☆</li>
                <li>Quality: ★★★★★</li>
                <li>Professionalism: ★★★★★</li>
              </ul>
            </div>
            <!-- End job block -->
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php include PARTIAL_PATH . 'footer.php'; ?>
