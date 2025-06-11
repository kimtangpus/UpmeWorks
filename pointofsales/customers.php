<?php
require 'connect.php'; 
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

date_default_timezone_set('Asia/Manila');
$currentDate = date('l, F j, Y');
$currentTimeFormatted = date('g:i A');

// Generate Order Number
$orderQuery = mysqli_query($conn, "SELECT MAX(id) AS last_id FROM orders");
$orderRow = mysqli_fetch_assoc($orderQuery);
$lastOrderId = $orderRow['last_id'] ?? 0;
$newOrderNumber = 'ORD-' . str_pad($lastOrderId + 1, 6, '0', STR_PAD_LEFT);


$editCustomer = null;
if (isset($_GET['edit'])) {
    $editId = intval($_GET['edit']);
    $editResult = mysqli_query($conn, "SELECT * FROM customers WHERE id = $editId");
    $editCustomer = mysqli_fetch_assoc($editResult);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerName = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $contactPerson = mysqli_real_escape_string($conn, $_POST['contact_person']);
    $contactPosition = mysqli_real_escape_string($conn, $_POST['contact_position']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $contactNo = mysqli_real_escape_string($conn, $_POST['contact_no']);
    $emailAddress = mysqli_real_escape_string($conn, $_POST['email_address']);
    $tinNumber = mysqli_real_escape_string($conn, $_POST['tin_number']);
    $accountClass = mysqli_real_escape_string($conn, $_POST['account_class']);
    $activeFlag = isset($_POST['active_flag']) ? 1 : 0;

    if (!empty($_POST['customer_id'])) {
        $customerId = intval($_POST['customer_id']);
        $query = "UPDATE customers SET 
            customer_name='$customerName', 
            contact_person='$contactPerson', 
            contact_position='$contactPosition', 
            address='$address', 
            contact_no='$contactNo', 
            email_address='$emailAddress', 
            tin_number='$tinNumber', 
            account_class='$accountClass', 
            active_flag='$activeFlag'
            WHERE id=$customerId";
    } else {
        $query = "INSERT INTO customers 
            (customer_name, contact_person, contact_position, address, contact_no, email_address, tin_number, account_class, active_flag)
            VALUES 
            ('$customerName', '$contactPerson', '$contactPosition', '$address', '$contactNo', '$emailAddress', '$tinNumber', '$accountClass', '$activeFlag')";
    }
    mysqli_query($conn, $query);
    header('Location: customers.php');
    exit();
}


if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM customers WHERE id = $id");
    header('Location: customers.php');
    exit();
}

$query = "SELECT * FROM customers WHERE customer_name LIKE '%$searchTerm%' ORDER BY customer_name ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Customer Master List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
</head>
<body>
<div class="container mt-4">
<div class="d-flex justify-content-between align-items-center mb-3">
  <h2 class="mb-0">Customer Master List</h2>
  <div class="d-flex gap-2">
    <a href="customers.php" class="btn btn-primary">Refresh</a>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#customerModal">
      Add Customer
    </button>
  </div>
</div>


  <form method="GET" class="mb-3">
    <input type="text" name="search" class="form-control" placeholder="Search customer..." value="<?php echo htmlspecialchars($searchTerm); ?>">
  </form>

  <table class="table table-bordered table-hover">
    <thead class="table-light">
      <tr>
        <th>Customer Name</th>
        <th>Contact Person</th>
        <th>Contact Position</th>
        <th>Address</th>
        <th>Contact No</th>
        <th>Email</th>
        <th>TIN</th>
        <th>Account Class</th>
        <th>Active</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
        <td><?php echo htmlspecialchars($row['contact_person']); ?></td>
        <td><?php echo htmlspecialchars($row['contact_position']); ?></td>
        <td><?php echo htmlspecialchars($row['address']); ?></td>
        <td><?php echo htmlspecialchars($row['contact_no']); ?></td>
        <td><?php echo htmlspecialchars($row['email_address']); ?></td>
        <td><?php echo htmlspecialchars($row['tin_number']); ?></td>
        <td><?php echo htmlspecialchars($row['account_class']); ?></td>
        <td><?php echo $row['active_flag'] ? 'Yes' : 'No'; ?></td>
        <td class="text-center">
  <div class="d-flex justify-content-center gap-2">
    <a href="customers.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">
      Edit
    </a>
    <a href="customers.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this customer?')">
      Delete
    </a>
  </div>
</td>

      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  <div class="d-flex justify-content-center mt-3">
    <a href="index.php" class="btn btn-primary">Back</a>
</div>
</div>



<div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="POST" class="modal-content">
  
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="customerModalLabel">
          <i class="bi bi-card-list"></i> Customer Information
        </h5>
        <a href="customers.php"><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button></a>
      </div>

      <div class="modal-body">
        <input type="hidden" name="customer_id" value="<?php echo $editCustomer ? htmlspecialchars($editCustomer['id']) : ''; ?>">

        <div class="mb-3">
          <label class="form-label">Customer Name :</label>
          <input type="text" name="customer_name" class="form-control" required value="<?php echo $editCustomer ? htmlspecialchars($editCustomer['customer_name']) : ''; ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Contact Person :</label>
          <input type="text" name="contact_person" class="form-control" value="<?php echo $editCustomer ? htmlspecialchars($editCustomer['contact_person']) : ''; ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Contact Position :</label>
          <input type="text" name="contact_position" class="form-control" value="<?php echo $editCustomer ? htmlspecialchars($editCustomer['contact_position']) : ''; ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Address :</label>
          <textarea name="address" class="form-control"><?php echo $editCustomer ? htmlspecialchars($editCustomer['address']) : ''; ?></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Contact No :</label>
          <input type="text" name="contact_no" class="form-control" value="<?php echo $editCustomer ? htmlspecialchars($editCustomer['contact_no']) : ''; ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Email Address :</label>
          <input type="email" name="email_address" class="form-control" value="<?php echo $editCustomer ? htmlspecialchars($editCustomer['email_address']) : ''; ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">TIN Number :</label>
          <input type="text" name="tin_number" class="form-control" value="<?php echo $editCustomer ? htmlspecialchars($editCustomer['tin_number']) : ''; ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Account Class :</label><br>
          <div class="border p-2 rounded">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="account_class" value="Individual" <?php echo ($editCustomer && $editCustomer['account_class'] == 'Individual') ? 'checked' : ''; ?>>
              <label class="form-check-label">Individual</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="account_class" value="Company" <?php echo ($editCustomer && $editCustomer['account_class'] == 'Company') ? 'checked' : ''; ?>>
              <label class="form-check-label">Company</label>
            </div>
          </div>
        </div>

        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" value="1" name="active_flag" id="active_flag" <?php echo ($editCustomer && $editCustomer['active_flag']) ? 'checked' : ''; ?>>
          <label class="form-check-label" for="active_flag">Active Flag</label>
        </div>

      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Save</button>
        <a href="customers.php" class="btn btn-secondary">Cancel</a>
      </div>

    </form>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
<?php if ($editCustomer): ?>
  var customerModal = new bootstrap.Modal(document.getElementById('customerModal'));
  customerModal.show();
<?php endif; ?>
</script>
</body>
</html>
