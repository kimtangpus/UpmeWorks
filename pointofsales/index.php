<?php  
require 'connect.php'; 
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}


if (!isset($_SESSION['order_number'])) {
    $_SESSION['order_number'] = 'ORD' . rand(10000, 99999); 
}

$newOrderNumber = $_SESSION['order_number']; 

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
 
if (isset($_POST['delete_product'])) {
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $_POST['product_id']);
    $stmt->execute();
    $stmt->close();
    header('Location: index.php');
    exit();
}

if (isset($_POST['add_category']) && !empty($_POST['category_name'])) {
    $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->bind_param("s", $_POST['category_name']);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit();
}


if (isset($_POST['edit_category'])) {
    $stmt = $conn->prepare("UPDATE categories SET name = ? WHERE id = ?");
    $stmt->bind_param("si", $_POST['category_name'], $_POST['category_id']);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit();
}

if (isset($_POST['delete_category'])) {
    $stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
    $stmt->bind_param("i", $_POST['category_id']);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit();
}


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

if (isset($_POST['checkout'])) {
    $orderItems = json_decode($_POST['order_items'], true);
    $customer_id = intval($_POST['customer_id'] ?? 0);
    $status = 'Pending';

   
    $orderNumber = 'ORD' . rand(10000, 99999);

   
    $customerStmt = $conn->prepare("SELECT customer_name FROM customers WHERE id = ?");
    $customerStmt->bind_param("i", $customer_id);
    $customerStmt->execute();
    $customerResult = $customerStmt->get_result();

    if ($customerResult->num_rows == 0) {
        echo "Customer not found! Cannot proceed with checkout.";
        exit();
    }

    $customer = $customerResult->fetch_assoc();
    $customer_name = $customer['customer_name'];
    $customerStmt->close();

    $stmt = $conn->prepare("INSERT INTO orders (order_number, created_at, status, customer_id, customer_name) VALUES (?, NOW(), ?, ?, ?)");
    $stmt->bind_param("ssis", $orderNumber, $status, $customer_id, $customer_name);
    $stmt->execute();
    $order_id = $stmt->insert_id;
    $stmt->close();

   
    if (is_array($orderItems)) {
        foreach ($orderItems as $item) {
            $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, price, qty, discount, amount) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iisdiid", $order_id, $item['product_id'], $item['name'], $item['price'], $item['qty'], $item['discount'], $item['amount']);
            $stmt->execute();
            $stmt->close();
        }
    }

  
    unset($_SESSION['order_number']);  

    
    header("Location: index.php?success=1");
    exit();
}



$searchTerm = $_GET['search'] ?? '';
$categoryFilter = $_GET['category'] ?? '';

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

if (!isset($_SESSION['order_number'])) {
    
    $_SESSION['order_number'] = 'ORD' . rand(10000, 99999);
    
}

$newOrderNumber = $_SESSION['order_number'];
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
        <div class="col-2 sidebar">
    <div class="nav-links">
        <a href="customers.php" class="btn btn-outline-primary w-100 mb-2">Customers</a>
        <a href="orders.php"><button class="btn btn-outline-primary w-100 mb-2">Orders</button></a>
        <a href="cashier.php"><button class="btn btn-outline-primary w-100 mb-2">Cashier</button></a>
        <a href="reports.php"><button class="btn btn-outline-primary w-100 mb-2">Reports</button></a>
        <a href="discounts.php" class="btn btn-outline-primary w-100 mb-2">Discounts</a>
    </div>

    <div class="bottom-controls">
        <div class="dropdown w-100 mt-3">
            <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Settings
            </button>
            <ul class="dropdown-menu w-100">
                <li><a class="dropdown-item" href="storage.php">Storage Areas</a></li>
                <li><a class="dropdown-item" href="charges.php">Other Charges</a></li>
                <li><a class="dropdown-item" href="config.php">Store Configuration</a></li>
            </ul>
        </div>

        <a href="logout.php" class="btn btn-outline-danger w-100 mt-2">Logout</a>
    </div>
</div>



        <!-- Main  -->
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
                    echo "<a href='index.php?category=" . urlencode($cat['name']) . "' class='btn $activeClass me-1'>" . htmlspecialchars($cat['name']) . "</a>";
                    echo "<button class='btn btn-sm btn-warning me-1' data-bs-toggle='modal' data-bs-target='#editCategoryModal{$cat['id']}'>✏️</button>";
                    
                    echo "<form method='POST' onsubmit=\"return confirm('Delete this category?');\">
                            <input type='hidden' name='category_id' value='{$cat['id']}'>
                            <button type='submit' name='delete_category' class='btn btn-sm btn-danger'>🗑️</button>
                          </form>";
                    echo "</div>";
                }
                
                ?>
                <!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal<?php echo $cat['id']; ?>" tabindex="-1" aria-labelledby="editCategoryLabel<?php echo $cat['id']; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCategoryLabel<?php echo $cat['id']; ?>">Edit Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="category_id" value="<?php echo $cat['id']; ?>">
        <div class="mb-3">
          <label for="category_name_<?php echo $cat['id']; ?>" class="form-label">Category Name</label>
          <input type="text" class="form-control" name="category_name" id="category_name_<?php echo $cat['id']; ?>" value="<?php echo htmlspecialchars($cat['name']); ?>" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="edit_category" class="btn btn-primary">Save changes</button>
      </div>
    </form>
  </div>
</div>

                <button class="btn btn-success me-2 mb-2" data-bs-toggle="modal" data-bs-target="#addCategoryModal">+ Add Category</button>
            </div>
            <!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="category_name" class="form-label">Category Name</label>
          <input type="text" class="form-control" id="category_name" name="category_name" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="add_category" class="btn btn-primary">Add Category</button>
      </div>
    </form>
  </div>
</div>


        
            <form method="GET" class="d-flex mb-3">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" value="<?php echo htmlspecialchars($searchTerm); ?>">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

            <div class="product-grid d-flex flex-wrap gap-3">
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while($product = mysqli_fetch_assoc($result)): ?>
                        <!-- Product Edit Modal -->
<div class="modal fade" id="editProductModal<?php echo $product['id']; ?>" tabindex="-1" aria-labelledby="editProductModalLabel<?php echo $product['id']; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProductModalLabel<?php echo $product['id']; ?>">Edit Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Price</label>
          <input type="number" step="0.01" class="form-control" name="price" value="<?php echo $product['price']; ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Image URL</label>
          <input type="text" class="form-control" name="image_url" value="<?php echo htmlspecialchars($product['image_url']); ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Category</label>
          <input type="text" class="form-control" name="category" value="<?php echo htmlspecialchars($product['category']); ?>" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="edit_product" class="btn btn-primary">Save changes</button>
      </div>
    </form>
  </div>
</div>

                        <div class="product-card-container">
                            <div class="product-card text-center p-2 add-to-order"
                                 data-name="<?php echo htmlspecialchars($product['name']); ?>"
                                 data-price="<?php echo $product['price']; ?>"
                                 data-id="<?php echo $product['id']; ?>">

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
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-center">No products found.</p>
                <?php endif; ?>
            </div>
        </div>
        

<div class="col-3 right-panel d-flex flex-column">
    <div>
      
        <div class="mb-3">
            <label for="customer_id" class="form-label">Select Customer:</label>
            <select class="form-select" id="customer_id" name="customer_id" onchange="fetchCustomerDetails(this.value)">
                <option value="">-- Choose --</option>
                <?php
                $customers = mysqli_query($conn, "SELECT id, customer_name FROM customers ORDER BY customer_name ASC");
                while ($customer = mysqli_fetch_assoc($customers)) {
                    echo "<option value=\"{$customer['id']}\">" . htmlspecialchars($customer['customer_name']) . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="discount_id" class="form-label">Select Discount:</label>
            <select class="form-select" id="discount_id">
                <option value="">-- Choose Discount --</option>
                <?php
                $discountQuery = mysqli_query($conn, "SELECT * FROM discounts");
                while ($discount = mysqli_fetch_assoc($discountQuery)) {
                    echo "<option value='{$discount['id']}' data-type='{$discount['discount_type_id']}' data-value='{$discount['value']}'>" . htmlspecialchars($discount['name']) . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <div><p><strong>Order No:</strong> <?php echo isset($_GET['order_number']) ? htmlspecialchars($_GET['order_number']) : 'ORD' . rand(10000, 99999); ?></p></div>
            <div><?php echo $currentDate; ?></div>
        </div>

        <div class="d-flex justify-content-between">
            <div id="customerDetails">
                <p><em>Select a customer to load details.</em></p>
            </div>
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
                <tbody id="order-summary">
                <tfoot>
    <tr>
        <td colspan="4" class="text-end"><strong>Subtotal:</strong></td>
        <td id="subtotal-cell">₱0.00</td>
    </tr>
    <tr>
        <td colspan="4" class="text-end"><strong>Discount:</strong></td>
        <td id="discount-cell">₱0.00</td>
    </tr>
</tfoot>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-auto">
        <button class="btn btn-warning w-100 mb-2">Hold Order</button>
        <form method="POST">
    <input type="hidden" name="order_items" id="order-items-input">
    <input type="hidden" name="customer_id" id="customer-hidden-id">
    <button type="submit" name="checkout" class="btn btn-success w-100">Checkout</button>
</form>

    </div>
</div>


<script>
    let orderItems = [];

document.addEventListener("DOMContentLoaded", function () {
    const orderTableBody = document.querySelector("#order-summary");
    const totalDisplay = document.querySelector(".total-display");
    const discountDropdown = document.getElementById("discount_id");
    

    function updateOrderDisplay() {
    orderTableBody.innerHTML = "";
    let total = 0;
    const discountId = discountDropdown.value;
    const selectedOption = discountDropdown.options[discountDropdown.selectedIndex];
    const discountType = selectedOption ? selectedOption.getAttribute('data-type') : null;
    const discountValue = selectedOption ? parseFloat(selectedOption.getAttribute('data-value')) : 0;

    orderItems.forEach(item => {
        const amount = item.price * item.qty;
        item.amount = amount;
        total += amount;
    });

    const discount = calculateDiscount(total);
    const subtotal = total;
    const finalTotal = total - discount;

   
    const discountPerItem = discount / orderItems.length;
    orderItems.forEach(item => {
        item.discount = discountPerItem;
        item.amount = (item.price * item.qty) - discountPerItem;
    });

    orderItems.forEach(item => {
        orderTableBody.innerHTML += `
            <tr>
                <td>${item.name}</td>
                <td>₱${item.price.toFixed(2)}</td>
                <td>${item.qty}</td>
                <td>₱${item.discount.toFixed(2)}</td>
                <td>₱${item.amount.toFixed(2)}</td>
            </tr>
        `;
    });

    document.getElementById("subtotal-cell").textContent = "₱" + subtotal.toFixed(2);
    document.getElementById("discount-cell").textContent = "-₱" + discount.toFixed(2);
    totalDisplay.textContent = "₱" + finalTotal.toFixed(2);

    document.getElementById('order-items-input').value = JSON.stringify(orderItems);
}

    function calculateDiscount(totalAmount) {
        const discountId = discountDropdown.value;
        if (!discountId) return 0;

        const selectedOption = discountDropdown.options[discountDropdown.selectedIndex];
        const discountType = selectedOption.getAttribute('data-type');
        const discountValue = parseFloat(selectedOption.getAttribute('data-value'));

        let discount = 0;

        if (discountType == 1) { 
            discount = (totalAmount * discountValue) / 100;
        } else if (discountType == 2) { 
            discount = discountValue;
        }

        return discount;
    }

    document.querySelectorAll(".add-to-order").forEach(card => {
        card.addEventListener("click", function () {
            const name = this.getAttribute("data-name");
            const price = parseFloat(this.getAttribute("data-price"));
            const id = this.getAttribute("data-id");

            const existingItem = orderItems.find(item => item.name === name);
            if (existingItem) {
                existingItem.qty++;
            } else {
                orderItems.push({
                    name,
                    price,
                    qty: 1,
                    product_id: id,
                    amount: price
                });
            }

            updateOrderDisplay();
        });
    });

    discountDropdown.addEventListener("change", function () {
        updateOrderDisplay();
        document.getElementById("order-items-input").value = JSON.stringify(orderItems);

    });
});

    function fetchCustomerDetails(customerId) {
        document.getElementById('customer-hidden-id').value = customerId;

        if (customerId === "") {
            document.getElementById("customerDetails").innerHTML = "<p><em>Select a customer to load details.</em></p>";
            return;
        }

        fetch("getcustomer.php?id=" + customerId)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById("customerDetails").innerHTML = `
                        <p><strong>Name:</strong> ${data.customer.customer_name}</p>
                        <p><strong>Account Class:</strong> ${data.customer.account_class}</p>
                    `;
                } else {
                    document.getElementById("customerDetails").innerHTML = "<p>Customer not found.</p>";
                }
            });
    }
</script>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

