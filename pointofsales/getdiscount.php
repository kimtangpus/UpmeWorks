<?php
require 'connect.php';

function getDiscounts($searchTerm = '') {
    global $conn;
    $searchTerm = mysqli_real_escape_string($conn, $searchTerm);

    $query = "SELECT d.*, 
              CASE d.discount_type_id 
                WHEN 1 THEN 'Percentage' 
                WHEN 2 THEN 'Amount' 
                ELSE 'Unknown' 
              END AS discount_type 
              FROM discounts d 
              WHERE d.name LIKE '%$searchTerm%' 
              ORDER BY d.name ASC";

    $result = mysqli_query($conn, $query);

    $discounts = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $discounts[] = $row;
    }

    return $discounts;
}
?>
