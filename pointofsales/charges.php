<?php
require 'connect.php';

if (isset($_POST['action'])) {
    $desc = $_POST['description'];
    $charge = $_POST['charge'];
    $withTimer = isset($_POST['with_timer']) ? 1 : 0;

    if ($_POST['action'] == 'add') {
        $conn->query("INSERT INTO other_charges (description, charge, with_timer) VALUES ('$desc', '$charge', $withTimer)");
    } elseif ($_POST['action'] == 'edit') {
        $id = $_POST['id'];
        $conn->query("UPDATE other_charges SET description='$desc', charge='$charge', with_timer=$withTimer WHERE id=$id");
    }
    header("Location: index.php");
    exit();
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM other_charges WHERE id=$id");
    header("Location: index.php");
    exit();
}

$charges = $conn->query("SELECT * FROM other_charges ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Other Charges</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
  <h2 class="mb-3">Other Charges</h2>
  <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Add New Record</button>
  <input type="text" id="searchInput" class="form-control mb-3" placeholder="Quick Search..." onkeyup="filterTable()">
  <table class="table table-bordered table-striped" id="chargesTable">
    <thead class="table-success">
      <tr>
        <th>Description</th>
        <th>Charge</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $charges->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['description']) ?></td>
          <td><?= number_format($row['charge'], 2) ?></td>
          <td>
            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editModal"
              onclick="editEntry(<?= $row['id'] ?>, '<?= htmlspecialchars($row['description']) ?>', <?= $row['charge'] ?>, <?= $row['with_timer'] ?>)">✏️</button>
            <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">❌</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  <div class="d-flex justify-content-center mt-4">
    <a href="index.php" class="btn btn-primary">Back</a>
</div>

</div>


<div class="modal fade" id="addModal" tabindex="-1">
  <div class="modal-dialog">
    <form method="post" class="modal-content">
      <input type="hidden" name="action" value="add">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Add New Charge</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-2">
          <label>Description:</label>
          <input type="text" class="form-control" name="description" required>
        </div>
        <div class="mb-2">
          <label>Charge:</label>
          <input type="number" class="form-control" name="charge" step="0.01" required>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="with_timer" checked>
          <label class="form-check-label">With Timer</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
      
    </form>
  </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <form method="post" class="modal-content">
      <input type="hidden" name="action" value="edit">
      <input type="hidden" name="id" id="editId">
      <div class="modal-header bg-warning">
        <h5 class="modal-title">Edit Charge</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-2">
          <label>Description:</label>
          <input type="text" class="form-control" name="description" id="editDesc" required>
        </div>
        <div class="mb-2">
          <label>Charge:</label>
          <input type="number" class="form-control" name="charge" id="editCharge" step="0.01" required>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="with_timer" id="editWithTimer">
          <label class="form-check-label">With Timer</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-warning">Update</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </form>
  </div>
</div>

<script>
  function editEntry(id, desc, charge, timer) {
    document.getElementById('editId').value = id;
    document.getElementById('editDesc').value = desc;
    document.getElementById('editCharge').value = charge;
    document.getElementById('editWithTimer').checked = timer ? true : false;
  }

  function filterTable() {
    const input = document.getElementById("searchInput").value.toLowerCase();
    const rows = document.querySelectorAll("#chargesTable tbody tr");
    rows.forEach(row => {
      const desc = row.cells[0].innerText.toLowerCase();
      row.style.display = desc.includes(input) ? "" : "none";
    });
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
