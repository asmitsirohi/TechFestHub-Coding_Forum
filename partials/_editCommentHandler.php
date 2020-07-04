<?php
    $update = false;
    $errorAlert = false;

    if(isset($_POST['submitEditComment'])) {
        include("_connection.php");

        $commentid = $_POST['commentid'];
        $commentEdit = $_POST['commentEdit'];

        $query = "UPDATE `comments` SET `comment_description` = '$commentEdit' WHERE `comment_id` = '$commentid'
        ";

        $data = mysqli_query($conn,$query);

        if($data) {
            $update = "Comment updated successfully.";
            header("location:/techfesthub_forum/manageAccount.php?update=".$update."");
        } else {
            $errorAlert = "Comment is not updated!";
            header("location:/techfesthub_forum/manageAccount.php?errorAlert=".$errorAlert."");
        }
    }
?>