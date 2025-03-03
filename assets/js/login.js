$(document).ready(function() {
  $('#loginForm').on('submit', function(e) {
    e.preventDefault();

    // Validate login credentials
    $.ajax({
      type: 'POST',
      url: '/se265-capstone/login',
      data: $('#loginForm').serialize(),
      dataType: 'json',
      success: function (response) {
        if (response.success) {
          window.location.href = '/se265-capstone';
        } else {
          if (response.usernameError !== '') {
            $('#usernameError').text(response.usernameError);
            $('#username').addClass('signup-input-error');
          } else {
            $('#username').removeClass('signup-input-error');
          }
    
          if (response.passwordError !== '') {
            $('#passwordError').text(response.passwordError);
            $('#password').addClass('signup-input-error');
          } else {
            $('#password').removeClass('signup-input-error');
          }
        }
      }
    });

    // Clear errors when typed in again
    $('#username').on('keyup', function() {
      $(this).removeClass('signup-input-error');
      $('#usernameError').text('');
    });

    $('#password').on('keyup', function() {
      $(this).removeClass('signup-input-error');
      $('#passwordError').text('');
    });
  })
});
