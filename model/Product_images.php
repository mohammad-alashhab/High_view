<?php
require_once ('Model.php');
class Product_images extends Model
{
    public function  __construct(){
        parent::__construct("product_images"); ///////////to establish the db connection form the parent
    }

    public function getProductImg($product_id){
        $sql = "SELECT product_id,front_view , back_view , side_view FROM product_images WHERE product_id = :product_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);



    }
}