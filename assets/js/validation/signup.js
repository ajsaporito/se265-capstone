document.getElementById('loginForm').addEventListener('submit', function(e) {
  let errorCt = 0;
  const errorContainer = document.getElementById(`errorContainer`);

  const inputs = document.querySelectorAll(`input[type="text"]`);

  for (let i = 0; i < inputs.length; i++) {
    let regex = ``;
    let errorMsg = ``;

    switch (inputs[i].getAttribute(`id`)) {
      case `username`:
        regex = /^[A-Za-z\-]+$/;
        errorMsg = `Invalid username format.`;
        break;
      case `email`:
        regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        errorMsg = `Invalid email format.`;
        break;
      case `password`:
        regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@.#$!%*?&^])[A-Za-z\d@.#$!%*?&]{8,15}$/;
        errorMsg = `Password must be 8-15 characters long and contain at least one lowercase letter, one uppercase letter, one digit, and one special character.`;
        break;
    }
  }

  if (!regex.test(inputs[i].value)) {
    errorContainer.innerHTML = errorMsg;
  } else {
    errorContainer.innerHTML = ``;
    errorCt++;
  }

  function createAccount() {
   //TODO: Get the form to submit to server when all fields are valid on the front end
  }

  if (errorCt === 3) {
    createAccount();
  }
});
