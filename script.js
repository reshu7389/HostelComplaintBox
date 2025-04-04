// Login Form Submission Handling
document.getElementById('loginForm')?.addEventListener('submit', function (e) {
    e.preventDefault();
  
   // Function to show validation messages below fields
function showValidationMessage(inputElement, message) {
  const messageElement = inputElement.nextElementSibling; // Element to display the message
  if (messageElement) {
      messageElement.textContent = message; // Set the message
      messageElement.style.color = message ? 'red' : 'green'; // Set the color (red for error, green for success)
  }
}

// Login Form Validation
document.getElementById('username')?.addEventListener('input', function () {
  const usernamePattern = /^[A-Z][a-z]*$/;
  const usernameInput = this;

  if (!usernamePattern.test(usernameInput.value)) {
      showValidationMessage(usernameInput, 'Username must be at least 5 alphanumeric characters.');
  } else {
      showValidationMessage(usernameInput, 'Valid username.');
  }
});

document.getElementById('password')?.addEventListener('input', function () {
  const passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%#*?&]{7,}$/;
  const passwordInput = this;

  if (!passwordPattern.test(passwordInput.value)) {
      showValidationMessage(passwordInput, 'Password must be at least 8 characters, contain 1 uppercase letter, and 1 digit.');
  } else {
      showValidationMessage(passwordInput, 'Valid password.');
  }
});

// Signup Form Validation
document.getElementById('signupForm')?.addEventListener('input', function (e) {
  const target = e.target;

  if (target.id === 'firstname') {
      const namePattern = /^[A-Z][a-z]*$/;
      if (!namePattern.test(target.value)) {
          showValidationMessage(target, 'First Name must start with a capital letter and contain only letters.');
      } else {
          showValidationMessage(target, 'Valid First Name.');
      }
  } else if (target.id === 'lastname') {
      const namePattern = /^[A-Z][a-z]*$/;
      if (!namePattern.test(target.value)) {
          showValidationMessage(target, 'Last Name must start with a capital letter and contain only letters.');
      } else {
          showValidationMessage(target, 'Valid Last Name.');
      }
  } else if (target.id === 'email') {
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(target.value)) {
          showValidationMessage(target, 'Please enter a valid email address.');
      } else {
          showValidationMessage(target, 'Valid email address.');
      }
  } else if (target.id === 'password') {
      const passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{7,}$/;
      if (!passwordPattern.test(target.value)) {
          showValidationMessage(target, 'Password must be at least 7 characters, include 1 uppercase letter, 1 digit, and 1 special character.');
      } else {
          showValidationMessage(target, 'Valid password.');
      }
  } else if (target.id === 'confirm-password') {
      const password = document.getElementById('password').value;
      if (target.value !== password) {
          showValidationMessage(target, 'Passwords do not match.');
      } else {
          showValidationMessage(target, 'Passwords match.');
      }
  } else if (target.id === 'pnum' || target.id === 'wnum') {
      const phonePattern = /^\d{10}$/;
      if (!phonePattern.test(target.value)) {
          showValidationMessage(target, 'Please enter a valid 10-digit phone number.');
      } else {
          showValidationMessage(target, 'Valid phone number.');
      }
  } else if (target.id === 'enum1') {
      const enrollmentPattern = /^\d{10}$/;
      if (!enrollmentPattern.test(target.value)) {
          showValidationMessage(target, 'Please enter a valid 10-digit Admin ID.');
      } else {
          showValidationMessage(target, 'Valid Admin ID.');
      }
  }
  else if (target.id === 'admin') {
    const adminPattern = /^\d{5}$/;
    if (!adminPattern.test(target.value)) {
        showValidationMessage(target, 'Please enter a valid 10-digit Admin ID.');
    } else {
        showValidationMessage(target, 'Valid Admin ID.');
    }
}
}); 

     // If all validations pass
     alert('Form submitted successfully!');
  
    // Simulate signup (replace with actual API call)
    console.log('Signing up with:', fullname, email, password, pnum, wnum, enum1);
    alert('Signup successful! Redirecting to login...');
    // Redirect to login page
    window.location.href = 'complain.html';
  });
  
  // Hide the splash screen after 3 seconds
  setTimeout(function () {
    const splashScreen = document.getElementById('splash-screen');
    if (splashScreen) {
      splashScreen.classList.add('hide');
    }
  },2000);