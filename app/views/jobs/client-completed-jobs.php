<?php
$title = htmlspecialchars($job['title']) . ' - Completed Jobs';
include PARTIAL_PATH . 'header.php';
include PARTIAL_PATH . 'navbar.php';
?>
<main id="contentContainer" class="flex-grow-1">
  <div class="container py-5 oxygen-regular">
    <h1 class="oxygen-bold">Completed Jobs</h1>
    <div class="card">
        <div class="card-body">
          <!-- Job Title and Pay -->
          <div class="row">
            <div class="col-md-8">
              <h2 class="card-title"><?= htmlspecialchars($job['title']); ?></h2>
              <p><strong>Location:</strong> <?= htmlspecialchars($job['location']); ?></p>
              <p><strong>Pay:</strong> <?= htmlspecialchars($pay); ?></p>
            </div>
            <div class="col-md-4 text-md-right">
              <p><strong>Date Posted:</strong> <?= date('F j, Y', strtotime($job['date_posted'])); ?></p> <!-- Format as "Month day, Year" -->
              <p><strong>Project Deadline:</strong> <?= date('F j, Y', strtotime($job['estimated_completion_date'])); ?></p> <!-- Format as "Month day, Year" -->
            </div>
          </div>
          <!-- Job Description -->
          <hr>
          <div class="row">
            <div class="col-12">
              <h5>Job Description:</h5>
              <p><?= nl2br(htmlspecialchars($job['description'])); ?></p>
            </div>
          </div>
          <!-- Skills/Expertise Required -->
          <hr>
          <div class="row">
            <div class="col-12">
              <h5>Skills/Expertise Required:</h5>
              <ul>
                <?php foreach ($job['skills'] as $skill): ?>
                  <li><?= htmlspecialchars($skill['skill_name']); ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="card-footer text-right">
          <div class="row">
            <h5>Completed By:</h5>
          </div>
          <ul>
            <li><?= htmlspecialchars($contractor['first_name']) . ' ' . htmlspecialchars($contractor['last_name']); ?></li>
            <li>Email: <?= htmlspecialchars($contractor['email']); ?></li>
          </ul>
        </div>
    </div>
  </div>
</main>
<?php include PARTIAL_PATH . 'footer.php'; ?>
