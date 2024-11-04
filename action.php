
<?php
require_once 'controllers/UserController.php';

$userController = new UserController();

if (isset($_POST['forgot'])) {
    $email = $_POST['email'];
    // Send the reset email
    $message = $userController->sendResetEmail($email);
    echo $message; // This can be changed to display a success or error message on the frontend.
}
?>
