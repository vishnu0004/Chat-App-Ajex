<?php
session_start();

if (isset($_SESSION['id'])) {

    if (isset($_POST['massage']) && isset($_POST['to_id'])) {
        include('../config/config.php');
        $massage = $_POST['massage'];
        $to_id = $_POST['to_id'];
        $from_id = $_SESSION['id'];

        // Insert message
        $insert = "INSERT INTO massage (from_id, to_id, massages) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insert);
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("iis", $from_id, $to_id, $massage);
        $stmt->execute();
        $stmt->close(); // Close statement

        // Check if chat exists
        $sql = "SELECT * FROM chat WHERE (user_1 = ? AND user_2 = ?) OR (user_2 = ? AND user_1 = ?)";
        $stmt1 = $conn->prepare($sql);
        if ($stmt1 === false) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt1->bind_param("iiii", $from_id, $to_id, $from_id, $to_id);
        $stmt1->execute();
        $result = $stmt1->get_result(); // Fetch result
        $stmt1->close(); // Close statement

        // If no chat exists, insert into chat table
        if ($result->num_rows == 0) {
            $sql3 = "INSERT INTO chat (user_1, user_2) VALUES (?, ?)";
            $stmt3 = $conn->prepare($sql3);
            if ($stmt3 === false) {
                die("Prepare failed: " . $conn->error);
            }
            $stmt3->bind_param("ii", $from_id, $to_id);
            $stmt3->execute();
            $stmt3->close(); // Close statement
        }
        ?>
        <p class="sent"><?= htmlspecialchars($massage) ?></p>
        <?php
    }
} else {
    header("location: login.php");
    exit;
}
?>
