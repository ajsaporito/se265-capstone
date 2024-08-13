$(document).ready(function() {
  $('#signUpForm').on('submit', function(e) {
    let isValid = true;
    let firstNameError = '';
    let lastNameError = '';
    let usernameError = '';
    let emailError = '';
    let passwordError = '';
    let confirmPasswordError = '';

    const firstName = $('#firstName').val().trim();
    const firstNamePattern = /([a-zA-Z0-9_\s]+)/
    const lastName = $('#lastName').val().trim();
    const lastNamePattern = /([a-zA-Z0-9_\s]+)/
    const username = $('#username').val().trim();
    const usernamePattern = /^(?!\.)(?!.*\.$)[a-z0-9._]{3,20}$/;
    const email = $('#email').val().trim();
    const emailPattern = /^([a-z\d-]+)@([a-z\d-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/;
    const password = $('#password').val().trim();
    const passwordPattern = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;
    const confirmPassword = $('#confirmPassword').val().trim();

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
      usernameError += 'User name must be between 3-20 characters - only lowercase letters, numbers, ".", and "_"';
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

    // Validate password
    if (password === '') {
      isValid = false;
      passwordError += 'Password is required';
      $('#password').addClass('signup-input-error');
      $('#passwordError').html(passwordError);
    } else if (!passwordPattern.test(password)) {
      isValid = false;
      passwordError += 'Password must be at least 8 characters with 1 number and 1 special character';
      $('#password').addClass('signup-input-error');
      $('#passwordError').html(passwordError);
    } else {
      $('#password').removeClass('signup-input-error');
      $('#passwordError').html('');
    }

    // Validate confirm password
    if (confirmPassword === '') {
      isValid = false;
      confirmPasswordError += 'Confirm password is required';
      $('#confirmPassword').addClass('signup-input-error');
      $('#confirmPasswordError').html(confirmPasswordError);
    } else if (password !== confirmPassword) {
      isValid = false;
      confirmPasswordError += 'Passwords do not match';
      $('#confirmPassword').addClass('signup-input-error');
      $('#confirmPasswordError').html(confirmPasswordError);
    } else {
      $('#confirmPassword').removeClass('signup-input-error');
      $('#confirmPasswordError').html('');
    }

    // TODO: Add AJAX call to check if username or email already exists
    $.ajax({
      type: 'POST',
      url: 'url',
      data: 'data',
      dataType: 'json',
      success: function (response) {
        
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
  
    $('#password').on('keyup', function() {
      if ($(this).hasClass('signup-input-error')) {
        $(this).removeClass('signup-input-error');
        $('#passwordError').html('');
      }
    });
  
    $('#confirmPassword').on('keyup', function() {
      if ($(this).hasClass('signup-input-error')) {
        $(this).removeClass('signup-input-error');
        $('#confirmPasswordError').html('');
      }
    });

    if (!isValid) {
      e.preventDefault();
    }
  })
});
