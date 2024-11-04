<?php
require_once('Model.php');

class Orders extends Model
{
    public function __construct()
    {
        parent::__construct("orders"); // Establish the db connection from the parent
    }

    private function getOrderCount($status, $id)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) AS count FROM `orders` WHERE `order_status` = :status AND `user_id` = :id");
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

public function getOrders( $id){
    $stmt = $this->pdo->prepare("SELECT COUNT(*) AS count FROM `orders` WHERE  `user_id` = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'];
}
    public function getNumberOrders($id)
    {
        return $this->getOrderCount('%', $id); // Get total orders
    }

    public function getNumberDelivered($id)
    {
        return $this->getOrderCount('Delivered', $id);
    }

    public function getNumberCancelled($id)
    {
        return $this->getOrderCount('Cancelled', $id);
    }

    public function getNumberPending($id)
    {
        return $this->getOrderCount('Pending', $id);
    }

    public function getNumberProcessing($id)
    {
        return $this->getOrderCount('Processing', $id);
    }

    public function getNumberShipped($id)
    {
        return $this->getOrderCount('Shipped', $id);
    }




    public function getOrderDetails($id){
        $stmt = $this->pdo->prepare("
   SELECT 
    op.order_item_id,
    op.order_id,
    op.product_id,
    op.quantity,
    op.price_at_purchase,
    op.total AS order_item_total,
    p.id AS product_id,
    p.name AS product_name,
    p.price AS product_price,
    p.description AS product_description,
    p.category_id,
    p.stock,
    p.type_id,
    p.image_id,
    pi.front_view,
    o.order_id,
    o.user_id,
    o.order_total,
    o.order_status,
    o.payment_status,
    o.shipping_address,
    o.product_quantity,
    o.created_at AS order_created_at,
    o.updated_at AS order_updated_at
FROM 
    orders o
INNER JOIN 
    order_products op ON o.order_id = op.order_id
INNER JOIN 
    product p ON op.product_id = p.id
INNER JOIN 
    product_images pi ON p.id = pi.product_id
WHERE 
    o.user_id = :id;
");


    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




    public function onStatus($id, $status){
        $stmt = $this->pdo->prepare("
        SELECT 
            op.order_item_id,
            op.order_id,
            op.product_id,
            op.quantity,
            op.price_at_purchase,
            op.total AS order_item_total,
            p.id AS product_id,
            p.name AS product_name,
            p.price AS product_price,
            p.description AS product_description,
            p.category_id,
            p.stock,
            p.type_id,
            p.image_id,
            pi.front_view,
            o.order_id,
            o.user_id,
            o.order_total,
            o.order_status,
            o.payment_status,
            o.shipping_address,
            o.product_quantity,
            o.created_at AS order_created_at,
            o.updated_at AS order_updated_at
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
            AND o.order_status = :status
    ");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function orderCancel($id)
    {
        $stmt = "update orders set order_status = 'Cancelled' where order_id = :id";
        $stmt = $this->pdo->prepare($stmt);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }


    public function getLast($id) {
        $stmt = $this->pdo->prepare("SELECT MAX(order_id) AS highest_order_id FROM orders WHERE user_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['highest_order_id'];
    }

    public function saveOrder($orderData) {
        // Start a transaction
        $this->pdo->beginTransaction();

        try {
            // Insert into orders
            $stmt = $this->pdo->prepare("INSERT INTO orders (user_id, order_total, order_status, payment_status, shipping_address, product_quantity, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())");
            // Calculate total order value and quantity from items
            $totalOrderValue = 0;
            $totalProductQuantity = 0;
            foreach ($orderData['items'] as $item) {
                $totalOrderValue += $item['total']; // Assuming 'total' is included in item
                $totalProductQuantity += $item['quantity'];
            }

            $stmt->execute([$orderData['userId'], $totalOrderValue, 'pending', 'not_paid', $orderData['shipping_address'], $totalProductQuantity]);

            // Get the last inserted order ID
            $orderId = $this->pdo->lastInsertId();

            // Insert into order_products
            foreach ($orderData['items'] as $item) {
                $stmt = $this->pdo->prepare("INSERT INTO order_products (order_id, product_id, quantity, price_at_purchase, total, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())");
                $stmt->execute([$orderId, $item['product_id'], $item['quantity'], $item['price'], $item['total']]);
            }

            // Commit transaction
            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            // Rollback transaction on error
            $this->pdo->rollBack();
            return false;
        }
    }
}
