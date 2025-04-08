<?php
require 'connect.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT CART.id AS cart_id, PRODUCT.item_name, PRODUCT.description, PRODUCT.image, CART.quantity, PRODUCT.price, 'product' AS item_type
        FROM CART
        JOIN PRODUCT ON CART.product_id = PRODUCT.id
        WHERE CART.user_id = ?
        UNION
        SELECT CART.id AS cart_id, CLOTHING.item_name, CLOTHING.description, CLOTHING.image, CART.quantity, CLOTHING.price, 'clothing' AS item_type
        FROM CART
        JOIN CLOTHING ON CART.clothing_id = CLOTHING.id
        WHERE CART.user_id = ?";


$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        $cart_id = $_POST['cart_id'];
        $delete_sql = "DELETE FROM CART WHERE id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $cart_id);
        $delete_stmt->execute();
        header("Location: cart.php"); 
        exit();
    }

    if (isset($_POST['edit'])) {
        $cart_id = $_POST['cart_id'];
        $new_quantity = $_POST['quantity'];
        $update_sql = "UPDATE CART SET quantity = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ii", $new_quantity, $cart_id);
        $update_stmt->execute();
        header("Location: cart.php"); 
        exit();
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkout'])) {
    $checkout_sql = "INSERT INTO ORDERS (user_id, item_name, quantity, price, item_type) VALUES (?, ?, ?, ?, ?)";
    $checkout_stmt = $conn->prepare($checkout_sql);

    $result->data_seek(0); // Reset result pointer to loop again

    while ($row = $result->fetch_assoc()) {
        $checkout_stmt->bind_param("isids", $user_id, $row['item_name'], $row['quantity'], $row['price'], $row['item_type']);
        $checkout_stmt->execute();
    }

    // Clear the cart
    $clear_cart_sql = "DELETE FROM CART WHERE user_id = ?";
    $clear_cart_stmt = $conn->prepare($clear_cart_sql);
    $clear_cart_stmt->bind_param("i", $user_id);
    $clear_cart_stmt->execute();

    // Redirect to homepage
    header("Location: index.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Styles remain the same as in your original code */
    </style>
</head>

<body>

    <div class="container">
        <h1>Your Cart</h1>
        <div class="d-flex justify-content-end mb-3">
            <a href="index.php" class="btn btn-close" aria-label="Close"></a>
        </div>

        <?php
        if ($result->num_rows > 0) {
            $totalPrice = 0; 
            while ($row = $result->fetch_assoc()) {
                $totalPrice += $row['price'] * $row['quantity']; 
                ?>
                <div class="cart-item">
                    <img src="images/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['item_name']); ?>">
                    <div class="cart-item-details">
                        <h5><?php echo htmlspecialchars($row['item_name']); ?></h5>
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                        <div class="cart-item-actions">
                            <form action="cart.php" method="POST" class="edit-quantity-form">
                                <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" min="1">
                                <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
                                <button type="submit" name="edit">Update Quantity</button>
                            </form>
                            <form action="cart.php" method="POST">
                                <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
                                <button type="submit" name="delete">Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="cart-summary">
    <p class="total-price">Total: $<?php echo number_format($totalPrice, 2); ?></p>
    <form action="cart.php" method="POST">
        <button type="submit" name="checkout" class="checkout-btn">Proceed to Checkout</button>
    </form>
</div>

            <?php
        } else {
            echo "<p class='empty-cart'>Your cart is empty.</p>";
        }
        ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>
<?php
?>

<style>
    
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 1200px;
            padding: 30px;
        }

        h1 {
            text-align: center;
            color: #016046;
            font-weight: bold;
        }

        .cart-item {
            background-color: #ffffff;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }

        .cart-item img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 20px;
        }

        .cart-item-details {
            flex: 1;
        }

        .cart-item-details h5 {
            font-size: 18px;
            color: #333;
        }

        .cart-item-details p {
            font-size: 14px;
            color: #777;
        }

        .cart-item-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-item-actions button {
            background-color: #dc3545;
            border: none;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }

        .cart-item-actions button:hover {
            background-color: #c82333;
        }

        .cart-summary {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
            text-align: right;
        }

        .cart-summary .total-price {
            font-size: 24px;
            font-weight: bold;
            color: #016046;
        }

        .cart-summary .checkout-btn {
            background-color: #016046;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }

        .cart-summary .checkout-btn:hover {
            background-color: #014c3f;
        }

        .empty-cart {
            text-align: center;
            font-size: 18px;
            color: #888;
        }

        .edit-quantity-form {
            display: flex;
            align-items: center;
        }

        .edit-quantity-form input {
            width: 60px;
            margin-right: 10px;
        }
    </style>
</html>
<?php

