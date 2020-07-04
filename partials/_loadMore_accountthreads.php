<?php
    include("_connection.php");
    
    if(isset($_POST['threadid'])) {
        session_start();

        $userid = $_SESSION['user_id'];
        $threadid = $_POST['threadid'];
        $bulk = array();

        require("_dateTime.php");
        
        $query = "SELECT * FROM threads WHERE thread_user_id = '$userid' AND thread_id > '$threadid' LIMIT 5";
        $data = mysqli_query($conn,$query);
        $rows = mysqli_num_rows($data);
        
        if($rows > 0) {
            while ($result_thread = mysqli_fetch_assoc($data)) {
                
                $txt = '<div class="media my-4 pb-4">
                        <div class="media-body">
                            <span class="float-right">Posted on '.filter_dateTime($result_thread['timestamp']).'</span>
                            <h5 class="mt-0"><a href="threads.php?threadid='.$result_thread['thread_id'].'" class="text-dark font-weight-bold">'.$result_thread['thread_title'].'</a></h5>
                            <p>'.$result_thread['thread_description'].'</p>
                            <button class="editThread btn btn-primary btn-sm" id="'.$result_thread['thread_id'].'">Edit</button>
                            <button class="deleteThread btn btn-danger btn-sm" id="'.$result_thread['thread_id'].'">Delete</button>
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