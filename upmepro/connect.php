<?php
$servername = "localhost";  
$username = "kimzap";        
$password = "kimzap625";             
$dbname = "upmepro";  


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
