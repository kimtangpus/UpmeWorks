<?php
require 'connect.php'; 
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$searchTerm = ''; 
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UPmePro</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/upmestyles.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" rel="stylesheet">

</head>

<body>

<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="pic/UPmePRO_Revised-removebg-preview.png" alt="logo" class="img-fluid" style="width: 150px;">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Electronics</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="second.php">Clothing</a>
        </li>
      </ul>

      <form class="d-flex" role="search" method="GET" action="">
        <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search"
          value="<?php echo htmlspecialchars($searchTerm); ?>" style="width: 200px;">
        <button class="btn btn-outline-success" type="submit">Search</button>
        <a href="cart.php" class="btn btn-outline-success mx-2" title="Cart">
          <i class="bi bi-cart3"></i>
        </a>
        <a href="logout.php" class="btn btn-outline-danger" title="Logout">
          <i class="bi bi-box-arrow-right"></i>
        </a>
      </form>
    </div>
  </div>
</nav>


  <section id="gallery">
    <div class="container-fluid">
      <div class="row my-5">
        <h5 class="display-3 text-center w-100" style="font-size: 50px;">Electronics</h5>
      </div>
      <div class="row my-5 pb-5 justify-content-center">

        <?php
      $sql = "SELECT * FROM  product";
      if ($searchTerm) {
          $sql .= " WHERE item_name LIKE '%$searchTerm%' OR description LIKE '%$searchTerm%'";
      }
      $result = $conn->query($sql);

      if ($result->num_rows > 0):
        while($row = $result->fetch_assoc()):
      ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
          <div class="card" style="background-color: #cce3cc; height: 600px;">
            <img src="images/<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top" alt="Product Image">
            <div class="card-body">
              <h5 class="card-title" style="color: #333;">
                <?php echo htmlspecialchars($row['item_name']); ?>
              </h5>
              <p class="card-text" style="color: #333;">
                <?php echo htmlspecialchars($row['description']); ?>
              </p>
              <p class="card-text" style="color: #333;">
              ₱<?php echo htmlspecialchars($row['price']); ?>
              </p>
              <form action="addcart.php" method="POST">
              
              <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                <div class="d-flex align-items-center mb-3">
                  <label for="quantity" class="form-label me-2" style="color: #333;">Quantity:</label>
                  <input type="number" id="quantity" name="quantity" value="1" min="1" max="99"
                    class="form-control w-50" required>
                </div>
                <button type="submit" class="btn btn-success"
                  style="background-color: #016046; border: none; padding: 10px 20px; font-size: 16px;">
                  Add to Cart
                </button>
              </form>

            </div>
          </div>
        </div>
        <?php
        endwhile;
      else:
        echo "<p class='text-center'>No products found.</p>";
      endif;
      ?>
 
  </section>

</body>

</html>