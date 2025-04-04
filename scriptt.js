// Function to display validation messages below fields
function showValidationMessage(inputElement, message) {
    let messageElement = inputElement.nextElementSibling;

    if (!messageElement || messageElement.className !== 'validation-message') {
        // Create a span element for the validation message if it doesn't already exist
        messageElement = document.createElement('span');
        messageElement.className = 'validation-message';
        inputElement.parentNode.appendChild(messageElement);
    }

    messageElement.textContent = message; // Set the message
    messageElement.style.color = 'red'; // Error messages are red

    // Hide the message if there's no error (valid input)
    if (!message) {
        messageElement.textContent = ''; // Clear the message
    }
}

// Reusable validation patterns
const patterns = {
    name: /^[A-Z][a-z]*$/, // Each name starts with a capital letter
    email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/, // Standard email format
    phone: /^\d{10}$/, // 10-digit phone number
    admin: /^[A-Z]\d$/, // Admin must be 10 digits
    enum: /^\d{10}$/, //Enrollment ID must be 10 digits
    password: /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%#*?&]{7,}$/ // Password with uppercase, number, special char, and min 7 chars
};

// Real-Time Validation Handler
function realTimeValidation(event) {
    const input = event.target;

    switch (input.id) {
        case 'firstname':
        case 'lastname':
            if (!patterns.name.test(input.value)) {
                showValidationMessage(input, `${input.id === 'firstname' ? 'First' : 'Last'} Name must start with a capital letter and contain only letters.`);
            } else {
                showValidationMessage(input, ''); // No message for valid input
            }
            break;
        case 'email':
            if (!patterns.email.test(input.value)) {
                showValidationMessage(input, 'Please enter a valid email address.');
            } else {
                showValidationMessage(input, ''); // No message for valid input
            }
            break;
        case 'password':
            if (!patterns.password.test(input.value)) {
                showValidationMessage(input, 'Password must be at least 7 characters, include 1 uppercase letter, 1 digit, and 1 special character.');
            } else {
                showValidationMessage(input, ''); // No message for valid input
            }
            break;
        case 'confirm-password':
            const password = document.getElementById('password').value;
            if (input.value !== password) {
                showValidationMessage(input, 'Passwords do not match.');
            } else {
                showValidationMessage(input, ''); // No message for valid input
            }
            break;
        case 'pnum':
        case 'wnum':
            if (!patterns.phone.test(input.value)) {
                showValidationMessage(input, `Please enter a valid 10-digit ${input.id === 'pnum' ? 'phone number' : 'WhatsApp number'}.`);
            } else {
                showValidationMessage(input, ''); // No message for valid input
            }
            break;
        case 'admin':
            if (!patterns.admin.test(input.value)) {
                showValidationMessage(input, 'Admin ID must be a 10-digit number.');
            } else {
                showValidationMessage(input, ''); // No message for valid input
            }
            break;
        case 'enum':
            if (!patterns.enum.test(input.value)) {
                    showValidationMessage(input, 'Admin ID must be a 10-digit number.');
            } else {
                    showValidationMessage(input, ''); // No message for valid input
            }
            break;
    }
}

// Attach real-time validation to all inputs
document.getElementById('signupForm')?.addEventListener('input', realTimeValidation);

// Form Submission Handler
function validateForm(formId) {
    const form = document.getElementById(formId);
    let isValid = true;

    // Validate each input field in the form
    form.querySelectorAll('input').forEach((input) => {
        const value = input.value.trim();

        switch (input.id) {
            case 'firstname':
            case 'lastname':
                if (!patterns.name.test(value)) {
                    showValidationMessage(input, `${input.id === 'firstname' ? 'First' : 'Last'} Name must start with a capital letter and contain only letters.`);
                    isValid = false;
                } else {
                    showValidationMessage(input, ''); // Clear message for valid input
                }
                break;
            case 'email':
                if (!patterns.email.test(value)) {
                    showValidationMessage(input, 'Please enter a valid email address.');
                    isValid = false;
                } else {
                    showValidationMessage(input, ''); // Clear message for valid input
                }
                break;
            case 'password':
                if (!patterns.password.test(value)) {
                    showValidationMessage(input, 'Password must be at least 7 characters, include 1 uppercase letter, 1 digit, and 1 special character.');
                    isValid = false;
                } else {
                    showValidationMessage(input, ''); // Clear message for valid input
                }
                break;
            case 'confirm-password':
                const password = document.getElementById('password').value;
                if (value !== password) {
                    showValidationMessage(input, 'Passwords do not match.');
                    isValid = false;
                } else {
                    showValidationMessage(input, ''); // Clear message for valid input
                }
                break;
            case 'pnum':
            case 'wnum':
                if (!patterns.phone.test(value)) {
                    showValidationMessage(input, `Please enter a valid 10-digit ${input.id === 'pnum' ? 'phone number' : 'WhatsApp number'}.`);
                    isValid = false;
                } else {
                    showValidationMessage(input, ''); // Clear message for valid input
                }
                break;
            case 'admin':
                if (!patterns.admin.test(value)) {
                    showValidationMessage(input, 'Admin ID must be a 10-digit number.');
                    isValid = false;
                } else {
                    showValidationMessage(input, ''); // Clear message for valid input
                }
                break;
            case 'enum':
                 if (!patterns.enum.test(value)) {
                     showValidationMessage(input, 'Admin ID must be a 10-digit number.');
                     isValid = false;
                } else {
                     showValidationMessage(input, ''); // Clear message for valid input
                }
                break;
        }
    });

    return isValid;
}

// Signup Form Submission
document.getElementById('signupForm')?.addEventListener('submit', function (e) {
    //e.preventDefault();

    if (validateForm('signupForm')) {
        alert('Signup successful! Redirecting...');
        console.log('Form submitted with valid data.');
        window.location.href = 'index.html'; // Redirect after successful validation
    } else {
        alert('Please fix the errors before submitting.');
    }
});

// Splash Screen Handler
setTimeout(() => {
    const splashScreen = document.getElementById('splash-screen');
    if (splashScreen) {
        splashScreen.classList.add('hide');
    }
}, 3000);
