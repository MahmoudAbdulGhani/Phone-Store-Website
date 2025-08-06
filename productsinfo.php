<?php
session_start();
require_once 'connection.php';
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
}
?>

<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Navbar 
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">PhoneStore</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php">Shop</a>
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
    </header>-->

    <!-- Product Display Section 
    <section class="product-section py-5">
        <div class="container">
            <h2 class="text-center mb-4">Our Products</h2>
            <div class="row">
  -->
                <!-- Product 1 
                <div class="col-md-4">
                    <div class="card">
                        <img src="phone1.jpg" class="card-img-top" alt="Phone 1">
                        <div class="card-body">
                            <h5 class="card-title">Smartphone XYZ</h5>
                            
                            <p class="price">$499.99</p>
                            <a href="cart.php" class="btn btn-primary">Add to Cart</a>
                        </div>
                    </div>
                </div>
-->
                <!-- Product 2 
                <div class="col-md-4">
                    <div class="card">
                        <img src="phone2.jpg" class="card-img-top" alt="Phone 2">
                        <div class="card-body">
                            <h5 class="card-title">Smartphone ABC</h5>
                            <p class="card-text">A budget-friendly smartphone with great value for money.</p>
                            <p class="price">$299.99</p>
                            <a href="cart.php" class="btn btn-primary">Add to Cart</a>
                        </div>
                    </div>
                </div>
-->
                <!-- Product 3 
                <div class="col-md-4">
                    <div class="card">
                        <img src="phone3.jpg" class="card-img-top" alt="Phone 3">
                        <div class="card-body">
                            <h5 class="card-title">Smartphone 123</h5>
                            <p class="card-text">An excellent choice for those who need performance and reliability.</p>
                            <p class="price">$399.99</p>
                            <a href="cart.php" class="btn btn-primary">Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>-->
  
   
    <!-- Footer
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p>&copy; 2024 PhoneStore. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> -->
