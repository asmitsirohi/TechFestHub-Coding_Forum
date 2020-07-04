<?php
    include("_connection.php");
    
    if(isset($_POST['commentid'])) {
        session_start();

        $userid = $_SESSION['user_id'];
        $commentid = $_POST['commentid'];
        $bulk = array();

        require("_dateTime.php");
        
        $query = "SELECT * FROM comments WHERE comment_by = '$userid' AND comment_id > '$commentid' LIMIT 5";
        $data = mysqli_query($conn,$query);
        $rows = mysqli_num_rows($data);
        
        if($rows > 0) {
            while ($result_comment = mysqli_fetch_assoc($data)) {

                $txt = '<div class="media my-4 pb-4">
                        <div class="media-body">
                        <span class="float-right">Posted on '.filter_dateTime($result_comment['comment_time']).'</span>
                        <p>'.$result_comment['comment_description'].'</p>
                        <button class="editComment btn btn-primary btn-sm" id="'.$result_comment['comment_id'].'">Edit</button>
                        <button class="deleteComment btn btn-danger btn-sm" id="'.$result_comment['comment_id'].'">Delete</button>
                        </div>
                    </div>';

                $id = $result_comment['comment_id'];
                $comment = array($id => $txt);
                array_push($bulk,$comment);
            }

            echo json_encode($bulk);
        } else {
            echo -1;
        }
    }
?>