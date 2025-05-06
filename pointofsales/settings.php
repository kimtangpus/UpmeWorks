<?php
require 'connect.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Fetch settings
$settings = $conn->query("SELECT * FROM settings LIMIT 1")->fetch_assoc();

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("UPDATE settings SET store_name = ?, contact_number = ?, address = ? WHERE id = ?");
    $stmt->bind_param("sssi", $_POST['store_name'], $_POST['contact_number'], $_POST['address'], $settings['id']);
    $stmt->execute();
    $stmt->close();
    header("Location: settings.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Store Settings</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="store_name" class="form-label">Store Name</label>
            <input type="text" name="store_name" id="store_name" class="form-control" value="<?php echo htmlspecialchars($settings['store_name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="contact_number" class="form-label">Contact No.</label>
            <input type="text" name="contact_number" id="contact_number" class="form-control" value="<?php echo htmlspecialchars($settings['contact_number']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea name="address" id="address" class="form-control" rows="3" required><?php echo htmlspecialchars($settings['address']); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
</body>
</html>
