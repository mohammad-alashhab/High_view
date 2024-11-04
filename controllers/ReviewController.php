<?php require 'model/UserReviews.php';

class ReviewController {
    private $reviewModel;
    public $id;
    public function __construct() {
        $this->reviewModel = new User_reviews();

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['user']) && isset($_SESSION['user']['id'])) {
            $this->id = $_SESSION['user']['id']; // Adjust as necessary
        } else {
            $this->id = null;
            // Optional: Log or handle the absence of a user session
            // error_log("User session not found.");
        }
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'], $_POST['name'], $_POST['email'], $_POST['message'], $_POST['rate'])) {
            $productId = (int)$_POST['product_id'];
            $name = htmlspecialchars(trim($_POST['name']));
            $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
            $message = htmlspecialchars(trim($_POST['message']));
            $rate = (int)$_POST['rate'];

            if (!$name || !$email || !$message || $rate < 0 || $rate > 5) {
                header("Location: /product/{$productId}?error=Invalid input data");
                exit();
            }

            $data = [
                'product_id' => $productId,
                'user_id' => $this->id ?? null, // Use null if no user is logged in
                'name' => $name,
                'email' => $email,
                'review' => $message,
                'rate' => $rate
            ];

            if ($this->reviewModel->addReview($data)) {
                header("Location: /products?message=Review added successfully");
            } else {
                header("Location: /products?error=Failed to add review");
            }
            exit();
        } else {
            header("Location: /products?error=Invalid request");
            exit();
        }
    }


} // Add this closing brace to close the ReviewController class
