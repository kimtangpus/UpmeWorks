<?php
require 'connect.php';
session_start();

if (!isset($_SESSION['username'])) {
    echo json_encode(["success" => false, "message" => "Please log in."]);
    exit();
}

$inputData = json_decode(file_get_contents("php://input"), true);

if (empty($inputData['items']) || empty($inputData['customer_id']) || empty($inputData['total'])) {
    echo json_encode(["success" => false, "message" => "Missing order details."]);
    exit();
}

$stmt = $conn->prepare("INSERT INTO orders (created_at, status, customer_id) VALUES (NOW(), 'pending', ?)");
$stmt->bind_param("i", $inputData['customer_id']);
$stmt->execute();
$orderId = $stmt->insert_id;  
$stmt->close();

foreach ($inputData['items'] as $item) {
    $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_name, price, qty, discount, amount) VALUES (?, ?, ?, ?, ?, ?)");
    $amount = ($item['price'] * $item['qty']) - $item['discount'];
    $stmt->bind_param("isdiid", $orderId, $item['name'], $item['price'], $item['qty'], $item['discount'], $amount);
    $stmt->execute();
    $stmt->close();
}

echo json_encode(["success" => true, "message" => "Order placed successfully!"]);
?>