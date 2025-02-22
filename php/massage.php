<?php
function getMassage($id_1, $id_2, $conn) {
    $sql = "SELECT * FROM massage 
            WHERE (from_id = ? AND to_id = ?) 
               OR (from_id = ? AND to_id = ?) 
            ORDER BY chat_id ASC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii", $id_1, $id_2, $id_2, $id_1); // Bind parameters
    $stmt->execute();

    $result = $stmt->get_result(); // Get the result set

    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    return $rows; // Return an array of messages
}
?>
