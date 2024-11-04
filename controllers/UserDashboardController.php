<?php
require 'model/User.php';
require 'model/Product.php';
require 'model/Faviorte.php';
require 'model/UserReviews.php';
require 'model/Contact.php';
require 'model/Orders.php';
//require 'model/CancellationFees.php';

class UserDashboardController
{
    public $id;

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->id = $_SESSION['user']['id'] ?? null;
    }

    public function show()
    {
        $user = new User();
        $users = $user->find($this->id);

        if ($users) {
            $_SESSION['firstName'] = $users['first_name'];
            $_SESSION['secondName'] = $users['last_name'];
            $_SESSION['img'] = $users['img'];
        }

        $product = new Product();
        $products = $product->getProducts();

        require 'views/user_profile/index.php';
    }

    public function showUser()
    {
        $user = new User();
        $userProfile = $user->find($this->id);

        require 'views/user_profile/profile.php';
    }

    public function showPrivacyPage() {
        require 'views/pages/securityAndPrivacy.php';
    }

    public function showHelpPage() {
        require 'views/pages/helpAndSupport.php';
    }

    public function showContactPage() {
        require 'views/user_profile/contact.php';
    }

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'first_name' => htmlspecialchars(trim($_POST['firstName'])),
                'last_name' => htmlspecialchars(trim($_POST['lastName'])),
                'email' => filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL),
                'phone' => htmlspecialchars(trim($_POST['phone'])),
                'city' => htmlspecialchars(trim($_POST['city'])),
                'district' => htmlspecialchars(trim($_POST['district'])),
                'street' => htmlspecialchars(trim($_POST['street'])),
                'building_num' => htmlspecialchars(trim($_POST['b_number'])),
            ];

            if (!empty(trim($_POST['newPassword']))) {
                $data['password'] = password_hash(trim($_POST['newPassword']), PASSWORD_DEFAULT);
            }

            $user = new User();
            $updateResult = $user->update($this->id, $data);

            $_SESSION['status'] = $updateResult ? 'success' : 'error';
            $_SESSION['message'] = $updateResult ? 'Edited successfully' : 'Error updating user';

            header('Location: /user/profile');
            exit;
        }
    }

    public function getFavorite() {
        $favorite = new Faviorte();
        $favorites = $favorite->getUserFavorites($this->id);
        require 'views/user_profile/fav.php';
    }


    public function showReview()
    {
        $review = new User_reviews();
        $reviews = $review->getReviewsByProductId($this->id);

        require 'views/user_profile/reviews.php';
    }

    public function showContact() {
        $contact = new Contact();
        $contacts = $contact->getContact($this->id);

        require "views/user_profile/contact.php";
    }

    public function showOrderHistory() {
        $orders = new Orders();
        $status = $_GET['status'] ?? null;

        $orderDetails = $status ? $orders->onStatus($this->id, $status) : $orders->getOrderDetails($this->id);

        $totalOrders = $orders->getOrders($this->id);
        $orderCounts = [
            'delivered' => $orders->getNumberDelivered($this->id),
            'cancelled' => $orders->getNumberCancelled($this->id),
            'pending' => $orders->getNumberPending($this->id),
            'processing' => $orders->getNumberProcessing($this->id),
            'shipped' => $orders->getNumberShipped($this->id),
        ];

        $ordersData = $this->formatOrdersData($orderDetails);

        require 'views/user_profile/orders.php';
    }

    private function formatOrdersData($orderDetails) {
        $ordersData = [];

        foreach ($orderDetails as $row) {
            $orderId = $row['order_id'];

            if (!isset($ordersData[$orderId])) {
                $ordersData[$orderId] = [
                    'order_id' => $row['order_id'],
                    'order_total' => $row['order_total'],
                    'order_status' => $row['order_status'],
                    'payment_status' => $row['payment_status'],
                    'shipping_address' => $row['shipping_address'],
                    'product_quantity' => $row['product_quantity'],
                    'created_at' => $row['order_created_at'],
                    'updated_at' => $row['order_updated_at'],
                    'items' => []
                ];
            }

            $ordersData[$orderId]['items'][] = [
                'product_id' => $row['product_id'],
                'product_name' => $row['product_name'],
                'quantity' => $row['quantity'],
                'price_at_purchase' => $row['price_at_purchase'],
                'order_item_total' => $row['order_item_total'],
                'product_price' => $row['product_price'],
                'front_view' => $row['front_view'],
            ];
        }

        return $ordersData;
    }

    public function cancelOrder($id, $status) {
        $order = new Orders();
        $order->orderCancel($id);

        $cancel = new CancellationFees();
        $feeAmounts = [
            'Delivered' => '15.00',
            'Shipped' => '10.00',
            'Pending' => '5.00',
            'Processing' => '5.00'
        ];

        if (isset($feeAmounts[$status])) {
            $data = [
                'fee_amount' => $feeAmounts[$status],
                'user_id' => $this->id,
                'status' => $status
            ];
            $cancel->create($data);
        }

        header('Location: /user/order');
        exit();
    }

}
