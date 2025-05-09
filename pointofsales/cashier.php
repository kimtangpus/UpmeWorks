<?php
require 'connect.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

$editCashier = null;
if (isset($_GET['edit'])) {
    $editId = intval($_GET['edit']);
    $editResult = mysqli_query($conn, "SELECT * FROM cashiers WHERE id = $editId");
    $editCashier = mysqli_fetch_assoc($editResult);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $role = 'cashier';  
    $active = isset($_POST['active']) ? 1 : 0;

    if (!empty($_POST['user_id'])) {
        
        $userId = intval($_POST['user_id']);
        $query = "UPDATE cashiers SET username='$username', fullname='$fullname', role='$role', active='$active' WHERE id=$userId";
    } else {
        
        $password = password_hash('default123', PASSWORD_DEFAULT); 
        $query = "INSERT INTO cashiers (username, fullname, password, role, active) VALUES ('$username', '$fullname', '$password', '$role', '$active')";
    }

   
    if (mysqli_query($conn, $query)) {
       
        header('Location: cashier.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM cashiers WHERE id = $id");
    header('Location: cashier.php');
    exit();
}

$query = "SELECT * FROM cashiers WHERE role='cashier' AND (username LIKE '%$searchTerm%' OR fullname LIKE '%$searchTerm%') ORDER BY fullname ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cashier Master List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Cashier Master List</h2>
        <div class="d-flex gap-2">
            <a href="cashiers.php" class="btn btn-primary">Refresh</a>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#cashierModal">Add Cashier</button>
        </div>
    </div>

    <form method="GET" class="mb-3">
        <input type="text" name="search" class="form-control" placeholder="Search cashier..." value="<?php echo htmlspecialchars($searchTerm); ?>">
    </form>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
        <tr>
            <th>Username</th>
            <th>Full Name</th>
            <th>Status</th>
            <th class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo htmlspecialchars($row['fullname']); ?></td>
                <td><?php echo $row['active'] ? 'Active' : 'Inactive'; ?></td>
                <td class="text-center">
                    <div class="d-flex justify-content-center gap-2">
                        <a href="cashier.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="cashier.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this cashier?')">Delete</a>
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

<div class="modal fade" id="cashierModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Cashier Information</h5>
                <a href="cashiers.php"><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></a>
            </div>

            <div class="modal-body">
                <input type="hidden" name="user_id" value="<?php echo $editCashier ? $editCashier['id'] : ''; ?>">

                <div class="mb-3">
                    <label class="form-label">Username:</label>
                    <input type="text" name="username" class="form-control" required value="<?php echo $editCashier ? htmlspecialchars($editCashier['username']) : ''; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Full Name:</label>
                    <input type="text" name="fullname" class="form-control" required value="<?php echo $editCashier ? htmlspecialchars($editCashier['fullname']) : ''; ?>">
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" name="active" id="active" <?php echo ($editCashier && $editCashier['active']) ? 'checked' : ''; ?>>
                    <label for="active" class="form-check-label">Active</label>
                </div>

                <?php if (!$editCashier): ?>
                    <div class="alert alert-info">Default password: <strong>default123</strong></div>
                <?php endif; ?>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save</button>
                <a href="cashiers.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
<?php if ($editCashier): ?>
    var cashierModal = new bootstrap.Modal(document.getElementById('cashierModal'));
    cashierModal.show();
<?php endif; ?>
</script>
</body>
</html>
