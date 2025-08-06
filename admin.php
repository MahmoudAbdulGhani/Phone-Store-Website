<?php
session_start();

require_once 'connection.php';
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php'); 
    exit();
}

$products = $conn->query("SELECT * FROM products");
$orders = $conn->query("SELECT * FROM neworder");
$users = $conn->query("SELECT * FROM user");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Page</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#products">Manage Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#orders">Manage Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#users">Manage Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger text-white" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <section id="products">
            <h2 class="text-center mb-4">Manage Products</h2>
            <button class="btn btn-primary mb-3" onclick="location.href='actions/add_product.php'">Add New Product</button>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($product = $products->fetch_assoc()): ?>
                        <tr>
                            <td><?= $product['id'] ?></td>
                            <td><?= $product['product_name'] ?></td>
                            <td><?= $product['price'] ?></td>
                            <td><?= $product['quantity'] ?></td>
                            <td>
                                <a href="actions/edit_product.php?id=<?= $product['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="actions/delete_product.php?id=<?= $product['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>

        <section id="orders" class="mt-5">
            <h2 class="text-center mb-4">Manage Orders</h2>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($order = $orders->fetch_assoc()): ?>
                        <?php
                        $status = "";
                        if($order['status_id'] == 1){
                            $status = "Pending";
                        }elseif($order['status_id'] == 2){
                            $status = "Delivered";
                        }else{
                            $status = "Cancelled";
                        }
                        ?>
                        <tr>
                            <td><?= $order['id'] ?></td>
                            <td><?= $order['user_id'] ?></td>
                            <td><?= $order['total_price'] ?></td>
                            <td><?= $status?></td>
                            <td>
                                <a href="actions/update_order.php?id=<?= $order['id'] ?>" class="btn btn-info btn-sm">Update Status</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>

        <section id="users" class="mt-5">
            <h2 class="text-center mb-4">Manage Users</h2>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = $users->fetch_assoc()): ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td>
                                <a href="actions/edit_user.php?id=<?= $user['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="actions/delete_user.php?id=<?= $user['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
