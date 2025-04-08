<?php
require 'connect.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "User not logged in. Please log in to add items to the cart.";
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
$clothing_id = isset($_POST['clothing_id']) ? (int)$_POST['clothing_id'] : 0;
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

// Make sure only one of them is set
if (($product_id > 0 && $clothing_id > 0) || ($product_id === 0 && $clothing_id === 0)) {
    echo "Invalid input! Please add either a product or a clothing item, not both.";
    exit();
}

// Helper function to check if item exists
function itemExists($conn, $id, $table) {
    $stmt = $conn->prepare("SELECT id FROM $table WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->num_rows > 0;
}

// Add product
if ($product_id > 0) {
    if (!itemExists($conn, $product_id, 'product')) {
        echo "Product not found.";
        exit();
    }

    $stmt = $conn->prepare("SELECT quantity FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $stmt = $conn->prepare("UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?");
        $stmt->bind_param("iii", $quantity, $user_id, $product_id);
    } else {
        $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $user_id, $product_id, $quantity);
    }
    $stmt->execute();
}

// Add clothing
if ($clothing_id > 0) {
    if (!itemExists($conn, $clothing_id, 'clothing')) {
        echo "Clothing item not found.";
        exit();
    }

    $stmt = $conn->prepare("SELECT quantity FROM cart WHERE user_id = ? AND clothing_id = ?");
    $stmt->bind_param("ii", $user_id, $clothing_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $stmt = $conn->prepare("UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND clothing_id = ?");
        $stmt->bind_param("iii", $quantity, $user_id, $clothing_id);
    } else {
        $stmt = $conn->prepare("INSERT INTO cart (user_id, clothing_id, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $user_id, $clothing_id, $quantity);
    }
    $stmt->execute();
}

header('Location: cart.php');
exit();
?>
