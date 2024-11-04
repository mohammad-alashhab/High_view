<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../../views/public/css/register-style.css">

    <!-- intl-tel-input CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.min.css">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../views/public/css/phone.css">

</head>

<body>
    <a href="/" class="home-button">Home</a>

    <div class="register-container">
        <div class="register-header">
            <h1>Create an Account</h1>
            <p>Sign up to get started</p>
        </div>

        <form action="/register" method="POST" id="registerForm">
            <div class="form-row">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-control" id="first_name" name="first_name">
                    <div class="validation-message" id="first-name-validation">First name should only contain letters and be 2-10 characters long</div>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-control" id="last_name" name="last_name">
                    <div class="validation-message" id="last-name-validation">Last name should only contain letters and be 2-10 characters long</div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <i class="fas fa-envelope"></i>
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                    <div class="validation-message" id="email-validation">Please enter a valid email address</div>
                </div>
                <div class="form-group eye-index">
                    <label for="phone">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="078XXXXXXX">
                    <div class="validation-message" id="phone-validation">Enter a valid phone number (8-15 digits)</div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">Password</label>
                    <i class="fas fa-lock"></i>
                    <input type="password" class="form-control" id="password" name="password">
                    <div class="strength-meter mt-2">
                        <div id="strength-meter-fill" class="strength-meter-fill"></div>
                    </div>
                    <p id="strength-text" class="strength-text"></p>
                    <div class="password-requirements">
                        <p class="requirement" id="length"><i class="fas fa-circles circles-icon"></i>8+ chars</p>
                        <p class="requirement" id="uppercase"><i class="fas fa-circles circles-icon"></i>Uppercase</p>
                        <p class="requirement" id="lowercase"><i class="fas fa-circles circles-icon"></i>Lowercase</p>
                        <p class="requirement" id="number"><i class="fas fa-circles circles-icon"></i>Number</p>
                        <p class="requirement" id="special"><i class="fas fa-circles circles-icon"></i>Special</p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <i class="fas fa-lock"></i>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                    <div class="validation-message" id="confirm-password-validation">Passwords do not match</div>
                    <p id="password-match" class="password-match-message"></p>
                </div>
            </div>

            <button type="submit" name="register" class="register-button">Register</button>

            <div class="login-link"><br>
                Already have an account? <a href="/login">Login here</a>
            </div>
        </form>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- intl-tel-input JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/utils.js"></script>
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <!-- Registration Validation Script -->
    <script src="../../views/public/js/register.js"></script>
    <script src="../../views/public/js/phone.js"></script>

</body>

</html>