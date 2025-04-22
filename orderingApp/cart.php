<?php
require 'connect.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];


$sql = "SELECT CART.id AS cart_id, PRODUCT.id AS product_id, PRODUCT.item_name, PRODUCT.description, PRODUCT.image, CART.quantity, PRODUCT.price, 'product' AS item_type
        FROM CART
        JOIN PRODUCT ON CART.product_id = PRODUCT.id
        WHERE CART.user_id = ?
        UNION
        SELECT CART.id AS cart_id, CLOTHING.id AS product_id, CLOTHING.item_name, CLOTHING.description, CLOTHING.image, CART.quantity, CLOTHING.price, 'clothing' AS item_type
        FROM CART
        JOIN CLOTHING ON CART.clothing_id = CLOTHING.id
        WHERE CART.user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        $cart_id = $_POST['cart_id'];
        $delete_sql = "DELETE FROM CART WHERE id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $cart_id);
        $delete_stmt->execute();
        header("Location: cart.php");
        exit();
    }

    if (isset($_POST['checkout'])) {
        $remarks = $_POST['particulars'] ?? '';
        $discount = (float) ($_POST['discounts'] ?? 0);
        $vat = isset($_POST['tax_inclusive']) ? 1 : 0;
        $withholding = isset($_POST['withholding']) ? 1 : 0;

        $user_sql = "SELECT name FROM user WHERE id = ?";
        $user_stmt = $conn->prepare($user_sql);
        $user_stmt->bind_param("i", $user_id);
        $user_stmt->execute();
        $user_result = $user_stmt->get_result();
        $user_row = $user_result->fetch_assoc();
        $user_name = $user_row['name'];

        $subtotal = 0;
        $cartItems = [];

        $item_query = $conn->prepare($sql);
        $item_query->bind_param("ii", $user_id, $user_id);
        $item_query->execute();
        $item_result = $item_query->get_result();

        while ($row = $item_result->fetch_assoc()) {
            $amount = $row['price'] * $row['quantity'];
            $subtotal += $amount;

            $cartItems[] = [
                'description' => $row['item_name'],
                'quantity' => $row['quantity'],
                'rate' => $row['price'],
                'amount' => $amount,
                'item_type' => $row['item_type']
            ];
        }

        $vatAmount = $vat ? $subtotal * 0.12 : 0;
        $withholdingAmount = $withholding ? $subtotal * 0.02 : 0;
        $grandTotal = $subtotal + $vatAmount - $discount - $withholdingAmount;

        $invoice_date = $_POST['doc_date'] ?? date('Y-m-d');
        $due_date = $_POST['due_date'] ?? null;
        $reference_no = $_POST['ref_no'] ?? '';
        $contact_no = $_POST['customer_code'] ?? '';
        $address = $_POST['bill_address'] ?? '';
        $user_name_posted = $_POST['bill_to'] ?? $user_name;

        $invoice_sql = "INSERT INTO INVOICE (user_id, user_name, invoice_date, due_date, reference_no, address, contact_no, remarks, discount, vat, withholding, subtotal, grand_total, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        
        $invoice_stmt = $conn->prepare($invoice_sql);
        $invoice_stmt->bind_param("issssssssdddd", $user_id, $user_name_posted, $invoice_date, $due_date, $reference_no, $address, $contact_no, $remarks, $discount, $vat, $withholding, $subtotal, $grandTotal);
        $invoice_stmt->execute();
        $invoice_id = $invoice_stmt->insert_id;
       

        $item_sql = "INSERT INTO INVOICEITEMS (invoice_id, item_name, quantity, price, amount) VALUES (?, ?, ?, ?, ?)";
        $item_stmt = $conn->prepare($item_sql);

        $order_sql = "INSERT INTO ORDERS (user_id, user_name, item_name, quantity, price, item_type) VALUES (?, ?, ?, ?, ?, ?)";
        $order_stmt = $conn->prepare($order_sql);

        foreach ($cartItems as $item) {
            $item_stmt->bind_param("isidd", $invoice_id, $item['description'], $item['quantity'], $item['rate'], $item['amount']);
            $item_stmt->execute();

            $order_stmt->bind_param("issids", $user_id, $user_name, $item['description'], $item['quantity'], $item['rate'], $item['item_type']);
            $order_stmt->execute();
        }

        $clear_cart_sql = "DELETE FROM CART WHERE user_id = ?";
        $clear_cart_stmt = $conn->prepare($clear_cart_sql);
        $clear_cart_stmt->bind_param("i", $user_id);
        $clear_cart_stmt->execute();

        header("Location: receipt.php?invoice_id=" . $invoice_id);
        exit();
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container py-4">
  <div class="card shadow-sm p-4">
    <h5 class="mb-3"><strong>Sales Invoice No :</strong> <span class="text-primary"><?php echo $invoice_id; ?></span></h5>

    <form action="cart.php" method="POST">
      <!-- Bill To and Ship To -->
      <div class="row g-3">
        <div class="col-md-6">
          <h6>Bill To Information</h6>
          <div class="mb-2">
            <label class="form-label">Customer Code</label>
            <input type="text" class="form-control" name="customer_code">
          </div>
          <div class="mb-2">
            <label class="form-label">Bill Address</label>
            <input type="text" class="form-control" name="bill_address">
          </div>
          <div class="row">
            <div class="col-md-6 mb-2">
              <label class="form-label">Salesman</label>
              <select class="form-select" name="salesman">
                <option value="">Select</option>
              </select>
            </div>
            <div class="col-md-6 mb-2">
              <label class="form-label">Pricelist</label>
              <select class="form-select" name="pricelist">
                <option value="">COD</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-2">
              <label class="form-label">P.O Ref No</label>
              <input type="text" class="form-control" name="po_ref_no">
            </div>
            <div class="col-md-6 mb-2">
              <label class="form-label text-danger">Ref. No:</label>
              <input type="text" class="form-control border-danger" name="ref_no">
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <h6>Ship To Information</h6>
          <div class="mb-2">
            <label class="form-label">Ship To</label>
            <input type="text" class="form-control" name="ship_to">
          </div>
          <div class="mb-2">
            <label class="form-label">Ship Address</label>
            <input type="text" class="form-control" name="ship_address">
          </div>
          <div class="row">
            <div class="col-md-6 mb-2">
              <label class="form-label">Credit Term</label>
              <select class="form-select" name="credit_term">
                <option value="Credit">Credit</option>
                <option value="Cash">Cash</option>
                <option value="Debit">Debit</option>
              </select>
            </div>
            <div class="col-md-6 mb-2">
              <label class="form-label">Doc Date</label>
              <input type="date" class="form-control" name="doc_date" value="<?php echo date('Y-m-d'); ?>">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-2">
              <label class="form-label">Due Date</label>
              <input type="date" class="form-control" name="due_date">
            </div>
            <div class="col-md-6 mb-2">
              <label class="form-label">Delivery Date</label>
              <input type="date" class="form-control" name="delivery_date">
            </div>
          </div>
        </div>
      </div>

      <!-- Item Table -->
      <div class="table-responsive my-4">
        <table class="table table-bordered text-center align-middle">
          <thead class="table-light">
            <tr>
              <th>Code</th>
              <th>Description</th>
              <th>UOM</th>
              <th>Qty</th>
              <th>Unit Price</th>
              <th>Amount</th>
              <th>Remarks</th>
              <th>Site</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $total = 0;
            while ($row = $result->fetch_assoc()):
              $amount = $row['price'] * $row['quantity'];
              $total += $amount;
            ?>
            <tr>
              <td><?php echo $row['product_id']; ?></td>
              <td><?php echo htmlspecialchars($row['item_name']); ?></td>
              <td>PC</td>
              <td><?php echo $row['quantity']; ?></td>
              <td><?php echo number_format($row['price'], 2); ?></td>
              <td><?php echo number_format($amount, 2); ?></td>
              <td><input type="text" class="form-control form-control-sm" name="remarks[]"></td>
              <td>
                <select class="form-select form-select-sm" name="site[]">
                  <option>HO-MAIN</option>
                </select>
              </td>
              <td>
                <form method="POST" action="cart.php">
                  <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
                  <button type="submit" name="delete" class="btn btn-sm btn-outline-danger">🗑</button>
                </form>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
        <a href="index.php"><button type="button" class="btn btn-sm btn-outline-secondary">+</button></a>
      </div>

      <!-- Particulars and Totals -->
      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label">Particulars</label>
          <textarea class="form-control" name="particulars" rows="2"></textarea>
        </div>
        <div class="col-md-6">
          <div class="bg-light border rounded p-3">
            <div class="d-flex justify-content-between mb-2">
              <span>Total Qty:</span>
              <input type="text" class="form-control form-control-sm w-50 text-end" name="total_qty" value="120.00">
            </div>
            <div class="form-check mb-2">
              <input type="checkbox" class="form-check-input" id="tax_inclusive" name="tax_inclusive">
              <label class="form-check-label" for="tax_inclusive">Tax Inclusive?</label>
            </div>
            <div class="d-flex justify-content-between mb-1"><span>Sub-Total:</span><span>₱<?php echo number_format($total, 2); ?></span></div>
            <div class="d-flex justify-content-between mb-1"><span>Discounts:</span><input type="text" class="form-control form-control-sm w-50 text-end" name="discounts" value="0.00"></div>
            <div class="d-flex justify-content-between mb-1"><span>Other Charges:</span><input type="text" class="form-control form-control-sm w-50 text-end" name="other_charges" value="0.00"></div>
            <div class="d-flex justify-content-between mb-1"><span>VAT (12%):</span><input type="text" class="form-control form-control-sm w-50 text-end" name="vat" value="0.00"></div>
            <div class="d-flex justify-content-between mb-1"><span>Net Of VAT:</span><input type="text" class="form-control form-control-sm w-50 text-end" name="net_vat" value="0.00"></div>
            <div class="d-flex justify-content-between fw-bold mt-2"><span>Net Amount:</span><span>₱<?php echo number_format($total, 2); ?></span></div>
          </div>
        </div>
      </div>

      <!-- Footer Buttons -->
      <div class="d-flex justify-content-between mt-4">
        <div>
          <span class="me-3"><strong>Status:</strong> Open</span>
          <a href="index.php"><button type="button" class="btn btn-outline-secondary btn-sm">Cancel Invoice</button></a>
        </div>
        <div>
          <button type="submit" name="checkout" class="btn btn-success me-2">OK</button>
          <a href="index.php"><button type="button" class="btn btn-secondary">Close</button></a>
        </div>
      </div>
    </form>
  </div>
</div>



   
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
    <script>
document.addEventListener('input', function () {
    let rows = document.querySelectorAll('#cartTable tbody tr');
    let subtotal = 0;

    rows.forEach(row => {
        let qty = parseFloat(row.querySelector('.qty').value) || 0;
        let rate = parseFloat(row.querySelector('.rate').value) || 0;
        let amount = qty * rate;
        subtotal += amount;
        row.querySelector('.amount').value = amount.toFixed(2);
    });

    document.getElementById('subtotal').textContent = `₱${subtotal.toFixed(2)}`;
    let discount = parseFloat(document.getElementById('discount').value) || 0;
    let vat = document.getElementById('vat').checked ? subtotal * 0.12 : 0;
    let withholding = document.getElementById('withholding').checked ? subtotal * 0.02 : 0;
    let grandTotal = subtotal + vat - discount - withholding;
    document.getElementById('grandTotal').textContent = `₱${grandTotal.toFixed(2)}`;
});
</script>


</html>
<?php
?>

<style>
    
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 1200px;
            padding: 30px;
        }

        h1 {
            text-align: center;
            color: #016046;
            font-weight: bold;
        }

        .cart-item {
            background-color: #ffffff;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }

        .cart-item img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 20px;
        }

        .cart-item-details {
            flex: 1;
        }

        .cart-item-details h5 {
            font-size: 18px;
            color: #333;
        }

        .cart-item-details p {
            font-size: 14px;
            color: #777;
        }

        .cart-item-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-item-actions button {
            background-color: #dc3545;
            border: none;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }

        .cart-item-actions button:hover {
            background-color: #c82333;
        }

        .cart-summary {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
            text-align: right;
        }

        .cart-summary .total-price {
            font-size: 24px;
            font-weight: bold;
            color: #016046;
        }

        .cart-summary .checkout-btn {
            background-color: #016046;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }

        .cart-summary .checkout-btn:hover {
            background-color: #014c3f;
        }

        .empty-cart {
            text-align: center;
            font-size: 18px;
            color: #888;
        }

        .edit-quantity-form {
            display: flex;
            align-items: center;
        }

        .edit-quantity-form input {
            width: 60px;
            margin-right: 10px;
        }
    </style>
</html>
<?php

