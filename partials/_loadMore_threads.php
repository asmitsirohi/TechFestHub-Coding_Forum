<?php
    include("_connection.php");
    
    if(isset($_POST['catid'])) {
        $catid = $_POST['catid'];
        $threadid = $_POST['threadid'];
        $bulk = array();

        require("_dateTime.php");
        
        $query = "SELECT * FROM threads WHERE thread_category_id = '$catid' AND thread_id > '$threadid' LIMIT 5";
        $data = mysqli_query($conn,$query);
        $rows = mysqli_num_rows($data);
        
        if($rows > 0) {
            while ($result_thread = mysqli_fetch_assoc($data)) {
                
                $query_thread_user = "SELECT * FROM users WHERE `user_id` = '$result_thread[thread_user_id]'";
                $data_thread_user = mysqli_query($conn,$query_thread_user);
                $result_thread_user = mysqli_fetch_assoc($data_thread_user);


                $txt = '<div class="media my-4 pb-4">
                        <img src="'.$result_thread_user['user_pic'].'" width="50px" class="mr-3 rounded img-thumbnail" alt="user">
                        <div class="media-body">
                            <h5 class="font-weight-bold">'.$result_thread_user['user_name'].'<span class="float-right">Posted on '.filter_dateTime($result_thread['timestamp']).'</span></h5>
                            <h5 class="mt-0"><a href="threads.php?threadid='.$result_thread['thread_id'].'" class="text-dark font-weight-bold">'.$result_thread['thread_title'].'</a></h5>
                            <p>'.$result_thread['thread_description'].'</p>
                        </div>
                    </div>';

                $id = $result_thread['thread_id'];
                $thread = array($id => $txt);
                array_push($bulk,$thread);
            }

            echo json_encode($bulk);
        } else {
            echo -1;
        }
    }
?>