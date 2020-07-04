<?php
    session_start();
    include("_connection.php");
    $update = false;
    $isImageAlert = false;

    if(isset($_POST['update'])) {
        $updateUsername = $_POST['updateusername'];
        $userid = $_SESSION['user_id'];

        $query_update = "UPDATE `users` SET `user_name` = '$updateUsername' WHERE `user_id` = '$userid'";
        $data_update = mysqli_query($conn,$query_update);
        
        if($data_update) {
            $update = "Data updated successfully. Login again to see update.";
            header("location:/techfesthub_forum/index.php?update=".$update."");
        } else {
            $isImageAlert = "Sorry, Data is not updated";
            header("location:/techfesthub_forum/index.php?isImageAlert=".$isImageAlert."");
        }
    }
?>