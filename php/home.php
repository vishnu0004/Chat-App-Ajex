<?php

session_start();

if (isset($_SESSION['id'])) {
    include('../config/config.php');
    include('../php/user.php');
    include('../php/chat.php');

    $user = GetUser($_SESSION['id'], $conn);

    $datas = GetChat($user['id'], $conn);

    // echo "<pre>";
    // print_r($data);
    // // die();

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../js/jquery.js"></script>
        <title>Document</title>
    </head>

    <body>
        <div class="profile">
            <div class="img">
                <img src="../uploads/<?php echo $user['image']; ?>" alt="" style="width: 20%;">
                <h3><?php echo $user['name']; ?></h3>
            </div>
            <a href="../php/logout.php">logout</a>
            <div class="search">
                <input type="text" name="search" id="search" placeholder="Search.....">
                <button id="btn">Search</button>
            </div>
        </div>
        <ul class="list" id="list">
            <?php
            if (!empty($datas)) {
                foreach ($datas as $data) {
            ?>
                    <li><a href="conv.php?id=<?php echo $data['id'] ?>">
                            <div class="image">
                                <img src="../uploads/<?php echo $data['image']; ?>" style="width: 20%;">
                            </div>
                            <h3><?php echo $data['name']; ?></h3>
                        </a>
                    </li>
                <?php } ?>
            <?php
            } else {
                echo "not massage start";
            }
            ?>
        </ul>


        <script>
            $(document).ready(function() {

                // Search on button click
                $("#btn").on("click", function() {
                    var SearchText = $("#search").val();
                    $.post('search.php', {
                        key: SearchText
                    }, function(data, status) {
                        $("#list").html(data); // FIXED: Changed .list to #list
                    });
                });
            });
        </script>
    </body>

    </html>

<?php
} else {
    header("location: ../html/login.php");
    exit();
}
?>