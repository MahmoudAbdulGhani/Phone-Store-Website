<?php
session_start();
require_once 'connection.php';
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
}
$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }

        /* Navbar */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background-color: #1e3d58;
            color: white;
        }

        header .logo {
            font-size: 28px;
            font-weight: bold;
            text-transform: uppercase;
        }

        header nav ul {
            list-style-type: none;
            display: flex;
        }

        header nav ul li {
            margin-right: 25px;
        }

        header nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        header nav ul li a:hover {
            color: #1abc9c;
        }

        header .cart-link {
            font-size: 18px;
            color: #1abc9c;
            font-weight: bold;
        }

        header .cart-link:hover {
            color: #16a085;
        }

        /* Cart Section */
        .cart-section {
            padding: 40px 20px;
            background-color: #fff;
        }

        .cart-container {
            max-width: 1100px;
            margin: 0 auto;
            background-color: #f9f9f9;
            padding: 30px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .cart-container h2 {
            font-size: 36px;
            margin-bottom: 30px;
            text-align: center;
            color: #333;
        }

        /* Cart Table */
        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .cart-table th, .cart-table td {
            padding: 15px;
            text-align: center;
        }

        .cart-table th {
            background-color: #1e3d58;
            color: white;
            font-size: 18px;
        }

        .cart-table td {
            background-color: #f9f9f9;
            font-size: 16px;
        }

        .cart-item-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            margin-right: 15px;
        }

        .cart-item-name {
            font-size: 16px;
            font-weight: bold;
        }

        /* Cart Summary */
        .cart-summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .cart-summary .subtotal {
            font-size: 24px;
            font-weight: bold;
        }

        .cart-summary #cart-total {
            font-size: 24px;
            color: #e74c3c;
        }

        .checkout-btn {
            background-color: #1abc9c;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .checkout-btn:hover {
            background-color: #16a085;
        }

        /* Remove Button */
        .remove-item {
            background-color: #e74c3c;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .remove-item:hover {
            background-color: #c0392b;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .cart-container {
                padding: 20px;
            }

            .cart-table th, .cart-table td {
                font-size: 14px;
            }

            .cart-summary {
                flex-direction: column;
                text-align: center;
            }

            .checkout-btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .cart-container {
                padding: 15px;
            }

            .cart-summary {
                flex-direction: column;
                text-align: center;
            }

            .checkout-btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">PhoneStore</div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="actions/logoutaction.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="cart-section">
        <div class="cart-container">
            <h2>Your Shopping Cart</h2>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_GET['id']) && !empty($_GET['id'])) {
                        $id = (int)$_GET['id'];

                        $sql = "SELECT `product_name`, `product_img`, `price` FROM `products` WHERE `id` = $id";
                       
                        $res = $conn->query($sql);

                        if ($res && $res->num_rows > 0) {
                            $row = $res->fetch_assoc();

                            $quantity = isset($_GET['quantity']) ? (int)$_GET['quantity'] : 1;
                            $total = $quantity * $row['price'];
                            ?>
                            <tr>
                                <td>
                                    <img src="<?php echo $row['product_img']; ?>" alt="Phone" class="cart-item-image">
                                    <?php echo $row['product_name']; ?>
                                </td>
                                <td><?php echo $row['price']; ?></td>
                                <td>
                                    <form action="cart.php" method="GET">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <input type="number" name="quantity" value="<?php echo $quantity; ?>" min="1">
                                        <input type="submit" value="Update">
                                    </form>
                                </td>
                                <td><?php echo $total; ?></td>
                                <td>
                                    <button class="remove-item">Remove</button>
                                </td>
                            </tr>
                            <?php
                        } else {
                            echo "<tr><td colspan='5'>Product not found</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Your cart is empty</td></tr>";
                    }
                    ?>
                </tbody>
               <!-- -->
            </table>
            <div class="cart-summary">
                <div class="subtotal">
                    <h3>Subtotal:</h3>
                    <span id="cart-total">$<?php echo $total; ?></span>
                </div>
              <a href="actions/purchase.php"><button class="checkout-btn" >Purchase</button></a> 
            </div> 
            <?php
             $_SESSION['product_id'] = $id;
             $_SESSION['quantity'] = $quantity;
             $_SESSION['total_price'] = $total;
             $date = date('Y-m-d H:i:s');
             $_SESSION['date'] = $date;
            ?>
        </div>
    </section>
</body>
</html>
