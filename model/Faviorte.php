<?php
require_once ('Model.php');
class Faviorte extends Model
{


    public function __construct()
    {
        parent::__construct("favorite"); ///////////to establesh the db connection form the parent
    }
public $id=9;
    public function getUserFavorites($userId)
    {
        // SQL query to retrieve favorite products with details for a specific user
        $sql = "
        SELECT 
            product.id AS product_id,  
            product.name AS product_name, 
            product.price, 
            product.category_id, 
            product.total_rating, 
            product.type_id,
            product_images.front_view, 
            product_images.side_view, 
            product_images.back_view, 
            category.name AS category_name,
            favorite.user_id, 
            favorite.product_id AS favorite_product_id
        FROM product
        INNER JOIN product_images 
            ON product.image_id = product_images.id
        INNER JOIN category
            ON product.category_id = category.id
        INNER JOIN favorite
            ON product.id = favorite.product_id
        WHERE favorite.user_id = :user_id;
    ";

        // Prepare the statement
        $stmt = $this->pdo->prepare($sql);

        // Bind the user ID parameter
        $stmt->bindParam(':user_id', $this->id, PDO::PARAM_INT);
//        dd($this->id);

        // Execute the statement
        $stmt->execute();

        // Fetch and return all results
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




    public function getFavoriteWithProductDetails()
    {
        $stmt = $this->pdo->prepare("
            SELECT favorite.*, product.name, product.description, product.price 
            FROM {$this->tableName} 
            JOIN product ON favorite.product_id = product.id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Check if a product is already in the wishlist
    public function findByProductId($productId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->tableName} WHERE product_id = :product_id");
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function addFavorite($userId, $productId, $createdBy)
    {
        // SQL query to insert a new favorite into the `favorite` table
        $sql = "INSERT INTO {$this->tableName} (user_id, product_id, created_by, created_at, updated_at) 
            VALUES (:user_id, :product_id, :created_by, NOW(), NOW())";

        // Prepare the statement
        $stmt = $this->pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->bindParam(':created_by', $createdBy, PDO::PARAM_INT);

        // Execute the statement
        return $stmt->execute();
    }


}