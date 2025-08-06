<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - PhoneStore</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>


<?php
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    echo '
    <header>
        <div class="logo">PhoneStore</div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li> 
                <li><a href="actions/logoutaction.php">Logout</a></li> 
                <li><a href="contact.php">Contact</a></li>
                <li><a href="shop.php">Shop</a></li>
            </ul>
        </nav>
    </header>';
}else{
    echo '
    <header>
        <div class="logo">PhoneStore</div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li> 
                <li><a href="login.php">Login</a></li> 
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>';
}
?>


    <section class="contact-form">
        <h2>Contact Us</h2>
        <form action="#">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name">
            <label for="message">Message:</label>
            <textarea id="message" name="message" placeholder="Your message..."></textarea>
            <button type="submit">Send</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2024 PhoneStore. All rights reserved.</p>
    </footer>

</body>
</html>
