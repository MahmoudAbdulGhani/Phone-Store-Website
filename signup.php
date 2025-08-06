<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Navbar -->
    <header>
        <div class="logo">PhoneStore</div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="contact.php">Contact</a></li>
                
                
            </ul>
        </nav>
    </header>

    <div class="login-container">
        <div class="login-form">
            <h2>Sign Up</h2>
            <form action="actions/signupaction.php" method="POST">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
                <label for="email">Email</label>
                <input type="text" id="username" name="email" placeholder="Enter your email" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>

                <label for="PHone">Phone number</label>
                <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>

                <input type="submit" class="submit">
                <p>You have an account? <a href="login.php">Login</a></p>

            </form>
        </div>
    </div>

</body>
</html>
