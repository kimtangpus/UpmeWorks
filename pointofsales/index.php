<?php 
require 'connect.php'; 
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// ADD PRODUCT
if (isset($_POST['add_product'])) {
    if (!empty($_POST['name']) && is_numeric($_POST['price']) && !empty($_POST['image_url']) && !empty($_POST['category'])) {
        $stmt = $conn->prepare("INSERT INTO products (name, price, image_url, category) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdss", $_POST['name'], $_POST['price'], $_POST['image_url'], $_POST['category']);
        $stmt->execute();
        $stmt->close();
    }
    header('Location: index.php');
    exit();
}

// DELETE PRODUCT
if (isset($_POST['delete_product'])) {
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $_POST['product_id']);
    $stmt->execute();
    $stmt->close();
    header('Location: index.php');
    exit();
}

// ADD CATEGORY
if (isset($_POST['add_category']) && !empty($_POST['category_name'])) {
    $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->bind_param("s", $_POST['category_name']);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit();
}

// EDIT CATEGORY
if (isset($_POST['edit_category'])) {
    $stmt = $conn->prepare("UPDATE categories SET name = ? WHERE id = ?");
    $stmt->bind_param("si", $_POST['category_name'], $_POST['category_id']);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit();
}

// DELETE CATEGORY
if (isset($_POST['delete_category'])) {
    $stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
    $stmt->bind_param("i", $_POST['category_id']);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit();
}

// EDIT PRODUCT
if (isset($_POST['edit_product'])) {
    if (!empty($_POST['name']) && is_numeric($_POST['price']) && !empty($_POST['image_url']) && !empty($_POST['category'])) {
        $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, image_url = ?, category = ? WHERE id = ?");
        $stmt->bind_param("sdssi", $_POST['name'], $_POST['price'], $_POST['image_url'], $_POST['category'], $_POST['product_id']);
        $stmt->execute();
        $stmt->close();
    }
    header('Location: index.php');
    exit();
}

// SEARCH AND FILTER
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';

$searchQuery = "SELECT * FROM products WHERE name LIKE ?";
$params = ["%{$searchTerm}%"];
$types = "s";

if ($categoryFilter !== '') {
    $searchQuery .= " AND category = ?";
    $params[] = $categoryFilter;
    $types .= "s";
}

$stmt = $conn->prepare($searchQuery);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

date_default_timezone_set('Asia/Manila');
$currentDate = date('l, F j, Y'); 
$currentTimeFormatted = date('g:i A');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>POS System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/posstyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
<div class="container-fluid">
    <div class="row">
        
        <div class="col-2 d-flex flex-column justify-content-between sidebar">
            <div>
                <a href="customers.php" class="btn btn-outline-primary w-100 mb-2">Customers</a>
                <button class="btn btn-outline-primary w-100 mb-2">Orders</button>
                <button class="btn btn-outline-primary w-100 mb-2">Cashier</button>
                <button class="btn btn-outline-primary w-100 mb-2">Reports</button>
                <a href="discounts.php" class="btn btn-outline-primary w-100 mb-2">Discounts</a>
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

            <div class="category-buttons d-flex flex-wrap mb-3">
    <?php
    $categoryQuery = mysqli_query($conn, "SELECT * FROM categories ORDER BY name");
    while ($cat = mysqli_fetch_assoc($categoryQuery)) {
        $activeClass = ($cat['name'] == $categoryFilter) ? 'btn-primary' : 'btn-outline-secondary';
        echo "<div class='me-2 mb-2 d-flex align-items-center'>";
        echo "<a href='index.php?category=" . urlencode($cat['name']) . "' class='btn $activeClass me-1'>{$cat['name']}</a>";
        echo "<button class='btn btn-sm btn-warning me-1' data-bs-toggle='modal' data-bs-target='#editCategoryModal{$cat['id']}'>✏️</button>";
        echo "<form method='POST' onsubmit=\"return confirm('Delete this category?');\">
                <input type='hidden' name='category_id' value='{$cat['id']}'>
                <button type='submit' name='delete_category' class='btn btn-sm btn-danger'>🗑️</button>
              </form>";
        echo "</div>";

        // Edit Modal
        echo "
        <div class='modal fade' id='editCategoryModal{$cat['id']}' tabindex='-1'>
            <div class='modal-dialog'>
                <form method='POST' class='modal-content'>
                    <div class='modal-header'><h5>Edit Category</h5><button type='button' class='btn-close' data-bs-dismiss='modal'></button></div>
                    <div class='modal-body'>
                        <input type='hidden' name='category_id' value='{$cat['id']}'>
                        <input type='text' name='category_name' value='" . htmlspecialchars($cat['name']) . "' class='form-control' required>
                    </div>
                    <div class='modal-footer'>
                        <button type='submit' name='edit_category' class='btn btn-primary'>Save</button>
                    </div>
                </form>
            </div>
        </div>";
    }
    ?>
    <button class="btn btn-success me-2 mb-2" data-bs-toggle="modal" data-bs-target="#addCategoryModal">+ Add Category</button>
</div>

<!-- Add Category -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" class="modal-content">
            <div class="modal-header"><h5>Add Category</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <input type="text" name="category_name" placeholder="Category Name" class="form-control" required>
            </div>
            <div class="modal-footer">
                <button type="submit" name="add_category" class="btn btn-success">Add</button>
            </div>
        </form>
    </div>
</div>




            <!-- Search -->
            <form method="GET" class="d-flex mb-3">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" value="<?php echo htmlspecialchars($searchTerm); ?>">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

            <div class="product-grid d-flex flex-wrap gap-3">
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while($product = mysqli_fetch_assoc($result)): ?>
                        <div class="product-card-container">
    <div class="product-card text-center p-2 add-to-order"
         data-name="<?php echo htmlspecialchars($product['name']); ?>"
         data-price="<?php echo $product['price']; ?>">
         
        <img src="<?php echo htmlspecialchars($product['image_url']); ?>" class="product-img" alt="Product Image">
        
        <div class="product-card-body">
            <h5 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h5>
            <p class="product-price">₱<?php echo number_format($product['price'], 2); ?></p>

            <div class="d-flex justify-content-center gap-2 mx-auto">
                <button class="btn btn-sm btn-warning mt-2" data-bs-toggle="modal" data-bs-target="#editProductModal<?php echo $product['id']; ?>">Edit</button>
                
                <form method="POST" action="index.php" onsubmit="return confirm('Delete this product?');">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <button type="submit" name="delete_product" class="btn btn-sm btn-danger mt-2">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

                        <!-- Edit Product -->
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
                                            <div class="mb-3">
    <label for="category<?php echo $product['id']; ?>" class="form-label">Category</label>
    <select id="category<?php echo $product['id']; ?>" name="category" class="form-select">
        <?php
    
        $categoryQuery = "SELECT name FROM categories";
        $categoryResult = mysqli_query($conn, $categoryQuery);

        while ($row = mysqli_fetch_assoc($categoryResult)) {
            $categoryName = $row['name'];
            $selected = ($product['category'] == $categoryName) ? 'selected' : '';
            echo "<option value='$categoryName' $selected>$categoryName</option>";
        }
        ?>
    </select>
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
                        <input type="text" id="addImageUrl" name="image_url" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="addCategory" class="form-label">Category</label>
                        <select id="addCategory" name="category" class="form-select">
                            <option value="Breakfast">Breakfast</option>
                            <option value="Beverages">Beverages</option>
                            <option value="Pasta">Pasta</option>
                            <option value="Sushi">Sushi</option>
                            <option value="Side Dish">Side Dish</option>
                            <option value="Rice Bowl">Rice Bowl</option>
                            <option value="Meals">Meals</option>
                            <option value="Appetizers">Appetizers</option>
                            <option value="Group 9">Group 9</option>
                            <option value="Group 10">Group 10</option>
                            <option value="Group 11">Group 11</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="add_product" class="btn btn-primary">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let orderItems = [];

    document.addEventListener("DOMContentLoaded", function () {
        const orderTableBody = document.querySelector("table tbody");
        const totalDisplay = document.querySelector(".total-display");

        function updateOrderDisplay() {
            orderTableBody.innerHTML = "";
            let total = 0;

            orderItems.forEach((item, index) => {
                const amount = (item.price * item.qty) - item.discount;
                total += amount;

                orderTableBody.innerHTML += `
                    <tr>
                        <td>${item.name}</td>
                        <td>₱${item.price.toFixed(2)}</td>
                        <td>${item.qty}</td>
                        <td>₱${item.discount.toFixed(2)}</td>
                        <td>₱${amount.toFixed(2)}</td>
                    </tr>
                `;
            });

            totalDisplay.textContent = "₱" + total.toFixed(2);
        }

        document.querySelectorAll(".add-to-order").forEach(card => {
            card.addEventListener("click", function () {
                const name = this.getAttribute("data-name");
                const price = parseFloat(this.getAttribute("data-price"));

                const existingItem = orderItems.find(item => item.name === name);
                if (existingItem) {
                    existingItem.qty += 1;
                } else {
                    orderItems.push({ name, price, qty: 1, discount: 0 });
                }

                updateOrderDisplay();
            });
        });
    });
</script>

</body>
</html>
