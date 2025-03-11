<?php
include 'connect.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM customers WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: topcustomer.php");
        exit(); 
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
