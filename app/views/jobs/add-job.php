<?php
$title = 'Add Job';
include PARTIAL_PATH . 'header.php';
include PARTIAL_PATH . 'navbar.php';
?>
<main id="contentContainer" class="flex-grow-1">
  <div class="container py-5">
    <h1>Add Job</h1>
    <form id="job-form" action="add-job.php" method="POST" enctype="multipart/form-data">
        <label for="title">Job Title:</label>
        <input type="text" id="title" name="title" required><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>

        <label for="job_type">Job Type:</label>
        <select id="job_type" name="job_type" required>
            <option value="">Select Type</option>
            <option value="fixed">Fixed</option>
            <option value="hourly">Hourly</option>
        </select><br>

        <div id="fixed-fields" style="display:none;">
            <label for="budget">Budget:</label>
            <input type="number" id="budget" name="budget" step="0.25"><br>

            <label for="estimated_completion_date">Estimated Completion Date:</label>
            <input type="date" id="estimated_completion_date" name="estimated_completion_date"><br>
        </div>

        <div id="hourly-fields" style="display:none;">
            <label for="hourly_rate">Hourly Rate:</label>
            <input type="number" id="hourly_rate" name="hourly_rate" step="0.25"><br>

            <label for="estimated_hours_per_week">Estimated Hours per Week:</label>
            <input type="number" id="estimated_hours_per_week" name="estimated_hours_per_week" step="0.50"><br>
        </div>

        <label for="documents">Upload Documents:</label>
        <input type="file" id="documents" name="documents[]" multiple><br>
      
        <button type="submit">Create Job</button>
    </form>
    <script>
        $(document).ready(function() {
            $('#job_type').on('change', function() {
                var jobType = $(this).val();
                if (jobType == 'fixed') {
                    $('#fixed-fields').show();
                    $('#budget').attr('required', true);
                    $('#hourly-fields').hide();
                    $('#hourly_rate, #estimated_hours_per_week').removeAttr('required');
                } else if (jobType == 'hourly') {
                    $('#fixed-fields').hide();
                    $('#budget').removeAttr('required');
                    $('#hourly-fields').show();
                    $('#hourly_rate, #estimated_hours_per_week').attr('required', true);
                } else {
                    $('#fixed-fields').hide();
                    $('#budget').removeAttr('required');
                    $('#hourly-fields').hide();
                    $('#hourly_rate, #estimated_hours_per_week').removeAttr('required');
                }
            });
        });
    </script>
  </div>
</main>
<?php include PARTIAL_PATH . 'footer.php'; ?>
