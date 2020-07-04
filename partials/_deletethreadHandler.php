<?php
    $delete = false;
    $errorAlert = false;

    if(isset($_POST['submitDeleteThread'])) {
        include("_connection.php");

        $deleteId = $_POST['deleteId'];

        $query = "DELETE FROM `threads` WHERE `thread_id` = '$deleteId' ";

        $data = mysqli_query($conn,$query);

        if($data) {
            $delete = "Thread deleted successfully.";
            header("location:/techfesthub_forum/manageAccount.php?update=".$delete."");
        } else {
            $errorAlert = "Thread is not deleted!";
            header("location:/techfesthub_forum/manageAccount.php?errorAlert=".$errorAlert."");
        }
    }
?>