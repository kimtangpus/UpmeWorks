<?php
require 'connect.php'; 

if (isset($_POST['action'])) {
    $desc = $_POST['description'];
    $printer = $_POST['printer_location'];

    if ($_POST['action'] == 'add') {
        $conn->query("INSERT INTO storage_areas (description, printer_location) VALUES ('$desc', '$printer')");
    } elseif ($_POST['action'] == 'edit') {
        $id = (int)$_POST['id'];
        $conn->query("UPDATE storage_areas SET description='$desc', printer_location='$printer' WHERE id=$id");
    }

    header("Location: storage.php");
    exit();
}

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM storage_areas WHERE id=$id");
    header("Location: storage.php");
    exit();
}

$storageAreas = $conn->query("SELECT * FROM storage_areas ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Storage Areas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2 class="mb-3">Storage Areas</h2>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Add New Storage</button>
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Quick Search..." onkeyup="filterTable()">
    <table class="table table-bordered table-hover" id="storageTable">
        <thead class="table-success">
        <tr>
            <th>Description</th>
            <th>Printer Location</th>
            <th style="width: 130px;">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $storageAreas->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td><?= htmlspecialchars($row['printer_location']) ?></td>
                <td>
                    <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#editModal"
                        onclick="editEntry(<?= $row['id'] ?>, <?= json_encode($row['description']) ?>, <?= json_encode($row['printer_location']) ?>)">
                        ✏️
                    </button>
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
                <h5 class="modal-title">Add Storage Area</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body">
                <div class="mb-2">
                    <label>Description:</label>
                    <input type="text" name="description" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Printer:</label>
                    <select name="printer_location" class="form-select" required>
                        <option>EPSON TM-T(180dpi) Receipt</option>
                        <option>EPSON TM-T(180dpi) Receipt6 (Copy 1)</option>
                        <option>EPSON TM-U220</option>
                        <option>Generic Printer</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit">Save</button>
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
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
                <h5 class="modal-title">Edit Storage</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label>Description:</label>
                    <input type="text" name="description" id="editDesc" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Printer:</label>
                    <select name="printer_location" id="editPrinter" class="form-select" required>
                        <option>EPSON TM-T(180dpi) Receipt</option>
                        <option>EPSON TM-T(180dpi) Receipt6 (Copy 1)</option>
                        <option>EPSON TM-U220</option>
                        <option>Generic Printer</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning" type="submit">Update</button>
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
function editEntry(id, desc, printer) {
    document.getElementById('editId').value = id;
    document.getElementById('editDesc').value = desc;
    document.getElementById('editPrinter').value = printer;
}

function filterTable() {
    const input = document.getElementById("searchInput").value.toLowerCase();
    const rows = document.querySelectorAll("#storageTable tbody tr");
    rows.forEach(row => {
        const desc = row.cells[0].innerText.toLowerCase();
        row.style.display = desc.includes(input) ? "" : "none";
    });
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
