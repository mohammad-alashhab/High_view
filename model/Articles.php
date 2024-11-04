<?php
require_once ('Model.php');
class Articles extends Model
{
    public function  __construct(){
        parent::__construct("articles"); ///////////to establish the db connection form the parent
    }

    public function getPaginatedArticles($limit, $offset) {
        $sql = "SELECT * FROM articles LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);

        // Debugging
//        echo "Limit: " . $limit . ", Offset: " . $offset . "\n"; // Debugging line
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            print_r($stmt->errorInfo()); // Print any errors
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function countAllArticles() {
        $sql = "SELECT COUNT(*) AS total FROM articles";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    public function views($newViewCount, $articleId) {
        $updateQuery = "UPDATE articles SET views = :views WHERE id = :id";
        $updateStmt = $this->pdo->prepare($updateQuery);

        // Bind parameters
        $updateStmt->bindValue(':views', $newViewCount, PDO::PARAM_INT);
        $updateStmt->bindValue(':id', $articleId, PDO::PARAM_INT);

        // Execute the statement and check for success
        if (!$updateStmt->execute()) {
            // Handle error (e.g., log the error, throw an exception, etc.)
            throw new Exception("Error updating views for article ID: $articleId");
        }
    }

}