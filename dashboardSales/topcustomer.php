<?php
include 'connect.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$top_customers_query = "SELECT id, name, SUM(total_spent) AS total_spent 
                        FROM customers 
                        GROUP BY name 
                        ORDER BY total_spent DESC 
                        LIMIT 10";
$top_customers_result = $conn->query($top_customers_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Analytics Dashboard</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sales.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 col-md-2 sidebar">
                <h2>Dashboard</h2>
                <nav class="nav flex-column">
                    <a class="nav-link active" href="index.php">Sales</a>
                </nav>
            </div>

            <div class="col-12 col-md-10">
            <div class="btn-group py-5" role="group" aria-label="Basic outlined example">
            <a href="index.php">  <button type="button" class="btn btn-outline-primary">Bestselling Items</button></a>
            <a href="topcustomer.php">   <button type="button" class="btn btn-outline-primary">Top Customers</button></a>
                   <a href="monthlysales.php"> <button type="button" class="btn btn-outline-primary">Month - Month</button></a>
                </div>

                    <div class="col-md-10 p-5">
                        <h3>Top 10 Customers</h3>
                        <ul class="list-group">
                            <?php while ($row = $top_customers_result->fetch_assoc()) { ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?php echo $row['name']; ?> - $<?php echo number_format($row['total_spent'], 2); ?>
                                    <span>
                                        <a href="editcustomer.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="deletecustomer.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this customer?');">Delete</a>
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