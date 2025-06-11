<?php
include 'connect.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$bestselling_query = "SELECT id, item_name, SUM(sale_amount) AS total_sales 
                      FROM sales 
                      GROUP BY item_name 
                      ORDER BY total_sales DESC 
                      LIMIT 10";
$bestselling_result = $conn->query($bestselling_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Analytics Dashboard</title>
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/sales.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 col-md-2 sidebar">
                <h2>Dashboard</h2>
                <nav class="nav flex-column">
                    <a class="nav-link active" style="font-size: 25px;" href="index.php">Sales</a>
                </nav>
            </div>

            <div class="col-12 col-md-10">
                <div class="btn-group py-5" role="group" aria-label="Basic outlined example">
                <a href="index.php">  <button type="button" class="btn btn-outline-primary">Bestselling Items</button></a>
                   <a href="topcustomer.php">   <button type="button" class="btn btn-outline-primary">Top Customers</button></a>
                   <a href="monthlysales.php"> <button type="button" class="btn btn-outline-primary">Month - Month</button></a>
                </div>

               
                <div class="row">
                    <div class="col-md-10 p-5">
                        <h3>Bestselling Items</h3>
                        <ul class="list-group">
                            <?php while ($row = $bestselling_result->fetch_assoc()) { ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?php echo $row['item_name']; ?> - $<?php echo number_format($row['total_sales'], 2); ?>
                                    <span>
                                        <a href="edititem.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="deleteitem.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                    </span>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>

                    
                </div>

               
                
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
