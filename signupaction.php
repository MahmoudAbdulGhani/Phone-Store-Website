<?php
session_start();
require_once '../connection.php';
if(
    !isset($_POST['username']) && empty($_POST['username'])
    || !isset($_POST['email']) && empty($_POST['email'])
    || !isset($_POST['password']) && empty($_POST['password'])
    || !isset($_POST['phone']) && empty($_POST['phone'])
    ){
        die("valid Input");
    }
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $phone = $_POST['phone'];
    
    $Sql = "SELECT  `name`, `email`, `password`, `phone`, `role_id` FROM `user` ";
    $result = $conn->query($Sql);
    $row = $result->fetch_assoc();

     if(
        $username == $row['name'] &&
        $email == $row['email'] &&
        $password == $row['password'] &&
        $phone == $row['phone']
        ){
            die("You Already have an account");
        }else{
           $Sql = "INSERT INTO `user`(`id`, `name`, `email`, `password`, `phone`, `role_id`) 
            VALUES (null,'$username','$email','$password','$phone','1')";
            $conn->query($Sql);
            $_SESSION["loggedin"] = true; 
            header("Location:../shop.php");
    
        }

