<?php
session_start();
require_once 'connection.php';

$query = "SELECT `id`, `product_name`, `product_img`, `price`
          FROM `products` WHERE isNEw = true";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone E-Commerce</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Header -->
    
    <header>
        <div class="logo">PhoneStore</div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>
    

    <!-- Main Section -->
    <section class="home-banner">
        <h1>Welcome to PhoneStore</h1>
        <input type="text" id="searchBar" placeholder="Search for phones...">
    </section>

    <section class="featured-products">
        <h2>New Phones</h2>
        <div class="products">
            <?php
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product-card">';
                echo '<img src="' . $row['product_img'] . '" alt="' . $row['product_name'] . '">';
                echo '<h3>' . $row['product_name'] . '</h3>';
                                echo '</div>';
            }
        
            ?>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 PhoneStore. All rights reserved.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
