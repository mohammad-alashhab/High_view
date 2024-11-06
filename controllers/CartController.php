<?php
require_once 'model/Cart.php';
require_once 'model/Coupon.php';
require_once 'model/Product.php';

class CartController
{
    protected $cartModel;
    public $id;

    public function __construct(){
        $this->cartModel = new Cart();

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->id = isset($_SESSION['user']) ? $_SESSION['user']['id'] : null;
    }

    private function checkLogin() {
        if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn']) {
            header("Location: /login?error=Please log in to continue");
            exit();
        }
    }

    public function showCart()
    {
        $this->checkLogin(); // Ensure user is logged in
        $cart_items = $this->cartModel->getItems($this->id);
        $subtotal = 0;

        foreach ($cart_items as $item) {
            if ($item['status'] == 'visible') {
                $subtotal += $item['price'] * $item['quantity'];
            }
        }

        require 'views/products/cart.view.php';
    }

    public function deleteFromCart($id)
    {
        $this->checkLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = intval($id);

            if ($this->cartModel->delete($productId)) {
                $_SESSION['message'] = "Item successfully deleted from the cart.";
            } else {
                $_SESSION['error'] = "Failed to delete item from the cart.";
            }
        }

        header("Location: /cart");
        exit();
    }

    public function applyCoupon()
    {
        $this->checkLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['action']) && $_POST['action'] === 'close_coupon') {
                unset($_SESSION['discount'], $_SESSION['coupon_code']);
                $_SESSION['message'] = "Coupon closed successfully.";
                header("Location: /cart");
                exit();
            }

            if (isset($_POST['coupon_code'])) {
                $couponCode = trim($_POST['coupon_code']);
                $coupon = new Coupon();
                $valid = $coupon->couponValid($couponCode);

                if (!empty($valid)) {
                    $_SESSION['discount'] = $valid['percentage'];
                    $_SESSION['coupon_code'] = $couponCode;
                    header("Location: /cart");
                    exit();
                } else {
                    $_SESSION['error'] = "Invalid coupon code.";
                    header("Location: /cart");
                    exit();
                }
            }
        }
    }

    public function store()
    {
        $this->checkLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'], $_POST['quantity'])) {
            $productId = (int)$_POST['product_id'];
            $quantity = (int)$_POST['quantity'];
            $productDetails = (new Product())->find($productId);

            if (!$productDetails) {
<<<<<<< Updated upstream
                // Product not found
                header("Location: /category?error=Product not found");
                exit();
            }

            $stock = $productDetails['stock'];

            // Validate the quantity
            if ($quantity > 0 && $quantity <= $stock) {
                // Check if the product is already in the cart
                $existingProduct = $this->cartModel->findByProductId($productId);
    
                if (!$existingProduct) {
                    // If not in cart, add it with the specified quantity
                    
                    $this->cartModel->addProductToCart($productId, $quantity);
                    header("Location: /category?message=Product added to your cart");
                    exit();
                } else {
                    $newQuantity = $existingProduct['quantity'] + $quantity;

                    // If already in cart, update the quantity with the new quantity
                    $this->cartModel->updateQuantity($productId, $newQuantity); // Set the quantity directly to the new one
                    header("Location: /category?message=Cart updated successfully");
                    exit();
                }
        } else {
            // Handle invalid request
            header("Location: /category?error=Failed to add product to your cart");
=======
                header("Location: /products?error=Product not found");
                exit();
            }

            if ($quantity > 0 && $quantity <= $productDetails['stock']) {
                $this->cartModel->addProductToCart($productId, $quantity, $_SESSION['user']['id']);
                header("Location: /products?message=Product added to your cart");
                exit();
            } else {
                header("Location: /products?error=Quantity exceeds stock available");
                exit();
            }
        } else {
            header("Location: /products?error=Failed to add product to your cart");
>>>>>>> Stashed changes
            exit();
        }
    }

    public function updateCart()
    {
        $this->checkLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['qty']) && is_array($_POST['qty'])) {
            $updated = false;

            foreach ($_POST['qty'] as $product_id => $quantity) {
                if (is_numeric($quantity) && $quantity > 0) {
                    $this->cartModel->update($product_id, (int)$quantity);
                    $updated = true;
                } else {
                    $_SESSION['error'] = "Invalid quantity for product ID: $product_id.";
                    header("Location: /cart");
                    exit();
                }
            }

            $_SESSION['message'] = $updated ? "Cart updated successfully." : "No valid quantities were provided for update.";
            header("Location: /cart");
            exit();
        } else {
            $_SESSION['error'] = "No quantities provided for update.";
            header("Location: /cart");
            exit();
        }
    }
}
}
