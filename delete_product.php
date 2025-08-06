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

        $sql = "DELETE FROM products WHERE id = $product_id";
        if ($conn->query($sql) === TRUE) {
            $success_message = "Product deleted successfully.";
        } else {
            $error_message = "Error deleting product: " . $conn->error;
        }
    } else {
        $error_message = "Product not found.";
    }
} else {
    $error_message = "Invalid product ID.";
}

if (isset($success_message) || isset($error_message)) {
    header("Location: ../admin.php?message=" . urlencode(isset($success_message) ? $success_message : $error_message));
    exit();
}
?>

