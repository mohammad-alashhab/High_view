<?php
require_once 'model/Model.php';

class Cart extends Model
{
    public $cart;

    public function __construct()
    {
        parent::__construct('cart_items');

    }
    public function getitems($user_id) {
        $query = "SELECT 
                `cart_items`.`id`, 
                `cart_items`.`user_id`, 
                `cart_items`.`product_id`, 
                `cart_items`.`quantity`, 
                `product`.`id` AS product_id, 
                `product`.`name`, 
                `product`.`price`, 
                `product`.`status`, 
                `product`.`stock` ,
                `product_images`.`front_view` AS image
              FROM `product` 
              INNER JOIN `cart_items` ON `cart_items`.`product_id`= `product`.`id` 
              Inner join `product_images` ON `product`.`id` = `product_images`.`product_id`
              WHERE `cart_items`.`user_id` = ? AND `product`.`status` = 'visible'";

        // Prepare and execute the query
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$user_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {
        if (!is_numeric($data)) {
            return; // Exit if $data is not a valid number
        }

        $sql = "UPDATE cart_items SET quantity = :quantity WHERE product_id = :product_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':quantity', $data);
        $stmt->bindValue(':product_id', $id);

        if ($stmt->execute()) {
            var_dump( "Updated product ID $id with quantity $data"); // Debugging output
        } else {
            echo "Failed to update product ID $id"; // Error handling
        }
    }
    public function addProductToCart($product_id, $quantity) {
        // Optional: Check if the product is already in the cart for the current session
        $sql = "INSERT INTO cart_items (product_id, quantity) VALUES (:product_id,:quantity)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);


        return $stmt->execute();
    }

    public function findByProductId($productId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->tableName} WHERE product_id = :product_id");
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateQuantity($productId, $quantity)
    {
        $stmt = $this->pdo->prepare("UPDATE {$this->tableName} SET quantity = :quantity WHERE product_id = :product_id");
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        return $stmt->execute();
    }


}
