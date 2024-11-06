document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("verificationForm");
  const inputs = Array.from(document.querySelectorAll(".code-input"));
  const otpInput = document.getElementById("otp");
  const verifyButton = document.getElementById("verifyButton");
  const resendButton = document.getElementById("resendButton");
  const timerDisplay = document.querySelector("#timer span");
  const errorMessage = document.getElementById("errorMessage");
  
  let timeLeft = 30;
  let submitCount = 0;
  const MAX_ATTEMPTS = 5;
  const LOCKOUT_TIME = 300; // 5 minutes in seconds
  
  // Security measures
  let isLocked = false;
  let lockoutTimer = null;

  function showError(message) {
    if (errorMessage) {
      errorMessage.textContent = message;
      errorMessage.style.display = "block";
      setTimeout(() => {
        errorMessage.style.display = "none";
      }, 5000);
    }
  }

  function lockForm(duration) {
    isLocked = true;
    inputs.forEach(input => {
      input.disabled = true;
      input.value = "";
    });
    verifyButton.disabled = true;
    resendButton.disabled = true;

    let lockTimeLeft = duration;
    showError(`Too many attempts. Please wait ${Math.ceil(lockTimeLeft/60)} minutes.`);

    lockoutTimer = setInterval(() => {
      lockTimeLeft--;
      if (lockTimeLeft <= 0) {
        clearInterval(lockoutTimer);
        unlockForm();
      } else {
        showError(`Too many attempts. Please wait ${Math.ceil(lockTimeLeft/60)} minutes.`);
      }
    }, 1000);
  }

  function unlockForm() {
    isLocked = false;
    inputs.forEach(input => {
      input.disabled = false;
    });
    verifyButton.disabled = false;
    resendButton.disabled = false;
    submitCount = 0;
    errorMessage.style.display = "none";
  }

  // Input handling with enhanced validation
  inputs.forEach((input, index) => {
    // Handle input with improved validation
    input.addEventListener("input", (e) => {
      if (isLocked) return;

      const value = e.target.value;
      
      // Validate input is a single digit
      if (!/^\d?$/.test(value)) {
        input.value = "";
        return;
      }

      input.value = value;
      input.classList.remove("error");

      if (value) {
        // Move to next input
        if (index < inputs.length - 1) {
          inputs[index + 1].focus();
        }
      }

      // Update hidden input with sanitized value
      otpInput.value = inputs.map(input => input.value.replace(/[^0-9]/g, "")).join("");
    });

    // Enhanced keydown handling
    input.addEventListener("keydown", (e) => {
      if (isLocked) return;

      if (e.key === "Backspace") {
        if (!input.value && index > 0) {
          inputs[index - 1].focus();
          inputs[index - 1].value = "";
          e.preventDefault();
        }
      } else if (e.key === "ArrowLeft" && index > 0) {
        inputs[index - 1].focus();
        e.preventDefault();
      } else if (e.key === "ArrowRight" && index < inputs.length - 1) {
        inputs[index + 1].focus();
        e.preventDefault();
      }
    });

    // Enhanced paste handling with validation
    input.addEventListener("paste", (e) => {
      if (isLocked) return;

      e.preventDefault();
      const paste = (e.clipboardData || window.clipboardData).getData("text");
      const numbers = paste.match(/\d/g);

      if (numbers) {
        const validNumbers = numbers.slice(0, inputs.length);
        inputs.forEach((input, i) => {
          input.value = validNumbers[i] || "";
          input.classList.remove("error");
        });
        otpInput.value = inputs.map(input => input.value).join("");
        inputs[Math.min(validNumbers.length, inputs.length) - 1].focus();
      }
    });
  });

  // Enhanced timer functionality
  function updateTimer() {
    if (timeLeft <= 0) {
      resendButton.disabled = false;
      document.getElementById("timer").style.display = "none";
      return;
    }

    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;
    timerDisplay.textContent = `${String(minutes).padStart(2, "0")}:${String(seconds).padStart(2, "0")}`;
    timeLeft--;
    setTimeout(updateTimer, 1000);
  }

  // Initialize timer
  updateTimer();

  // Enhanced form submission with rate limiting and security checks
  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    if (isLocked) {
      showError("Please wait for the lockout period to end.");
      return;
    }

    const code = otpInput.value;

    // Validate code format
    if (!/^\d{6}$/.test(code)) {
      inputs.forEach((input, index) => {
        if (!input.value || !/^\d$/.test(input.value)) {
          input.classList.add("error");
        }
      });
      showError("Please enter a valid 6-digit code.");
      return;
    }

    submitCount++;
    if (submitCount >= MAX_ATTEMPTS) {
      lockForm(LOCKOUT_TIME);
      return;
    }

    verifyButton.disabled = true;
    const spinner = document.querySelector(".loading-spinner");
    spinner.style.display = "inline-block";

    try {
      // Simulate API call with proper error handling
      const response = await new Promise((resolve, reject) => {
        setTimeout(() => {
          // Example validation - in real implementation, this would be an API call
          if (code === "123456") {
            resolve({ success: true });
          } else {
            reject(new Error("Invalid verification code"));
          }
        }, 1500);
      });

      // Success handling
      inputs.forEach(input => {
        input.classList.remove("error");
        input.classList.add("success");
      });

      setTimeout(() => {
        window.location.href = "password-changed.php";
      }, 500);

    } catch (error) {
      inputs.forEach(input => {
        input.classList.add("error");
        input.value = "";
      });
      inputs[0].focus();
      showError(error.message || "Verification failed. Please try again.");
    } finally {
      verifyButton.disabled = false;
      spinner.style.display = "none";
    }
  });

  // Enhanced resend functionality with rate limiting
  let resendCount = 0;
  const MAX_RESEND = 3;
  
  resendButton.addEventListener("click", async () => {
    if (isLocked) return;

    resendCount++;
    if (resendCount >= MAX_RESEND) {
      showError("Maximum resend attempts reached. Please try again later.");
      resendButton.disabled = true;
      return;
    }

    resendButton.disabled = true;
    timeLeft = 120;
    document.getElementById("timer").style.display = "flex";
    updateTimer();

    try {
      // Simulate API call for resending code
      await new Promise((resolve) => setTimeout(resolve, 1000));
      showError("New verification code sent successfully.");
    } catch (error) {
      showError("Failed to resend code. Please try again.");
      resendButton.disabled = false;
    }
  });

  // Cleanup on page unload
  window.addEventListener("beforeunload", () => {
    if (lockoutTimer) {
      clearInterval(lockoutTimer);
    }
  });
});