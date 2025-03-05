<?php
$servername = "localhost";  // or "127.0.0.1" if running locally
$username = "kimzap";         // your MySQL username
$password = "kimzap625";             // your MySQL password (leave blank if you have no password set)
$dbname = "products";  // the database name we created earlier

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
