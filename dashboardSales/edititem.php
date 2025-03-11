<?php
include 'connect.php';

$id = $_GET['id']; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_name = $_POST['item_name'];
    $sale_amount = $_POST['sale_amount'];

    $sql = "UPDATE sales SET item_name='$item_name', sale_amount='$sale_amount' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Item updated successfully";
        header("Location: index.php");
    } else {
        echo "Error updating item: " . $conn->error;
    }
} else {
    $sql = "SELECT * FROM sales WHERE id=$id";
    $result = $conn->query($sql);
    $item = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Item</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="item_name" class="form-label">Item Name</label>
                <input type="text" class="form-control" id="item_name" name="item_name" value="<?php echo $item['item_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="sale_amount" class="form-label">Sale Amount</label>
                <input type="number" step="0.01" class="form-control" id="sale_amount" name="sale_amount" value="<?php echo $item['sale_amount']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Item</button>
        </form>
    </div>
</body>
</html>
