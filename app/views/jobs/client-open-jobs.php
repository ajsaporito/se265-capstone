<?php
$title = htmlspecialchars($job['title']) . ' - Open Jobs';
include PARTIAL_PATH . 'header.php';
include PARTIAL_PATH . 'navbar.php';
?>

<main id="contentContainer" class="flex-grow-1">
    <div class="container py-5 oxygen-regular">
        <h1 class="oxygen-bold">Open Jobs</h1>

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
                <h5>Job Requests:</h5>
                <?php if (!empty($requests)): ?>
                <?php foreach ($requests as $request): ?>
                    <div class="request-item mb-2">
                        <p><?= htmlspecialchars($request['first_name'] . ' ' . $request['last_name']); ?> - Status: <?= htmlspecialchars($request['status']); ?></p>
                        <?php if ($request['status'] === 'pending'): ?>
                            <button class="btn btn-success accept-request-btn" data-request-id="<?= $request['request_id']; ?>">Accept</button>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                <?php else: ?>
                    <p>No requests yet.</p>
                <?php endif; ?>

            </div>
        </div>
    </div>
</main>

<?php include PARTIAL_PATH . 'footer.php'; ?>
