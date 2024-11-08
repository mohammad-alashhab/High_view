<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../views/public/css/forgot.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <title>Reset Password</title>
</head>

<body>
  <div class="auth-container">
    <div class="auth-header">
      <h1>Reset Password</h1>
    </div>
    <div class="input-box">
      <label for="email">Email</label>
      <i class="fas fa-envelope"></i>
      <input type="email" id="email" placeholder="Enter your email" required>
    </div>
    <button class="auth-button" id="resetButton">Reset Password</button>
    <div class="register-redirect"><br>
      <p>Remember your password? <a href="/login">Login here</a></p>
    </div>
  </div>

  <script src="../../views/public/js/forgot.js"></script>
</body>
</html>
