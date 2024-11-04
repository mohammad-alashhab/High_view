<?php
require_once 'model/Cart.php';
require_once 'model/Coupon.php';
require_once 'model/Product.php';
require_once 'model/Orders.php';
require_once 'model/Order_products.php';
require_once 'model/User.php';
class ConfirmationController
{
    public $id;

    public function __construct() {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }


        if (isset($_SESSION['user'])) {
            // Assuming $_SESSION['user'] is an associative array with an 'id' key
            $this->id = $_SESSION['user']['id']; // Adjust as necessary
        } else {
            $this->id = null;
        }
    }

    public function getOrderInfo()
    {
        $cart = new Cart();
        $carts = $cart->getitems($this->id);

//        dd($cart);// Retrieve cart data based on the ID
        $order = new Orders();
        $orders = $order->getLast($this->id);  // Retrieve the last order data
        $user = new User();
        $users = $user->find($this->id);  // Retrieve user information

        require 'views/user/confirmation.php';
    }


    public function editUserInfo()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize and validate input data as needed
            $data = [
                'city' => htmlspecialchars(trim($_POST['city'])),
                'district' => htmlspecialchars(trim($_POST['district'])),
                'street' => htmlspecialchars(trim($_POST['street'])),
                'building_num' => htmlspecialchars(trim($_POST['building_num']))
            ];

            $user = new User();
            $updateResult = $user->update($this->id, $data);

            // Set feedback message for Toast notification
            if ($updateResult) {
                $_SESSION['status'] = 'success';
                $_SESSION['message'] = 'Edited successfully';
            } else {
                $_SESSION['status'] = 'error';
                $_SESSION['message'] = 'Error updating user';
            }

            // Optionally keep the old input values
            $_SESSION['input'] = $data; // Store input to repopulate the form
        }

        // Load the view again to show feedback
        header('Location: /confirmation');
        exit(); // Replace with your actual view file
    }

    public function confirmOrder() {
        // Assuming you have a way to gather the cart items
        $cart = new Cart();
        $cartItems = $cart->getitems($this->id); // Get cart items for the current user

        // Prepare order data
        $orderData = [
            'items' => $cartItems,
            'userId' => $this->id, // Use the user ID from the session
            // Add other necessary order details if required
        ];

        // Make a request to your server to save the order (you might call this function directly instead of using fetch)
        $order = new Orders();
        $result = $order->saveOrder($orderData); // You will need to create this method in your Orders model

        if ($result) {
            // Set session message for successful order confirmation
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'Order confirmed successfully!';
        } else {
            // Set session message for error
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = 'Error confirming order.';
        }

        // Redirect to confirmation page
        header('Location: /confirmation');
        exit();
    }





}