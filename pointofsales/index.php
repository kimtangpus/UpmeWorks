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
$currentDate = date('l, F j, Y '); 
$currentTime = time(); 
$currentTimeFormatted = date('g:i A', $currentTime);


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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM8d7xj1z5l5e5e5e5e5e5e5e5e5e5e5e5e5" crossorigin="anonymous"> 
  
</head>
<body>
<div class="container-fluid">
  <div class="row">
    
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

    
    <div class="col-7">
      <div class="search-bar d-flex justify-content-between align-items-center mb-3">
        <h4>Categories</h4>
       
        <form method="GET" action="" class="d-flex">
          <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search"
            value="<?php echo htmlspecialchars($searchTerm); ?>">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>

     
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

     
      <div class="product-grid">
        <?php
        
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
        <button class="btn btn-warning w-100 mb-2 checkout-btn">Hold Order</button>
        <button class="btn btn-success w-100 checkout-btn">Checkout</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
