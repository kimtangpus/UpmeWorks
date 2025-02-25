<?php
require_once 'connect.php';

// Fetch dog sizes and store in an array for reuse
$sizeQuery = "SELECT * FROM dogsize";
$sizeResult = mysqli_query($conn, $sizeQuery);
$sizes = [];

while ($size = mysqli_fetch_assoc($sizeResult)) {
    $sizes[] = $size;  // Store each size in the array
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get form data
  $breedName = mysqli_real_escape_string($conn, $_POST['breedName']);
  $description = mysqli_real_escape_string($conn, $_POST['description']);
  $shortDescription = mysqli_real_escape_string($conn, $_POST['shortDescription']);
  $sizeID = mysqli_real_escape_string($conn, $_POST['sizeID']);

  // Insert the new dog breed into the database (no image or background color)
  $query = "INSERT INTO dogBreeds (breedName, description, shortDescription, sizeID) 
            VALUES ('$breedName', '$description', '$shortDescription', '$sizeID')";

  if (mysqli_query($conn, $query)) {
      // Redirect back to the contact page with success message
      header("Location: index.php?success=true");
  } else {
      echo "Error: " . $query . "<br>" . mysqli_error($conn);
  }
}
//delete breed
if (isset($_POST['delete'])) {
  $breedID = mysqli_real_escape_string($conn, $_POST['breedID']);
  
  // SQL query to delete the breed based on the breedID
  $deleteQuery = "DELETE FROM dogBreeds WHERE breedID = $breedID";

  if (mysqli_query($conn, $deleteQuery)) {
      // Redirect to the same page with a success flag
      header("Location: index.php?deleted=true");
  } else {
      // Handle the error
      echo "Error deleting record: " . mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Woofopedia</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="icon" href="https://i.postimg.cc/FHxQjQZ4/doggo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Athiti:wght@200;300;400;500;600;700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>

  <nav class="navbar navbar-expand-lg fixed-top">
    <a class="navbar-brand" href="#home">
      <img src="https://i.postimg.cc/8PjFKtY9/doggo.png" class="fas fa-bed mr-2"></i>
    </a>
    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span style="color: #FFFFFF;"><i class="fa-solid fa-bars"></i></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#doggos">Dogs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact</a>
        </li>
      </ul>
    </div>
  </nav>

  <section class="home" id="home">
    <div class="container-fluid">
      <div class="row align-items-center px-5">

        <div class="col-md-6 pb-5">
          <h1 class="display-4"><span style=" color: #0078D0;">Welcome to Woofopedia</span></h1>
          <p class="lead"><span style=" color: #00A651;">Discover and learn about your favorite dog breeds</span></p>
          <a href="#doggos" class="btn btn-lg btn-light ">Explore</a>
        </div>

        <div class="col-md-6">
          <img src="https://i.postimg.cc/FHFQcVwG/dogs.jpg" class="img-fluid img-border rounded-5" alt="Dogs" />
        </div>
      </div>
    </div>
  </section>

  <section id="doggos" class="py-2 mt-2">
    <div class="container mt-5">
      <h1 class="text-center pt-5" style="font-size:50px; color: #0078D0;">Dog Sizes</h1>
      <?php foreach ($sizes as $size) { ?>
      <div class="container">
        <div class="row my-5">
          <h2 class="display-3 text-center w-100" style="font-size: 35px; color: #F0282D;">
            <?php echo $size['sizeName']; ?>
          </h2>
        </div>
        <div class="row" id="dogs">
          <?php
          $dogQuery = "SELECT breedID, breedName, description, image, backgroundColor, shortDescription FROM dogBreeds WHERE sizeID = {$size['sizeID']} LIMIT 6";
          $dogResult = mysqli_query($conn, $dogQuery);

          while ($dog = mysqli_fetch_assoc($dogResult)) {
          ?>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card border-green" style="background-color: <?php echo $dog['backgroundColor']; ?>;">
              <img class="card-img" src="<?php echo $dog['image']; ?>" alt="<?php echo $dog['breedName']; ?>">
              <div class="card-body" style="background-color: #0078D0; border-radius: 25px;">
                <h3 class="card-title pb-2"><?php echo $dog['breedName']; ?></h3>
                <p class="desc pb-3"><?php echo $dog['description']; ?></p>
                <div class="d-flex justify-content-between">                  
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dogModal<?php echo $dog['breedID']; ?>">
                  View More
                </button>
                <form action="index.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this breed?');">
                  <input type="hidden" name="breedID" value="<?php echo $dog['breedID']; ?>">
                  <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                </form>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="dogModal<?php echo $dog['breedID']; ?>" tabindex="-1" aria-labelledby="dogModalLabel<?php echo $dog['breedID']; ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="dogModalLabel<?php echo $dog['breedID']; ?>"><?php echo $dog['breedName']; ?></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <img class="img-fluid" src="<?php echo $dog['image']; ?>" alt="<?php echo $dog['breedName']; ?>">
                  <div class="modal-body">
                    <p><strong>Quick Info:</strong> <?php echo $dog['shortDescription']; ?></p>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
      <?php } ?>
    </div>
  </section>

  <section id="contact" class="py-2 mt-2">
    <div class="container my-5">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="card">
            <div class=" pt-4 card-header">
              <h5 class="card-title" style="color: #0078D0;">Add a Dog Breed</h5>
            </div>
            <div class="card-body">
              <form action="index.php" method="POST">
                <div class="form-group">
                  <label for="breedName">Breed Name</label>
                  <input type="text" class="form-control" id="breedName" name="breedName" placeholder="Enter breed name" required>
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="form-group">
                  <label for="shortDescription">Short Description</label>
                  <input type="text" class="form-control" id="shortDescription" name="shortDescription" placeholder="Enter short description" required>
                </div>
                <div class="form-group">
                  <label for="sizeID">Size</label>
                  <select class="form-control" id="sizeID" name="sizeID" required>
                    <?php
                    // Loop through the stored sizes array to populate the dropdown
                    foreach ($sizes as $size) {
                      echo "<option value='{$size['sizeID']}'>{$size['sizeName']}</option>";
                    }
                    ?>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="text-center py-3" style="background-color: #000000;">
    <p style="color: #FFB114;">All rights reserved.</p>
  </footer>


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    html {
      scroll-behavior: smooth;
      font-family: 'Roboto', sans-serif;
    }

    body {
      padding-top: 0px;
    }

    .navbar {
      padding: 10px 20px;
      background-color: #000000;
      top: 0;
      position: fixed;
      width: 100%;
      z-index: 1000;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .navbar img {
      height: 40px;
    }

    .nav-link {
      color: #FFB114;
      font-size: 20px;
      transition: color 0.3s ease, background-color 0.3s ease;
    }

    .nav-link:hover {
      background-color: #F0282D;
      border-radius: 5px;
    }


    .home {
      padding: 100px 0;
      background-color: #FFFFFF;
    }

    .home h1 {
      font-size: 3rem;
      font-weight: bold;
      color: #333;
    }

    .home p {
      font-size: 1.2rem;
      color: #666;
    }

    .home img {
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .img-border {
      border: 5px solid #0078D0;
    }

    .text h1 {
      font-size: 80px;
    }

    .text p {
      font-size: 40px;
    }

    .card {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      border-radius: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s ease;
      height: 100%;
    }

    .card-body {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .card-img {
      border-radius: 20px 20px 0 0;
      height: 200px;
      object-fit: cover;
    }

    .card:hover {
      transform: scale(1.05);
    }

    .card-title {
      color: #FFFFFF;
      font-size: 24px;
      font-weight: bold;
    }


    .desc {
      color: #FFFFFF;
      font-size: 16px;
    }

    .btn {
      background-color: #FFB114;
      color: #000000;
      border-radius: 20px;
      border: none;
      transition: background-color 0.3s ease;
    }

    section {
    background-color: #ffffff; 
    border: 1px solid #ccc;
    padding: 20px;  
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  
    border-radius: 10px;  

    }

    .btn:hover {
      background-color: #F0282D;

    }

    .modal-content {
      border-radius: 20px;
      background-color: #0078D0;
      color: #FFFFFF;
    }


    .modal-header {
      border-bottom: none;
      background-color: #0078D0;
      color: #FFFFFF;
    }

    .modal-title {
      color: #FFFFFF;
    }


    .modal-footer {
      background-color: #0078D0;
      border-top: none;
    }


    .close {
      color: #FFFFFF;
      opacity: 1;
    }


    .btn-secondary {
      background-color: #FFB114;
      color: #000000;
      border-radius: 20px;
      border: none;
    }

    .btn-secondary:hover {
      background-color: #F0282D;
      color: #FFFFFF;
    }

    .modal-body {
      color: #FFFFFF;
    }


    #contact .btn:hover {
      background-color: #F0282D;

    }

    .form-control {
      border-radius: 20px;
    }

    footer {
      background-color: #000000;
      color: #FFB114;

    }
  </style>
</body>
</html>