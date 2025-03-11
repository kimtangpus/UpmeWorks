<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_name = $_POST['item_name'];
    $sale_amount = $_POST['sale_amount'];

    // Use prepared statements to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO sales (item_name, sale_amount) VALUES (?, ?)");
    $stmt->bind_param("sd", $item_name, $sale_amount); // 's' for string, 'd' for double

    if ($stmt->execute()) {
        echo "New item added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Sales Item</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="item_name" class="form-label">Item Name</label>
                <input type="text" class="form-control" id="item_name" name="item_name" required>
            </div>
            <div class="mb-3">
                <label for="sale_amount" class="form-label">Sale Amount</label>
                <input type="number" step="0.01" class="form-control" id="sale_amount" name="sale_amount" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Item</button>
        </form>
    </div>
</body>
</html>
