<?php
$title = 'Dashboard';
include PARTIAL_PATH . 'header.php';
include PARTIAL_PATH . 'navbar.php';
?>
<main id="contentContainer" class="flex-grow-1">
    <div class="container py-5">
        <h1>Dashboard</h1>
        
        <!-- User Information and Bio Section -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?= htmlspecialchars($userDetails['last_name']) . ', ' . htmlspecialchars($userDetails['first_name']); ?></h4>
                        <h6><?= htmlspecialchars($userDetails['email']); ?></h6>
                        <hr>
                        <h6>My Ratings</h6>
                        <?php if (!empty($averageRatings)): ?>
                        <ul class="list-unstyled">
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

        <!-- Job Feedback Section -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Job Feedback</h5>
                        <?php if (!empty($reviews) && is_array($reviews)): ?>
                            <?php foreach ($reviews as $review): ?>
                                <div class="card mt-3">
                                    <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted">Reviewed by: <?= htmlspecialchars($review['first_name'] . ' ' . $review['last_name']); ?></h6>
                                        <p class="card-text">
                                            <strong>Communication:</strong> <?= renderStars($review['communication']); ?><br>
                                            <strong>Time Management:</strong> <?= renderStars($review['time_management']); ?><br>
                                            <strong>Quality:</strong> <?= renderStars($review['quality']); ?><br>
                                            <strong>Professionalism:</strong> <?= renderStars($review['professionalism']); ?><br>
                                            <?= htmlspecialchars($review['comments']); ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="alert alert-warning">No feedback available.</p>
                        <?php endif; ?>
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
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Completed Jobs</h5>
                        <?php if (!empty($completedJobs)): ?>
                            <?php foreach ($completedJobs as $job): ?>
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($job['title']); ?></h5>
                                        <p class="card-text"><?= htmlspecialchars($job['description']); ?></p>
                                        <small class="text-muted">Posted on <?= htmlspecialchars($job['date_posted']); ?></small>
                                        <a href="/se265-capstone/client-completed-jobs?job_id=<?= htmlspecialchars($job['job_id']); ?>" class="stretched-link"></a>
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

        <!-- Jobs In Progress Section -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jobs In Progress</h5>
                        <?php if (!empty($inProgressJobs)): ?>
                            <?php foreach ($inProgressJobs as $job): ?>
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($job['title']); ?></h5>
                                        <p class="card-text"><?= htmlspecialchars($job['description']); ?></p>
                                        <p><strong>Assigned to:</strong> <?= htmlspecialchars($job['first_name'] . ' ' . $job['last_name']); ?></p>
                                        <small class="text-muted">Posted on <?= htmlspecialchars($job['date_posted']); ?></small>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="alert alert-warning">No jobs currently in progress.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Open Jobs Section -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div the="card-body" style="margin: 8px; padding: 10px;" >
                        <h5 class="card-title">Open Jobs</h5>
                        <?php if (!empty($openJobs)): ?>
                            <?php foreach ($openJobs as $job): ?>
                                <div class="card mb-4" >
                                    <div class="card-body" >
                                        <h5 class="card-title"><?= htmlspecialchars($job['title']); ?></h5>
                                        <p class="card-text"><?= htmlspecialchars($job['description']); ?></p>
                                        <small class="text-muted">Posted on <?= htmlspecialchars($job['date_posted']); ?></small>
                                        <a href="/se265-capstone/client-open-jobs?job_id=<?= htmlspecialchars($job['job_id']); ?>" class="stretched-link"></a>
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
<script src="/se265-capstone/assets/js/dashboard.js"></script>
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