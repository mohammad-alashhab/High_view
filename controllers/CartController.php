<?php
require_once 'model/Cart.php';
require_once 'model/Coupon.php';
require_once 'model/Product.php';


class CartController
{
    protected $cartModel;

    public function __construct(){
        $this->cartModel = new Cart();


            // Start the session if it hasn't been started yet
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            // Set the user ID from the session
            $this->id = isset($_SESSION['user']) ? $_SESSION['user']['id'] : null; // Ensure you access the correct key for user ID
//dd($this->id);
    }
    public $id ; // Assume this represents the user ID; modify as needed

    public function showCart()
    {
        $cart = new Cart();
        $cart_items = $cart->getItems($this->id); // Assuming $this->id is the user ID or cart ID

        $subtotal = 0; // Initialize subtotal

        // Calculate subtotal
        foreach ($cart_items as $item) {
            if ($item['status'] == 'visible') { // Ensure the item is visible
                $totalPrice = $item['price'] * $item['quantity']; // Calculate total price for the item
                $subtotal += $totalPrice; // Accumulate subtotal
            }
        }

        // Pass data to the view
        require 'views/products/cart.view.php';
    }

    public function deleteFromCart($id)
    {
        error_log("Delete from cart method reached.");

        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cartModel = new Cart();

            // Check if product_id is provided
            if (isset($_POST['product_id'])) {
                $productId = intval($_POST['product_id']); // Sanitize input

                // Attempt to delete the item from the cart
                if ($cartModel->delete($productId)) {
                    // Set a success message
                    $_SESSION['message'] = "Item successfully deleted from the cart.";
                } else {
                    // Log the failure
                    error_log("Failed to delete item from cart for product ID: $productId");
                    $_SESSION['error'] = "Failed to delete item from the cart.";
                }
            } else {
                // Log missing product ID
                error_log("No product ID provided in deleteFromCart method.");
                $_SESSION['error'] = "No product ID provided.";
            }
        } else {
            // Log unexpected request method
            error_log("Unexpected request method: " . $_SERVER['REQUEST_METHOD']);
        }

        // Redirect back to the cart page after handling the request
        header("Location: /cart"); // Adjust the path as necessary
        exit();
    }

    public function applyCoupon()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['action']) && $_POST['action'] === 'close_coupon') {
                // Clear the coupon session variable
                unset($_SESSION['discount']);
                unset($_SESSION['coupon_code']); // Optionally clear coupon code if stored
                $_SESSION['message'] = "Coupon closed successfully.";
                header("Location: /cart");
                exit();
            }

            if (isset($_POST['coupon_code'])) {
                $couponCode = trim($_POST['coupon_code']); // Sanitize input
                $coupon = new Coupon();

                // Validate the coupon code
                $valid = $coupon->couponValid($couponCode);
                if (!empty($valid)) {
                    // Get the discount percentage from the valid coupon
                    $_SESSION['discount'] = $valid['percentage']; // Assuming 'percentage' is the column name
                    $_SESSION['coupon_code'] = $couponCode; // Optionally store the coupon code
                    header("Location: /cart"); // Redirect to the cart page after applying the coupon
                    exit();
                } else {
                    // Handle invalid coupon
                    $_SESSION['error'] = "Invalid coupon code.";
                    header("Location: /cart"); // Redirect back to the cart page
                    exit();
                }
            }
        }
    }
    public function updateCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//            dd($_POST); // Debug line to inspect posted data

            if (isset($_POST['qty']) && is_array($_POST['qty'])) {
                $cart = new Cart();
                $quantities = $_POST['qty'];

                foreach ($quantities as $product_id => $quantity) {
                    if (is_numeric($quantity) && $quantity > 0) {
                        var_dump( "Updating product ID: $product_id with quantity: $quantity\n"); // Debug output
                        $cart->update($product_id, (int)$quantity);
                    }
                }


                // Optionally, set a success message
                $_SESSION['message'] = "Cart updated successfully.";
                header("Location: /cart"); // Adjust the path as necessary
                exit();
//            } else {
//                $_SESSION['error'] = "No quantities provided.";
//                header("Location: /cart");
//                exit();
            }
        } else {
            header("Location: /cart");
            exit();
        }
    }

    public function store() {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if the user is logged in


        // Ensure the form was submitted via POST and required fields are set
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'], $_POST['quantity'])) {
            $productId = (int) $_POST['product_id'];
            $quantity = (int) $_POST['quantity'];

            // Get the product to check its stock
            $product = new Product();
            $productDetails = $product->find($productId);

            if (!$productDetails) {
                // Product not found
                header("Location: /products?error=Product not found");
                exit();
            }

            $stock = $productDetails['stock'];

            // Validate the quantity
            if ($quantity > 0 && $quantity <= $stock) {
                // Directly add the product to the cart with the specified quantity
                $this->cartModel->addProductToCart($productId, $quantity);
                header("Location: /products?message=Product added to your cart");
                exit();
            } else {
                // Handle invalid quantity
                header("Location: /products?error=Quantity exceeds stock available");
                exit();
            }
        } else {
            // Handle invalid request
            header("Location: /products?error=Failed to add product to your cart");
            exit();
        }
    }





}
