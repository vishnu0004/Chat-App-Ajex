<?php
include('../config/config.php'); // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // File upload logic
    $image = $_FILES['image']['name'];
    $target = "../uploads/" . basename($image);

    // Check if email already exists
    $check_email = "SELECT * FROM user WHERE email = '$email'";
    $result = $conn->query($check_email);

    if ($result->num_rows > 0) {
        header("Location: ../html/signup.php?error=Email already exists!");
        exit();
    }

    // Insert into database
    $sql = "INSERT INTO user (name, email, password, image) VALUES ('$name', '$email', '$password', '$image')";

    if ($conn->query($sql) === TRUE) {
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        header("refresh;2 :url = ../html/signup.php?success=Signup successful!");
    } else {
        header("Location: ../html/signup.php?error=Error: " . $conn->error);
    }
}
?>
