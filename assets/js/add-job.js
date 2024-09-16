$(document).ready(function() {
  // On job type change, show/hide fields
  $('#job_type').on('change', function() {
    let jobType = $(this).val();
    if (jobType == 'Fixed') {
      $('#fixed-fields').show();
      $('#hourly-fields').hide();
    } else if (jobType == 'Hourly') {
      $('#fixed-fields').hide();
      $('#hourly-fields').show();
    } else {
      $('#fixed-fields').hide();
      $('#hourly-fields').hide();
    }
  });

  // On page load, show/hide fields based on previously selected job type
  if ($('#job_type').val() == 'Fixed') {
    $('#fixed-fields').show();
    $('#hourly-fields').hide();
  } else if ($('#job_type').val() == 'Hourly') {
    $('#fixed-fields').hide();
    $('#hourly-fields').show();
  } else {
    $('#fixed-fields').hide();
    $('#hourly-fields').hide();
  }
});
