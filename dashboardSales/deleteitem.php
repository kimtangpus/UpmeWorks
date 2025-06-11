<?php
include 'connect.php';

$id = $_GET['id'];


$sql = "DELETE FROM sales WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header('Location: index.php');
    exit(); 
} else {
    echo "Error deleting item: " . $conn->error;
}

$conn->close();
?>
