$(document).ready(function() {
    $('#job-form').on('submit', function(e) {
      e.preventDefault(); // Prevent default form submission
  
      // Perform the AJAX request
      $.ajax({
        type: 'POST',
        url: '/se265-capstone/add-job', // The route handled by the PHP router
        data: $('#job-form').serialize(), // Serialize form data
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            // Redirect to job listing or success page on success
            window.location.href = '/se265-capstone/jobs';
          } else {
            // Handle validation errors
            if (response.titleError) {
              $('#titleError').html(response.titleError);
              $('#title').addClass('input-error');
            } else {
              $('#title').removeClass('input-error');
            }
  
            if (response.locationError) {
              $('#locationError').html(response.locationError);
              $('#location').addClass('input-error');
            } else {
              $('#location').removeClass('input-error');
            }
  
            if (response.descriptionError) {
              $('#descriptionError').html(response.descriptionError);
              $('#description').addClass('input-error');
            } else {
              $('#description').removeClass('input-error');
            }
  
            // Handle other fields similarly...
          }
        }
      });
  
      // Clear error messages when user types again
      $('#title').on('keyup', function() {
        $(this).removeClass('input-error');
        $('#titleError').html('');
      });
  
      $('#location').on('change', function() {
        $(this).removeClass('input-error');
        $('#locationError').html('');
      });
  
      // Similarly, clear errors for other fields...
    });
  });
  