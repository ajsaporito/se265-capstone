$(document).ready(function() {
  $('#editProfileForm').on('submit', function(e) {
    //e.preventDefault();
    let isValid = true;
    let firstNameError = '';
    let lastNameError = '';
    let usernameError = '';
    let emailError = '';
    /*
    let currentPasswordError = '';
    let newPasswordError = '';
    let confirmNewPasswordError = ''; */

    const firstName = $('#firstName').val().trim();
    const firstNamePattern = /([a-zA-Z0-9_\s]+)/
    const lastName = $('#lastName').val().trim();
    const lastNamePattern = /([a-zA-Z0-9_\s]+)/
    const username = $('#username').val().trim();
    const usernamePattern = /^(?!\.)(?!.*\.$)[a-z0-9._]{3,20}$/;
    const email = $('#email').val().trim();
    const emailPattern = /^([a-z\d-]+)@([a-z\d-]+)\.([a-z]{2,8})(\.[a-z]{1,8})?$/;
    /*
    const currentPassword = $('#currentPassword').val().trim();
    const newPassword = $('#newPassword').val().trim();
    const newPasswordPattern = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;
    const confirmNewPassword = $('#confirmPassword').val().trim(); */

    // Validate first name
    if (firstName === '') {
      isValid = false;
      firstNameError += 'First name is required';
      $('#firstName').addClass('signup-input-error');
      $('#firstNameError').html(firstNameError);
    } else if (!firstNamePattern.test(firstName)) {
      isValid = false;
      firstNameError += 'First name cannot have special characters';
      $('#firstName').addClass('signup-input-error');
      $('#firstNameError').html(firstNameError);
    } else {
      $('#firstName').removeClass('signup-input-error');
      $('#firstNameError').html('');
    }

    // Validate last name
    if (lastName === '') {
      isValid = false;
      lastNameError += 'Last name is required';
      $('#lastName').addClass('signup-input-error');
      $('#lastNameError').html(lastNameError);
    } else if (!lastNamePattern.test(lastName)) {
      isValid = false;
      lastNameError += 'Last name cannot have special characters';
      $('#lastName').addClass('signup-input-error');
      $('#lastNameError').html(lastNameError);
    } else {
      $('#lastName').removeClass('signup-input-error');
      $('#lastNameError').html('');
    }

    // Validate username
    if (username === '') {
      isValid = false;
      usernameError += 'Username is required';
      $('#username').addClass('signup-input-error');
      $('#usernameError').html(usernameError);
    } else if (!usernamePattern.test(username)) {
      isValid = false;
      usernameError += 'Username must be between 3-20 characters (cannot start with or end with ".")';
      $('#username').addClass('signup-input-error');
      $('#usernameError').html(usernameError);
    } else {
      $('#username').removeClass('signup-input-error');
      $('#usernameError').html('');
    }

    // Validate email
    if (email === '') {
      isValid = false;
      emailError += 'Email is required';
      $('#email').addClass('signup-input-error');
      $('#emailError').html(emailError);
    } else if (!emailPattern.test(email)) {
      isValid = false;
      emailError += 'Please enter a valid email address';
      $('#email').addClass('signup-input-error');
      $('#emailError').html(emailError);
    } else {
      $('#email').removeClass('signup-input-error');
      $('#emailError').html('');
    }

    /*
    // Validate current password
    if (currentPassword === '') {
      isValid = false;
      currentPasswordError += 'Current password is required';
      $('#currentPassword').addClass('signup-input-error');
      $('$currentPasswordError').html(currentpasswordError);
    } else if (currentPassword !== $password) {
      isValid = false;
      currentPasswordError += 'Current password is incorrect';
      $('#currentPassword').addClass('signup-input-error');
      $('#currentPasswordError').html(currentPasswordError);
    } else {
      $('#currentPassword').removeClass('signup-input-error');
      $('#currentPasswordError').html('');
    }

    // Validate new password
    if (newPassword === '') {
      isValid = false;
      newPasswordError += 'New password is required';
      $('#newPassword').addClass('signup-input-error');
      $('#newPasswordError').html(confirmPasswordError);
    } else if (newPassword !== confirmNewPassword) {
      isValid = false;
      confirmNewPasswordError += 'Passwords do not match';
      $('#confirmNewPassword').addClass('signup-input-error');
      $('#confirmNewPasswordError').html(confirmNewPasswordError);
    } else {
      $('#confirmNewPassword').removeClass('signup-input-error');
      $('#confirmNewPasswordError').html('');
    } */

    // Check if username and email are already taken
    $.ajax({
      type: 'POST',
      url: '/se265-capstone/check-edit-profile',
      data: $('#editProfileForm').serialize(),
      dataType: 'json',
      success: function (response) {
        isValid = false;
        if (!response.success) {
          if (response.usernameError !== '') {
            $('#usernameError').html(response.usernameError);
            //$('#username').addClass('signup-input-error');
          } else {
            $('#username').removeClass('signup-input-error');
            $('#usernameError').html('');
          }
    
          if (response.emailError !== '') {
            $('#emailError').html(response.emailError);
            //$('#email').addClass('signup-input-error');
          } else {
            $('#email').removeClass('signup-input-error');
            $('#emailError').html('');
          } 
        } else {
          isValid = true;
        }
      }
    }); 

    // Clear errors when typed in again
    $('#firstName').on('keyup', function() {
      if ($(this).hasClass('signup-input-error')) {
        $(this).removeClass('signup-input-error');
        $('#firstNameError').html('');
      }
    });
  
    $('#lastName').on('keyup', function() {
      if ($(this).hasClass('signup-input-error')) {
        $(this).removeClass('signup-input-error');
        $('#lastNameError').html('');
      }
    });
  
    $('#username').on('keyup', function() {
      if ($(this).hasClass('signup-input-error')) {
        $(this).removeClass('signup-input-error');
        $('#usernameError').html('');
      }
    });
  
    $('#email').on('keyup', function() {
      if ($(this).hasClass('signup-input-error')) {
        $(this).removeClass('signup-input-error');
        $('#emailError').html('');
      }
    });
  
    /*
    $('#currentPassword').on('keyup', function() {
      if ($(this).hasClass('signup-input-error')) {
        $(this).removeClass('signup-input-error');
        $('#passwordError').html('');
      }
    });

    $('#newPassword').on('keyup', function() {
      if ($(this).hasClass('signup-input-error')) {
        $(this).removeClass('signup-input-error');
        $('#passwordError').html('');
      }
    });
  
    $('#confirmNewPassword').on('keyup', function() {
      if ($(this).hasClass('signup-input-error')) {
        $(this).removeClass('signup-input-error');
        $('#confirmPasswordError').html('');
      }
    });

    */
    // Prevent form submission if there are errors
    if (!isValid) {
      e.preventDefault();
    }
  })
});
