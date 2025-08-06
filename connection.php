<?php
$conn = new mysqli("localhost", "root", "", "e-commerce");

if ($conn->connect_error) {
    die('Unable to connect: ' . $conn->connect_error);
}
?>