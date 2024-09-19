<?php
$title = 'Add Job';
include PARTIAL_PATH . 'header.php';
include PARTIAL_PATH . 'navbar.php';
?>
<style>
  .btn-check:checked + .btn {
    background-color: #8257e6 !important;
    transform: scale(0.9);
    transition: transform 0.2s ease;
  }

  .btn:hover {
    background-color: #8257e6 !important;
  }
</style>
<main id="contentContainer" class="flex-grow-1">
  <div class="container py-5 oxygen-regular">
    <div id="cards" class="card shadow-sm p-3" style="background-color:#E4E4E4">
      <div class="card-body">
        <h1 class="card-title oxygen-bold">Add Job</h1>
        <form id="job-form" method="post">
          <div class="form-group mb-4">
            <label for="title">Job Title:</label>
            <input type="text" id="title" name="title" value="<?= $jobTitle ?>" class="form-control shadow-none main-form-input <?php echo $titleErrorClass;?>" placeholder="Enter job title">
            <?php if (!empty($titleError)) : ?>
              <span style="font-size: 14px;" id="titleError" class="text-danger position-absolute m-1 oxygen-light"><?= $titleError ?></span>
            <?php endif; ?>
          </div>
          <div class="form-group mb-4">
            <label for="location">Location:</label>
            <select id="location" name="location" class="form-control shadow-none main-form-input <?php echo $locationErrorClass;?>">
              <option value="<?= $location ?>"><?= $location ?></option>
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
            <?php if (!empty($locationError)) : ?>
              <span style="font-size: 14px;" id="locationError" class="text-danger position-absolute m-1 oxygen-light"><?= $locationError ?></span>
            <?php endif; ?>
          </div>
          <div class="form-group mb-4">
            <label for="description">Description:</label>
            <input id="description" name="description" value="<?= $description ?>" class="form-control shadow-none main-form-input <?php echo $descriptionErrorClass ?>" placeholder="Enter job description">
            <?php if (!empty($descriptionError)) : ?>
              <span style="font-size: 14px;" id="descriptionError" class="text-danger position-absolute m-1 oxygen-light"><?= $descriptionError ?></span>
            <?php endif; ?>
          </div>
          <div class="form-group mb-4">
            <label for="job_type">Job Type:</label>
            <select id="job_type" name="job_type" value="<?= $jobType ?>" class="form-control shadow-none main-form-input <?php echo $jobTypeErrorClass ?>">
              <option value="<?= $jobType ?>"><?= $jobType ?></option>
              <option value="Fixed">Fixed</option>
              <option value="Hourly">Hourly</option>
            </select>
            <?php if (!empty($jobTypeError)) : ?>
              <span style="font-size: 14px;" id="jobTypeError" class="text-danger position-absolute m-1 oxygen-light"><?= $jobTypeError ?></span>
            <?php endif; ?>
          </div>
          <div class="form-group mb-4">
            <label for="estimated_completion_date">Estimated Completion Date:</label>
            <input type="date" id="estimated_completion_date" name="estimated_completion_date" value="<?= $date ?>" class="form-control shadow-none main-form-input <?php echo $dateErrorClass ?>">
            <?php if (!empty($dateError)) : ?>
              <span style="font-size: 14px;" id="dateError" class="text-danger position-absolute m-1 oxygen-light"><?= $dateError ?></span>
            <?php endif; ?>
          </div>
          <div id="fixed-fields">
            <div class="form-group mb-4">
              <label for="budget">Budget:</label>
              <input type="number" min="1" id="budget" name="budget" value="<?= $budget ?>" class="form-control shadow-none main-form-input <?php echo $budgetErrorClass ?>" step="0.25" placeholder="Enter budget amount">
              <?php if (!empty($budgetError)) : ?>
                <span style="font-size: 14px;" id="budgetError" class="text-danger position-absolute m-1 oxygen-light"><?= $budgetError ?></span>
              <?php endif; ?>
            </div>
          </div>
          <div id="hourly-fields">
            <div class="form-group mb-4">
              <label for="hourly_rate">Hourly Rate:</label>
              <input type="number" min="1" id="hourly_rate" name="hourly_rate" value="<?= $hourlyRate ?>" class="form-control shadow-none main-form-input <?php echo $hourlyRateErrorClass ?>" step="0.25" placeholder="Enter hourly rate">
              <?php if (!empty($hourlyRateError)) : ?>
                <span style="font-size: 14px;" id="hourlyRateError" class="text-danger position-absolute m-1 oxygen-light"><?= $hourlyRateError ?></span>
              <?php endif; ?>
            </div>
            <div class="form-group mb-4">
              <label for="estimated_hours_per_week">Estimated Hours per Week:</label>
              <input type="number" min="1" id="estimated_hours_per_week" name="estimated_hours_per_week" value="<?= $hoursPerWeek ?>" class="form-control shadow-none main-form-input <?php echo $hoursPerWeekErrorClass ?>" step="0.50" placeholder="Enter estimated hours per week">
              <?php if (!empty($hoursPerWeekError)) : ?>
                <span style="font-size: 14px;" id="hoursPerWeekError" class="text-danger position-absolute m-1 oxygen-light"><?= $hoursPerWeekError ?></span>
              <?php endif; ?>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label for="skills" class="col-form-label">Skills Required:</label>
            <div class="col-sm-9">
              <div name="skills[]" id="skills" class="form-control shadow-none main-form-input <?php echo $skillsErrorClass ?>">
                <?php foreach ($skills as $skill): ?>
                  <div class="py-2 form-check-inline">
                    <input type="checkbox" class="btn-check" name="skills[]" id="skill<?= htmlspecialchars($skill['skill_id']); ?>" value="<?= htmlspecialchars($skill['skill_id']); ?>" <?= in_array($skill['skill_id'], $skillsSelected) ? 'checked' : ''; ?>> 
                    <label style="background-color: #714bc9;" class="btn btn-outline rounded-pill text-white" for="skill<?= htmlspecialchars($skill['skill_id']); ?>">
                      <?= htmlspecialchars($skill['skill_name']); ?>
                    </label>
                  </div>
                <?php endforeach; ?>
              </div>
              <?php if (!empty($skillsError)) : ?>
                <span style="font-size: 14px;" id="skillsError" class="text-danger position-absolute m-1 oxygen-light"><?= $skillsError ?></span>
              <?php endif; ?>
            </div>
          </div>
          <button id="add-job-btn" style="background-color: #6643b5;" class="btn rounded-4 text-white mt-3" type="submit" name="addJobBtn" onmouseover="this.style.background='#714bc9'" onmouseout="this.style.background='#6643b5'">Create Job</button>
        </form>
        <div class="row oxygen-light">
          <div class="col-12">
            <span class="nav justify-content-center border-bottom mt-2 pb-3 mb-3"></span>
            <p class="m-0 text-secondary text-center">Want to go back? Click
              <a style="color: #6643b5;" class="text-decoration-none" href="/se265-capstone"><b>here</b></a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="/se265-capstone/assets/js/add-job.js"></script>
</main>
<?php include PARTIAL_PATH . 'footer.php'; ?>
