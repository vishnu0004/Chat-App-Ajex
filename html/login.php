<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signup.css">

    <title>Document</title>
</head>

<body>
    <div class="container">
        <form action="../php/login.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required>

            <input type="submit" value="Login Now" name="submit">

        </form>
        <a href="../html/signup.php">Signup Now</a>
    </div>
</body>

</html>