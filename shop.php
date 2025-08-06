<?php
session_start();
require_once 'connection.php';

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - PhoneStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        .image-container {
            width: 100%;
            height: 250px;
            overflow: hidden;
            border-radius: 8px;
            position: relative;
        }
        .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            position: absolute;
            top: 0;
            left: 0;
        }
        .card-img-top:hover {
            transform: scale(1.05);
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
        }
        .card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
    </style>
</head>
<body>
<header>
    <div class="logo">PhoneStore</div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="actions/logoutaction.php">LogOut</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- Shop Section -->
<section class="shop-header">
    <h1>Our Phones</h1>
    <input type="text" id="searchBar" placeholder="Search for phones...">
</section>

<section class="product-section py-5">
    <div class="container">
        <h2 class="text-center mb-4">Our Products</h2>
        <div class="row">
            <?php
                $sql = "SELECT `id`, `product_name`, `product_img`, `description`, `price` FROM `products`";
                $res = $conn->query($sql);
                
                if ($res && $res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {
                        $product_name = htmlspecialchars($row['product_name']);
                        $product_img = htmlspecialchars($row['product_img']);
                        $description = htmlspecialchars($row['description']);
                        $price = htmlspecialchars($row['price']);
                        
                        echo '<div class="col-md-4" style="margin-bottom: 100px;">';
                        echo '<div class="card">';
                        echo '<div class="image-container">';
                        echo '<img src="' . $product_img . '" class="card-img-top" alt="' . $product_name . '">';
                        echo '</div>';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . $product_name . '</h5>';
                        echo '<p>' . $description . '</p>';
                        echo '<p>$' . $price . '</p>';
                        echo '<a href="cart.php?id=' . $row['id'] . '"><button class="add-to-cart btn btn-primary">Add to Cart</button></a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No products available at the moment.</p>';
                }
            ?>
        </div>
    </div>
</section>

<footer>
    <p>&copy; 2024 PhoneStore. All rights reserved.</p>
</footer>

<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
