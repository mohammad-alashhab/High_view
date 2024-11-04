document.addEventListener("DOMContentLoaded", function () {
  const resetForm = document.getElementById("resetPasswordForm");
  const emailInput = document.getElementById("email");
  const newPasswordInput = document.getElementById("new-password");
  const confirmPasswordInput = document.getElementById("confirm-password");
  const resetButton = document.getElementById("resetButton");
  const emailError = document.getElementById("emailError");
  const passwordError = document.getElementById("passwordError");
  const confirmPasswordError = document.getElementById("confirmPasswordError");
  const strengthBars = document.querySelectorAll(".strength-bar");
  const loadingModal = document.getElementById("loadingModal");
  const successModal = document.getElementById("successModal");
  const errorModal = document.getElementById("errorModal");

  // Email validation regex
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  // Password strength and validation
  function checkPasswordStrength(password) {
    const lengthCheck = password.length >= 8;
    const uppercaseCheck = /[A-Z]/.test(password);
    const lowercaseCheck = /[a-z]/.test(password);
    const numberCheck = /[0-9]/.test(password);
    const specialCharCheck = /[!@#$%^&*(),.?":{}|<>]/.test(password);

    // Update strength bars
    strengthBars[0].classList.toggle("weak", lengthCheck && uppercaseCheck);
    strengthBars[1].classList.toggle(
        "medium",
        lengthCheck && uppercaseCheck && (lowercaseCheck || numberCheck)
    );
    strengthBars[2].classList.toggle(
        "strong",
        lengthCheck &&
        uppercaseCheck &&
        lowercaseCheck &&
        numberCheck &&
        specialCharCheck
    );

    return (
        lengthCheck &&
        uppercaseCheck &&
        lowercaseCheck &&
        numberCheck &&
        specialCharCheck
    );
  }

  // Validation and input listeners
  emailInput.addEventListener("input", function () {
    const isValidEmail = emailRegex.test(emailInput.value);
    emailError.style.display = isValidEmail ? "none" : "block";
    validateForm();
  });

  newPasswordInput.addEventListener("input", function () {
    const isStrongPassword = checkPasswordStrength(newPasswordInput.value);
    passwordError.style.display = isStrongPassword ? "none" : "block";
    confirmPasswordInput.value = ""; // Reset confirm password when new password changes
    confirmPasswordError.style.display = "none";
    validateForm();
  });

  confirmPasswordInput.addEventListener("input", function () {
    const passwordsMatch =
        newPasswordInput.value === confirmPasswordInput.value;
    confirmPasswordError.style.display = passwordsMatch ? "none" : "block";
    validateForm();
  });

  function validateForm() {
    const isValidEmail = emailRegex.test(emailInput.value);
    const isStrongPassword = checkPasswordStrength(newPasswordInput.value);
    const passwordsMatch =
        newPasswordInput.value === confirmPasswordInput.value;

    resetButton.disabled = !(
        isValidEmail &&
        isStrongPassword &&
        passwordsMatch
    );
  }

  // Toggle password visibility
  document
      .getElementById("toggleNewPassword")
      .addEventListener("click", function () {
        const type = newPasswordInput.type === "password" ? "text" : "password";
        newPasswordInput.type = type;
        this.querySelector("i").classList.toggle("fa-eye-slash");
      });

  document
      .getElementById("toggleConfirmPassword")
      .addEventListener("click", function () {
        const type =
            confirmPasswordInput.type === "password" ? "text" : "password";
        confirmPasswordInput.type = type;
        this.querySelector("i").classList.toggle("fa-eye-slash");
      });

  // Form submission
  resetForm.addEventListener("submit", function (e) {
    e.preventDefault();

    // Show loading modal
    loadingModal.style.display = "flex";

    // Prepare data for FormData
    const formData = new FormData();
    formData.append("email", emailInput.value);
    formData.append("new_password", newPasswordInput.value);

    // Send reset password request with proper configuration
    fetch("controllers/reset_password.php", {
      method: "POST", // Ensure POST method
      body: formData,
      headers: {
        Accept: "application/json", // Expect JSON response
      },
    })
        .then((response) => {
          // Check if response is OK
          if (!response.ok) {
            throw new Error("Network response was not ok");
          }
          return response.json();
        })
        .then((data) => {
          loadingModal.style.display = "none";

          if (data.status === "success") {
            Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: 'Your password has been reset successfully.',
              confirmButtonText: 'OK',
            }).then(() => {
              window.location.href = "/login"; // Redirect to login page
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error!',
              text: data.message || 'Password reset failed',
              confirmButtonText: 'OK',
            });
          }
        })
        .catch((error) => {
          loadingModal.style.display = "none";
          console.error("Error:", error);
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'E-mail Not Exists!',
            confirmButtonText: 'OK',
          });
        });
  });

  // Modal close handlers
  document
      .getElementById("modalCloseSuccess")
      .addEventListener("click", function () {
        successModal.style.display = "none";
        window.location.href = "/login"; // Redirect to login page
      });

  document
      .getElementById("modalCloseError")
      .addEventListener("click", function () {
        errorModal.style.display = "none";
      });
});
