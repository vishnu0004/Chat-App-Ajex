<?php
    function GetUser($id,$conn){
        $sql = "select * from user Where id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i",$id);
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows === 1){
            $user = $result->fetch_assoc();
            return $user;
        }
        else{
            $user = [];
            return $user;
        }
    }
?>