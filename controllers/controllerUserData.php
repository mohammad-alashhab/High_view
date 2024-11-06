<?php
session_start();
require 'connection.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$email = "";
$name = "";
$errors = array();

// Email sending function using PHPMailer
function sendMail($recipientEmail, $subject, $messageBody) {
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hamza.t.a.altal@gmail.com'; 
        $mail->Password = 'akes iddq uhop afhe';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('HighView@gmail.com', 'HighView');
        $mail->addAddress($recipientEmail);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $messageBody;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Signup Process
if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    
    if ($password !== $cpassword) {
        $errors['password'] = "Confirm password does not match!";
    }
    
    $email_check = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);
    
    if (mysqli_num_rows($res) > 0) {
        $errors['email'] = "Email already exists!";
    }
    
    if (count($errors) === 0) {
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        
        $insert_data = "INSERT INTO usertable (name, email, password, code, status)
                        VALUES ('$name', '$email', '$encpass', '$code', '$status')";
        
        if (mysqli_query($con, $insert_data)) {
            $subject = "Email Verification Code";
            $message = "Your verification code is: $code";
            
            if (sendMail($email, $subject, $message)) {
                $_SESSION['info'] = "We've sent a verification code to your email - $email";
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: user-otp.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed while sending code!";
            }
        } else {
            $errors['db-error'] = "Failed while inserting data into database!";
        }
    }
}

// Email Verification Code Verification
if (isset($_POST['check'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    
    $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['email'];
        $update_status = "UPDATE usertable SET code = 0, status = 'verified' WHERE email = '$email'";
        
        if (mysqli_query($con, $update_status)) {
            $_SESSION['name'] = $fetch_data['name'];
            $_SESSION['email'] = $email;
            header('location: home.php');
            exit();
        } else {
            $errors['otp-error'] = "Failed to update verification status!";
        }
    } else {
        $errors['otp-error'] = "Invalid verification code!";
    }
}

// Login Process
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    
    $check_email = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con, $check_email);
    
    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        
        if (password_verify($password, $fetch['password'])) {
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $fetch['name'];
            
            if ($fetch['status'] == 'verified') {
                header('location: home.php');
                exit();
            } else {
                $code = rand(999999, 111111);
                $update_code = "UPDATE usertable SET code = $code WHERE email = '$email'";
                mysqli_query($con, $update_code);
                
                $subject = "Email Verification Code";
                $message = "Your verification code is: $code";
                
                if (sendMail($email, $subject, $message)) {
                    $_SESSION['info'] = "We've sent a verification code to your email - $email";
                    header('location: user-otp.php');
                    exit();
                } else {
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }
        } else {
            $errors['email'] = "Incorrect email or password!";
        }
    } else {
        $errors['email'] = "It seems you're not yet a member! Click on the bottom link to signup.";
    }
}

// Forgot Password Process
if (isset($_POST['check-email'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $check_email = "SELECT * FROM usertable WHERE email='$email'";
    $run_sql = mysqli_query($con, $check_email);
    
    if (mysqli_num_rows($run_sql) > 0) {
        $code = rand(999999, 111111);
        $insert_code = "UPDATE usertable SET code = $code WHERE email = '$email'";
        
        if (mysqli_query($con, $insert_code)) {
            $subject = "Password Reset Code";
            $message = "Your password reset code is: $code";
            
            if (sendMail($email, $subject, $message)) {
                $_SESSION['info'] = "We've sent a password reset code to your email - $email";
                $_SESSION['email'] = $email;
                header('location: reset-code.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed while sending code!";
            }
        } else {
            $errors['db-error'] = "Something went wrong!";
        }
    } else {
        $errors['email'] = "This email address does not exist!";
    }
}

// Reset Code Verification
if (isset($_POST['check-reset-otp'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['email'];
        $_SESSION['email'] = $email;
        $_SESSION['info'] = "Please create a new password.";
        header('location: new-password.php');
        exit();
    } else {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}

// Password Change Process
if (isset($_POST['change-password'])) {
    $_SESSION['info'] = "";
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    
    if ($password !== $cpassword) {
        $errors['password'] = "Confirm password does not match!";
    } else {
        $email = $_SESSION['email'];
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        
        $update_pass = "UPDATE usertable SET code = 0, password = '$encpass' WHERE email = '$email'";
        if (mysqli_query($con, $update_pass)) {
            $_SESSION['info'] = "Your password changed. Now you can login with your new password.";
            header('location: password-changed.php');
            exit();
        } else {
            $errors['db-error'] = "Failed to change your password!";
        }
    }
}

// Login Now Button Click
if (isset($_POST['login-now'])) {
    header('Location: login-user.php');
    exit();
}
?>