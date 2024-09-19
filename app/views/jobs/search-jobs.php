<?php
$title = 'Find Jobs';
include PARTIAL_PATH . 'header.php';
include PARTIAL_PATH . 'navbar.php';
?>
<main id="contentContainer" class="flex-grow-1">
  <div class="container py-5 oxygen-regular">
    <h3 class="oxygen-bold mb-4">Your search: '<?php echo $search ?>'</h3>
    <?php if (!empty($jobs)): ?>
      <div class="card-columns">
        <?php foreach ($jobs as $job): ?>
          <input type="hidden" name="userId" value="<?= $job['job_id']; ?>">
          <div class="card mb-3 job-card">
            <a href="/se265-capstone/job-info?id=<?= $job['job_id']; ?>" class="stretched-link" ></a>
            <div class="card-body">
              <h5 class="card-title oxygen-bold"><?= htmlspecialchars($job['title']); ?></h5>
              <p><strong>Date Posted:</strong> <?= date('F j, Y', strtotime($job['date_posted'])); ?></p> <!-- Format as "Month day, Year" -->
              <p class="card-text"><strong>Type:</strong> <?= htmlspecialchars($job['job_type']); ?></p>
              <p class="card-text"><strong>Description:</strong> <?= htmlspecialchars($job['description']); ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="alert alert-warning" role="alert">No jobs found.</div>
    <?php endif; ?>
  </div>
</main>
<?php include PARTIAL_PATH . 'footer.php'; ?>
