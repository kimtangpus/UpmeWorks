<?php
require 'connect.php';
session_start();

if (!isset($_GET['invoice_id'])) {
    die('Invoice not found.');
}

$invoice_id = $_GET['invoice_id'];

$sql_invoice = "SELECT * FROM INVOICE WHERE id = ?";
$stmt_invoice = $conn->prepare($sql_invoice);
$stmt_invoice->bind_param("i", $invoice_id);
$stmt_invoice->execute();
$invoice = $stmt_invoice->get_result()->fetch_assoc();

$sql_items = "SELECT * FROM INVOICEITEMS WHERE invoice_id = ?";
$stmt_items = $conn->prepare($sql_items);
$stmt_items->bind_param("i", $invoice_id);
$stmt_items->execute();
$items = $stmt_items->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales Invoice #<?php echo $invoice_id; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        @media print {
            .no-print { display: none; }
        }

        body {
            background-color: #fff;
            font-family: 'Arial', sans-serif;
        }

        .invoice-box {
            max-width: 900px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            background: #fff;
        }

        .invoice-header h2 {
            color: #016046;
        }

        .table td, .table th {
            vertical-align: middle;
        }
    </style>
</head>
<body>

<div class="invoice-box">
    <div class="invoice-header text-center mb-4">
        <h2>Sales Invoice</h2>
        <p><strong>Invoice #: </strong> <?php echo $invoice_id; ?> <br>
           <strong>Date: </strong> <?php echo $invoice['invoice_date']; ?> <br>
           <strong>Due Date: </strong> <?php echo $invoice['due_date']; ?></p>
    </div>

    <div class="mb-4">
        <h5>Bill To:</h5>
        <p>
            <?php echo htmlspecialchars($invoice['user_name']); ?><br>
            <?php echo htmlspecialchars($invoice['address']); ?><br>
            Contact: <?php echo htmlspecialchars($invoice['contact_no']); ?>
        </p>
    </div>

    <table class="table table-bordered text-center">
        <thead class="table-light">
            <tr>
                <th>Description</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th>Remarks</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($item = $items->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['item_name']); ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td>₱<?php echo number_format($item['price'], 2); ?></td>
                <td><?php echo htmlspecialchars($item['remarks']); ?></td>
                <td>₱<?php echo number_format($item['amount'], 2); ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-end">Subtotal:</th>
                <td>₱<?php echo number_format($invoice['subtotal'], 2); ?></td>
            </tr>
            <tr>
                <th colspan="4" class="text-end">Discount:</th>
                <td>-₱<?php echo number_format($invoice['discount'], 2); ?></td>
            </tr>
            <tr>
                <th colspan="4" class="text-end">VAT (12%):</th>
                <td>₱<?php echo $invoice['vat'] ? number_format($invoice['subtotal'] * 0.12, 2) : '0.00'; ?></td>
            </tr>
            <tr>
                <th colspan="4" class="text-end">Withholding Tax (2%):</th>
                <td>-₱<?php echo $invoice['withholding'] ? number_format($invoice['subtotal'] * 0.02, 2) : '0.00'; ?></td>
            </tr>
            <tr class="fw-bold">
                <th colspan="4" class="text-end">Grand Total:</th>
                <td>₱<?php echo number_format($invoice['grand_total'], 2); ?></td>
            </tr>
        </tfoot>
    </table>

    <?php if (!empty($invoice['remarks'])): ?>
        <div class="mt-3">
            <strong>Remarks:</strong><br>
            <p><?php echo nl2br(htmlspecialchars($invoice['remarks'])); ?></p>
        </div>
    <?php endif; ?>

    <div class="text-end mt-4 no-print">
        <button onclick="window.print()" class="btn btn-outline-success">Print Invoice</button>
        <a href="index.php" class="btn btn-outline-primary">Back to Shop</a>
    </div>
</div>

</body>
</html>
