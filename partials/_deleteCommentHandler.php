<?php
    $delete = false;
    $errorAlert = false;

    if(isset($_POST['submitDeleteComment'])) {
        include("_connection.php");

        $deleteCommentId = $_POST['deleteCommentId'];

        $query = "DELETE FROM `comments` WHERE `comment_id` = '$deleteCommentId'";

        $data = mysqli_query($conn,$query);

        if($data) {
            $delete = "Comment deleted successfully.";
            header("location:/techfesthub_forum/manageAccount.php?update=".$delete."");
        } else {
            $errorAlert = "Comment is not deleted!";
            header("location:/techfesthub_forum/manageAccount.php?errorAlert=".$errorAlert."");
        }
    }
?>