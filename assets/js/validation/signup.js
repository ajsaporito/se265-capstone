document.getElementById('signUpForm').addEventListener('submit', function(e) {
  document.getElementById('errorContainer').innerHTML = '';

  const username = document.getElementById('username').value.trim();
  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value.trim();

  // 3-16 characters long, alphanumeric and underscores
  const usernamePattern = /^[a-zA-Z0-9_]{3,16}$/;
  // Basic email pattern
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  // At least 8 characters long, with at least one letter and one number
  const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

  let errors = [];

  if (!usernamePattern.test(username)) {
    errors.push('Username must be 3-16 characters long and can contain letters, numbers, and underscores.');
    return;
  }

  if (!emailPattern.test(email)) {
    errors.push('Please enter a valid email address.');
    return;
  }

  if (!passwordPattern.test(password)) {
    errors.push('Password must be at least 8 characters long and contain at least one letter and one number.');
    return;
  }

  if (errors.length > 0) {
    showErrors(errors);
  }

  this.submit();
});

function showErrors(message) {
  const errorContainer = document.getElementById('errorContainer');
  errorContainer.innerHTML = `<p class="text-danger">${message}</p>`;
}