<?php
    include("partials/_connection.php");
    include("partials/_protectXSS.php");

    $threadid = $_GET['threadid'];
    $comment_insert_alert = false;
    $id=null;

    $query_thread = "SELECT * FROM threads WHERE thread_id = '$threadid'";
    $data_thread = mysqli_query($conn,$query_thread);
    $rows_thread = mysqli_num_rows($data_thread);

    if($rows_thread > 0) {
        $result_thread = mysqli_fetch_assoc($data_thread);
    }

    $query_thread_user = "SELECT * FROM users WHERE `user_id` = '$result_thread[thread_user_id]'";
    $data_thread_user = mysqli_query($conn,$query_thread_user);
    $result_thread_user = mysqli_fetch_assoc($data_thread_user);

    if(isset($_POST['submit_comment'])) {
        $description = filter_str($_POST['description']);
        $user_id = $_POST['user_id'];

        $query_comment_insert = "INSERT INTO `comments` (`comment_description`, `comment_thread_id`, `comment_by`, `comment_time`) VALUES ('$description', '$threadid', '$user_id', CURRENT_TIMESTAMP())";
        
        $data_comment_insert = mysqli_query($conn,$query_comment_insert);
        
        if($data_comment_insert) {
            $comment_insert_alert = true;
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assests/icon.ico" type="image/x-icon">
    <title>TechFestHub - Thread Forum</title>
    <link rel="stylesheet" href="libs/css/bootstrap.min.css">
    <script src="libs/jquery-3.4.1.min.js"></script>
    <script src="libs/popper.min.js"></script>
    <script src="libs/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <script src="js/script.js"></script>
</head>

<body>
    <?php require('partials/_header.php');?>
    <?php
        if($comment_insert_alert) {
            echo '<div class="alert alert-success alert-dismissible fade show sticky-top" role="alert">
                    <strong>Success: </strong> Your Comment posted successfully.  
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
    ?>


    <div class="container my-2">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $result_thread['thread_title']; ?></h1>
            <p class="lead"><?php echo $result_thread['thread_description']; ?></p>
            <hr class="my-4">
            <p>This is a perr to perr forum. No spam / Advertising / Self-promote in the forums is not allowed. Do not
                post copyright-infringing material. Do not post "offensive" posts, links pr images. Do not cross post
                questions. Remain respectful of other members at all times.</p>
            <h5><span class="badge badge-success">Posted by : <?php echo $result_thread_user['user_name']; ?></span></h5>
        </div>
    </div>

    <div class="container">
        <h1 class="my-3 pb-3">Post a Comment</h1>

        <?php
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo '<form action="'.htmlspecialchars($_SERVER['REQUEST_URI']).'" method="POST">
                        <div class="form-group">
                            <label for="description">Write Your Comment</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Write..."
                                required></textarea>
                        </div>
                        <input type="hidden" name="user_id" value="'.$_SESSION['user_id'].'">
                        <button type="submit" class="btn btn-success" name="submit_comment">Post Comment</button>
                    </form>';
            } else {
                echo '<p class="lead text-danger">You are not loggedin. Please Login to be able to Post a Comment.</p>';
            }
        ?>
        
    </div>


    <div class="container mb-4">
        <h1 class="my-3 pb-3">Discussion</h1>
        
        <div id="results">
            <?php
                $query_comment = "SELECT * FROM comments WHERE comment_thread_id = '$threadid' LIMIT 5";
                $data_comment = mysqli_query($conn,$query_comment);
                $rows_comment = mysqli_num_rows($data_comment);

                require("partials/_dateTime.php");
            
                if($rows_comment > 0) {
                    while($result_comment = mysqli_fetch_assoc($data_comment)) {

                        $query_comment_user = "SELECT * FROM users WHERE `user_id` = '$result_comment[comment_by]'";
                        $data_comment_user = mysqli_query($conn,$query_comment_user);
                        $result_comment_user = mysqli_fetch_assoc($data_comment_user);

                        echo '<div class="media my-4 pb-4">
                                <img src="'.$result_comment_user['user_pic'].'" width="50px" class="mr-3 rounded img-thumbnail" alt="user">
                                <div class="media-body">
                                <h5 class="font-weight-bold">'.$result_comment_user['user_name'].'<span class="float-right">Posted on '.filter_dateTime($result_comment['comment_time']).'</span></h5>
                                <p>'.$result_comment['comment_description'].'</p>
                                </div>
                            </div>';

                        $id = $result_comment['comment_id'];
                    }
                } else {
                    echo '<h4 class="pb-4"><span class="badge badge-danger">No Comments Yet!</span></h4>'; 
                }
            ?>
        </div>
        
        <div class="text-center pb-4" id="mainId">
            <input type="hidden" id="threadid" value="<?php echo $threadid; ?>">
            <input type="hidden" id="commentid" value="<?php echo $id; ?>">
            
            <?php
                if($rows_comment > 0) {
                    echo '<div id="nonspinner">
                            <button class="btn btn-primary" id="loadMore">Load more</button>
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

    <?php require('partials/_footer.php');?>
    <script src="js/load_commentlist.js"></script>
</body>

</html>
