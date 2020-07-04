<?php
    $update = false;
    $errorAlert = false;

    if(isset($_POST['submitEditThread'])) {
        include("_connection.php");

        $editId = $_POST['editId'];
        $problemEdit = $_POST['problemEdit'];
        $contentEdit = $_POST['contentEdit'];

        $query = "UPDATE `threads` SET `thread_title` = '$problemEdit' , `thread_description` = '$contentEdit' WHERE `threads`.`thread_id` = '$editId'";

        $data = mysqli_query($conn,$query);

        if($data) {
            $update = "Thread updated successfully.";
            header("location:/techfesthub_forum/manageAccount.php?update=".$update."");
        } else {
            $errorAlert = "Thread is not updated!";
            header("location:/techfesthub_forum/manageAccount.php?errorAlert=".$errorAlert."");
        }
    }
?>