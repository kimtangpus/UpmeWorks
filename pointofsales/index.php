<?php 
require 'connect.php'; 
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['add_product'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = floatval($_POST['price']);
    $image_url = mysqli_real_escape_string($conn, $_POST['image_url']);

    $insertQuery = "INSERT INTO products (name, price, image_url) VALUES ('$name', $price, '$image_url')";
    mysqli_query($conn, $insertQuery);
    header('Location: index.php');
    exit();
}

if (isset($_POST['edit_product'])) {
    $product_id = intval($_POST['product_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = floatval($_POST['price']);
    $image_url = mysqli_real_escape_string($conn, $_POST['image_url']);

    $updateQuery = "UPDATE products SET name='$name', price=$price, image_url='$image_url' WHERE id=$product_id";
    mysqli_query($conn, $updateQuery);
    header('Location: index.php');
    exit();
}

$searchTerm = ''; 
if (isset($_GET['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
}

date_default_timezone_set('Asia/Manila');
$currentDate = date('l, F j, Y'); 
$currentTimeFormatted = date('g:i A');

$query = "SELECT * FROM products WHERE name LIKE '%$searchTerm%'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>POS System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/posstyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        
        <div class="col-2 d-flex flex-column justify-content-between sidebar">
            <div>
                <a href="#" class="btn btn-outline-primary w-100 mb-2">Customers</a>
                <button class="btn btn-outline-primary w-100 mb-2">Orders</button>
                <button class="btn btn-outline-primary w-100 mb-2">Cashier</button>
                <button class="btn btn-outline-primary w-100 mb-2">Reports</button>
            </div>
            <div>
                <button class="btn btn-outline-secondary w-100 mt-5">Settings</button>
                <a href="logout.php" class="btn btn-outline-danger w-100 mt-2">Logout</a>
            </div>
        </div>

        <div class="col-7">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Categories</h4>
            </div>

            <form method="GET" class="d-flex mb-3">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" value="<?php echo htmlspecialchars($searchTerm); ?>">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

         
            <div class="category-buttons d-flex flex-wrap mb-3">
                <?php
                $categories = ['Breakfast', 'Beverages', 'Pasta', 'Sushi', 'Side Dish', 'Rice Bowl', 'Meals', 'Appetizers', 'Group 9', 'Group 10', 'Group 11'];
                foreach ($categories as $category) {
                    echo "<a href='index.php' class='btn btn-outline-secondary me-2 mb-2'>{$category}</a>";
                }
                ?>
            </div>

            <div class="product-grid d-flex flex-wrap gap-3">
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while($product = mysqli_fetch_assoc($result)): ?>
                        <div class="product-card-container">
                            <div class="product-card text-center p-2">
                                <img src="<?php echo htmlspecialchars($product['image_url']); ?>" class="product-img" alt="Product Image">
                                <div class="product-card-body">
                                    <h5 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                                    <p class="product-price">₱<?php echo number_format($product['price'], 2); ?></p>
                                    <button class="btn btn-sm btn-warning mt-2" data-bs-toggle="modal" data-bs-target="#editProductModal<?php echo $product['id']; ?>">Edit</button>
                                </div>
                            </div>
                        </div>

                      
                        <div class="modal fade" id="editProductModal<?php echo $product['id']; ?>" tabindex="-1" aria-labelledby="editProductModalLabel<?php echo $product['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editProductModalLabel<?php echo $product['id']; ?>">Edit Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                            <div class="mb-3">
                                                <label for="name<?php echo $product['id']; ?>" class="form-label">Name</label>
                                                <input type="text" id="name<?php echo $product['id']; ?>" name="name" class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="price<?php echo $product['id']; ?>" class="form-label">Price</label>
                                                <input type="number" id="price<?php echo $product['id']; ?>" name="price" class="form-control" value="<?php echo $product['price']; ?>" step="0.01">
                                            </div>
                                            <div class="mb-3">
                                                <label for="image_url<?php echo $product['id']; ?>" class="form-label">Image URL</label>
                                                <input type="text" id="image_url<?php echo $product['id']; ?>" name="image_url" class="form-control" value="<?php echo htmlspecialchars($product['image_url']); ?>">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="edit_product" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-center">No products found.</p>
                <?php endif; ?>
            </div>

            <div class="text-center my-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    <i class="fas fa-plus"></i> Add Product
                </button>
            </div>
        </div>

        
        <div class="col-3 right-panel d-flex flex-column">
            <div>
                <div class="d-flex justify-content-between">
                    <div><strong>Order No:</strong></div>
                    <div><?php echo $currentDate; ?></div>
                </div>
                <div class="d-flex justify-content-between">
                    <div><strong>Customer:</strong></div>
                    <div><?php echo $currentTimeFormatted; ?></div>
                </div>

                <div class="total-display text-center my-3">₱0.00</div>

                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Particular</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Disc</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-auto">
                <button class="btn btn-warning w-100 mb-2">Hold Order</button>
                <button class="btn btn-success w-100">Checkout</button>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="addName" class="form-label">Name</label>
                        <input type="text" id="addName" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="addPrice" class="form-label">Price</label>
                        <input type="number" id="addPrice" name="price" class="form-control" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="addImageUrl" class="form-label">Image URL</label>
                        <input type="text" id="addImageUrl" name="image_url" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="add_product" class="btn btn-success">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
