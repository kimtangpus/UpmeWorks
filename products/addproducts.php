<?php include('connect.php'); ?>

<?php
$target_dir = "uploads/";  // Directory where images will be saved

// Check if the form has been submitted and file upload is not empty
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image']) && !empty($_FILES['image']['name'])) {

    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Retrieve form data safely
    $name = $conn->real_escape_string($_POST['name']);
    $price = $conn->real_escape_string($_POST['price']);
    $stock = $conn->real_escape_string($_POST['stock']);
    $rating = $conn->real_escape_string($_POST['rating']);
    $total_buyers = $conn->real_escape_string($_POST['total_buyers']);
    $status = $conn->real_escape_string($_POST['status']);
    
    // Check if the image file is an actual image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        // Only allow certain file formats (JPEG, PNG, JPG, GIF)
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $allowed_types)) {
            
            // Check if the directory exists, create it if it doesn't
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }
            
            // Check if file already exists and rename it if needed
            if (file_exists($target_file)) {
                $file_name = pathinfo($_FILES["image"]["name"], PATHINFO_FILENAME);
                $new_file_name = $file_name . '_' . time() . '.' . $imageFileType;
                $target_file = $target_dir . $new_file_name;
            }
            
            // Attempt to move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                
                // Prepare and bind the SQL statement
                $stmt = $conn->prepare("INSERT INTO products (name, price, stock, rating_percentage, total_buyers, status, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sdidiss", $name, $price, $stock, $rating, $total_buyers, $status, $target_file);
                
                // Execute the statement
                if ($stmt->execute()) {
                    header('Location: index.php');
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Sorry, there was an error uploading your image.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    } else {
        echo "File is not an image.";
    }
} else {
    echo "";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="card-title mb-4">Add New Product</h2>
                
                <form method="POST" action="addproducts.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Enter product price" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock Quantity</label>
                        <input type="number" class="form-control" id="stock" name="stock" placeholder="Enter stock quantity" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating Percentage</label>
                        <input type="number" class="form-control" id="rating" name="rating" placeholder="Enter product rating" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="total_buyers" class="form-label">Total Buyers</label>
                        <input type="number" class="form-control" id="total_buyers" name="total_buyers" placeholder="Enter number of buyers" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Active">Active</option>
                            <option value="Archived">Archived</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="product_image" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
