<?php
require 'connect.php';
session_start();

$data = json_decode(file_get_contents("php://input"), true);
$cart = $data['cart'] ?? [];

if (empty($cart)) {
    echo json_encode(["status" => "error", "message" => "No items."]);
    exit();
}

// Save order (basic example)
$stmt = $conn->prepare("INSERT INTO orders (username, total_amount, order_time) VALUES (?, ?, NOW())");
$total = array_sum(array_column($cart, 'price'));
$stmt->bind_param("sd", $_SESSION['username'], $total);
$stmt->execute();
$order_id = $stmt->insert_id;
$stmt->close();

// Save order items
$itemStmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, price) VALUES (?, ?, ?)");
foreach ($cart as $item) {
    $itemStmt->bind_param("iid", $order_id, $item['productId'], $item['price']);
    $itemStmt->execute();
}
$itemStmt->close();

echo json_encode(["status" => "success", "order_id" => $order_id]);
?>
