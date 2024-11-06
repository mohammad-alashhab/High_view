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
public $shippingaddress;

    public function __construct() {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }


        if (isset($_SESSION['user'])) {
            // Assuming $_SESSION['user'] is an associative array with an 'id' key
            $this->id = $_SESSION['user']['id']; // Adjust as necessary
            $this->shippingaddress=$_SESSION['user']['street'] . ',' . $_SESSION['user']['city'] . ',' .$_SESSION['user']['district'] .','.$_SESSION['user']['building_num'];

//            dd($orderTotal);
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
                'district' => htmlspecialchars(trim($_POST['country'])), // Corrected from district to country
                'street' => htmlspecialchars(trim($_POST['street'])),
                'building_num' => htmlspecialchars(trim($_POST['building_num']))
            ];

            $user = new User();
            $updateResult = $user->update($this->id, $data);


            // Set feedback message for Toast notification
            if ($updateResult) {
                $_SESSION['status'] = 'success';
                $_SESSION['message'] = 'Address updated successfully';
            } else {
                $_SESSION['status'] = 'error';
                $_SESSION['message'] = 'Error updating address';
            }

            // Store input to repopulate the form in case of error
            $_SESSION['input'] = $data;

            // Redirect to the confirmation page to display the message
            header('Location: /confirmation');
            exit(); // Replace with your actual view file
        }
    }

    public function confirmOrder() {
        if (isset($_POST['submit'])) {
            // Assuming you have a way to gather the cart items
            $cart = new Cart();
            $cartItems = $cart->getItems($this->id);

            if (empty($cartItems)) {
                $_SESSION['status'] = 'error';
                $_SESSION['message'] = 'Your cart is empty!';
                header('Location: /cart');
                exit();
            }

            $orderData = [
                'userId' => $this->id,
                'shipping_address' => $this->shippingaddress,
                'total' => $this->calculateTotal($cartItems),
                'quantity' => $_POST['quantity'],
                'items' => $cartItems
            ];

            $order = new Orders();
            $orderId = $order->saveOrder($orderData, $this->calculateTotal($cartItems));

            if ($orderId) {
                $_SESSION['status'] = 'success';
                $_SESSION['orderDetails'] = [
                    'order_id' => $orderId,
                    'total' => $orderData['total'],
                    'items' => $cartItems,
                    'shipping_address' => $orderData['shipping_address']
                ];
            } else {
                $_SESSION['status'] = 'error';
                $_SESSION['message'] = 'Error confirming order.';
            }

            header('Location: /confirmation');
            exit();
        }
    }




// Assuming you have a method to calculate the total order price
    private function calculateTotal($cartItems) {
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['quantity'] * $item['price']; // Calculate total price for each item
        }
        return $total;
    }





}