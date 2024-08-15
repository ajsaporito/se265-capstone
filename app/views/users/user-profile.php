<?php
$title = 'Public Profile';
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
            <img src="path/to/avatar.png" class="rounded-circle mb-3" alt="Profile Picture" width="80" height="80">
            <h5 class="card-title"><?= htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name']); ?></h5>
            <p class="card-text"><?= htmlspecialchars($user['email']); ?></p>
            <hr>
            <h6>Bio</h6>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam fermentum dolor purus.</p>
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
            <?php if (!empty($completedJobs)): ?>
              <?php foreach ($completedJobs as $job): ?>
                <div class="job-feedback mb-4">
                  <h6><?= htmlspecialchars($job['title']); ?></h6>
                  <small>Date completed: <?= htmlspecialchars($job['estimated_completion_date']); ?></small>
                  <p class="mt-2"><?= htmlspecialchars($job['description']); ?></p>
                  <hr>
                  <?php if (!empty($job['reviews'])): ?>
                    <h6>Reviews</h6>
                    <ul class="list-unstyled">
                      <?php foreach ($job['reviews'] as $review): ?>
                        <li>Communication: <?= str_repeat('★', $review['communication']) . str_repeat('☆', 5 - $review['communication']); ?></li>
                        <li>Time Management: <?= str_repeat('★', $review['time_management']) . str_repeat('☆', 5 - $review['time_management']); ?></li>
                        <li>Quality: <?= str_repeat('★', $review['quality']) . str_repeat('☆', 5 - $review['quality']); ?></li>
                        <li>Professionalism: <?= str_repeat('★', $review['professionalism']) . str_repeat('☆', 5 - $review['professionalism']); ?></li>
                        <li>Comments: <?= htmlspecialchars($review['comments']); ?></li>
                        <hr>
                      <?php endforeach; ?>
                    </ul>
                  <?php else: ?>
                    <p>No reviews for this job.</p>
                  <?php endif; ?>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p>No jobs completed by this user.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php include PARTIAL_PATH . 'footer.php'; ?>
