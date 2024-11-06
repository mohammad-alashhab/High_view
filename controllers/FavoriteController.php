<?php
require 'model/Faviorte.php'; // Corrected the spelling of Favorite

class FavoriteController {
    protected $favoriteModel;
    public $id;

    public function __construct() {
        // Start the session if it hasn't been started yet
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Check if the user session exists and retrieve the user ID
        if ($this->isUserLoggedIn()) {
            $this->id = $_SESSION['user']['id']; // Assign the user ID to the property
        } else {
            $this->id = null; // Set ID to null if the user is not logged in
            error_log("User session not found."); // Optional log message
        }

        // Initialize the favorite model
        $this->favoriteModel = new Faviorte(); // Corrected model name
    }

    // Helper method to check if the user is logged in
    private function isUserLoggedIn() {
        return isset($_SESSION['user']) && isset($_SESSION['user']['id']);
    }

    public function store() {
        // Check if the user is logged in using the helper method
        if (!$this->isUserLoggedIn()) {
            // Redirect to login page if not logged in
            header("Location: /login?error=Please log in to add products to your wishlist");
            exit();
        }

        // Retrieve the product ID from the POST data
        $productId = $_POST['product_id'] ?? null;
        $userId = $this->id;

        if ($productId && $userId) {  // Ensure both productId and userId are available
            // Check if the product is already in the wishlist to avoid duplicates
            $existingProduct = $this->favoriteModel->findByProductId($productId, $userId);

            if (!$existingProduct) {
                // Add the product to the wishlist with user ID
<<<<<<< Updated upstream
                $this->favoriteModel->addFavorite($this->id, $productId, $this->id);
                header("Location: /category?message=Product added to wishlist");
                exit();
            } else {
                // Handle duplicate product in the wishlist
                header("Location: /category?error=Product already in wishlist");
                exit();
            }
        } else {
            // Handle missing product ID or user ID in the request
            header("Location: /category?error=Failed to add product to wishlist");
            exit();
=======
                $this->favoriteModel->addFavorite($userId, $productId,);
                header("Location: /products?message=Product added to wishlist");
                exit(); // Stop further execution
            } else {
                // Handle duplicate product in the wishlist
                header("Location: /products?error=Product already in wishlist");
                exit(); // Stop further execution
            }
        } else {
            // Handle missing product ID or user ID in the request
            header("Location: /products?error=Failed to add product to wishlist");
            exit(); // Stop further execution
>>>>>>> Stashed changes
        }
    }
}
