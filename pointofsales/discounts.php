<?php
require 'connect.php'; 
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';


$editDiscount = null;
if (isset($_GET['edit'])) {
    $editId = intval($_GET['edit']);
    $editResult = mysqli_query($conn, "SELECT * FROM discounts WHERE id = $editId");
    $editDiscount = mysqli_fetch_assoc($editResult);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $discountTypeId = intval($_POST['discount_type_id']);
    $value = floatval($_POST['value']);

    if (!empty($_POST['discount_id'])) {
        $discountId = intval($_POST['discount_id']);
        $query = "UPDATE discounts SET name='$name', discount_type_id='$discountTypeId', value='$value' WHERE id=$discountId";
    } else {
        $query = "INSERT INTO discounts (name, discount_type_id, value) VALUES ('$name', '$discountTypeId', '$value')";
    }

    mysqli_query($conn, $query);
    header('Location: discounts.php');
    exit();
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM discounts WHERE id = $id");
    header('Location: discounts.php');
    exit();
}


$query = "SELECT d.*, 
          CASE d.discount_type_id 
            WHEN 1 THEN 'Percentage' 
            WHEN 2 THEN 'Amount' 
            ELSE 'Unknown' 
          END AS discount_type 
          FROM discounts d 
          WHERE d.name LIKE '%$searchTerm%' 
          ORDER BY d.name ASC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Discounts Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Discounts List</h2>
    <div class="d-flex gap-2">
      <a href="discounts.php" class="btn btn-primary">Refresh</a>
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#discountModal">
        Add Discount
      </button>
    </div>
  </div>

  <form method="GET" class="mb-3">
    <input type="text" name="search" class="form-control" placeholder="Search discount..." value="<?php echo htmlspecialchars($searchTerm); ?>">
  </form>

  <table class="table table-bordered table-hover">
    <thead class="table-light">
      <tr>
        <th>Name</th>
        <th>Discount Type</th>
        <th>Value</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['name']); ?></td>
        <td><?php echo htmlspecialchars($row['discount_type']); ?></td>
        <td>
  <?php 
    echo htmlspecialchars($row['value']); 
    if ($row['discount_type_id'] == 1) {
      echo '%';
    }
  ?>
</td>

        <td class="text-center">
          <div class="d-flex justify-content-center gap-2">
            <a href="discounts.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
            <a href="discounts.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this discount?')">Delete</a>
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

<!-- modal -->
<div class="modal fade" id="discountModal" tabindex="-1" aria-labelledby="discountModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="discountModalLabel">Discount Information</h5>
        <a href="discounts.php"><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button></a>
      </div>

      <div class="modal-body">
        <input type="hidden" name="discount_id" value="<?php echo $editDiscount ? htmlspecialchars($editDiscount['id']) : ''; ?>">

        <div class="mb-3">
          <label class="form-label">Discount Name:</label>
          <input type="text" name="name" class="form-control" required value="<?php echo $editDiscount ? htmlspecialchars($editDiscount['name']) : ''; ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Discount Type:</label>
          <select name="discount_type_id" class="form-select" required>
            <option value="">Select Type</option>
            <option value="1" <?php echo ($editDiscount && $editDiscount['discount_type_id'] == 1) ? 'selected' : ''; ?>>Percentage</option>
            <option value="2" <?php echo ($editDiscount && $editDiscount['discount_type_id'] == 2) ? 'selected' : ''; ?>>Amount</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Discount Value:</label>
          <input type="number" name="value" class="form-control" required value="<?php echo $editDiscount ? htmlspecialchars($editDiscount['value']) : ''; ?>" step="0.01" min="0">
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Save</button>
        <a href="discounts.php" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
<?php if ($editDiscount): ?>
  var discountModal = new bootstrap.Modal(document.getElementById('discountModal'));
  discountModal.show();
<?php endif; ?>
</script>
</body>
</html>
