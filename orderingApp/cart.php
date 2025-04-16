<?php
require 'connect.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT CART.id AS cart_id, PRODUCT.item_name, PRODUCT.description, PRODUCT.image, CART.quantity, PRODUCT.price, 'product' AS item_type
        FROM CART
        JOIN PRODUCT ON CART.product_id = PRODUCT.id
        WHERE CART.user_id = ?
        UNION
        SELECT CART.id AS cart_id, CLOTHING.item_name, CLOTHING.description, CLOTHING.image, CART.quantity, CLOTHING.price, 'clothing' AS item_type
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

    if (isset($_POST['edit'])) {
        $cart_id = $_POST['cart_id'];
        $new_quantity = $_POST['quantity'];
        $update_sql = "UPDATE CART SET quantity = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ii", $new_quantity, $cart_id);
        $update_stmt->execute();
        header("Location: cart.php");
        exit();
    }

    if (isset($_POST['checkout'])) {
        $remarks = $_POST['remarks'] ?? '';
        $discount = $_POST['discount'] ?? 0;
        $vat = isset($_POST['vat']) ? 1 : 0;
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

        foreach ($_POST['items'] as $id => $item) {
            $desc = $item['description'];
            $qty = (int)$item['quantity'];
            $rate = (float)$item['rate'];
            $amount = $qty * $rate;
            $subtotal += $amount;

            $cartItems[] = [
                'description' => $desc,
                'quantity' => $qty,
                'rate' => $rate,
                'amount' => $amount
            ];
        }

        $vatAmount = $vat ? $subtotal * 0.12 : 0;
        $withholdingAmount = $withholding ? $subtotal * 0.02 : 0;
        $grandTotal = $subtotal + $vatAmount - $discount - $withholdingAmount;

        $invoice_date = $_POST['invoice_date'] ?? date('Y-m-d');
        $due_date = $_POST['due_date'] ?? null;
        $reference_no = $_POST['reference_no'] ?? '';
        $address = $_POST['address'] ?? '';
        $user_name_posted = $_POST['bill_to'] ?? $user_name;

      
        $invoice_sql = "INSERT INTO INVOICE 
            (user_id, user_name, invoice_date, due_date, reference_no, address, remarks, discount, vat, withholding, subtotal, grand_total, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

        $invoice_stmt = $conn->prepare($invoice_sql);
        $invoice_stmt->bind_param("issssssiiidd", $user_id, $user_name_posted, $invoice_date, $due_date, $reference_no, $address, $remarks, $discount, $vat, $withholding, $subtotal, $grandTotal);
        $invoice_stmt->execute();
        $invoice_id = $invoice_stmt->insert_id;

        $item_sql = "INSERT INTO INVOICEITEMS (invoice_id, item_name, quantity, price, amount) VALUES (?, ?, ?, ?, ?)";
        $item_stmt = $conn->prepare($item_sql);

        $order_sql = "INSERT INTO ORDERS (user_id, user_name, item_name, quantity, price, item_type) VALUES (?, ?, ?, ?, ?, ?)";
        $order_stmt = $conn->prepare($order_sql);


        $stmt->execute();
        $result = $stmt->get_result();

        foreach ($cartItems as $i => $item) {
            $row = $result->fetch_assoc(); 

           
            $item_stmt->bind_param("isidd", $invoice_id, $item['description'], $item['quantity'], $item['rate'], $item['amount']);
            $item_stmt->execute();

            
            $order_stmt->bind_param("issids", $user_id, $user_name, $item['description'], $item['quantity'], $item['rate'], $row['item_type']);
            $order_stmt->execute();
        }

       
        $clear_cart_sql = "DELETE FROM CART WHERE user_id = ?";
        $clear_cart_stmt = $conn->prepare($clear_cart_sql);
        $clear_cart_stmt->bind_param("i", $user_id);
        $clear_cart_stmt->execute();

        header("Location: index.php");
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

<div class="container py-5">
    <h2 class="text-center mb-4 text-success">Cart</h2>
    <form action="cart.php" method="POST">
    <div class="mb-4 p-4 bg-white rounded shadow-sm">
    <h4 class="text-success mb-3">Create New Invoice</h4>
    <div class="row g-3">
        <div class="col-md-6">
            <label for="invoiceDate" class="form-label">Invoice Date</label>
            <input type="date" class="form-control" id="invoiceDate" name="invoice_date" value="<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="col-md-6">
            <label for="dueDate" class="form-label">Due Date</label>
            <input type="date" class="form-control" id="dueDate" name="due_date">
        </div>
        <div class="col-md-6">
            <label for="billTo" class="form-label">Bill To</label>
            <input type="text" class="form-control" id="billTo" name="bill_to" value="<?php echo htmlspecialchars($user_name ?? ''); ?>">
        </div>
        <div class="col-md-6">
            <label for="referenceNo" class="form-label">Reference No.</label>
            <input type="text" class="form-control" id="referenceNo" name="reference_no" placeholder="Optional">
        </div>
        <div class="col-12">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" rows="2" placeholder="Billing address..."></textarea>
        </div>
    </div>
</div>

        <div class="table-responsive mb-3">
            <table class="table table-bordered align-middle text-center" id="cartTable">
                <thead class="table-light">
                    <tr>
                        <th style="width: 35%">Description</th>
                        <th style="width: 10%">Qty</th>
                        <th style="width: 15%">Measure</th>
                        <th style="width: 15%">Rate</th>
                        <th style="width: 15%">Amount</th>
                        <th style="width: 10%"></th>
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
                        <td>
                            <input type="text" name="items[<?php echo $row['cart_id']; ?>][description]" class="form-control" value="<?php echo htmlspecialchars($row['item_name']); ?>">
                        </td>
                        <td>
                            <input type="number" name="items[<?php echo $row['cart_id']; ?>][quantity]" class="form-control text-end qty" value="<?php echo $row['quantity']; ?>" min="1">
                        </td>
                        <td>
                            <input type="text" name="items[<?php echo $row['cart_id']; ?>][measure]" class="form-control text-center" placeholder="pcs" value="pcs">
                        </td>
                        <td>
                            <input type="number" name="items[<?php echo $row['cart_id']; ?>][rate]" class="form-control text-end rate" step="0.01" value="<?php echo $row['price']; ?>">
                        </td>
                        <td>
                            <input type="text" class="form-control-plaintext text-end amount" readonly value="<?php echo number_format($amount, 2); ?>">
                        </td>
                        <td>
                        <form action="cart.php" method="POST" style="display:inline;">
        <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
        <button type="submit" name="delete" class="btn btn-sm btn-outline-danger">×</button>
    </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-start mb-4">
            <a href="index.php"><button type="button" id="addRow" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Add Item
            </button>
                    </a>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="remarks" class="form-label">Remarks</label>
                <textarea name="remarks" id="remarks" class="form-control" rows="4"></textarea>
            </div>
            <div class="col-md-6">
                <div class="mb-2 d-flex justify-content-between">
                    <span>Subtotal</span>
                    <span id="subtotal">₱<?php echo number_format($total, 2); ?></span>
                </div>
                <div class="mb-2 d-flex justify-content-between">
                    <span>Discounts</span>
                    <input type="number" class="form-control form-control-sm w-25 text-end" id="discount" name="discount" value="0">
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value="1" id="vat" name="vat">
                    <label class="form-check-label" for="vat">Add VAT 12%</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value="1" id="withholding" name="withholding">
                    <label class="form-check-label" for="withholding">Less Withholding Tax</label>
                </div>
                <div class="mt-3 d-flex justify-content-between fw-bold">
                    <span>Grand Total</span>
                    <span id="grandTotal">₱<?php echo number_format($total, 2); ?></span>
                </div>
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" name="checkout" class="btn btn-success px-4">Create Invoice</button>
        </div>
    </form>
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

