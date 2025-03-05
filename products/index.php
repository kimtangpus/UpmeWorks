<?php include('connect.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2 class="my-4">All Products</h2>

        <nav class="mb-4 p-1 d-flex align-items-center justify-content-between">
            <div class="nav-links d-flex">
                <a href="index.php" class="btn btn-secondary">All Products</a>
                <a href="live.php" class="btn btn-secondary">Live Products</a>
                <a href="archive.php" class="btn btn-secondary">Archived Products</a>
                <a href="outofstock.php" class="btn btn-secondary">Out of Stock</a>
                <a href="lowstock.php" class="btn btn-secondary">Low Stock</a>
            </div>

            <form class="d-flex" method="GET" action="index.php">
                <input class="form-control me-2" type="search" name="search" placeholder="Search Products" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
        </nav>
        <div class="text-end mb-3">
            <a href="addproducts.php" class="btn btn-success">Add Product</a>
        </div>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Rank</th>
                    <th>Product</th>
                    <th>Total Buyers</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Rating</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Search and display products
                $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
                $sql = "SELECT * FROM products";
                if ($search) {
                    $sql .= " WHERE name LIKE '%$search%'";
                }
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $checked = $row['status'] == 'Active' ? 'checked' : '';

                        // Generate rating circles
                        $rating_circles = '';
                        $rating_percentage = $row['rating_percentage'];
                        $filled_circles = floor($rating_percentage / 20); 

                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $filled_circles) {
                                if ($rating_percentage >= 80) {
                                    $rating_circles .= "<div class='circle active-perfect'></div>";
                                } elseif ($rating_percentage >= 60) {
                                    $rating_circles .= "<div class='circle active-verygood'></div>";
                                } elseif ($rating_percentage >= 40) {
                                    $rating_circles .= "<div class='circle active-good'></div>";
                                } else {
                                    $rating_circles .= "<div class='circle active-bad'></div>";
                                }
                            } else {
                                $rating_circles .= "<div class='circle'></div>";
                            }
                        }

                        echo "<tr>
                                <td>{$row['rank']}</td>
                                <td> <img src='{$row['image']}' alt='Product Image' style='width: 50px;'> {$row['name']} <br>{$row['id']} </td>
                                <td>{$row['total_buyers']}</td>
                                <td>\${$row['price']}</td>
                                <td>{$row['stock']}</td>
                                <td>
                                    <div class='rating-circles'>
                                        $rating_circles
                                    </div>
                                    {$row['rating_percentage']}%
                                </td>
                                <td>
                                    <form action='toggle.php' method='POST'>
                                        <label class='switch'>
                                            <input type='checkbox' name='toggle' $checked onchange='this.form.submit()'>
                                            <span class='slider'></span>
                                        </label>
                                        <span class='status-label'>".($row['status'] == 'Active' ? 'Active' : 'Archived')."</span>
                                        <input type='hidden' name='product_id' value='{$row['id']}'>
                                        <input type='hidden' name='new_status' value='".($row['status'] == 'Active' ? 'Archived' : 'Active')."'>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No products found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
