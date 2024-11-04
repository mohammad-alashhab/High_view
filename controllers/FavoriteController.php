<?php  require 'model/Faviorte.php';


class FavoriteController{

    protected $favoriteModel;
    public $id;

    public function __construct()
    {


        // Start the session if it hasn't been started yet
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Check if the user session exists and retrieve the user ID
        if (isset($_SESSION['user']) && isset($_SESSION['user']['id'])) {
            $this->id = $_SESSION['user']['id']; // Assign the user ID to the property
        } else {
            $this->id = null; // Set ID to null if the user is not logged in
            // Optional: Log or handle the absence of a user session
            // error_log("User session not found.");
        }

        // Initialize the favorite model
        $this->favoriteModel = new Faviorte(); // Assuming the model class is named Favorite
    }


    public function store()
    {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Retrieve the product ID from the POST data
        $productId = $_POST['product_id'] ?? null;

        if ($productId && $this->id) {  // Ensure both productId and userId are available
            // Check if the product is already in the wishlist to avoid duplicates
            $existingProduct = $this->favoriteModel->findByProductId($productId);

            if (!$existingProduct) {
                // Add the product to the wishlist with user ID
                $this->favoriteModel->addFavorite($this->id, $productId, $this->id);
                header("Location: /products?message=Product added to wishlist");
                exit();
            } else {
                // Handle duplicate product in the wishlist
                header("Location: /products?error=Product already in wishlist");
                exit();
            }
        } else {
            // Handle missing product ID or user ID in the request
            header("Location: /products?error=Failed to add product to wishlist");
            exit();
        }
    }







}






