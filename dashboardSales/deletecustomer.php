<?php
// Database connection
include 'connect.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the 'id' parameter is set in the URL (i.e., if a deletion is requested)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL query to delete the record based on the provided 'id'
    $sql = "DELETE FROM customers WHERE id = $id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // After deletion, redirect to the customer.php page
        header("Location: topcustomer.php");
        exit(); // Make sure to stop further execution
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
