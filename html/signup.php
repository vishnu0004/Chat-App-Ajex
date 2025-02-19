<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled Form</title>
    <script src="../js/jquery.js"></script>
    <link rel="stylesheet" href="../css/signup.css">
</head>
<body>
    <!-- <script> 
        $(Document).ready(function(){
            alert("hello you");
        });
    </script> -->

    <div class="container">
        <?php
        if (isset($_GET['error'])) {
            echo "<p style='color: red;'>" . $_GET['error'] . "</p>";
        } elseif (isset($_GET['success'])) {
            echo "<p style='color: green;'>" . $_GET['success'] . "</p>";
        }
        ?>
        <form action="../php/signup.php" method="post" enctype="multipart/form-data">
            <h2>Register Here</h2>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter Name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required>

            <label for="image">Upload Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>

            <input type="submit" value="Signup Now" name="submit">
        </form>
        <a href="../html/login.php">Login Now</a>
    </div>
</body>
</html>
