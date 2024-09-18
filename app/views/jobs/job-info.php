<?php
$title = htmlspecialchars($job['title']) . ' - Job Details';
include PARTIAL_PATH . 'header.php';
include PARTIAL_PATH . 'navbar.php';
?>
<main id="contentContainer" class="flex-grow-1">
  <div class="container py-5">
    <div id="cards" class="card">
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
        </form>
      </div>
      <div class="card-footer">
        <!-- Request Job Button -->
        <button id="requestJobButton" style="background-color: #6643b5;" class="btn rounded-4 text-white" onmouseover="this.style.background='#714bc9'" onmouseout="this.style.background='#6643b5'">Request Job</button>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#requestJobButton').on('click', function() {
        $.ajax({
          type: 'POST',
          url: '/se265-capstone/request-job',
          data: {
            job_id: <?= $job['job_id']; ?>,
            requested_by: <?= $_SESSION['user_id']; ?>
          }, success: function(response) {
            let res = JSON.parse(response);
            if (res.status === 'success') {
              alert('Job request sent successfully!');
            } else if (res.status === 'already_requested') {
              alert('You have already requested this job.');
            }
          }, error: function() {
            alert('There was an error sending the job request.');
          }
        });
      });
    });
  </script>
</main>
<?php include PARTIAL_PATH . 'footer.php'; ?>
