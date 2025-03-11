<?php
include 'connect.php';

$id = $_GET['id'];

// SQL query to delete the item from the sales table
$sql = "DELETE FROM sales WHERE id=$id";

// Check if the deletion is successful
if ($conn->query($sql) === TRUE) {
    // Redirect to dashboard.php after deletion
    header('Location: index.php');
    exit(); // Ensure no further code is executed after redirection
} else {
    // If there's an error, output the error message
    echo "Error deleting item: " . $conn->error;
}

$conn->close();
?>
