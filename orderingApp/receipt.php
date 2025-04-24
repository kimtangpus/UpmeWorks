<?php
require 'connect.php';
session_start();

if (!isset($_GET['invoice_id'])) {
    die('Invoice not found.');
}

$invoice_id = $_GET['invoice_id'];


$sql_invoice = "
    SELECT i.*, u.tin, u.business_style 
    FROM INVOICE i 
    JOIN USER u ON i.user_id = u.id 
    WHERE i.id = ?
";
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            font-size: 14px;
            overflow-y: auto;
        }

        .invoice-wrapper {
            max-width: 900px;
            margin: auto;
            padding: 20px;
        }

        .invoice-box {
            border: 1px solid #000;
            padding: 20px;
            overflow-x: auto;
        }

        .title {
            font-weight: bold;
            background: #000;
            color: white;
            padding: 5px 10px;
            display: inline-block;
        }

        .section-label {
            font-weight: bold;
        }

        .table-bordered th, .table-bordered td {
            border: 1px solid #000 !important;
        }

        .text-small {
            font-size: 12px;
        }

        .action-buttons {
            text-align: center;
            margin-top: 20px;
        }

        @media print {
            .no-print {
                display: none !important;
            }
            body {
                overflow: visible !important;
            }
        }
    </style>
</head>
<body>
<div class="invoice-wrapper">
    <div class="invoice-box">
        <div class="d-flex justify-content-between">
            <div class="title">SALES INVOICE</div>
            <div class="text-end">
                <span>No :</span> <strong style="color:red"><?php echo $invoice_id; ?></strong>
            </div>
        </div>

        <table class="table table-borderless mt-2 mb-3">
            <tr>
                <td width="60%">
                    <div class="section-label">Sold To :</div> <?php echo htmlspecialchars($invoice['user_name']); ?><br>
                    <div class="section-label">TIN :</div> <?php echo htmlspecialchars($invoice['tin']); ?><br>
                    <div class="section-label">Address :</div> <?php echo htmlspecialchars($invoice['address']); ?><br>
                    <div class="section-label">Business Style :</div> <?php echo htmlspecialchars($invoice['business_style']); ?><br>
                </td>
                <td width="40%">
                    <div class="section-label">Date :</div> <?php echo $invoice['invoice_date']; ?><br>
                    <div class="section-label">Terms :</div> <?php echo htmlspecialchars($invoice['pricelist']); ?>
                </td>
            </tr>
        </table>

        <table class="table table-bordered text-center align-middle">
            <thead>
            <tr>
                <th>QTY</th>
                <th>UNIT</th>
                <th>ARTICLES</th>
                <th>UNIT PRICE</th>
                <th>AMOUNT</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($item = $items->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>PC</td>
                    <td><?php echo htmlspecialchars($item['item_name']); ?></td>
                    <td><?php echo number_format($item['price'], 2); ?></td>
                    <td><?php echo number_format($item['amount'], 2); ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>

        <div class="row">
            <div class="col-6"></div>
            <div class="col-6">
                <table class="table table-borderless">
                    <tr><td>Total Sales (VAT Inclusive)</td><td class="text-end"><?php echo number_format($invoice['subtotal'], 2); ?></td></tr>
                    <tr><td>Less: VAT</td><td class="text-end">-<?php echo number_format($invoice['subtotal'] * 0.12, 2); ?></td></tr>
                    <tr><td>Amount Net of VAT</td><td class="text-end"><?php echo number_format($invoice['subtotal'] * 0.88, 2); ?></td></tr>
                    <tr><td>Add: VAT</td><td class="text-end"><?php echo number_format($invoice['subtotal'] * 0.12, 2); ?></td></tr>
                    <tr class="fw-bold"><td>Total Amount Due</td><td class="text-end"><?php echo number_format($invoice['grand_total'], 2); ?></td></tr>
                </table>
            </div>
        </div>

        <div class="mt-4 text-small">
            Received the above goods in good order and condition.<br><br>
            <div class="row">
                <div class="col-6">
                    <strong>10 Pads (50x5) SN:</strong> 0001-0500<br>
                    <strong>BIR Auth:</strong> OCN4AU0002591650<br>
                    <strong>Valid:</strong> <?php echo date('F d, Y'); ?> - <?php echo date('F d, Y', strtotime('+5 years')); ?><br>
                    <strong>Printer:</strong> RENZO PRESS, 0920-932-7081<br>
                    <strong>TIN:</strong> <?php echo htmlspecialchars($invoice['tin']); ?><br>
                </div>
                <div class="col-6 text-end">
                    <strong>Cashier/Authorized Representative</strong><br><br><br>
                    ______________________________<br>
                    <strong>Customer Signature</strong><br>
                    <strong>Printer’s Accreditation No.:</strong> 004MP2018000000014<br>
                    <strong>Date Issued:</strong> <?php echo date('F d, Y'); ?><br>
                    <strong>Valid Until:</strong> <?php echo date('F d, Y', strtotime('+5 years')); ?>
                </div>
            </div>
        </div>

        <div class="mt-3 text-center fw-bold text-small">
            This invoice shall be valid for Five (5) years from the date of ATP
        </div>
    </div>

    
    <div class="action-buttons no-print">
        <button onclick="window.print()" class="btn btn-dark me-2">Print Invoice</button>
        <a href="index.php" class="btn btn-primary">Back to Home</a>
    </div>
</div>
</body>
</html>
