
<?php
$email = $_SESSION['email'] ?? false; // Use null coalescing to avoid warnings
if (!$email) {
    header('Location:/login');
    exit(); // Always exit after a header redirect
}
$errors = []; // Ensure $errors is initialized

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Verification</title>
    <link rel="stylesheet" href="../views/public/css/resetcode.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body>
    <div class="auth-container">
        <div class="auth-header">
            <h1>Verify Your Email</h1>
            <p>We've sent a verification code to<br>
                <span class="email-display"><?php echo htmlspecialchars($email); ?></span>
            </p>
        </div>

        <?php
        if (isset($_SESSION['info'])) {
            echo '<div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    ' . $_SESSION['info'] . '
                  </div>';
        }
        if (count($errors) > 0) {
            echo '<div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    ';
            foreach ($errors as $showerror) {
                echo $showerror;
            }
            echo '</div>';
        }
        ?>

        <form action="reset-code.php" method="POST" autocomplete="off" id="verificationForm">
            <div class="verification-code">
                <input type="text" class="code-input" inputmode="numeric" pattern="[0-9]" maxlength="1" required>
                <input type="text" class="code-input" inputmode="numeric" pattern="[0-9]" maxlength="1" required>
                <input type="text" class="code-input" inputmode="numeric" pattern="[0-9]" maxlength="1" required>
                <input type="text" class="code-input" inputmode="numeric" pattern="[0-9]" maxlength="1" required>
                <input type="text" class="code-input" inputmode="numeric" pattern="[0-9]" maxlength="1" required>
                <input type="text" class="code-input" inputmode="numeric" pattern="[0-9]" maxlength="1" required>
            </div>

            <input type="hidden" name="otp" id="otp" required>

            <button type="submit" class="auth-button" name="check-reset-otp" id="verifyButton">
                <span class="loading-spinner"></span>
                <i class="fas fa-shield-alt"></i>
                Verify Code
            </button>
        </form>

        <div class="resend-code">
            <div class="timer" id="timer">
                <i class="fas fa-clock"></i>
                <span>:30</span>
            </div>
            <button type="button" id="resendButton" class="resend-button" disabled>
                <i class="fas fa-redo-alt"></i> Resend Code
            </button>
            <div class="login-link"><br>
                <a style="text-decoration: none;" href="/login">Login Here</a>
            </div>
        </div>
    </div>
    <script src="views/public/js/resetcode.js"></script>

</body>

</html>