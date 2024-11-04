<?php
require_once 'model/Cart.php';
require_once 'model/Coupon.php';
require_once 'model/Product.php';
require_once 'model/Orders.php';
require_once 'model/Order_products.php';
require_once 'model/User.php';
class OrdersController
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



}