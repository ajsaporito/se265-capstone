<?php
$title = 'Public Profile';
include PARTIAL_PATH . 'header.php';
include PARTIAL_PATH . 'navbar.php';
?>
<main id="contentContainer" class="flex-grow-1">
  <div class="container py-5 oxygen-regular">
    <div class="row">
      <!-- Profile Information Card -->
      <div class="col-12">
        <div class="card mb-3">
          <div class="card-body text-center">
            <h5 class="card-title oxygen-bold"><?= htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name']); ?></h5>
            <p class="card-text oygen-regular">
              <a id="mail-to-link" href="mailto:<?= htmlspecialchars($user['email']); ?>">
                <?= htmlspecialchars($user['email']); ?>
              </a>
            </p>
            <hr>
            <!-- Display Average Ratings -->
            <h6 class="oxygen-bold">My Ratings</h6>
            <?php if (!empty($averageRatings)): ?>
              <div class="row justify-content-center">
                <div class="col-3">
                  <h6 class="mb-1">Communication</h6>
                  <p class="rating-value"><?= renderStars(round($averageRatings['avg_communication'])); ?> <?= number_format($averageRatings['avg_communication'], 1); ?> / 5</p>
                </div>
                <div class="col-3">
                  <h6 class="mb-1">Time Management</h6>
                  <p class="rating-value"><?= renderStars(round($averageRatings['avg_time_management'])); ?> <?= number_format($averageRatings['avg_time_management'], 1); ?> / 5</p>
                </div>
                <div class="col-3">
                  <h6 class="mb-1">Quality</h6>
                  <p class="rating-value"><?= renderStars(round($averageRatings['avg_quality'])); ?> <?= number_format($averageRatings['avg_quality'], 1); ?> / 5</p>
                </div>
                <div class="col-3">
                  <h6 class="mb-1">Professionalism</h6>
                  <p class="rating-value"><?= renderStars(round($averageRatings['avg_professionalism'])); ?> <?= number_format($averageRatings['avg_professionalism'], 1); ?> / 5</p>
                </div>
              </div>
            <?php else: ?>
              <p>No ratings available.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <!-- Jobs Completed Card -->
      <div class="col-12">
        <div class="card mt-4">
          <div class="card-body">
            <h5 class="card-title oxygen-bold">Jobs Completed</h5>
            <hr>
            <div class="job-feedback mb-4">
              <?php if (!empty($completedJobs)): ?>
                <?php foreach ($completedJobs as $job): ?>
                  <div class="card mt-4" style="padding: 35px; margin:35px;">
                    <h6 class="oxygen-bold"><?= htmlspecialchars($job['title']); ?></h6>
                    <small>Date completed: <?= htmlspecialchars($job['estimated_completion_date']); ?></small>
                    <p class="mt-2"><?= htmlspecialchars($job['description']); ?></p>
                    <hr>
                    <!-- Display Reviews for the Job -->
                    <?php if (!empty($job['reviews'])): ?>
                      <h6 class="oxygen-bold">Reviews</h6>
                      <ul class="list-unstyled">
                        <?php foreach ($job['reviews'] as $review): ?>
                          <strong>Communication:</strong> 
                          <?= isset($review['communication']) ? renderStars($review['communication']) : 'N/A'; ?>
                          <br>
                          <strong>Time Management:</strong> 
                          <?= isset($review['time_management']) ? renderStars($review['time_management']) : 'N/A'; ?>
                          <br>
                          <strong>Quality:</strong> 
                          <?= isset($review['quality']) ? renderStars($review['quality']) : 'N/A'; ?>
                          <br>
                          <strong>Professionalism:</strong> 
                          <?= isset($review['professionalism']) ? renderStars($review['professionalism']) : 'N/A'; ?>
                          <br>
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
  </div>
</main>
<?php include PARTIAL_PATH . 'footer.php'; ?>
