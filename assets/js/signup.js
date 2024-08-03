$(document).ready(function() {
  $('#signUpForm').on('submit', function(e) {
    let isValid = true;
    let errorMsgs = '';
    
    const username = $('#username').val().trim();
    const usernamePattern = /^(?!\.)(?!.*\.$)[a-z0-9._]{3,20}$/;
    const email = $('#email').val().trim();
    const emailPattern = /^([a-z\d-]+)@([a-z\d-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/;
    const password = $('#password').val().trim();
    const passwordPattern = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;
    const confirmPassword = $('#confirmPassword').val().trim();

    if (username === '') {
      isValid = false;
      errorMsgs += 'Username is required.<br>';
    } else if (!usernamePattern.test(username)) {
      isValid = false;
      errorMsgs += 'User name must be between 3-20 characters - only lowercase letters, numbers, ".", and "_".<br>';
    }

    if (email === '') {
      isValid = false;
      errorMsgs += 'Email is required.<br>';
    } else if (!emailPattern.test(email)) {
      isValid = false;
      errorMsgs += 'Please enter a valid email address.<br>';
    }

    if (password === '') {
      isValid = false;
      errorMsgs += 'Password is required.<br>';
    } else if (!passwordPattern.test(password)) {
      isValid = false;
      errorMsgs += 'Password must be at least 8 characters with one number and one special character.<br>';
    }

    if (confirmPassword === '') {
      isValid = false;
      errorMsgs += 'Confirm password is required.<br>';
    } else if (password !== confirmPassword) {
      isValid = false;
      errorMsgs += 'Passwords do not match.<br>';
    } 

    if (!isValid) {
      e.preventDefault();
      $('#errorContainer').html(errorMsgs).addClass('text-danger');
    }
  })
});
