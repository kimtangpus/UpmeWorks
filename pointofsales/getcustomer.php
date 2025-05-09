<?php
require 'connect.php';

$id = intval($_GET['id'] ?? 0);
$result = mysqli_query($conn, "SELECT * FROM customers WHERE id = $id");

if ($row = mysqli_fetch_assoc($result)) {
    echo json_encode(['success' => true, 'customer' => $row]);
} else {
    echo json_encode(['success' => false]);
}
exit;
