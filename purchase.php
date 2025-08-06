<?php 
session_start();

require_once '../connection.php';

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    die("User ID is not set in the session.");
}

$user_id = $_SESSION['user_id'];
$product_id = $_SESSION['product_id'];
$quantity = $_SESSION['quantity'];
$total_price = $_SESSION['total_price'];
$date = $_SESSION['date'];

$status_id = 1;

$sql = "INSERT INTO `neworder`(`user_id`, `product_id`, `total_price`, `date`, `quantity`, `status_id`) 
        VALUES (?, ?, ?, ?, ?, ?)";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("iidssi", $user_id, $product_id, $total_price, $date, $quantity, $status_id);

    echo "Debugging Info:<br>";
    echo "User ID: " . $user_id . "<br>";
    echo "Product ID: " . $product_id . "<br>";
    echo "Quantity: " . $quantity . "<br>";
    echo "Total Price: " . $total_price . "<br>";
    echo "Date: " . $date . "<br>";
    echo "Status ID: " . $status_id . "<br>";

    if ($stmt->execute()) {
        header("Location: ../shop.php");
        exit;
    } else {
        echo "Error: Could not execute the query. " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error: Could not prepare the statement. " . $conn->error;
}

$conn->close();
?>
