<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>POS Sales Report</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 40px;
      color: #000;
    }
    .print-btn {
      margin-bottom: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    th, td {
      padding: 8px 6px;
      font-size: 13px;
      border-bottom: 1px solid #444;
      text-align: left;
    }
    th {
      background: #fff;
      font-weight: bold;
    }
    .section-title {
      font-size: 16px;
      font-weight: bold;
      margin-top: 30px;
    }
    .label {
      font-weight: bold;
      margin-top: 20px;
    }
    .net-sales {
      border: 1px solid #000;
      padding: 10px 20px;
      display: inline-block;
      font-weight: bold;
      margin-top: 40px;
      float: right;
    }
    @media print {
      .print-btn,
      .back-btn {
        display: none;
      }
    }
  </style>
</head>
<body>

  
  <div class="print-btn">
    <button onclick="window.print()" class="btn btn-secondary">🖨️ Print</button>
  </div>


  <table>
    <thead>
      <tr>
        <th>DOC DATE</th>
        <th>TRANS. NO</th>
        <th>CUSTOMER NAME</th>
        <th>NO. OF PAX</th>
        <th>SC/PWD PAX</th>
        <th>SC AMOUNT</th>
        <th>PAYMENT TYPE</th>
        <th>AMOUNT</th>
        <th>CASHIER</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>

  <div class="label">GRAND TOTAL:</div>
  <div class="label" style="float: right;">SUMMARY:</div>
  <div style="clear: both;"></div>

  
  <div class="section-title">EXPENSES:</div>
  <table>
    <thead>
      <tr>
        <th>REFERENCE NO</th>
        <th>SUPPLIER</th>
        <th>REQUESTED BY</th>
        <th>AMOUNT</th>
        <th>PARTICULARS</th>
      </tr>
    </thead>
    <tbody>
      
    </tbody>
  </table>
  <div class="label">TOTAL EXPENSE</div>

  
  <div class="section-title">REFUNDS:</div>
  <table>
    <thead>
      <tr>
        <th>TRANS NO</th>
        <th>OR NUMBER</th>
        <th>DATE</th>
        <th>CUSTOMER NAME</th>
        <th>AMOUNT</th>
      </tr>
    </thead>
    <tbody>
      
    </tbody>
  </table>
  <div class="label">TOTAL EXPENSE</div>

  
  <div class="net-sales">NET SALES :</div>

 
  <div class="d-flex justify-content-center mt-5 back-btn">
    <a href="index.php" class="btn btn-primary">Back</a>
  </div>

</body>
</html>
