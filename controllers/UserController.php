<?php
require_once 'model/User.php';
class UserController
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }
    public function showlogin()
    {
        require 'views/pages/login.php';
    }
    public function showresetcode()
    {
        require 'views/pages/resetcode.php';
    }
    public function showregister()
    {
        require 'views/pages/register.php';
    }
    public function showforgot()
    {
        require 'views/pages/forgot.php';
    }
    public function showreset()
    {
        require 'views/pages/reset.php';
    }
    public function showcontact()
    {
        require 'views/pages/contact.php';
    }
    public function registerUser()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Assuming you have sanitized your input data before this point
            $firstName = trim($_POST['first_name']);
            $lastName = trim($_POST['last_name']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);
            $password = $_POST['password']; // This is the plain password

            // Validate the data...

            // Hash the password before storing it
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Now, save the user to the database, using the hashed password
            $success = $this->user->createUser($firstName, $lastName, $email, $hashedPassword, $phone);

            if ($success) {
                echo json_encode(['success' => true, 'redirect' => '/login']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Registration failed.']);
            }
        }
    }
    public function loginUser()
    {
        // Check if session is already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Start the session if it hasn't been started yet
        }

        if (isset($_POST['user_email']) && isset($_POST['user_password'])) {
            $email = $_POST['user_email'];
            $password = $_POST['user_password'];

            // Verify if the user exists
            $user = $this->user->getUserByEmail($email);

            // Debugging output
            if (!$user) {
                echo json_encode([
                    'success' => false,
                    'message' => 'User not found.',
                ]);
                exit();
            }

            // Check if the password is correct
            if (password_verify($password, $user['password'])) { // Assume passwords are hashed
                $_SESSION['user'] = $user; // Store user info in the session
                $isLoggedIn = isset($_SESSION['user']);

                // Respond with success
                echo json_encode([
                    'success' => true,
                    'redirect' => '/', // Redirect URL
                ]);
                exit;
            } else {
                // Incorrect password
                echo json_encode([
                    'success' => false,
                    'message' => 'Incorrect password.', // Specific message for incorrect password
                ]);
                exit;
            }
        }

        // Handle the case where POST data is not set
        echo json_encode([
            'success' => false,
            'message' => 'Please provide both email and password.', // Message for missing data
        ]);
        exit();
    }
    public function logoutUser()

    {
        // Check if session is already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Start the session if it hasn't been started yet
        }

        // Destroy the session to log the user out
        session_destroy();

        // Redirect to the homepage
        header("Location: /");
        exit; // Ensure no further output is sent

    }
}
