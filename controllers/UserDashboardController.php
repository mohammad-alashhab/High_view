<?php
require 'model/User.php';
require 'model/Product.php';
require 'model/Faviorte.php';
require 'model/UserReviews.php';
require 'model/Contact.php';
require 'model/Orders.php';



class UserDashboardController
{
    public $id;

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->id = $_SESSION['user']['id'] ?? null;
    }


///////////////////////////////////

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

        $orders= new Orders();
        $orderDetails = $orders->getOrderDetails($this->id);
        $status = $_GET['status'] ?? null;


        $orderDetails = $status ? $orders->onStatus($this->id, $status) : $orders->getOrderDetails($this->id);

        $ordersCount=$this->getOrderCount($this->id);
        $orderDetails = $status ? $orders->onStatus($this->id, $status) : $orders->getOrderDetails($this->id);


        $formattedOrderData = $this->formatOrdersData($orderDetails);

//        dd($formattedOrderData);
        if (empty($formattedOrderData)) {

            $formattedOrderData = [];

        }



        $totalOrders = $ordersCount['total'];
        $deliveredOrders = $ordersCount['Delivered'];
        $cancelledOrders = $ordersCount['Cancelled'];
        $pendingOrders = $ordersCount['Pending'];
        $processingOrders = $ordersCount['Processing'];
        $shippedOrders = $ordersCount['Shipped'];


        $review = new User_reviews();
        $reviews = $review->getReviewsByProductId($this->id);

        $contact = new Contact();
        $contacts = $contact->getContact($this->id);

        require 'views/pages/newIndex.php';
    }


///////////////////////

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

            header('Location: /user');
            exit;
        }
    }



/////////////////////
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
                    'created_at' => $row['order_created_at'] ?? null, // Use order_created_at if created_at does not exist
                    'updated_at' => $row['order_updated_at'] ?? null, // Use order_updated_at if updated_at does not exist
                    'items' => []
                ];
            }
            $ordersData[$orderId]['items'] = $ordersData[$orderId]['items'] ?? [];
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


//////////////////////////////////////////////////////////

    public function showOrderHistory() {
        $orders = new Orders();
        $status = $_GET['status'] ?? null;

        // Fetch order details based on status, if available
        $orderDetails = $status ? $orders->onStatus($this->id, $status) : $orders->getOrderDetails($this->id);

        // Fetch counts of each order status



    }
/////////////////////////////////
    public function getOrderCount($id)
    {
        $order = new Orders();

        return [
            'total'=>$order->getOrders($id),
            'Delivered' => $order->getNumberDeliver($id),
            'Cancelled' => $order->getNumberCancel($id),
            'Pending' => $order->getNumberPend($id),
            'Processing' => $order->getNumberProcess($id),
            'Shipped' => $order->getNumberShip($id),

        ];
    }

///////////////////////////////////////
    public function cancelOrder($orderId) {
        $status = 'canceled';
        $result = $this->orderModel->update($orderId, ['status' => $status]);

        if ($result) {
            // Redirect to /user#nav-profile upon successful cancellation
            header('Location: /user');
            exit;
        } else {
            echo "Failed to cancel order #$orderId.";
        }
    }

//////////////////////////////////////////////////

public function getfavorite(){
      $favorite =new Faviorte();
      $favorites= $favorite->getUserFavorites($this->id);
      require 'views/user/fav.php';
}


}
