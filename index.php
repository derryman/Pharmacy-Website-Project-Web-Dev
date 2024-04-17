<?php
//http://localhost/WebDevProj/index.php
session_start();  // Ensures session is started at the beginning of the script
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
</html>
    <main>
        <div class="container1">
        <section class="featured-products">
            <div class="featured-image">
                <img src="feature.webp" alt="Featured Products">
                <div class="featured-text">
                    <h2>Featured Products</h2>
                </div>
            </div>
        </section>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 Mahon Pharmacy. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
