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
    <link rel = "stylesheet" type = "text/css" href = "css/style.css" />  
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar">
        <div class="py-3 px-4 d-flex justify-content-center">
        <img src="logos/UPmePRO_Revised-removebg-preview.png" alt="logo" class="img-fluid" style="width: 150px;">
        </div>

          
            <div>
                <a href="index.php" id="dashboard-link"><span class="mdi mdi-poll"></span>  Executive Dashboard</a>
                <a href="order.php" id="order-entry-link"><span class="mdi mdi-note-text-outline"></span>  Order Entry & Billing</a>
                <a href="service.php" id="service-management-link"><span class="mdi mdi-wrench-clock-outline"></span>  Service Management</a>
                <a href="receive.php" id="accounts-receivable-link"><span class="mdi mdi-briefcase-clock-outline"></span>  Accounts Receivable</a>
                <a href="inventory.php" id="inventory-control-link"><span class="mdi mdi-package-variant-closed"></span>  Inventory Control</a>
                <a href="purchasing.php" id="smart-purchasing-link"><span class="mdi mdi-truck-outline"></span>  Smart Purchasing</a>
                <a href="payable.php" id="accounts-payable-link"><span class="mdi mdi-briefcase-account-outline"></span>  Accounts Payable</a>
            </div>

           
            <div class="sidebar-bottom">
                <a href="maintenance.php" id="maintenances-link"><span class="mdi mdi-database-outline"></span>  Maintenances</a>
                <a href="explorer.php" id="report-explorer-link"><span class="mdi mdi-printer-pos-outline"></span>  Report Explorer</a>
            </div>
        </div>

   
        <div class="col-md-10">
            <div class="top-bar d-flex justify-content-between align-items-center">
                <div>
                    <h5>Dashboard</h5>
                </div>
                <div>
                    <span>Welcome back, Admin! | Role: Administrator</span>
                    <button class="btn btn-light btn-sm"><i class="bi bi-bell"></i></button>
                    <button class="btn btn-light btn-sm"><i class="bi bi-gear"></i></button>
                    <a href="logout.php" class="btn btn-light btn-sm">
    <i class="bi bi-box-arrow-right"></i>
</a>

                </div>
            </div>
            
            <!-- content -->
            <div class="row dashboard-cards">
                <div class="col-md-3">
                    <div class="dashboard-card bg-success">
                        <h3>Orders</h3>
                        <h2>2,896</h2>
                        <p>146% Compared last month</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card bg-primary">
                        <h3>Sales</h3>
                        <h2>2,567</h2>
                        <p>142% Compared last month</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card bg-danger">
                        <h3>Receivables</h3>
                        <h2>1,890</h2>
                        <p>120% Compared last month</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card bg-warning">
                        <h3>Payables</h3>
                        <h2>1,200</h2>
                        <p>96% Compared last month</p>
                    </div>
                </div>
            </div>
            
            <!-- content2 -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="chart-placeholder">
                        <p>Monthly Sales Performance (Line Chart)</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="chart-placeholder">
                        <p> League Table: Sales Performance</p>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="chart-placeholder">
                        <p>YTD Sales Performance (Bar Chart)</p>
                    </div>
                    

                </div>
                <div class="col-md-6">
                    <div class="chart-placeholder">
                        <p>Business Share % (Pie Chart)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    const currentLocation = location.href;
    const menuLinks = document.querySelectorAll('.sidebar a');
    menuLinks.forEach(link => {
        if (link.href === currentLocation) {
            link.classList.add('active');
        }
    });

    
    
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>
</html>
