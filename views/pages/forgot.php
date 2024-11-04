<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <link rel="stylesheet" href="../../views/public/css/forgot.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
  <!-- Reset Password Form -->
  <div class="auth-container">
    <div class="auth-header">
      <h1>Reset Password</h1>
    </div>
    <form id="resetPasswordForm">
      <div class="input-box">
        <label for="email">Email</label>
        <i class="fas fa-envelope"></i>
        <input type="email" id="email" placeholder="Enter your email" required>
        <div id="emailError" class="error-message">Please enter a valid email address</div>
      </div>
      <div class="input-box">
        <label for="new-password">New Password</label>
        <i class="fas fa-lock"></i>
        <input type="password" id="new-password" placeholder="Enter new password" required>
        <button type="button" id="toggleNewPassword" class="toggle-password"><i class="fas fa-eye"></i></button>
        <div class="password-strength" id="passwordStrength">
          <div class="strength-bar"></div>
          <div class="strength-bar"></div>
          <div class="strength-bar"></div>
        </div>
        <div id="passwordError" class="error-message">Password must be at least 8 characters long and include uppercase, lowercase, number, and special character</div>
      </div>
      <div class="input-box">
        <label for="confirm-password">Confirm Password</label>
        <i class="fas fa-lock"></i>
        <input type="password" id="confirm-password" placeholder="Confirm new password" required>
        <button type="button" id="toggleConfirmPassword" class="toggle-password"><i class="fas fa-eye"></i></button>
        <div id="confirmPasswordError" class="error-message">Passwords do not match</div>
      </div>
      <button type="submit" id="resetButton" class="auth-button" disabled>Reset Password</button>
    </form>
    <div class="register-redirect">
      Remember your password? <a href="/login">Sign In</a>
    </div>
  </div>

  <!-- Success Modal -->
  <div id="successModal" class="modal">
    <div class="modal-content success">
      <i class="fas fa-check-circle"></i>
      <h2>Password Reset Successful</h2>
      <p>Your password has been successfully updated. You can now log in with your new password.</p>
      <button class="modal-close" id="modalCloseSuccess">Continue to Login</button>
    </div>
  </div>

  <!-- Error Modal -->
  <div id="errorModal" class="modal">
    <div class="modal-content error">
      <i class="fas fa-times-circle"></i>
      <h2>Password Reset Failed</h2>
      <p id="errorModalMessage">An error occurred while resetting your password. Please try again.</p>
      <button class="modal-close" id="modalCloseError">Try Again</button>
    </div>
  </div>

  <!-- Loading Modal -->
  <div id="loadingModal" class="modal">
    <div class="modal-content">
      <div class="loading-spinner"></div>
      <h2>Resetting Password</h2>
      <p>Please wait while we update your password...</p>
    </div>
  </div>
  <script src="../../views/public/js/forgot.js"></script>
</body>

</html>
