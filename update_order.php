<?php
session_start();
require_once '../connection.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $order_id = $_GET['id'];

    $query = "
        SELECT neworder.id, neworder.user_id, neworder.total_price, order_status.status
        FROM neworder
        JOIN order_status ON neworder.status_id = order_status.id
        WHERE neworder.id = $order_id
    ";

    $result = $conn->query($query);

    if ($result === false) {
        die("Error executing query: " . $conn->error);
    }

    if ($result->num_rows == 1) {
        $order = $result->fetch_assoc();
    } else {
        die("Order not found.");
    }
} else {
    die("Invalid order ID.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_status_id = $_POST['status_id'];

    $update_query = "UPDATE neworder SET status_id = $new_status_id WHERE id = $order_id";

    if ($conn->query($update_query) === TRUE) {
        $success_message = "Order status updated successfully.";
    } else {
        $error_message = "Error updating order status: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Update Order Status</h2>
        
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?= $success_message ?></div>
        <?php elseif (isset($error_message)): ?>
            <div class="alert alert-danger"><?= $error_message ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="mb-3">
                <label for="order_id" class="form-label">Order ID</label>
                <input type="text" class="form-control" id="order_id" value="<?= $order['id'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="customer" class="form-label">Customer ID</label>
                <input type="text" class="form-control" id="customer" value="<?= $order['user_id'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="total_price" class="form-label">Total Price</label>
                <input type="text" class="form-control" id="total_price" value="<?= $order['total_price'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status_id" name="status_id" required>
                    <option value="1" <?= $order['status'] == "Pending" ? 'selected' : '' ?>>Pending</option>
                    <option value="2" <?= $order['status'] == "Delivered" ? 'selected' : '' ?>>Delivered</option>
                    <option value="3" <?= $order['status'] == "Cancelled" ? 'selected' : '' ?>>Cancelled</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Status</button>
            <a href="../admin.php" class="btn btn-secondary">Back to Admin Page</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
