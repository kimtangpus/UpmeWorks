<?php 
require 'connect.php'; 
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$searchTerm = ''; 
if (isset($_GET['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
}
date_default_timezone_set('Asia/Manila');
$currentDate = date('l, F j, Y '); // Format: Year-Month-Day Hour:Minute:Second
$currentTime = time(); // Get the current timestamp
$currentTimeFormatted = date('g:i A', $currentTime);

// Modify the query to search by product name
$query = "SELECT * FROM products WHERE name LIKE '%$searchTerm%'"; // Replace 'products' with your actual table name
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>POS System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin-top: 10px;
    }

    /* Sidebar Styles */
    .sidebar {
      background-color: #f8f9fa;
      min-height: 100vh;
      padding: 10px;
    }

    /* Product Card Styling */
    .product-card {
      text-align: center;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 10px;
      margin: 5px;
      cursor: pointer;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      height: 250px; /* Increased height for product cards */
      font-size: auto;
    }
    .product-card:hover {
      background-color: #f1f1f1;
    }
    .product-img {
      width: 100%;
      height: 150px; /* Adjusted height for images */
      object-fit: contain;
      border-bottom: 1px solid #ddd;
    }

    /* Right Panel (Order Summary) Styles */
    .right-panel {
      background-color: #f4f4f4;
      height: 100vh;
      padding: 20px;
      border-left: 2px solid #ddd;
      display: flex;
      flex-direction: column;
      justify-content: space-between; /* Ensure buttons are at the bottom */
    }
    .checkout-btn {
      height: 60px;
      font-size: 20px;
      margin-bottom: 15px;
    }
    .total-display {
      font-size: 48px;
      color: green;
      margin: 20px 0;
    }

    /* Category Buttons Styles */
    .category-buttons {
      overflow-x: auto;
      white-space: nowrap;
      margin-bottom: 15px;
    }
    .category-buttons button {
      margin-right: 10px;
      margin-bottom: 5px;
      font-size: 14px;
    }

    /* Product Grid Styles */
    .product-grid {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }
    .product-card-container {
      flex: 1 0 21%; /* Flex basis for 4 items per row */
      margin: 15px 0;
      padding: 10px;
    }

    /* Search Bar and Header */
    .search-bar {
      margin-bottom: 20px;
    }

    .search-bar input {
      width: 250px;
    }

    /* Responsive Design Adjustments */
    @media (max-width: 992px) {
      .product-card-container {
        flex: 1 0 45%; /* Two items per row on medium screens */
      }
    }

    @media (max-width: 576px) {
      .product-card-container {
        flex: 1 0 100%; /* One item per row on small screens */
      }

      .sidebar {
        width: 100%; /* Sidebar takes full width on small screens */
        margin-bottom: 15px;
      }

      .right-panel {
        width: 100%; /* Right panel takes full width on small screens */
        margin-top: 15px;
      }
    }
  </style>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-2 d-flex flex-column justify-content-between sidebar">
      <div>
        <button class="btn btn-outline-primary w-100 mb-2">Customers</button>
        <button class="btn btn-outline-primary w-100 mb-2">Orders</button>
        <button class="btn btn-outline-primary w-100 mb-2">Cashier</button>
        <button class="btn btn-outline-primary w-100 mb-2">Reports</button>
      </div>
      <div>
        <button class="btn btn-outline-secondary w-100 mt-5">Settings</button>
        <a href="logout.php"><button class="btn btn-outline-danger w-100 mt-2">Logout</button></a>
      </div>
    </div>

    <!-- Main Content -->
    <div class="col-7">
      <div class="search-bar d-flex justify-content-between align-items-center mb-3">
        <h4>Categories</h4>
        <!-- Form for searching products -->
        <form method="GET" action="" class="d-flex">
          <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search"
            value="<?php echo htmlspecialchars($searchTerm); ?>">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>

      <!-- Category Buttons -->
      <div class="category-buttons d-flex flex-wrap mb-3">
        <a href="index.php"><button class="btn btn-outline-secondary">Breakfast</button></a>
        <a href="index.php"><button class="btn btn-outline-secondary">Beverages</button></a>
        <a href="index.html"><button class="btn btn-outline-secondary">Pasta</button></a>
        <a href="index.html"><button class="btn btn-outline-secondary">Sushi</button></a>
        <a href="index.html"><button class="btn btn-outline-secondary">Side Dish</button></a>
        <a href="index.html"><button class="btn btn-outline-secondary">Rice Bowl</button></a>
        <a href="index.html"><button class="btn btn-outline-secondary">Meals</button></a>
        <a href="index.html"><button class="btn btn-outline-secondary">Appetizers</button></a>
        <a href="index.html"><button class="btn btn-outline-secondary">Group 9</button></a>
        <a href="index.html"><button class="btn btn-outline-secondary">Group 10</button></a>
        <a href="index.html"><button class="btn btn-outline-secondary">Group 11</button></a>
      </div>

      <!-- Product Cards -->
      <div class="product-grid">
        <?php
        // Display products dynamically
        if (mysqli_num_rows($result) > 0):
          while($product = mysqli_fetch_assoc($result)):
        ?>
        <div class="product-card-container">
          <div class="product-card">
            <img src="<?php echo htmlspecialchars($product['image_url']); ?>" class="product-img" alt="Product Image">
            <div class="product-card-body">
              <h5 class="product-title" style="color: #333;"><?php echo htmlspecialchars($product['name']); ?></h5>
              <p class="product-price" style="color: #333;">₱<?php echo number_format($product['price'], 2); ?></p>
            </div>
          </div>
        </div>
        <?php
          endwhile;
        else:
          echo "<p class='text-center'>No products found.</p>";
        endif;
        ?>
      </div>
    </div>

    <!-- Order Summary -->
    <div class="col-3 right-panel">
      <div>
        <div class="d-flex justify-content-between">
          <div><strong>Order No:</strong></div>
          <div><?php echo $currentDate; ?></div>
        </div>
        <div class="d-flex justify-content-between">
          <div><strong>Customer:</strong></div>
          <div><?php echo $currentTimeFormatted;?></div>
        </div>
        <div class="total-display text-center my-3">0.00</div>
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
          <!-- Order items will go here -->
          </tbody>
        </table>
      </div>
      
      <!-- Buttons at the bottom -->
      <div class="mt-auto">
        <button class="btn btn-warning w-100 mb-2 checkout-btn">Hold Order</button>
        <button class="btn btn-success w-100 checkout-btn">Checkout</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
