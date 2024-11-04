<?php
require_once('Model.php');
class Search
{


    public function fetchSearchResults($query)
    {
        // Prepare SQL query to prevent SQL injection
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE title LIKE ? OR description LIKE ?");
        $searchTerm = "%$query%";
        $stmt->bind_param("ss", $searchTerm, $searchTerm);

        $stmt->execute();
        $result = $stmt->get_result();

        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }

        // Return results as JSON
        return json_encode($items);
    }
}