<?php
session_start();
require_once '../connection.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $image_name = $_FILES['product_image']['name'];
    $image_tmp_name = $_FILES['product_image']['tmp_name'];
    $image_folder = '../background_images/' . $image_name;

    if (!empty($product_name) && !empty($description) &&
        is_numeric($price) && is_numeric($quantity) && 
        !empty($image_name)) 
     {
        if (move_uploaded_file($image_tmp_name, $image_folder)) {
            $sql = "INSERT INTO products (product_name, product_img, description, price, quantity) 
                    VALUES ('$product_name', '$image_folder', '$description', $price, $quantity)";

            if ($conn->query($sql) === TRUE) {
                $success_message = "Product added successfully.";
            } else {
                $error_message = "Error adding product: " . $conn->error;
            }
        } else {
            $error_message = "Failed to upload the image.";
        }
    } else {
        $error_message = "Please fill out all fields with valid data.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Add New Product</h2>
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?= $success_message ?></div>
        <?php elseif (isset($error_message)): ?>
            <div class="alert alert-danger"><?= $error_message ?></div>
        <?php endif; ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" required>
            </div>
            <div class="mb-3">
                <label for="product_image" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="product_image" name="product_image" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
            <a href="../admin.php" class="btn btn-secondary">Back to Admin Page</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
