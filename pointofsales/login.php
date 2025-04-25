<?php
session_start();
require 'connect.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['name'] = $user['name'];
$_SESSION['user_id'] = $user['id']; 


        header("Location: index.php");
        exit();
    } else {

        echo "<script>alert('Invalid username or password'); window.location.href='login.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPmePro Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg" style="max-width: 400px; width: 100%;">
            <div class="text-center">
                <img src="https://i.ibb.co/Txzk8Rg0/UPme-PRO-Revised-removebg-preview.png" alt="UpMePro" class="img-fluid mb-3" style="max-width: 150px;">
            </div>
            <h3 class="text-center mb-3">Sign In</h3>
            <p class="text-center text-muted mb-4">Enter your credentials to access the system</p>
            
            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username :</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password :</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                </div>
                
                <button type="submit" class="btn btn-success w-100 mb-2">Login</button>
                
                <a href="signup.php" class="btn btn-outline-success w-100">Sign Up</a>
            </form>
            
            <footer class="text-center mt-4">
                <p class="text-muted small">Copyright © 2024</p>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>