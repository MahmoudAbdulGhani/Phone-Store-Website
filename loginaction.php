<?php
session_start();
require_once '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['username']) && !empty($_POST['username']) &&
        isset($_POST['email']) && !empty($_POST['email']) &&
        isset($_POST['password']) && !empty($_POST['password'])
    ) {
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars(md5($_POST['password'])); 

        $sql = "SELECT * FROM `user` WHERE `name` = '$username' AND `email` = '$email' AND `password` = '$password'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['name'];
            $_SESSION['role_id'] = $row['role_id'];
            $_SESSION['loggedin'] = true;

            if ($row['role_id'] == 2) { 
                $_SESSION['admin_logged_in'] = true;
                header("Location: ../admin.php");
            } else {
                header("Location: ../shop.php");
            }
            exit;
        } else {
            die("Invalid credentials. Please sign up or try again.");
        }
    } else {
        die("All fields are required.");
    }
} else {
    die("Invalid request method.");
}
?>
