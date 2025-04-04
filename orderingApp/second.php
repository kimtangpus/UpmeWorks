<?php
require 'connect.php'; 
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Executive Dashboard</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/styles.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>


<nav class="navbar" >
  <div class="container-fluid">
    <a class="navbar-brand"><img src="images/UPmePRO_Revised-removebg-preview.png" alt="logo" class="img-fluid" style="width: 150px;"></a>
    <form class="d-flex" role="search">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button> 
      <a href="cart.php" class="btn btn-outline-success mx-2">
  <span class="mdi mdi-cart-outline"></span>
</a>

      
    </form>
  </div>
</nav>


<section id="gallery" >
<div class="container-fluid">
    <div class="row my-5">
        <h5 class="display-3 text-center w-100" style="font-size: 50px;">Products</h5>
    </div>

    <div class="row my-5 pb-5 justify-content-center">

      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
        <div class="card" style="background-color: #cce3cc;">
          <img src="images/sample2.jpg" class="card-img-top" alt="Gallery Image">
          <div class="card-body">
            <h5 class="card-title" style="color: #333;">Jacket</h5>
            <p class="card-text" style="color: #333;">Sample sample sample</p>
            <button type="button" class="btn btn-primary" style="background-color: #016046; border: none;">Add to Cart</button>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
        <div class="card" style="background-color: #cce3cc;">
          <img src="images/sample2.jpg" class="card-img-top" alt="Gallery Image">
          <div class="card-body">
            <h5 class="card-title" style="color: #333;">Jacket</h5>
            <p class="card-text" style="color: #333;">Sample sample sample</p>
            <button type="button" class="btn btn-primary" style="background-color: #016046; border: none;">Add to Cart</button>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
        <div class="card" style="background-color: #cce3cc;">
          <img src="images/sample2.jpg" class="card-img-top" alt="Gallery Image">
          <div class="card-body">
            <h5 class="card-title" style="color: #333;">Jacket</h5>
            <p class="card-text" style="color: #333;">Sample sample sample</p>
            <button type="button" class="btn btn-primary" style="background-color: #016046; border: none;">Add to Cart</button>
          </div>
        </div>
      </div>

        <nav aria-label="...">
  <ul class="pagination pagination-lg justify-content-center py-5">
    
  <li class="page-item"><a class="page-link" href="index.php">1</a></li>
    <li class="page-item"><a class="page-link" href="second.php">2</a></li>
    <li class="page-item"><a class="page-link" href="third.php">3</a></li>
  </ul>
</nav>

</section>

     