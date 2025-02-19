<?php 

    include('../config/config.php');
    session_start();

    if(isset($_SESSION['id'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="profile">
        <div class="img">
        <img src="../uploads/<?php  echo $_SESSION['image'];?>" alt="" style="width: 20%;">
        <h3><?php echo $_SESSION['name'];?></h3>
        </div>
        <a href="../php/logout.php">logout</a>
    </div>
    <div class="person">
        
    </div>
</body>
</html>




<?php
}
else{
    header("location: ../html/login.php");
    exit();
} 
?>