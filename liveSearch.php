<?php
require 'core/Dbconn.php';
$db = new Conn();

if (isset($_POST['input'])) {
    $input = $_POST['input'];

    // Prepare the SQL query with a placeholder
    $query = "
        SELECT id, name FROM `product` WHERE name LIKE :input
    ";

    // Execute the query
    $result = $db->query($query, ['input' => $input . '%']);

    if (is_array($result) && count($result) > 0) {
        foreach ($result as $row) {
            // Construct the link to the product details page using the product ID
            echo "<div class='text-start m-3'><a href='/product/details?product_id=" . htmlspecialchars($row->id) . "' style='text-decoration: none; color: #0b0b0b'>" . htmlspecialchars($row->name) . "</a></div>";
        }
    } else {
        echo "<h6 class='text-danger text-center mt-3'>No Data Found</h6>";
    }
}
