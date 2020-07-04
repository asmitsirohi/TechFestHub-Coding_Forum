<?php
    include("partials/_connection.php");
    $commentId = null;
    $id = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assests/icon.ico" type="image/x-icon">
    <title>TechFestHub - Coding Forums</title>
    <link rel="stylesheet" href="libs/css/bootstrap.min.css">
    <script src="libs/jquery-3.4.1.min.js"></script>
    <script src="libs/popper.min.js"></script>
    <script src="libs/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="libs/style.css">
</head>

<body>
    <?php require('partials/_header.php');?>
    <?php require('partials/editThreadModal.php');?>
    <?php require('partials/deleteThreadModal.php');?>
    <?php require('partials/editCommentModal.php');?>
    <?php require('partials/deleteCommentModal.php');?>

    <div class="container mb-4">
        <div class="form-inline my-4">
            <a href="<?php echo $_SESSION['user_pic'];?>"><img src="<?php echo $_SESSION['user_pic'];?>"
                    alt="profile_pic" class="rounded img-thumbnail" width="100px"></a>
            <h1 class="ml-4 text-center">Hi, <?php echo $_SESSION['user_name'];?></h1>
        </div>
        <div class="container">
            <h5 class="text-danger mb-3">*After making changes on your data, Press <span
                    class="badge badge-primary">Update</span> button to update.</h5>

            <form action="partials/_updateAccount.php" method="POST">
                <div class="form-group">
                    <label for="updateusername">Username</label>
                    <input type="text" class="form-control" id="updateusername" name="updateusername"
                        value="<?php echo $_SESSION['user_name'];?>" required>
                </div>
                <div class="form-group">
                    <label for="useremail">Email address</label>
                    <input type="email" class="form-control" id="useremail" name="useremail"
                        aria-describedby="emailHelp" value="<?php echo $_SESSION['user_email'];?>" disabled>
                    <small id="emailHelp" class="form-text text-danger">You can't change email address.</small>
                </div>
                <button type="submit" class="btn btn-primary" name="update">Update</button>
            </form>
        </div>

        <div class="container mb-4 pb-3">
            <h1 class="my-3 py-3"><span class="badge badge-success">Your Threads</span></h1>

            <div id="scroll">
                <div id="manageThreads">
                    <?php
                            require("partials/_dateTime.php");
                            $userid = $_SESSION['user_id'];
    
                            $query_thread = "SELECT * FROM threads WHERE thread_user_id = '$userid' LIMIT 5";
                            $data_thread = mysqli_query($conn,$query_thread);
                            $rows_thread = mysqli_num_rows($data_thread);
                        
                            if($rows_thread > 0) {
                                while($result_thread = mysqli_fetch_assoc($data_thread)) {
    
                                    echo '<div class="media my-4 pb-4">
                                            <div class="media-body">
                                                <span class="float-right">Posted on '.filter_dateTime($result_thread['timestamp']).'</span>
                                                <h5 class="mt-0"><a href="threads.php?threadid='.$result_thread['thread_id'].'" class="text-dark font-weight-bold">'.$result_thread['thread_title'].'</a></h5>
                                                <p>'.$result_thread['thread_description'].'</p>
                                                <button class="editThread btn btn-primary btn-sm" id="'.$result_thread['thread_id'].'">Edit</button>
                                                <button class="deleteThread btn btn-danger btn-sm" id="'.$result_thread['thread_id'].'">Delete</button>
                                            </div>
                                        </div>';
    
                                    $id = $result_thread['thread_id'];
                                        
                                }
                            } else {
                                echo '<h4 class=" pb-4"><span class="badge badge-danger">No threads asked by you!</span></h4>'; 
                            }
                        ?>
                </div>

                <div class="text-center pb-4" id="mainId">
                    <input type="hidden" id="threadid" value="<?php echo $id; ?>">

                    <?php
                        if($rows_thread > 0) {
                            echo '<div id="nonspinner">
                                    <button class="btn btn-primary" id="loadMorethreads">Load more</button>
                                </div>';
        
                            echo '<div id="spinner" style="display:none;">
                                <button class="btn btn-primary" type="button" disabled>
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                    Loading...
                                </button>    
                                </div>';
                        }
                    ?>

                </div>
            </div>
        </div>

        <div class="container mb-4 pb-3">
            <h1 class="my-3 py-3"><span class="badge badge-success">Your Comments</span></h1>

            <div id="scroll">
                <div id="manageComments">
                    <?php

                            $query_comment = "SELECT * FROM comments WHERE comment_by = '$userid' LIMIT 5";
                            $data_comment = mysqli_query($conn,$query_comment);
                            $rows_comment = mysqli_num_rows($data_comment);
                        
                            if($rows_comment > 0) {
                                while($result_comment = mysqli_fetch_assoc($data_comment)) {

                                    echo '<div class="media my-4 pb-4">
                                            <div class="media-body">
                                            <span class="float-right">Posted on '.filter_dateTime($result_comment['comment_time']).'</span>
                                            <p>'.$result_comment['comment_description'].'</p>
                                            <button class="editComment btn btn-primary btn-sm" id="'.$result_comment['comment_id'].'">Edit</button>
                                            <button class="deleteComment btn btn-danger btn-sm" id="'.$result_comment['comment_id'].'">Delete</button>
                                            </div>
                                        </div>';

                                    $commentId = $result_comment['comment_id'];
                                }
                            } else {
                                echo '<h4 class=" pb-4"><span class="badge badge-danger">No Comments by you!</span></h4>'; 
                            }
                        ?>
                </div>

                <div class="text-center pb-4" id="mainCommentId">
                    <input type="hidden" id="commentid" value="<?php echo $commentId; ?>">

                    <?php
                        if($rows_comment > 0) {
                            echo '<div id="nonspinnerComments">
                                    <button class="btn btn-primary" id="loadMoreComments">Load more</button>
                                </div>';

                            echo '<div id="spinnerComments" style="display:none;">
                                <button class="btn btn-primary" type="button" disabled>
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                    Loading...
                                </button>    
                                </div>';
                        }
                    ?>

                </div>

            </div>
        </div>
    </div>
    <?php require('partials/_footer.php');?>
    <script src="js/editThreadModal.js"></script>
    <script src="js/editCommentModal.js"></script>
    <script src="js/load_acountthread.js"></script>
    <script src="js/load_accountcomment.js"></script>
</body>

</html>