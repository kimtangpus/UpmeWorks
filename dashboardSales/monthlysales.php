<?php
include 'connect.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Fetch monthly sales
$monthly_sales_query = "SELECT DATE_FORMAT(sale_date, '%Y-%m') AS month, SUM(sale_amount) AS total_sales 
                        FROM sales 
                        GROUP BY month 
                        ORDER BY month";
$monthly_sales_result = $conn->query($monthly_sales_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Analytics Dashboard</title>
    <!-- Bootstrap CSS -->
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

                <!-- Monthly Sales Chart -->
                <div class="row mt-5">
                    <div class="col-md-10 px-5">
                        <h3>Sales Month-by-Month</h3>
                        <canvas id="salesChart"></canvas>
                        <script>
                            const ctx = document.getElementById('salesChart').getContext('2d');
                            const salesChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: [
                                        <?php
                                        $months = [];
                                        while ($row = $monthly_sales_result->fetch_assoc()) {
                                            $months[] = "'" . $row['month'] . "'";
                                        }
                                        echo implode(", ", $months);
                                        ?>
                                    ],
                                    datasets: [{
                                        label: 'Total Sales',
                                        data: [
                                            <?php
                                            $sales = [];
                                            $monthly_sales_result->data_seek(0); 
                                            while ($row = $monthly_sales_result->fetch_assoc()) {
                                                $sales[] = $row['total_sales'];
                                            }
                                            echo implode(", ", $sales);
                                            ?>
                                        ],
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        fill: false,
                                        tension: 0.1
                                    }]
                                },
                                options: {
                                    scales: {
                                        x: {
                                            title: {
                                                display: true,
                                                text: 'Month'
                                            }
                                        },
                                        y: {
                                            title: {
                                                display: true,
                                                text: 'Total Sales ($)'
                                            }
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>