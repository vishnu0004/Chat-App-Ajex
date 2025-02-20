<?php
    function GetUser($username,$conn){
        $sql = "select * from user where id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username]);

        if($stmt->RowCount() === 1){
            $user = $stmt->fetch();
            return $user;
        }
        else{
            $user =[];
            return $user;
        }
    }
?>