<?php
$title = htmlspecialchars($job['title']) . ' - Job Details';
include PARTIAL_PATH . 'header.php';
include PARTIAL_PATH . 'navbar.php';
?>
<main id="contentContainer" class="flex-grow-1">
  <div class="container py-5 oxygen-regular">
    <div class="card">
      <div class="card-body">
        <!-- Job Title and Pay -->
        <div class="row">
          <div class="col-md-8">
            <h2 class="card-title oxygen-bold"><?= htmlspecialchars($job['title']); ?></h2>
            <p><strong>Location:</strong> <?= htmlspecialchars($job['location']); ?></p>
          </div>
          <div class="col-md-4 text-md-right">
            <p><strong>Pay:</strong> <?= htmlspecialchars($pay); ?></p>
            <p><strong>Date posted:</strong> <?= htmlspecialchars($job['date_posted']); ?></p>
            <p><strong>Project deadline:</strong> <?= htmlspecialchars($job['estimated_completion_date']); ?></p>
          </div>
        </div>

        <!-- Job Description -->
        <hr>
        <h5>Job description:</h5>
        <p><?= nl2br(htmlspecialchars($job['description'])); ?></p>

        <!-- Skills/Expertise Required -->
        <hr>
        <h5>Skills/Expertise Required:</h5>
        <ul>
          <?php foreach ($job['skills'] as $skill): ?>
            <li><?= htmlspecialchars($skill['skill_name']); ?></li>
          <?php endforeach; ?>
        </ul>

        <!-- Request Job Button -->
        <div class="text-right mt-4">
          <a href="/se265-capstone/request-job?id=<?= htmlspecialchars($job['job_id']); ?>" class="btn btn-secondary">Request Job</a>
        </div>
      </div>
    </div>
  </div>
</main>
<?php include PARTIAL_PATH . 'footer.php'; ?>

