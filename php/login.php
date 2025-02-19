<?php
session_start();
include('../config/config.php');
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password= md5($_POST['password']);
    $login = "select * from user where email = '$email' or password = '$password'";
    $result = $conn->query($login);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['image'] = $row['image'];

            header("location: home.php");
        }
    }
    else{
        echo "somethings wrong";
    }
    }
?>