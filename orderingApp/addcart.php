<?php
require 'connect.php'; 
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "User not logged in. Please log in to add items to the cart.";
    exit(); 
}

$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
$user_id = $_SESSION['user_id']; 

if ($product_id > 0 && $quantity > 0) {
    $sql_check = "SELECT * FROM CART WHERE user_id = ? AND product_id = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ii", $user_id, $product_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
      
        $sql_update = "UPDATE CART SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("iii", $quantity, $user_id, $product_id);
        $stmt_update->execute();
    } else {
      
        $sql_insert = "INSERT INTO CART (user_id, product_id, quantity) VALUES (?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("iii", $user_id, $product_id, $quantity);
        $stmt_insert->execute();
    }

    header('Location: cart.php');
    exit();
} else {
    echo "Invalid input!";
}
?>
