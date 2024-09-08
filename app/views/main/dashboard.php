<?php
$title = 'Dashboard';
include PARTIAL_PATH . 'header.php';
require_once PARTIAL_PATH . 'navbar.php';
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

<?php include PARTIAL_PATH . 'footer.php'; ?>
