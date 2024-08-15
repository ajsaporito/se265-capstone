<?php
$title = 'Dashboard';
include PARTIAL_PATH . 'header.php';
include PARTIAL_PATH . 'navbar.php';
?>
<main id="contentContainer" class="flex-grow-1">
  <div class="container py-5">
    <div class="container">
      <div class="row">
        <h1>Dashboard</h1>
        <a href="/se265-capstone/add-job">Add Job</a>
        <div class="col-lg-6 col-md-6 col-sm-12 d-flex align-items-stretch">
          <div class="card w-100">
            <div class="card-body">
              <h4 class="card-title">Lastname, Firstname</h4>
              <h6>Email@email.com</h6>
              <hr>
              <h5>Bio</h5>
              <p class="card-text">Lorem ipsum odor amet, consectetuer adipiscing elit. Consectetur donec class ligula nec sollicitudin ligula id dis. Et fusce hac fringilla tristique tellus proin facilisi.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 d-flex align-items-stretch">
          <div class="card w-100">
            <div class="card-body">
              <h5 class="card-title">Job Feedback</h5>
                  <!-- Dynamically insert reviews here -->
                  <?php if (!empty($reviews) && is_array($reviews)): ?>
                    <?php foreach ($reviews as $review): ?>
                      <div class="card mt-3">
                        <div class="card-body">
                          <h6 class="card-subtitle mb-2 text-muted">
                            Reviewed by: <?php echo htmlspecialchars($review['reviewer_id']); ?>
                          </h6>
                          <p class="card-text">
                            <strong>Communication:</strong> <?php echo htmlspecialchars($review['communication']); ?>/5<br>
                            <strong>Time Management:</strong> <?php echo htmlspecialchars($review['time_management']); ?>/5<br>
                            <strong>Quality:</strong> <?php echo htmlspecialchars($review['quality']); ?>/5<br>
                            <strong>Professionalism:</strong> <?php echo htmlspecialchars($review['professionalism']); ?>/5<br>
                          </p>
                          <p class="card-text"><?php echo htmlspecialchars($review['comments']); ?></p>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <p class="alert alert-warning"><?php echo $resultMessage?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-12 d-flex align-items-stretch">
        <div class="card w-100">
          <div class="card-body">
            <h5 class="card-title">Completed</h5>
            <?php if (!empty($reviews) && is_array($reviews)): ?>
              <?php foreach ($reviews as $review): ?>
                <div class="card mb-4">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($review['game_title']); ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">Rating: <?php echo htmlspecialchars($review['rating']); ?>/5</h6>
                    <p class="card-text"><?php echo htmlspecialchars($review['review_text']); ?></p>
                    <p class="card-text"><small class="text-muted">Posted on <?php echo htmlspecialchars($review['date_posted']); ?></small></p>
                    <a href="edit_review.php?review_id=<?php echo $review['review_id']; ?>" class="btn btn-warning">edit</a>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p class="alert alert-warning">You have not completed any jobs yet.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-12 d-flex align-items-stretch">
        <div class="card w-100">
          <div class="card-body">
            <h5 class="card-title">In Progress</h5>
            <?php if (!empty($reviews) && is_array($reviews)): ?>
              <?php foreach ($reviews as $review): ?>
                <div class="card mb-4">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($review['game_title']); ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">Rating: <?php echo htmlspecialchars($review['rating']); ?>/5</h6>
                    <p class="card-text"><?php echo htmlspecialchars($review['review_text']); ?></p>
                    <p class="card-text"><small class="text-muted">Posted on <?php echo htmlspecialchars($review['date_posted']); ?></small></p>
                    <a href="edit_review.php?review_id=<?php echo $review['review_id']; ?>" class="btn btn-warning">edit</a>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p class="alert alert-warning">No Jobs currently in progress.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-12 d-flex align-items-stretch">
        <div class="card w-100">
          <div class="card-body">
            <h5 class="card-title">Open</h5>
              <?php if (!empty($reviews) && is_array($reviews)): ?>
                <?php foreach ($reviews as $review): ?>
                  <div class="card mb-4">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo htmlspecialchars($review['game_title']); ?></h5>
                      <h6 class="card-subtitle mb-2 text-muted">Rating: <?php echo htmlspecialchars($review['rating']); ?>/5</h6>
                      <p class="card-text"><?php echo htmlspecialchars($review['review_text']); ?></p>
                      <p class="card-text"><small class="text-muted">Posted on <?php echo htmlspecialchars($review['date_posted']); ?></small></p>
                      <a href="edit_review.php?review_id=<?php echo $review['review_id']; ?>" class="btn btn-warning">edit</a>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <p class="alert alert-warning">You have no open jobs.</p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
</main>
<?php include PARTIAL_PATH . 'footer.php'; ?>
