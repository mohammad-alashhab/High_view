<?php
require_once ('Model.php');
class Product extends Model
{
    public function  __construct(){
        parent::__construct("product"); ///////////to establish the db connection form the parent
    }

    public function getProducts() {
        $stmt = $this->pdo->query("SELECT 
        `product`.`id`,
        `product`.`name`,
        `product`.`price`,
        `product`.`description`, 
        `product`.`stock`, 
        `product`.`status`,
        `product`.`type_id`, 
        `product`.`image_id`,
        `product`.`created_at`,
        `product_images`.`product_id`,
        `product_images`.`front_view`
    FROM  
        `product`
    INNER JOIN 
        `product_images` ON `product`.`id` = `product_images`.`product_id`
    WHERE 
        `product`.`stock` > 0 AND 
        `product`.`status` = 'visible'
    ORDER BY 
        `product`.`created_at` DESC 
    LIMIT 3");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBestSellers()
    {
        try {
            $sql = "SELECT p.id, c.name AS category_name, pi.front_view
                    FROM product p
                    JOIN category c ON p.category_id = c.id
                    JOIN product_images pi ON p.id = pi.product_id
                    ORDER BY p.total_rating DESC 
                    LIMIT 10";





            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return []; // Return an empty array on error
        }
    }

    public function getBestSellersProduct() {
        $query = "
             SELECT p.id, p.name,  p.price,  
                   COALESCE(d.newprice, p.price) AS newprice, 
                   pi.front_view 
            FROM product p
            LEFT JOIN product_images pi ON p.id = pi.product_id
            LEFT JOIN discount d ON p.id = d.id_product
            ORDER BY p.total_rating DESC  -- Assume sales_count column exists
            LIMIT 4;";  // Adjust the limit as needed
        return $this->pdo->query($query);
    }


    public function getRandomPackage()
    {
        $query = "SELECT p.*, pi.front_view 
                  FROM product p
                  JOIN product_images pi ON p.id = pi.product_id
                  WHERE p.is_package = 'yes' 
                  ORDER BY RAND() LIMIT 3";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRandomCategory()
    {
        $query = "SELECT * 
                  FROM category
                  ORDER BY RAND() LIMIT 3";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRandomDiscountProduct()
    {
        $query = "SELECT p.name,p.price, pi.front_view, d.newprice 
                  FROM discount d 
                  JOIN product p ON d.id_product = p.id 
                  JOIN product_images pi ON p.id = pi.product_id 
                  ORDER BY RAND() LIMIT 3";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRandomLatestProduct()
    {
        $query = "SELECT p.name, pi.front_view
                  FROM product p 
                  JOIN product_images pi ON p.id = pi.product_id 
                  ORDER BY p.created_at DESC 
                  LIMIT 4";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductsForSlider() {
        $query = "
            SELECT p.id,p.name, p.price, pi.front_view AS image,
                   COALESCE(d.newprice, p.price) AS new_price
            FROM product p
            JOIN product_images pi ON p.id = pi.product_id
            LEFT JOIN discount d ON p.id = d.id_product
            ORDER BY p.created_at DESC;
        ";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductDiscountExpiryDates() {
        $query = "
            SELECT p.id, d.enddate AS expiry_date
            FROM product p
            LEFT JOIN discount d ON p.id = d.id_product
            WHERE d.enddate IS NOT NULL
            ORDER BY p.created_at DESC;
        ";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function getComingProducts() {
        $query = "SELECT p.*, pi.front_view, d.newprice 
                  FROM product p 
                  JOIN product_images pi ON p.id = pi.product_id 
                  JOIN discount d ON p.id = d.id_product 
                  WHERE p.status = 'visible' 
                  ORDER BY p.created_at DESC 
                  LIMIT 4"; // Adjust LIMIT as needed
        return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLatestProducts() {
        $query = "SELECT p.*, pi.front_view, d.newprice 
                  FROM product p 
                  JOIN product_images pi ON p.id = pi.product_id 
                  LEFT JOIN discount d ON p.id = d.id_product 
                  WHERE p.status = 'visible' 
                  ORDER BY p.created_at DESC 
                  LIMIT 4"; // Adjust LIMIT as needed
        return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }


    public function orderByPrice(){
        $sql = "SELECT * FROM product ORDER BY price ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $product = $stmt->fetchAll();
        return $product;
    }
    public function orderBytimeNew(){
        $sql = "SELECT * FROM product ORDER BY id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $product = $stmt->fetchAll();
        return $product;
    }
    public function orderBytimeOld(){
        $sql = "SELECT * FROM product ORDER BY id ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $product = $stmt->fetchAll();
        return $product;
    }
    public function orderByCategory($categoryId) {
        $sql = "SELECT * FROM product WHERE category_id = :category_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getProductsByTypeId($typeId)
    {
        $sql='SELECT name,price FROM product WHERE type_id = :typeId';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':typeId', $typeId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




    public function getPaginatedProducts($limit, $offset) {
        $sql = "SELECT * FROM product LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAllProducts() {
        $sql = "SELECT COUNT(*) AS total FROM product";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }


    public function getDiscountedProducts()
    {
        $sql = 'SELECT product.id,product.name, product.price, product_images.front_view AS img, discount.newprice, discount.startdate, discount.enddate
                FROM product 
                INNER JOIN discount ON product.id = discount.id_product
                LEFT JOIN product_images ON product.id = product_images.product_id
                WHERE discount.startdate <= NOW() AND discount.enddate >= NOW() LIMIT 3';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getImageByProductId($productId)
    {
        $sql='SELECT front_view FROM product_images WHERE product_id = :product_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function searchProducts($query)
    {
        // Ensure $query is safe for the database
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE name LIKE :query OR description LIKE :query");
        $stmt->execute(['query' => '%' . $query . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}









