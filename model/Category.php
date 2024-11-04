<?php
require_once ('Model.php');
class Category extends Model
{
    public function  __construct(){
        parent::__construct("category"); ///////////to establish the db connection form the parent
    }
    public function getCategoryName($id) {
        $sql='SELECT category.name 
        FROM product 
        JOIN category ON product.category_id = category.id 
        WHERE product.id = :product_id';

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); ;
    }
}