<?php
session_start();
require_once 'config.php'; // Your database configuration file

$products = [
    ['id' => 1,'name' => 'Acetaminophen', 'description' => 'Used to treat mild to moderate pain and to reduce fever.', 'price' => '10.99'],
    ['id' => 2,'name' => 'Ibuprofen', 'description' => 'Relieves pain, decreases inflammation and reduces fever.', 'price' => '15.49'],
    ['id' => 3,'name' => 'Aspirin', 'description' => 'Used to reduce pain, fever, or inflammation.', 'price' => '8.25'],
    ['id' => 4,'name' => 'Loratadine', 'description' => 'Antihistamine that reduces the effects of natural chemical histamine in the body.', 'price' => '12.35'],
    ['id' => 5,'name' => 'Omeprazole', 'description' => 'Used to treat certain stomach and esophagus problems (such as acid reflux, ulcers).', 'price' => '22.70'],
    ['id' => 6,'name' => 'Metformin', 'description' => 'Used to improve blood sugar control in people with type 2 diabetes.', 'price' => '5.80'],
    ['id' => 7,'name' => 'Amoxicillin', 'description' => 'Antibiotic that fights bacteria.', 'price' => '18.90'],
    ['id' => 8,'name' => 'Simvastatin', 'description' => 'Used to lower cholesterol and triglycerides in the blood.', 'price' => '25.99']
];

// Handle adding items to cart
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    // Adding product to session cart
    foreach ($products as $product) {
        if ($product['id'] == $product_id) {
            if (!isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id] = $product;
                $_SESSION['cart'][$product_id]['quantity'] = 1;
            } else {
                $_SESSION['cart'][$product_id]['quantity']++; // Increment quantity if already in cart
            }
            break;
        }
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
</body>
    <main>
        <div class="container">
            <h1>Our Products</h1>
            <div class="product-grid">
                <?php foreach ($products as $product): ?>
                    <div class='product'>
                        <img src='<?= strtolower($product['name']) . ".jpg" ?>' alt='<?= htmlspecialchars($product['name']) ?> Image' class='product-image'>
                        <h2><?= htmlspecialchars($product['name']) ?></h2>
                        <p><?= htmlspecialchars($product['description']) ?></p>
                        <p class='price'>$<?= htmlspecialchars($product['price']) ?></p>
                        <form method="post">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <button type="submit" name="add_to_cart">Purchase</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 Mahon Pharmacy. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
