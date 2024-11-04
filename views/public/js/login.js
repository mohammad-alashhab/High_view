// Select the login form
const loginForm = document.querySelector("form");

loginForm.addEventListener("submit", async function (e) {
  e.preventDefault(); // Prevent the default form submission

  // Gather form data
  const formData = new FormData(loginForm);
  const email = formData.get("user_email");
  const password = formData.get("user_password");

  // Validate form data
  if (!email || !password) {
    Swal.fire(
        "Missing Information",
        "Please enter both email and password.",
        "warning"
    );
    return;
  }

  try {
    // Send the form data using fetch
    const response = await fetch("/login", {
      method: "POST",
      body: formData,
    });

    // Get response as text to check for errors
    const text = await response.text();
    console.log(text); // Log the full response text for debugging

    // Parse response if it was successful
    if (response.ok) {
      const data = JSON.parse(text); // Attempt to parse JSON

      if (data.success) {
        // Success popup and redirect
        Swal.fire({
          title: "Login Successful!",
          text: "Redirecting to your profile...",
          icon: "success",
          timer: 2000,
          showConfirmButton: false,
        });

        // Redirect after showing the SweetAlert
        setTimeout(() => {
          window.location.href = data.redirect || "/profile";
        }, 2500);
      } else {
        // Error popup for invalid credentials
        Swal.fire(
            "Login Failed",
            data.message || "Invalid email or password.",
            "error"
        );
      }
    } else {
      // Handle HTTP errors (like 404)
      console.error("Login Error: ", text);
      Swal.fire(
          "Error",
          "An unexpected error occurred. Please try again later.",
          "error"
      );
    }
  } catch (error) {
    // Show error popup for unexpected errors
    console.error("Login Error:", error);
    Swal.fire(
        "Error",
        "An unexpected error occurred. Please try again later.",
        "error"
    );
  }
});

// Google Sign-In function
function onGoogleSignIn(googleUser) {
  const profile = googleUser.getBasicProfile();
  const email = profile.getEmail();
  console.log("Email: " + email);

  // Here you can send the Google user data to your server for further processing
}

// Initialize Google sign-in
function googleLogin() {
  gapi.load("auth2", function () {
    gapi.auth2
        .init({
          client_id: "YOUR_GOOGLE_CLIENT_ID.apps.googleusercontent.com",
        })
        .then(function (auth2) {
          auth2.signIn().then(onGoogleSignIn);
        });
  });
}

// Toggle password visibility
function togglePassword() {
  const passwordField = document.getElementById('user_password');
  const toggleIcon = document.getElementById('togglePassword');
  if (passwordField.type === 'password') {
    passwordField.type = 'text';
    toggleIcon.classList.replace('fa-eye', 'fa-eye-slash');
  } else {
    passwordField.type = 'password';
    toggleIcon.classList.replace('fa-eye-slash', 'fa-eye');
  }
}
