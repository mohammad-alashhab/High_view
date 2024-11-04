// Form Elements and Password Requirements
const form = document.getElementById("registerForm");
const inputs = form.querySelectorAll("input[required]");
const passwordInput = document.getElementById("password");
const confirmPasswordInput = document.getElementById("confirm_password");
const strengthMeterFill = document.getElementById("strength-meter-fill");
const strengthText = document.getElementById("strength-text");
const passwordMatch = document.getElementById("password-match");
const submitButton = form.querySelector("button[type='submit']");

// Password requirements elements
const requirements = {
  length: document.getElementById("length"),
  uppercase: document.getElementById("uppercase"),
  lowercase: document.getElementById("lowercase"),
  number: document.getElementById("number"),
  special: document.getElementById("special"),
};

// Add Input Validation Listener to All Fields
inputs.forEach((input) => {
  input.addEventListener("input", function () {
    validateField(this);
  });
});

// Individual Field Validation Function
function validateField(field) {
  const validationMessage = field.parentElement.querySelector(
      ".validation-message"
  );
  let isValid = true;

  switch (field.id) {
    case "first_name":
    case "last_name":
      isValid = /^[A-Za-z ]{2,50}$/.test(field.value);
      break;
    case "email":
      isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field.value);
      break;
    case "phone":
      isValid = /^[0-9]{8,15}$/.test(field.value);
      break;
    default:
      isValid = field.value.length > 0;
  }

  field.classList.toggle("is-valid", isValid);
  field.classList.toggle("is-invalid", !isValid);
  if (validationMessage) {
    validationMessage.classList.toggle("show", !isValid && field.value !== "");
  }

  return isValid;
}

// Password Strength Meter and Requirements Update
passwordInput.addEventListener("input", function () {
  const password = this.value;
  const strength = calculatePasswordStrength(password);
  updateRequirements(password);

  strengthMeterFill.style.width = strength.percentage + "%";
  strengthMeterFill.className = "strength-meter-fill " + strength.className;
  strengthText.textContent = strength.text;
  strengthText.className = "strength-text " + strength.textClass;

  checkPasswordMatch();
});

// Confirm Password Match Check
confirmPasswordInput.addEventListener("input", checkPasswordMatch);

function updateRequirements(password) {
  const checks = {
    length: password.length >= 8,
    uppercase: /[A-Z]/.test(password),
    lowercase: /[a-z]/.test(password),
    number: /[0-9]/.test(password),
    special: /[!@#$%^&*(),.?":{}|<>]/.test(password),
  };

  for (const [requirement, valid] of Object.entries(checks)) {
    const element = requirements[requirement];
    element.classList.toggle("valid", valid);
  }
}

// Password Strength Calculation
function calculatePasswordStrength(password) {
  let strengthScore = 0;
  const hasUpperCase = /[A-Z]/.test(password);
  const hasLowerCase = /[a-z]/.test(password);
  const hasNumbers = /[0-9]/.test(password);
  const hasSpecialChars = /[!@#$%^&*(),.?":{}|<>]/.test(password);
  const lengthCriteria = password.length >= 8;

  if (hasUpperCase) strengthScore += 1;
  if (hasLowerCase) strengthScore += 1;
  if (hasNumbers) strengthScore += 1;
  if (hasSpecialChars) strengthScore += 1;
  if (lengthCriteria) strengthScore += 1;

  let strength = {
    percentage: 0,
    className: "weak",
    text: "Weak",
    textClass: "weak-text",
  };

  if (strengthScore === 5) {
    strength = {
      percentage: 100,
      className: "strong",
      text: "Strong",
      textClass: "strong-text",
    };
  } else if (strengthScore >= 3) {
    strength = {
      percentage: 60,
      className: "medium",
      text: "Medium",
      textClass: "medium-text",
    };
  } else if (strengthScore > 0) {
    strength = {
      percentage: 30,
      className: "weak",
      text: "Weak",
      textClass: "weak-text",
    };
  }
  return strength;
}

// Password Match Validation Display
function checkPasswordMatch() {
  const password = passwordInput.value;
  const confirmPassword = confirmPasswordInput.value;

  if (confirmPassword === "") {
    passwordMatch.textContent = "";
    passwordMatch.style.color = "";
  } else if (password === confirmPassword) {
    passwordMatch.textContent = "Passwords match!";
    passwordMatch.style.color = "#4caf50";
  } else {
    passwordMatch.textContent = "Passwords do not match";
    passwordMatch.style.color = "#ff4d4d";
  }
}

// Toggle Password Visibility
function togglePassword(fieldId, icon) {
  const passwordField = document.getElementById(fieldId);
  if (passwordField.type === "password") {
    passwordField.type = "text";
    icon.classList.replace("fa-eye", "fa-eye-slash");
  } else {
    passwordField.type = "password";
    icon.classList.replace("fa-eye-slash", "fa-eye");
  }
}

// Submit Form with Validation Checks
form.addEventListener("submit", async function (e) {
  e.preventDefault();

  let isValid = true;

  // Check if first name and last name are filled
  const firstName = document.getElementById("first_name").value.trim();
  const lastName = document.getElementById("last_name").value.trim();
  const email = document.getElementById("email").value.trim();
  const phone = document.getElementById("phone").value.trim();

  if (!firstName || !lastName || !email || !phone) {
    swal({
      title: "Missing Information",
      text: "Please fill in all field.",
      icon: "warning",
      button: "OK",
    });
    isValid = false;
  }

  // Validate all other fields
  inputs.forEach((input) => {
    if (!validateField(input)) {
      isValid = false;
    }
  });

  // Further validation checks
  if (!isValid) {
    return;
  }

  const password = passwordInput.value;
  const confirmPassword = confirmPasswordInput.value;
  if (password !== confirmPassword) {
    swal("Error", "Passwords do not match!", "error");
    return;
  }

  const strength = calculatePasswordStrength(password);
  if (strength.text !== "Strong") {
    swal("Weak Password", "Your password needs to be stronger.", "warning");
    return;
  }

  const formData = new FormData(this);
  const submitButton = this.querySelector("button[type='submit']");
  submitButton.disabled = true;

  try {
    const response = await fetch("/register", {
      method: "POST",
      body: formData,
    });

    if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

    const data = await response.json();

    if (data.success) {
      swal({
        title: "Registration Successful!",
        text: "Redirecting to the login page.",
        icon: "success",
        button: "OK",
        timer: 2000,
      });
      setTimeout(() => (window.location.href = data.redirect), 2500);
    } else {
      swal("Error", data.message || "Registration failed", "error");
      submitButton.disabled = false;
    }
  } catch (error) {
    console.error("Fetch Error:", error);
    swal(
        "Error",
        "An unexpected error occurred. Please try again later.",
        "error"
    );
    submitButton.disabled = false;
  }
});

// Login Form Elements
// Login Form Elements
const loginForm = document.querySelector("form");
const passwordField = document.querySelector("input[name='user_password']");
const emailField = document.querySelector("input[name='user_email']");

// Password Toggle for Login Form with Show on Input
function setupPasswordToggle() {
  const passwordFields = document.querySelectorAll('input[type="password"]');

  passwordFields.forEach((field) => {
    // Create toggle button but hide it initially
    const toggleButton = document.createElement("span");
    toggleButton.className = "toggle-password";
    toggleButton.style.display = "none"; // Hide toggle button initially
    toggleButton.innerHTML = '<i class="far fa-eye"></i>';

    field.parentElement.appendChild(toggleButton);
    field.style.paddingRight = "40px";

    // Show toggle button on input
    field.addEventListener("input", function () {
      toggleButton.style.display = field.value ? "inline" : "none";
    });

    toggleButton.addEventListener("click", function () {
      const isPasswordVisible = field.type === "text";
      field.type = isPasswordVisible ? "password" : "text";
      this.innerHTML = `<i class="far fa-eye${
          isPasswordVisible ? "" : "-slash"
      }"></i>`;

      const icon = this.querySelector("i");
      icon.classList.add("fa-flip");
      setTimeout(() => icon.classList.remove("fa-flip"), 200);
    });
  });
}

setupPasswordToggle();

// Function to show loading animation on the button
function showLoadingAnimation(button) {
  button.disabled = true;

  // Add loading text and spinner icon
  button.innerHTML = `
    <span class="button-text">Registering...</span>
    <i class="fas fa-spinner fa-spin" style="margin-left: 10px;"></i>
  `;
}

// Function to hide loading animation and restore original button text
function hideLoadingAnimation(button) {
  button.disabled = false;
  button.innerHTML = "Register";
}
