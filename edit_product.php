<?php
session_start();
require_once '../connection.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = $_GET['id'];
    $product_result = $conn->query("SELECT * FROM products WHERE id = $product_id");

    if ($product_result->num_rows == 1) {
        $product = $product_result->fetch_assoc();
    } else {
        die("Product not found.");
    }
} else {
    die("Invalid product ID.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $image_name = $_FILES['product_image']['name'];
    $image_tmp_name = $_FILES['product_image']['tmp_name'];
    $image_folder = '../background_images/' . $image_name; 

    if (!empty($product_name) && !empty($description) && is_numeric($price) && is_numeric($quantity)) {
        if (!empty($image_name)) {
            move_uploaded_file($image_tmp_name, $image_folder);
            $sql = "UPDATE products 
                    SET product_name = '$product_name', product_img = '$image_folder', description = '$description', price = $price, quantity = $quantity 
                    WHERE id = $product_id";
        } else {
            $sql = "UPDATE products 
                    SET product_name = '$product_name', description = '$description', price = $price, quantity = $quantity 
                    WHERE id = $product_id";
        }

        if ($conn->query($sql) === TRUE) {
            $success_message = "Product updated successfully.";
            header("Location: ../admin.php"); 
            exit();
        } else {
            $error_message = "Error updating product: " . $conn->error;
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
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Product</h2>
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?= $success_message ?></div>
        <?php elseif (isset($error_message)): ?>
            <div class="alert alert-danger"><?= $error_message ?></div>
        <?php endif; ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" value="<?= $product['product_name'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="product_image" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="product_image" name="product_image" accept="image/*">
                <small>
                    Current Image: 
                    <?= isset($product['product_image']) && !empty($product['product_image']) 
                        ? "<a href='{$product['product_image']}' target='_blank'>View Image</a>" 
                        : "No image available" ?>
                </small>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?= $product['description'] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?= $product['price'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="<?= $product['quantity'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
            <a href="../admin.php" class="btn btn-secondary">Back to Admin Page</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
