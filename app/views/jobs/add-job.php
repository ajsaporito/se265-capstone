<?php
$title = 'Add Job';
include PARTIAL_PATH . 'header.php';
include PARTIAL_PATH . 'navbar.php';
?>
<main id="contentContainer" class="flex-grow-1">
  <div class="container py-5 oxygen-regular">
    <div id="cards" class="card shadow-sm" style=" background-color:#E4E4E4">
      <div class="card-body">
        <h1 class="card-title oxygen-bold">Add Job</h1>
        <form id="job-form" action="/se265-capstone/add-job" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Job Title:</label>
                <input type="text" id="title" name="title" class="form-control " placeholder="Enter job title" >
            </div>

            <div class="form-group">
                <label for="location">Location:</label>
                <select id="location" name="location" class="form-control" >
                    <option value="">Select State</option>
                    <option value="Alabama">Alabama</option>
                    <option value="Alaska">Alaska</option>
                    <option value="Arizona">Arizona</option>
                    <option value="Arkansas">Arkansas</option>
                    <option value="California">California</option>
                    <option value="Colorado">Colorado</option>
                    <option value="Connecticut">Connecticut</option>
                    <option value="Delaware">Delaware</option>
                    <option value="Florida">Florida</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Hawaii">Hawaii</option>
                    <option value="Idaho">Idaho</option>
                    <option value="Illinois">Illinois</option>
                    <option value="Indiana">Indiana</option>
                    <option value="Iowa">Iowa</option>
                    <option value="Kansas">Kansas</option>
                    <option value="Kentucky">Kentucky</option>
                    <option value="Louisiana">Louisiana</option>
                    <option value="Maine">Maine</option>
                    <option value="Maryland">Maryland</option>
                    <option value="Massachusetts">Massachusetts</option>
                    <option value="Michigan">Michigan</option>
                    <option value="Minnesota">Minnesota</option>
                    <option value="Mississippi">Mississippi</option>
                    <option value="Missouri">Missouri</option>
                    <option value="Montana">Montana</option>
                    <option value="Nebraska">Nebraska</option>
                    <option value="Nevada">Nevada</option>
                    <option value="New Hampshire">New Hampshire</option>
                    <option value="New Jersey">New Jersey</option>
                    <option value="New Mexico">New Mexico</option>
                    <option value="New York">New York</option>
                    <option value="North Carolina">North Carolina</option>
                    <option value="North Dakota">North Dakota</option>
                    <option value="Ohio">Ohio</option>
                    <option value="Oklahoma">Oklahoma</option>
                    <option value="Oregon">Oregon</option>
                    <option value="Pennsylvania">Pennsylvania</option>
                    <option value="Rhode Island">Rhode Island</option>
                    <option value="South Carolina">South Carolina</option>
                    <option value="South Dakota">South Dakota</option>
                    <option value="Tennessee">Tennessee</option>
                    <option value="Texas">Texas</option>
                    <option value="Utah">Utah</option>
                    <option value="Vermont">Vermont</option>
                    <option value="Virginia">Virginia</option>
                    <option value="Washington">Washington</option>
                    <option value="West Virginia">West Virginia</option>
                    <option value="Wisconsin">Wisconsin</option>
                    <option value="Wyoming">Wyoming</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" class="form-control" placeholder="Enter job description" ></textarea>
            </div>

            <div class="form-group">
                <label for="job_type">Job Type:</label>
                <select id="job_type" name="job_type" class="form-control" >
                    <option value="">Select Type</option>
                    <option value="fixed">Fixed</option>
                    <option value="hourly">Hourly</option>
                </select>
            </div>

            <div class="form-group">
                <label for="estimated_completion_date">Estimated Completion Date:</label>
                <input type="date" id="estimated_completion_date" name="estimated_completion_date" class="form-control" >
            </div>

            <div id="fixed-fields" style="display:none;">
                <div class="form-group">
                    <label for="budget">Budget:</label>
                    <input type="number" id="budget" name="budget" class="form-control" step="0.25" placeholder="Enter budget amount">
                </div>
            </div>

            <div id="hourly-fields" style="display:none;">
                <div class="form-group">
                    <label for="hourly_rate">Hourly Rate:</label>
                    <input type="number" id="hourly_rate" name="hourly_rate" class="form-control" step="0.25" placeholder="Enter hourly rate">
                </div>

                <div class="form-group">
                    <label for="estimated_hours_per_week">Estimated Hours per Week:</label>
                    <input type="number" id="estimated_hours_per_week" name="estimated_hours_per_week" class="form-control" step="0.50" placeholder="Enter estimated hours per week">
                </div>
            </div>

            <div class="form-group row">
              <label for="skills" class="col-form-label">Skills Required:</label>
              <div class="col-sm-9">
                <select name="skills[]" id="skills" class="form-control select2-multi" multiple>
                  <?php foreach ($skills as $skill): ?>
                    <option class="rounded-pill" value="<?= htmlspecialchars($skill['skill_id']); ?>"><?= htmlspecialchars($skill['skill_name']); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <!-- Submit Button -->
            <button id="add-job-btn" style="background-color: #6643b5;" class="btn rounded-4 text-white " type="submit" name="updateBtn" onmouseover="this.style.background='#714bc9'" onmouseout="this.style.background='#6643b5'">Create Job</button>
        </form>
      </div>
    </div>
  </div>

  <!-- jQuery Script for Dynamic Fields -->
  <script>
      $(document).ready(function() {
            // Show/hide fields based on Job Type
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

            // Initialize select2 for skills dropdown
            $('#skills').select2({
                placeholder: "Select skills",
                allowClear: true,
                templateSelection: function(data, container) {
                    $(container).addClass('rounded-pill');
                    return data.text;
                }
            });

            // Form validation on submit
            $('#job-form').on('submit', function(event) {
                var isValid = true;

                // Validate Job Title
                var title = $('#title').val().trim();
                if (title === '') {
                    alert('Job Title is required.');
                    isValid = false;
                }

                // Validate Location
                var location = $('#location').val();
                if (location === '') {
                    alert('Location is required.');
                    isValid = false;
                }

                // Validate Description
                var description = $('#description').val().trim();
                if (description === '') {
                    alert('Description is required.');
                    isValid = false;
                }

                // Validate Fixed fields if Fixed job type is selected
                if ($('#job_type').val() === 'fixed') {
                    var budget = $('#budget').val().trim();
                    if (budget === '' || parseFloat(budget) <= 0) {
                        alert('Please enter a valid budget.');
                        isValid = false;
                    }
                }

                // Validate Hourly fields if Hourly job type is selected
                if ($('#job_type').val() === 'hourly') {
                    var hourlyRate = $('#hourly_rate').val().trim();
                    var estimatedHours = $('#estimated_hours_per_week').val().trim();
                    if (hourlyRate === '' || parseFloat(hourlyRate) <= 0) {
                        alert('Please enter a valid hourly rate.');
                        isValid = false;
                    }
                    if (estimatedHours === '' || parseFloat(estimatedHours) <= 0) {
                        alert('Please enter valid estimated hours per week.');
                        isValid = false;
                    }
                }

                // If any validation fails, prevent form submission
                if (!isValid) {
                    event.preventDefault();
                }
            });
        });

  </script>
</main>
<?php include PARTIAL_PATH . 'footer.php'; ?>
