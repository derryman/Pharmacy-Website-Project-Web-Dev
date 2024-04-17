<?php
include 'config.php'; // Ensure this file contains your database connection settings
session_start();

// Check if the user is not logged in, then display a login message
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    die("Must log in before viewing your shopping cart. <a href='login.php'>Login Here</a>.");
}

// Check if the user wants to remove an item from the cart
if (isset($_GET['remove'])) {
    $product_id = $_GET['remove'];
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]); // Remove the item from the cart
    }
}

// Check if the purchase button has been pressed
if (isset($_POST['completePurchase']) && !empty($_SESSION['cart'])) {
    // Start transaction
    mysqli_begin_transaction($conn);

    try {
        foreach ($_SESSION['cart'] as $product_id => $item) {
            $insertOrder = "INSERT INTO orders (user_id, product_id, quantity) VALUES (?, ?, ?)";
            $orderStmt = mysqli_prepare($conn, $insertOrder);
            mysqli_stmt_bind_param($orderStmt, "iii", $_SESSION['user_id'], $product_id, $item['quantity']);
            mysqli_stmt_execute($orderStmt);
        }

        // Clear the cart
        unset($_SESSION['cart']);  // Assuming cart is stored in session

        // Commit transaction
        mysqli_commit($conn);
        $successMessage = "Order successful!";
    } catch (Exception $e) {
        // Rollback transaction on error
        mysqli_rollback($conn);
        $errorMessage = "Order failed: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Website</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="top-bar">
    <div class="logo">
        <img src="logo.webp" alt="Pharmacy Logo">
    </div>
    <div class="login-register-container">
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            // Show logout if user is logged in
            echo '<a href="logout.php">Logout</a>';
        } else {
            // Show login and register links if user is not logged in
            echo '<a href="login.php">Login</a> ';
            echo '<a href="register.php">Register</a>';
        }
        ?>
    </div>
    <div class="search-bar">
        <input type="text" placeholder="Search products...">
        <button type="submit">Search</button>
    </div>
</div>

<header class="main-header">
    <nav class="main-nav">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="catalog.php">Product Catalog</a></li>
            <li><a href="cart.php">Shopping Cart</a></li>
        </ul>
    </nav>
</header>
<main>
    <div class="container">
        <h1>Your Shopping Cart</h1>
        <!-- Display success or error message -->
        <?php if (!empty($successMessage)) echo "<p>$successMessage</p>"; ?>
        <?php if (!empty($errorMessage)) echo "<p>$errorMessage</p>"; ?>
        <?php if (!empty($_SESSION['cart'])): ?>
            <form method="post">
                <table>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td>$<?= number_format($item['price'], 2) ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td>$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                            <td><a href="cart.php?remove=<?= $id ?>">Remove</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <button type="submit" name="completePurchase">Complete Purchase</button>
            </form>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>
</main>
<footer>
    <div class="container">
        <p>&copy; 2024 Mahon Pharmacy. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
