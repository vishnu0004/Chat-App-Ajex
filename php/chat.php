<?php
function GetChat($user_id, $conn) {
    $sql = "SELECT * FROM chat WHERE user_1 = ? OR user_2 = ? ORDER BY chat_id DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $user_id); // Binding user_id twice
    $stmt->execute();
    $result = $stmt->get_result(); // Get result set

        
    if ($result->num_rows > 0) {  
        $data = [];
            
        while ($chat = $result->fetch_assoc()) {  // Fetching chat records
            if ($chat['user_1'] == $user_id) {
                $sql2 = "SELECT id, name, image, last_seen FROM user WHERE id = ?";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bind_param("i", $chat['user_2']);  // Fix: Correct key usage
            } else {
                $sql2 = "SELECT id, name, image, last_seen FROM user WHERE id = ?";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bind_param("i", $chat['user_1']);  // Fix: Correct key usage
            }

            $stmt2->execute();
            $result2 = $stmt2->get_result();
            $userData = $result2->fetch_assoc();  // Fetch only one row

            array_push($data, $userData); // Store chat data
        }
        
        return $data;
    } else {
        return [];  // Return empty array if no chat found
    }
}
?>
