<?php
include 'connect.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $total_spent = $_POST['total_spent'];

    // SQL query to update the customer
    $sql = "UPDATE customers SET name='$name', total_spent='$total_spent' WHERE id=$id";

    // Check if the query was successful
    if ($conn->query($sql) === TRUE) {
        // Redirect to topcustomer.php after successful update
        header("Location: topcustomer.php");
        exit(); // Make sure to stop script execution after the redirect
    } else {
        echo "Error updating customer: " . $conn->error;
    }
} else {
    // SQL query to fetch the customer data
    $sql = "SELECT * FROM customers WHERE id=$id";
    $result = $conn->query($sql);
    $customer = $result->fetch_assoc();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Customer</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Customer Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $customer['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="total_spent" class="form-label">Total Spent</label>
                <input type="number" step="0.01" class="form-control" id="total_spent" name="total_spent" value="<?php echo $customer['total_spent']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Customer</button>
        </form>
    </div>
</body>
</html>
