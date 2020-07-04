<?php
    include("_connection.php");
    
    if(isset($_POST['threadid'])) {
        $threadid = $_POST['threadid'];
        $commentid = $_POST['commentid'];
        $bulk = array();

        require("_dateTime.php");
        
        $query = "SELECT * FROM comments WHERE comment_thread_id = '$threadid' AND comment_id > '$commentid' LIMIT 5";
        $data = mysqli_query($conn,$query);
        $rows = mysqli_num_rows($data);
        
        if($rows > 0) {
            while ($result_comment = mysqli_fetch_assoc($data)) {
                
                $query_comment_user = "SELECT * FROM users WHERE `user_id` = '$result_comment[comment_by]'";
                $data_comment_user = mysqli_query($conn,$query_comment_user);
                $result_comment_user = mysqli_fetch_assoc($data_comment_user);

                $txt = '<div class="media my-4 pb-4">
                        <img src="'.$result_comment_user['user_pic'].'" width="50px" class="mr-3 rounded img-thumbnail" alt="user">
                        <div class="media-body">
                        <h5 class="font-weight-bold">'.$result_comment_user['user_name'].'<span class="float-right">Posted on '.filter_dateTime($result_comment['comment_time']).'</span></h5>
                        <p>'.$result_comment['comment_description'].'</p>
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