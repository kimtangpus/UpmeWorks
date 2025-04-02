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
    <title>Order Entry & Billing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" rel="stylesheet">

</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar">
                <div class="py-3 px-4 d-flex justify-content-center">
                    <img src="https://i.ibb.co/Txzk8Rg0/UPme-PRO-Revised-removebg-preview.png" alt="logo"
                        class="img-fluid" style="width: 150px;">
                </div>


                <div>
                    <a href="index.php" id="dashboard-link"><span class="mdi mdi-poll"></span> Executive Dashboard</a>
                    <a href="order.php" id="order-entry-link"><span class="mdi mdi-note-text-outline"></span> Order
                        Entry & Billing</a>
                    <a href="service.php" id="service-management-link"><span
                            class="mdi mdi-wrench-clock-outline"></span> Service Management</a>
                    <a href="receive.php" id="accounts-receivable-link"><span
                            class="mdi mdi-briefcase-clock-outline"></span> Accounts Receivable</a>
                    <a href="inventory.php" id="inventory-control-link"><span
                            class="mdi mdi-package-variant-closed"></span> Inventory Control</a>
                    <a href="purchasing.php" id="smart-purchasing-link"><span class="mdi mdi-truck-outline"></span>
                        Smart Purchasing</a>
                    <a href="payable.php" id="accounts-payable-link"><span
                            class="mdi mdi-briefcase-account-outline"></span> Accounts Payable</a>
                </div>


                <div class="sidebar-bottom">
                    <a href="maintenance.php" id="maintenances-link"><span class="mdi mdi-database-outline"></span>
                        Maintenances</a>
                    <a href="explorer.php" id="report-explorer-link"><span class="mdi mdi-printer-pos-outline"></span>
                        Report Explorer</a>
                </div>
            </div>

            <div class="col-md-10">
                <div class="top-bar d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Order Entry & Billing</h5>
                    </div>
                    <div>
                        <span>Welcome back, Admin! | Role: Administrator</span>
                        <button class="btn btn-light btn-sm"><i class="bi bi-bell"></i></button>
                        <button class="btn btn-light btn-sm"><i class="bi bi-gear"></i></button>
                        <a href="logout.php" class="btn btn-light btn-sm"><i class="bi bi-box-arrow-right"></i></a>
                    </div>
                </div>
                <!-- content -->
                <div class="row g-0 row-gap-3 my-5">
                    <div class="col-md-4 text-center mb-3">
                        <button type="button" class="btn btn-lg" data-bs-toggle="modal" data-bs-target="#orderModal1"
                            style="background-color: #FFFFFF; width:200px; height: 150px;">Customer Master</button>
                    </div>
                    <div class="col-md-4 text-center mb-5">
                        <button type="button" class="btn btn-lg" data-bs-toggle="modal" data-bs-target="#orderModal2"
                            style="background-color: #FFFFFF; width:200px; height: 150px;">Pricelist
                            Maintenance</button>
                    </div>
                    <div class="col-md-4 text-center mb-5">
                        <button type="button" class="btn btn-lg" data-bs-toggle="modal" data-bs-target="#orderModal3"
                            style="background-color: #FFFFFF; width:200px; height: 150px;">Sales Order Entry</button>
                    </div>
                    <div class="col-md-4 text-center mb-5">
                        <button type="button" class="btn btn-lg" data-bs-toggle="modal" data-bs-target="#orderModal"
                            style="background-color: #FFFFFF; width:200px; height: 150px;">SO Approval</button>
                    </div>
                    <div class="col-md-4 text-center mb-5">
                        <button type="button" class="btn btn-lg" data-bs-toggle="modal" data-bs-target="#orderModal"
                            style="background-color: #FFFFFF; width:200px; height: 150px;">Delivery Receipt</button>
                    </div>
                    <div class="col-md-4 text-center mb-5">
                        <button type="button" class="btn btn-lg" data-bs-toggle="modal" data-bs-target="#orderModal"
                            style="background-color: #FFFFFF; width:200px; height: 150px;">DR Approval</button>
                    </div>
                    <div class="col-md-4 text-center mb-5">
                        <button type="button" class="btn btn-lg" data-bs-toggle="modal" data-bs-target="#orderModal"
                            style="background-color: #FFFFFF; width:200px; height: 150px;">Delivery Trip Ticket</button>
                    </div>
                    <div class="col-md-4 text-center mb-5">
                        <button type="button" class="btn btn-lg" data-bs-toggle="modal" data-bs-target="#orderModal"
                            style="background-color: #FFFFFF; width:200px; height: 150px;">Sales Invoice</button>
                    </div>
                    <div class="col-md-4 text-center mb-5">
                        <button type="button" class="btn btn-lg" data-bs-toggle="modal" data-bs-target="#orderModal"
                            style="background-color: #FFFFFF; width:200px; height: 150px;">Invoice Printing</button>
                    </div>
                    <div class="col-md-4 text-center mb-5">
                        <button type="button" class="btn btn-lg" data-bs-toggle="modal" data-bs-target="#orderModal"
                            style="background-color: #FFFFFF; width:200px; height: 150px;">Proof Of Delivery</button>
                    </div>
                    <div class="col-md-4 text-center mb-5">
                        <button type="button" class="btn btn-lg" data-bs-toggle="modal" data-bs-target="#orderModal"
                            style="background-color: #FFFFFF; width:200px; height: 150px;">Item Return</button>
                    </div>
                    <div class="col-md-4 text-center mb-5">
                        <button type="button" class="btn btn-lg" data-bs-toggle="modal" data-bs-target="#orderModal"
                            style="background-color: #FFFFFF; width:200px; height: 150px;">Reports</button>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="orderModal3" tabindex="-1" aria-labelledby="orderModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="orderModalLabel">Sales Order Entry</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="customerName" class="form-label">Customer Name</label>
                                        <input type="text" class="form-control" id="customerName" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="orderDate" class="form-label">Order Date</label>
                                        <input type="date" class="form-control" id="orderDate" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="orderAmount" class="form-label">Order Amount</label>
                                        <input type="number" class="form-control" id="orderAmount" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit Order</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--asdasd-->
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