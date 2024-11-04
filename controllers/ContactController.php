<?php
require "model/Contact.php";
class ContactController
{
    public function showContact() {
        require "views/pages/contact.view.php";
    }

    public function submitMessage() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            if (empty($name) || empty($email) || empty($subject) || empty($message)) {
                header("Location: /contact?status=validation_error");
                exit();
            }

            $contactModel = new Contact();
            $success = $contactModel->saveContact($name, $email, $subject, $message);

            if ($success) {
                header("Location: /contact?status=success");
            } else {
                header("Location: /contact?status=error");
            }
        }
    }
}