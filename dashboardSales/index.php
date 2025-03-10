<?php
include 'connect.php';


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$bestselling_query = "SELECT item_name, SUM(sale_amount) AS total_sales 
                      FROM sales 
                      GROUP BY item_name 
                      ORDER BY total_sales DESC 
                      LIMIT 5";
$bestselling_result = $conn->query($bestselling_query);

$top_customers_query = "SELECT name, SUM(total_spent) AS total_spent 
                        FROM customers 
                        GROUP BY name 
                        ORDER BY total_spent DESC 
                        LIMIT 10";
$top_customers_result = $conn->query($top_customers_query);

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Sales Analytics Dashboard</h1>

       
        <div class="row">
            <div class="col-md-6">
                <h3>Bestselling Items</h3>
                <ul class="list-group">
                    <?php while ($row = $bestselling_result->fetch_assoc()) { ?>
                        <li class="list-group-item">
                            <?php echo $row['item_name']; ?> - $<?php echo number_format($row['total_sales'], 2); ?>
                        </li>
                    <?php } ?>
                </ul>
            </div>

           
            <div class="col-md-6">
                <h3>Top 20 Customers</h3>
                <ul class="list-group">
                    <?php while ($row = $top_customers_result->fetch_assoc()) { ?>
                        <li class="list-group-item">
                            <?php echo $row['name']; ?> - $<?php echo number_format($row['total_spent'], 2); ?>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>

       
        <div class="row mt-5">
            <div class="col-md-12">
                <h3>Sales Month-by-Month</h3>
                <canvas id="salesChart"></canvas>
                <script>
                    const ctx = document.getElementById('salesChart').getContext('2d');
                    const salesChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: [
                                <?php
                                // month labels
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
                                    // sales data
                                    $sales = [];
                                    $monthly_sales_result->data_seek(0);  // Reset the pointer to start of results
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
