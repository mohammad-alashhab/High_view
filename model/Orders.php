<?php
require_once('Model.php');

class Orders extends Model
{
    public $shippingaddress;

    public function __construct()
    {
        parent::__construct("orders"); // Establish the db connection from the parent
        $this->shippingaddress=$_SESSION['user']['street'] . ',' . $_SESSION['user']['city'] . ',' .$_SESSION['user']['district'] .','.$_SESSION['user']['building_num'];

    }



    // Retrieves count of orders based on a specific status
    private function getOrderCount($status, $id)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) AS count FROM `orders` WHERE `order_status` LIKE :status AND `user_id` = :id");
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public function getOrders($id)
    {
        return $this->getOrderCount('%', $id); // Get total orders for the user
    }

    public function getNumberDeliver($id)
    {
        return $this->getOrderCount('Delivered', $id);
    }

    public function getNumberCancel($id)
    {
        return $this->getOrderCount('Cancelled', $id);
    }

    public function getNumberPend($id)
    {
        return $this->getOrderCount('Pending', $id);
    }

    public function getNumberProcess($id)
    {
        return $this->getOrderCount('Processing', $id);
    }

    public function getNumberShip($id)
    {
        return $this->getOrderCount('Shipped', $id);
    }

    public function getOrderDetails($id)
    {
        $stmt = $this->pdo->prepare("
            SELECT 
                op.order_item_id, op.order_id, op.product_id, op.quantity, op.price_at_purchase,
                op.total AS order_item_total, p.id AS product_id, p.name AS product_name, 
                p.price AS product_price, pi.front_view, o.order_id, o.user_id, o.order_total, 
                o.order_status, o.payment_status, o.shipping_address, o.product_quantity,
                o.created_at AS order_created_at, o.updated_at AS order_updated_at
            FROM 
                orders o
            INNER JOIN 
                order_products op ON o.order_id = op.order_id
            INNER JOIN 
                product p ON op.product_id = p.id
            INNER JOIN 
                product_images pi ON p.id = pi.product_id
            WHERE 
                o.user_id = :id
        ");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function onStatus($id, $status)
    {
        $stmt = $this->pdo->prepare("
            SELECT 
                op.order_item_id, op.order_id, op.product_id, op.quantity, op.price_at_purchase,
                op.total AS order_item_total, p.id AS product_id, p.name AS product_name, 
                p.price AS product_price, pi.front_view, o.order_id, o.user_id, o.order_total, 
                o.order_status, o.payment_status, o.shipping_address, o.product_quantity,
                o.created_at AS order_created_at, o.updated_at AS order_updated_at
            FROM 
                orders o
            INNER JOIN 
                order_products op ON o.order_id = op.order_id
            INNER JOIN 
                product p ON op.product_id = p.id
            INNER JOIN 
                product_images pi ON p.id = pi.product_id
            WHERE 
                o.user_id = :id AND o.order_status = :status
        ");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function orderCancel($id)
    {
        $stmt = $this->pdo->prepare("UPDATE orders SET order_status = 'Cancelled' WHERE order_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getLast($id)
    {
        $stmt = $this->pdo->prepare("SELECT MAX(order_id) AS highest_order_id FROM orders WHERE user_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['highest_order_id'];
    }

    public function saveOrder($orderData , $total)
    {
        // Start a transaction
        $this->pdo->beginTransaction();

        try {
            // Calculate total order value and quantity from items
            $totalOrderValue = array_sum(array_column($orderData['items'], 'total')); // Sum of all item totals
            $totalProductQuantity = array_sum(array_column($orderData['items'], 'quantity')); // Sum of all item quantities

            // Insert into orders table with additional fields
            $stmt = $this->pdo->prepare(
                "INSERT INTO orders (user_id, order_total, order_status, payment_status, shipping_address, product_quantity, created_at, updated_at, order_status_id, payment_status_id) 
            VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW(), ?, ?)"
            );

            // Execute with values including order_status_id and payment_status_id
            $stmt->execute([
                $orderData['userId'],
                $total,
                'pending', // Order status as a placeholder
                'not_paid', // Payment status as a placeholder
                $orderData['shipping_address'],
                $totalProductQuantity,
                $orderData['order_status_id'] ?? 1, // Default order_status_id if not set
                $orderData['payment_status_id'] ?? 1 // Default payment_status_id if not set
            ]);

            // Get the last inserted order ID
            $orderId = $this->pdo->lastInsertId();

            // Insert each item into order_products table
            foreach ($orderData['items'] as $item) {
                $totalProductPrice = $item['quantity'] * $item['price']; // Calculate total price for the current product
                $stmt = $this->pdo->prepare(
                    "INSERT INTO order_products (order_id, product_id, quantity, price_at_purchase, total, created_at, updated_at) 
                VALUES (?, ?, ?, ?, ?, NOW(), NOW())"
                );
                $stmt->execute([
                    $orderId,
                    $item['product_id'],
                    $item['quantity'],
                    $item['price'],
                    $totalProductPrice
                ]);
            }
         $this->deleteCart( $orderData['userId']);
            // Commit transaction
            $this->pdo->commit();
            return $orderId; // Return the order ID for reference
        } catch (Exception $e) {
            // Rollback transaction on error
            $this->pdo->rollBack();
            return false;
        }
    }

    public function deleteCart($userId) {
        $stmt = $this->pdo->prepare("DELETE FROM cart_items WHERE user_id = :id");
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }



}
