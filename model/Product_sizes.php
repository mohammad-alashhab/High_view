<?php
require_once ('Model.php');
class Product_sizes extends Model
{
    public function  __construct(){
        parent::__construct("product_sizes"); ///////////to establish the db connection form the parent
    }

    public function getProductSize($product_id){
        $sql = "SELECT product_id,size FROM product_sizes WHERE product_id = :product_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);



    }
}