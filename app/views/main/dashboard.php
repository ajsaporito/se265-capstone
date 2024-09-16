<?php
$title = 'Dashboard';
include PARTIAL_PATH . 'header.php';
include PARTIAL_PATH . 'navbar.php';
?>
<main id="contentContainer" class="flex-grow-1">
    <div class="container py-5">
        <h1 class="oxygen-bold">My Dashboard</h1>
        
        <!-- User Information and Bio Section -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card  oxygen-regular">
                    <div class="card-body" id="bio-card-body">
                        <h4 class="user-name oxygen-bold"><?= htmlspecialchars($userDetails['first_name']) . ', ' . htmlspecialchars($userDetails['last_name']); ?></h4>
                        <h6 class="user-email oxygen-bold"><?= htmlspecialchars($userDetails['email']); ?></h6>
                        <hr class="section-divider">
                        <h6 class="oxygen-bold">My Ratings</h6>
                        <?php if (!$averageRatings === null): ?>
                        <ul class="list-unstyled ratings-list oxygen-regular">
                            <li>Communication: <?= number_format($averageRatings['avg_communication'], 1); ?> / 5</li>
                            <li>Time Management: <?= number_format($averageRatings['avg_time_management'], 1); ?> / 5</li>
                            <li>Quality: <?= number_format($averageRatings['avg_quality'], 1); ?> / 5</li>
                            <li>Professionalism: <?= number_format($averageRatings['avg_professionalism'], 1); ?> / 5</li>
                        </ul>
                        <?php else: ?>
                        <p>No ratings available.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4" id="feedback-section">
            <div class="col-12">
                <div class="card oxygen-regular">
                    <div class="card-body">
                        <h5 class="card-title oxygen-bold">Job Feedback</h5>
                        <div class="job-list">
                            <?php if (!empty($reviews) && is_array($reviews)): ?>
                                <?php foreach ($reviews as $review): ?>
                                    <div class="card mt-3 job-card">
                                        <div class="card-body">
                                            <h6 class="card-subtitle mb-2 text-muted">Reviewed by: <?= htmlspecialchars($review['first_name'] . ' ' . $review['last_name']); ?></h6>
                                            <p class="card-text">
                                                <strong>Communication:</strong> 
                                                <?= isset($review['communication']) && $review['communication'] !== null ? number_format($review['communication'], 1) : 'N/A'; ?> / 5
                                                <br>

                                                <strong>Time Management:</strong> 
                                                <?= isset($review['time_management']) && $review['time_management'] !== null ? number_format($review['time_management'], 1) : 'N/A'; ?> / 5
                                                <br>

                                                <strong>Quality:</strong> 
                                                <?= isset($review['quality']) && $review['quality'] !== null ? number_format($review['quality'], 1) : 'N/A'; ?> / 5
                                                <br>

                                                <strong>Professionalism:</strong> 
                                                <?= isset($review['professionalism']) && $review['professionalism'] !== null ? number_format($review['professionalism'], 1) : 'N/A'; ?> / 5
                                                <br>

                                                <?= htmlspecialchars($review['comments']); ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <button id="toggle-feedback" class="btn btn-primary mt-3">Show More</button>
                            <?php else: ?>
                                <p class="alert alert-warning">No feedback available.</p>
                            <?php endif; ?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        
        <!-- Button to Add Job -->
        <div class="row">
            <div class="col-12">
                <a href="/se265-capstone/add-job" id="add-job-btn" style="background-color: #6643b5;" class="btn text-white" onmouseover="this.style.background='#714bc9'" onmouseout="this.style.background='#6643b5'">Add Job</a>
            </div>
        </div>

       <!-- Completed Jobs Section -->
        <div class="row mt-4" id="completed-jobs-section">
            <div class="col-12">
                <div class="card oxygen-regular">
                    <div class="card-body">
                        <h5 class="card-title oxygen-bold">Completed Jobs</h5>
                        <div class="job-list">
                            <?php if (!empty($completedJobs)): ?>
                                <?php foreach ($completedJobs as $job): ?>
                                    <div class="card mb-4 job-card">
                                        <div class="card-body">
                                            <h5 class="card-title oxygen-bold"><?= htmlspecialchars($job['title']); ?></h5>
                                            <h6 class="mt-3 oxygen-bold">Job Description:</h6>
                                            <p class="card-text"><?= htmlspecialchars($job['description']); ?></p>
                                            <small class="text-muted">Posted on <?= htmlspecialchars($job['date_posted']); ?></small>
                                            <a href="/se265-capstone/client-completed-jobs?job_id=<?= htmlspecialchars($job['job_id']); ?>" class="stretched-link"></a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <button id="toggle-feedback" class="btn btn-primary mt-3">Show More</button>
                            <?php else: ?>
                                <p class="alert alert-warning">You have not completed any jobs yet.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

     <!-- In-Progress Jobs Section -->
        <div class="row mt-4" id="in-progress-jobs-section">
            <div class="col-12">
                <div class="card oxygen-regular">
                    <div class="card-body">
                        <h5 class="card-title oxygen-bold">Jobs In Progress</h5>
                        <div class="job-list">
                            <?php if (!empty($inProgressJobs)): ?>
                                <?php foreach ($inProgressJobs as $job): ?>
                                    <div class="card mb-4 job-card">
                                        <div class="card-body d-flex justify-content-between">
                                            <div>
                                                <h5 class="card-title oxygen-bold"><?= htmlspecialchars($job['title']); ?></h5>
                                                <h6 class="mt-3 oxygen-bold">Job Description:</h6>
                                                <p class="card-text"><?= htmlspecialchars($job['description']); ?></p>
                                                <p><strong>Assigned to:</strong> <?= htmlspecialchars($job['first_name'] . ' ' . $job['last_name']); ?></p>
                                                <small class="text-muted">Posted on <?= htmlspecialchars($job['date_posted']); ?></small>
                                            </div>
                                            <!-- Button aligned to the bottom-right -->
                                            <div class="ml-auto">
                                                <button id="marked-completed-button" class="btn btn-success mark-completed-btn" data-job-id="<?= htmlspecialchars($job['job_id']); ?>">Mark as Completed</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <button id="toggle-in-progress-jobs" class="btn btn-primary mt-3">Show More</button>
                            <?php else: ?>
                                <p class="alert alert-warning">No jobs currently in progress.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Open Jobs Section -->
        <div class="row mt-4" id="open-jobs-section">
            <div class="col-12">
                <div class="card oxygen-regular">
                    <div class="card-body">
                        <h5 class="card-title oxygen-bold">Open Jobs</h5>
                        <div class="job-list">
                            <?php if (!empty($openJobs)): ?>
                                <?php foreach ($openJobs as $job): ?>
                                    <div class="card mb-4 job-card">
                                        <div class="card-body d-flex justify-content-between">
                                            <div>
                                                <h5 class="card-title oxygen-bold"><?= htmlspecialchars($job['title']); ?></h5>
                                                <h6 class="mt-3 oxygen-bold">Job Description:</h6>
                                                <p class="card-text"><?= htmlspecialchars($job['description']); ?></p>
                                                <small class="text-muted">Posted on <?= htmlspecialchars($job['date_posted']); ?></small>
                                            </div>
                                        </div>
                                        <a href="/se265-capstone/client-open-jobs?job_id=<?= htmlspecialchars($job['job_id']); ?>" class="stretched-link"></a>
                                    </div>
                                <?php endforeach; ?>
                            <button id="toggle-open-jobs" class="btn btn-primary mt-3">Show More</button>
                            <?php else: ?>
                                <p class="alert alert-warning">You have no open jobs.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<?php include PARTIAL_PATH . 'footer.php'; ?>

<!-- Custom JavaScript for Dashboard Page -->

<!-- Mark Job as Completed Button Logic -->
<script>
    $(document).on('click', '.mark-completed-btn', function () {
        var jobId = $(this).data('job-id'); // Get the job ID from the button's data attribute
        
        $.ajax({
            type: 'POST',
            url: '/se265-capstone/mark-job-complete', // The route that will handle the completion
            data: { job_id: jobId },
            success: function (response) {
                try {
                    // Parse the response if it's not an object already
                    if (typeof response !== 'object') {
                        response = JSON.parse(response);
                    }
                    console.log(response); // Debug to see the response
                    if (response.status === 'success') {
                        alert('Job marked as completed successfully!');
                        location.reload(); // Reload the page or update the UI as needed
                    } else {
                        alert('There was an error marking the job as completed: ' + response.message);
                    }
                } catch (e) {
                    console.error('Error parsing response: ', e);
                    alert('There was an error processing the response.');
                }
            },
            error: function (xhr, status, error) {
                console.error('XHR Error:', xhr, status, error);
                alert('An error occurred while processing the request.');
            }
        });
    });
</script>

<!-- Toggle Logic for Job Sections -->
<script>
    $(document).ready(function () {
        // Toggle logic for Completed Jobs
        $("#completed-jobs-section .job-card:nth-child(n+4)").hide(); // Hide all but the first 3 jobs
        $("#toggle-completed-jobs").click(function () {
            let jobSection = $("#completed-jobs-section .job-list");
            let btnText = $(this);
            
            if (jobSection.find(".job-card:hidden").length > 0) {
                jobSection.find(".job-card").slideDown();
                btnText.text("Show Less");
            } else {
                jobSection.find(".job-card:nth-child(n+4)").slideUp();
                btnText.text("Show More");
            }
        });

        // Toggle logic for Open Jobs
        $("#open-jobs-section .job-card:nth-child(n+4)").hide(); // Hide all but the first 3 jobs
        $("#toggle-open-jobs").click(function () {
            let jobSection = $("#open-jobs-section .job-list");
            let btnText = $(this);
            
            if (jobSection.find(".job-card:hidden").length > 0) {
                jobSection.find(".job-card").slideDown();
                btnText.text("Show Less");
            } else {
                jobSection.find(".job-card:nth-child(n+4)").slideUp();
                btnText.text("Show More");
            }
        });

        // Toggle logic for In-Progress Jobs
        $("#in-progress-jobs-section .job-card:nth-child(n+4)").hide(); // Hide all but the first 3 jobs
        $("#toggle-in-progress-jobs").click(function () {
            let jobSection = $("#in-progress-jobs-section .job-list");
            let btnText = $(this);
            
            if (jobSection.find(".job-card:hidden").length > 0) {
                jobSection.find(".job-card").slideDown();
                btnText.text("Show Less");
            } else {
                jobSection.find(".job-card:nth-child(n+4)").slideUp();
                btnText.text("Show More");
            }
        });

        // Toggle logic for Job Feedback
        $("#feedback-section .job-card:nth-child(n+4)").hide(); // Hide all but the first 3 feedback items
        $("#toggle-feedback").click(function () {
            let feedbackSection = $("#feedback-section .job-list");
            let btnText = $(this);
            
            if (feedbackSection.find(".job-card:hidden").length > 0) {
                feedbackSection.find(".job-card").slideDown();
                btnText.text("Show Less");
            } else {
                feedbackSection.find(".job-card:nth-child(n+4)").slideUp();
                btnText.text("Show More");
            }
        });
    });
</script>

<!-- Delete Job Button Logic -->
<script>
$(document).on('click', '.delete-job-btn', function (e) {
    e.stopPropagation(); // Stop the click event from bubbling up to the card's stretched link
    var jobId = $(this).data('job-id'); // Get the job ID from the button's data attribute
    
    if (confirm("Are you sure you want to delete this job?")) {
        $.ajax({
            type: 'POST',
            url: '/se265-capstone/delete-job', // The route that handles the deletion
            data: { job_id: jobId },
            success: function (response) {
                try {
                    if (typeof response !== 'object') {
                        response = JSON.parse(response);
                    }
                    if (response.status === 'success') {
                        alert('Job deleted successfully!');
                        location.reload(); // Reload the page or update the UI as needed
                    } else {
                        alert('There was an error deleting the job: ' + response.message);
                    }
                } catch (e) {
                    console.error('Error parsing response: ', e);
                    alert('There was an error processing the response.');
                }
            },
            error: function (xhr, status, error) {
                console.error('XHR Error:', xhr, status, error);
                alert('An error occurred while processing the request.');
            }
        });
    }
});

</script>