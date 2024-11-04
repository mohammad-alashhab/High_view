<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ensure headers are sent before any output
header('Content-Type: application/json');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// Database connection parameters
$host = 'localhost';
$dbname = 'e_commerce';
$username = 'root';
$password = '';

// Response function
function sendResponse($status, $message = '') {
    http_response_code($status === 'error' ? 400 : 200);
    echo json_encode([
        'status' => $status,
        'message' => $message
    ]);
    exit();
}

// Debug logging function
function logError($message) {
    error_log($message);
}

// Input validation
// Added explicit POST method check and log
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    logError('Invalid request method: ' . $_SERVER['REQUEST_METHOD']);
    sendResponse('error', 'Invalid request method');
}

// Validate POST data
if (!isset($_POST['email']) || !isset($_POST['new_password'])) {
    logError('Missing required POST parameters');
    sendResponse('error', 'Missing required parameters');
}

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$new_password = $_POST['new_password'];

// Validate inputs
if (!$email) {
    logError('Invalid email address');
    sendResponse('error', 'Invalid email address');
}

// Password strength validation
if (strlen($new_password) < 8 ||
    !preg_match('/[A-Z]/', $new_password) ||
    !preg_match('/[a-z]/', $new_password) ||
    !preg_match('/[0-9]/', $new_password) ||
    !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $new_password)
) {
    logError('Password does not meet complexity requirements');
    sendResponse('error', 'Password does not meet complexity requirements');
}

try {
    // Create database connection with error handling
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if email exists
    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        logError('Email not found: ' . $email);
        sendResponse('error', 'Email not found');
    }

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_ARGON2ID);

    // Update password in database
    $stmt = $pdo->prepare('UPDATE users SET password = :password, updated_at = NOW() WHERE email = :email');
    $result = $stmt->execute([
        'password' => $hashed_password,
        'email' => $email
    ]);

    if (!$result) {
        logError('Failed to update password for email: ' . $email);
        sendResponse('error', 'Failed to update password');
    }

    // Log password reset event
    $stmt = $pdo->prepare('INSERT INTO password_reset_log (user_id, email, reset_timestamp) VALUES (:user_id, :email, NOW())');
    $stmt->execute([
        'user_id' => $user['id'],
        'email' => $email
    ]);

    // Success response
    sendResponse('success', 'Password successfully updated');

} catch (PDOException $e) {
    logError('Database Error: ' . $e->getMessage());
    sendResponse('error', 'Database error occurred');
} catch (Exception $e) {
    logError('Unexpected Error: ' . $e->getMessage());
    sendResponse('error', 'An unexpected error occurred');
}