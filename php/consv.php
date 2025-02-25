<?php
session_start();

if (isset($_SESSION['id'])) {
    include('../config/config.php');

    include('../php/user.php');

    include('../php/massage.php');
    
    $id = $_GET['id'];

    if (!isset($id)) {
        header("location: home.php");
        exit;
    }
    $chatWith = GetUser($id, $conn);

    
    
    $chats = getMassage($_SESSION['id'], $chatWith['id'], $conn);
    
    // echo"<pre>";
    // print_r($chats);
    // die();

    if (empty($chatWith)) {
        header("location: home.php");
        exit;
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/cansv.css">
        <script src="../js/jquery.js"></script>
        <title>Chat Room</title>
    </head>

    <body>
        <div id="chat" class="chat">
            <h2>Welcome, <span><?php echo $chatWith['name']; ?></span></h2>
            <div class="msg" id="msg">
                    <?php
                        if(!empty($chats)){
                            foreach($chats as $chat){
                                if($chat['from_id'] == $_SESSION['id']){
                                    ?>
                                    <p class="sent"><?=$chat['massages'];?>
                                                <small style=" font-size: 9px;"><?=$chat['created_at'];?></small>
                                            </p>
                                    
                                    <?php
                                }else{

                                    ?>
                                    
                                    <p class="received"><?=$chat['massages'];?>
                                    <small style=" font-size: 9px;"><?=$chat['created_at'];?></small></p>
                                    
                                    <?php
                                }
                            }
                    ?>
<?php
                        }
                        else{
                            echo "not sended massages";
                        }
?>
            </div>

            <div class="input-msg">
                <input type="text" name="msg" id="massage" placeholder="Type your message here" class="input_msg" required>
                <button id="sendbtn">Send</button>
            </div>
        </div>
    </body>

    <script>
    // Function to scroll chat to the bottom
    function scrollToBottom() {
        let chatBox = document.getElementById('msg'); // Targeting the messages container
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    $(document).ready(function() {
        scrollToBottom(); // Scroll to bottom when the page loads

        $('#sendbtn').on("click", function(event) {
            event.preventDefault(); // Prevent form submission and page reload

            var message = $('#massage').val().trim();
            
            if (message == "") return; // Prevent empty messages

            $.post("insert.php", {
                massage: message,  // Ensure correct variable name
                to_id: <?= $chatWith['id'] ?> // Sending receiver ID
            },
            function(data) {
                $('#massage').val(''); // Clear input field
                $("#msg").append(data); // Append message to chat
                scrollToBottom(); // Scroll to the bottom automatically
            });
        });
    });
</script>



    </html>

<?php
} else {
    header("location: ../html/login.php");
    exit();
}
?>