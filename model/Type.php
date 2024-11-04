<?php
require_once ('Model.php');
class Type extends Model
{
    public function  __construct(){
        parent::__construct("type"); ///////////to establish the db connection form the parent
    }
    public function searchTypes($query) {
        $query = $this->pdo->real_escape_string($query);
        $sql = "SELECT `id`, `type_name` FROM `type` WHERE `type_name` LIKE '%$query%'";
        $result = $this->conn->query($sql);

        $types = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $types[] = $row; // Collect types
            }
        }
        return $types;
    }
}