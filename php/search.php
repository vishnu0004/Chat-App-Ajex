<?php
session_start();
if (isset($_SESSION['id'])) {
    if (isset($_POST['key'])) {
        include('../config/config.php');
        $search = $_POST['key'];
        $key = "%$search%";

        // Prepare query
        $select = "SELECT * FROM user WHERE name LIKE ?";
        $stmt = $conn->prepare($select);
        $stmt->bind_param("s", $key);
        $stmt->execute();
        $result = $stmt->get_result(); // Get the result set

        // Fetch results
        if ($result->num_rows > 0) {
            while ($chat = $result->fetch_assoc()) { 
                ?>
                <li><a href="consv.php?id=<?php echo htmlspecialchars($chat['id']); ?>">
                        <div class="image">
                            <img src="../uploads/<?php echo htmlspecialchars($chat['image']); ?>" style="width: 20%;">
                        </div>
                        <h3><?php echo htmlspecialchars($chat['name']); ?></h3>
                    </a>
                </li>
                <?php
            }
        } else {
            echo "<li>" . htmlspecialchars($_POST['key']) . " is not found</li>";
        }

        $stmt->close(); // Close statement
    }
} else {
    header("Location: ../html/login.php");
    exit;
}
?>
