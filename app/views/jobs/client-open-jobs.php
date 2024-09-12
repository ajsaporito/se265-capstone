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
            <div class="card-footer">
                <h5>Job Requests:</h5>
                <?php if (!empty($requests)): ?>
                    <?php foreach ($requests as $request): ?>
                    <div class="request-item mb-2">
                        <p><?= htmlspecialchars($request['first_name'] . ' ' . $request['last_name']); ?> - Status: <?= htmlspecialchars($request['status']); ?></p>
                        <?php if ($request['status'] === 'pending'): ?>
                            <button class="btn btn-success accept-request-btn" 
                                    data-request-id="<?= $request['request_id']; ?>" 
                                    data-requested-by="<?= $request['requested_by']; ?>">  <!-- Attach the correct user_id -->
                                Accept
                            </button>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                <?php else: ?>
                    <p>No requests yet.</p>
                <?php endif; ?>
            </div>
        </div>
         <!-- Delete button -->
         <button id="delete-job-btn" class="btn btn-danger" data-job-id="<?= htmlspecialchars($job['job_id']); ?>">Delete Job</button>
    </div>
</main>

<?php include PARTIAL_PATH . 'footer.php'; ?>

<script>
$(document).on('click', '.accept-request-btn', function () {
    var requestId = $(this).data('request-id');
    var requestedBy = $(this).data('requested-by');  // Fetch the correct user_id

    $.ajax({
        type: 'POST',
        url: '/se265-capstone/handle-job-request',
        data: {
            job_id: <?= isset($job['job_id']) ? intval($job['job_id']) : 'null'; ?>,
            requested_by: requestedBy,  // Send the correct user_id
            action: 'accept'
        },
        success: function (response) {
            try {
                var parsedResponse = JSON.parse(response);
                console.log(parsedResponse); // Inspect the parsed response here
                if (parsedResponse.status === 'success') {
                    alert('Job request accepted successfully!');
                    location.reload(); // Reload page or update the specific UI element
                } else {
                    alert('There was an error accepting the job request. ' + parsedResponse.message);
                }
            } catch (e) {
                console.error('Error parsing response:', e);
                alert('There was an error processing the response.');
            }
        },
        error: function(xhr, status, error) {
            console.error('XHR Error:', xhr, status, error);
            alert('There was an error accepting the job request.');
        }
    });
});
</script>

<script>
    $(document).on('click', '#delete-job-btn', function (e) {
        e.preventDefault();
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
                            window.location.href = '/se265-capstone'; // Redirect to job list
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
