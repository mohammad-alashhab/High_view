document.addEventListener("DOMContentLoaded", function () {
  const resetButton = document.getElementById("resetButton");
  const emailInput = document.getElementById("email");

  // Function to validate email format
  function validateEmail(email) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
  }

  // Click event listener for reset button
  resetButton.addEventListener("click", function (e) {
    e.preventDefault();

    const email = emailInput.value.trim();

    // Validate email
    if (!validateEmail(email)) {
      Swal.fire({
        icon: "error",
        title: "Invalid Email",
        text: "Please enter a valid email address.",
      });
      return;
    }

    // Send request to backend
    fetch("../../controllers/reset_password.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ email: email }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          Swal.fire({
            icon: "success",
            title: "Email Sent!",
            text: "A reset link has been sent to your email address.",
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: data.message || "Failed to send reset link. Please try again.",
          });
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        Swal.fire({
          icon: "error",
          title: "Network Error",
          text: "An error occurred. Please try again later.",
        });
      });
  });
});
