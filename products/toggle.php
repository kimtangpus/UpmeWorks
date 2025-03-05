<?php
include('connect.php');

if (isset($_POST['product_id']) && isset($_POST['new_status'])) {
    $product_id = $_POST['product_id'];
    $new_status = $_POST['new_status'];

    
    $sql = "UPDATE products SET status = '$new_status' WHERE id = $product_id";
    
    if ($conn->query($sql) === TRUE) {
        
        header('Location: index.php');
        exit();
    } else {
        echo "Error updating status: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
