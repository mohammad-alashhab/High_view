<?php



$client = new Google\Client;

$client->setClientId("1006063154544-9rhbc2igqm7jjhnge5abt0nmrlnoreu1.apps.googleusercontent.com");
$client->setClientSecret("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");
$client->setRedirectUri("http://localhost:8888/auth/google/callback");

$client->addScope("email");
$client->addScope("profile");

$url = $client->createAuthUrl();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../../views/public/css/login-style.css">
  <link rel="stylesheet" href="../../views/public/css/google.css">
  <link rel="stylesheet" href="../../views/public/css/sweetAlert.css">

  <!-- Google API -->
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <meta name="google-signin-client_id" content="YOUR_GOOGLE_CLIENT_ID.apps.googleusercontent.com">

  <!-- SweetAlert2 CSS and JS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
<a href="/" class="home-button">Home</a>

  <div class="auth-container">
    <div class="auth-header">
      <h1>Welcome Back</h1>
    </div>

    <form action="/login" method="POST">
      <div class="input-box">
        <label for="user_email">Email address</label>
        <i class="fas fa-envelope"></i>
        <input type="email" id="user_email" name="user_email" placeholder="name@example.com">
      </div>

      <div class="input-box">
        <label for="user_password">Password</label>
        <i class="fas fa-lock"></i>
        <input type="password" id="user_password" name="user_password" placeholder="Enter your password">
        <i class="fas fa-eye toggle-password" onclick="togglePassword()" id="togglePassword"></i>
      </div>

<!--      <div class="options-link">-->
<!--        <a href="/forgot" class="link-forgot">Forgot password?</a>-->
<!--      </div>-->

      <button type="submit" class="auth-button">
        Sign In
      </button>

<!--      <div class="social-separator">Or continue with</div>-->
<!---->
<!--      <div class="social-options">-->
<!--        <button type="button" class="login-with-google-btn" onclick="window.location.href='-->
<!--      Sign in with Google-->
<!--     </button>-->
<!--     </div>-->

      <div class="register-redirect"><br>
        Don't have an account? <a href="/register">Register here</a>
      </div>
    </form>
  </div>

  <script src="../../views/public/js/login.js"></script>

</body>

</html>