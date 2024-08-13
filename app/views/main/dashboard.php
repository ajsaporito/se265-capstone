<?php
$title = 'Home';
include PARTIAL_PATH . 'header.php';
include PARTIAL_PATH . 'navbar.php';
include MODEL_PATH . 'reviews.php';

$errors = [];
$resultMessage = '';

// Initializing variables
$review_id = 0;
$action = '';
$comments = '';
$communication = '';
$time_management = '';
$quality = '';
$professionalism = '';
$reviewer_name = '';
$contractor_name = '';

if (isset($_GET['review_id'])) {
    $review_id = filter_input(INPUT_GET, 'review_id', FILTER_VALIDATE_INT);

    // Debugging: Print the review_id
    echo '<pre>Review ID: ' . $review_id . '</pre>';

    if ($review_id) {
        // Fetch the review using the updated GetReviewById function
        $review = GetReviewById($review_id);

        // Debugging: Print the review data
        echo '<pre>';
        print_r($review);
        echo '</pre>';

        if ($review) {
            $comments = $review['comments'] ?? '';
            $communication = $review['communication'] ?? '';
            $time_management = $review['time_management'] ?? '';
            $quality = $review['quality'] ?? '';
            $professionalism = $review['professionalism'] ?? '';
            $reviewer_name = $review['reviewer_name'] ?? '';
            $contractor_name = $review['contractor_name'] ?? '';
        } else {
            $resultMessage = "No review found with that ID.";
        }
    }
}


?>
<main id="contentContainer" class="flex-grow-1">
  <div class="container py-5">
    <h1>Dashboard</h1>
  </div>
  <?php 
    // Debugging: Print the review
    echo '<pre>' . $review . '</pre>';
  ?>

  <div class="container">
      <div class="row">
          <!-- Bio Card -->
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

          <!-- Job Feedback Card with Nested Reviews -->
      <div class="col-lg-6 col-md-6 col-sm-12 d-flex align-items-stretch">
          <div class="card w-100">
              <div class="card-body">
                  <h5 class="card-title">Job Feedback</h5>
                  
                  <!-- Check if reviews exist -->
                  <?php if (!empty($reviews) && is_array($reviews)): ?>
                      <?php foreach ($reviews as $review): ?>
                          <div class="card mb-4">
                              <div class="card-body">
                                  <h5 class="card-title"><?php echo htmlspecialchars($review['reviewer_name']); ?>'s Review</h5>
                                  <h6 class="card-subtitle mb-2 text-muted">Communication: <?php echo htmlspecialchars($review['communication']); ?>/5</h6>
                                  <h6 class="card-subtitle mb-2 text-muted">Time Management: <?php echo htmlspecialchars($review['time_management']); ?>/5</h6>
                                  <h6 class="card-subtitle mb-2 text-muted">Quality: <?php echo htmlspecialchars($review['quality']); ?>/5</h6>
                                  <h6 class="card-subtitle mb-2 text-muted">Professionalism: <?php echo htmlspecialchars($review['professionalism']); ?>/5</h6>
                                  <p class="card-text"><?php echo htmlspecialchars($review['comments']); ?></p>
                                  <p class="card-text"><small class="text-muted">Job ID: <?php echo htmlspecialchars($review['job_id']); ?></small></p>
                                  <a href="edit_review.php?review_id=<?php echo $review['review_id']; ?>" class="btn btn-warning">Edit</a>
                              </div>
                          </div>
                      <?php endforeach; ?>
                  <?php else: ?>
                      <p class="alert alert-warning">No reviews available for this job.</p>
                  <?php endif; ?>
              </div>
          </div>
      </div>

      </div>
  </div>


   <!-- Jobs Completed -->
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

<!-- Jobs In Progress -->
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

<!-- Jobs Open -->
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










  <!-- Table -->

  <div class="container mt-5">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">title</th>
          <th scope="col">Last</th>
          <th scope="col">Handle</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Mark</td>
          <td>Walburg</td>
          <td>Markymark@email.com</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>James</td>
          <td>Hetfield</td>
          <td>JH@email.com</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>Larry</td>
          <td>the Bird</td>
          <td>LarBird@email.com</td>
        </tr>
      </tbody>
    </table>
  </div>

</main>
<?php include PARTIAL_PATH . 'footer.php'; ?>
