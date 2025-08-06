<?php
session_start();
require_once '../connection.php'; 

if (!isset($_SESSION['admin_logged_in'])) {
    die("Access denied. Please log in as an admin.");
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $user_id = intval($_GET['id']);

    $sql = "DELETE FROM `user` WHERE `id` = $user_id";
    $result = $conn->query($sql);

    if ($result) {
        header("Location: ../admin.php?msg=User+deleted+successfully");
        exit();
    } else {
        die("Error deleting user: " . $conn->error);
    }
} else {
    die("Invalid user ID.");
}
?>
