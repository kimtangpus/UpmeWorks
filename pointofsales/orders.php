<?php
require 'connect.php';
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$selectedCustomerId = isset($_GET['customer_id']) ? intval($_GET['customer_id']) : 0;

$customersQuery = "
    SELECT DISTINCT c.id, c.customer_name 
    FROM customers c
    INNER JOIN orders o ON c.id = o.customer_id
    ORDER BY c.customer_name
";
$customersResult = mysqli_query($conn, $customersQuery);


$orders = [];
if ($selectedCustomerId > 0) {
    $ordersQuery = "
        SELECT * FROM orders 
        WHERE customer_id = $selectedCustomerId 
        ORDER BY created_at DESC
    ";
    $orders = mysqli_query($conn, $ordersQuery);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Customer Orders</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Customer Orders</h2>
    <a href="index.php" class="btn btn-primary">Back</a>
  </div>

  <form method="GET" class="mb-4">
    <label for="customer_id" class="form-label">Select Customer:</label>
    <div class="input-group">
      <select name="customer_id" id="customer_id" class="form-select" onchange="this.form.submit()">
        <option value="">-- Select a Customer --</option>
        <?php while ($cust = mysqli_fetch_assoc($customersResult)): ?>
          <option value="<?php echo $cust['id']; ?>" <?php echo ($cust['id'] == $selectedCustomerId) ? 'selected' : ''; ?>>
            <?php echo htmlspecialchars($cust['customer_name']); ?>
          </option>
        <?php endwhile; ?>
      </select>
    </div>
  </form>

  <?php if ($selectedCustomerId && $orders && mysqli_num_rows($orders) > 0): ?>
  <?php while($order = mysqli_fetch_assoc($orders)): ?>
    <?php
      $orderId = $order['id'];
      $itemsQuery = mysqli_query($conn, "SELECT * FROM order_items WHERE order_id = $orderId");

      $totalAmount = 0;
      $totalItems = 0;
      while($item = mysqli_fetch_assoc($itemsQuery)) {
          $totalAmount += $item['amount'];
          $totalItems += $item['qty'];
      }

      mysqli_data_seek($itemsQuery, 0);
    ?>
    <div class="card mb-3 shadow-sm">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h5 class="card-title mb-1">Order #<?php echo htmlspecialchars($order['order_number']); ?></h5>
            <p class="mb-1 text-muted">
              Date: <?php echo date('M d, Y h:i A', strtotime($order['created_at'])); ?>
              <br>
              Total Items: <strong><?php echo $totalItems; ?></strong>
              | Total Amount: <strong>₱<?php echo number_format($totalAmount, 2); ?></strong>
            </p>
            <span class="badge bg-<?php echo $order['status'] === 'Completed' ? 'success' : ($order['status'] === 'Cancelled' ? 'danger' : 'warning'); ?>">
              <?php echo htmlspecialchars($order['status']); ?>
            </span>
          </div>
          <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#itemsModal<?php echo $orderId; ?>">
            <i class="bi bi-eye"></i> View Items
          </button>
        </div>
      </div>
    </div>

    <div class="modal fade" id="itemsModal<?php echo $orderId; ?>" tabindex="-1" aria-labelledby="itemsModalLabel<?php echo $orderId; ?>" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="itemsModalLabel<?php echo $orderId; ?>">Items in Order #<?php echo htmlspecialchars($order['order_number']); ?></h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Qty</th>
                  <th>Discount</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>
                <?php while($item = mysqli_fetch_assoc($itemsQuery)): ?>
                  <tr>
                    <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                    <td>₱<?php echo number_format($item['price'], 2); ?></td>
                    <td><?php echo $item['qty']; ?></td>
                    <td>₱<?php echo number_format($item['discount'], 2); ?></td>
                    <td>₱<?php echo number_format($item['amount'], 2); ?></td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
<?php elseif ($selectedCustomerId): ?>
  <div class="alert alert-warning">No orders found for this customer.</div>
<?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
