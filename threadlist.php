<?php
    include("partials/_connection.php");
    include("partials/_protectXSS.php");

    $catid = $_GET['catid'];
    $thread_insert_alert = false;
    $id=null;

    $query_category = "SELECT * FROM categories WHERE category_id = '$catid'";
    $data_category = mysqli_query($conn,$query_category);
    $rows_category = mysqli_num_rows($data_category);

    if($rows_category > 0) {
        $result_category = mysqli_fetch_assoc($data_category);
    }

    if(isset($_POST['submit_thread'])) {
        $title = filter_str($_POST['title']);
        $description = filter_str($_POST['description']);
        $user_id = $_POST['user_id'];

        $query_thread_insert = "INSERT INTO `threads` (`thread_title`, `thread_description`, `thread_category_id`,                 `thread_user_id`, `timestamp`) VALUES ('$title', '$description', '$catid', '$user_id', CURRENT_TIMESTAMP())";
        
        $data_thread_insert = mysqli_query($conn,$query_thread_insert);
        
        if($data_thread_insert) {
            $thread_insert_alert = true;
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assests/icon.ico" type="image/x-icon">
    <title>TechFestHub - <?php echo $result_category['category_name']; ?> Forums</title>
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
        if($thread_insert_alert) {
            echo '<div class="alert alert-success alert-dismissible fade show sticky-top" role="alert">
                    <strong>Success: </strong> Your Problem submitted successfully. Please wait for community to respond.  
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
    ?>

    <div class="container my-2">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $result_category['category_name']; ?> forums</h1>
            <p class="lead"><?php echo $result_category['category_description']; ?></p>
            <hr class="my-4">
            <p>This is a perr to perr forum. No spam / Advertising / Self-promote in the forums is not allowed. Do not
                post copyright-infringing material. Do not post "offensive" posts, links pr images. Do not cross post
                questions. Remain respectful of other members at all times.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>

    <div class="container">
        <h1 class="my-3 pb-3">Start a Discussion</h1>

        <?php
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                
                echo '<form action="'.htmlspecialchars($_SERVER['REQUEST_URI']).'" method="POST">
                        <div class="form-group">
                            <label for="title">Problem Title</label>
                            <input type="text" class="form-control" id="title" name="title" aria-describedby="titleHelp"
                                placeholder="Title..." required>
                            <small id="titleHelp" class="form-text text-muted">Keep your title as short and crisp as
                                possible.</small>
                        </div>
                        <input type="hidden" name="user_id" value="'.$_SESSION['user_id'].'">
                        <div class="form-group">
                            <label for="description">Elaborate Your Problem</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Elaborate..."
                                required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success" name="submit_thread">Submit</button>
                    </form>';
            } else {
                echo '<p class="lead text-danger">You are not loggedin. Please Login to be able to Post a Problem.</p>';
            }
        ?>
        
    </div>

    <div class="container mb-4 pb-3">
        <h1 class="my-3 pb-3">Browse Questions</h1>
        
        <div id="results">
            <?php
                require("partials/_dateTime.php");

                $query_thread = "SELECT * FROM threads WHERE thread_category_id = '$catid' LIMIT 5";
                $data_thread = mysqli_query($conn,$query_thread);
                $rows_thread = mysqli_num_rows($data_thread);
            
                if($rows_thread > 0) {
                    while($result_thread = mysqli_fetch_assoc($data_thread)) {

                        $query_thread_user = "SELECT * FROM users WHERE `user_id` = '$result_thread[thread_user_id]'";
                        $data_thread_user = mysqli_query($conn,$query_thread_user);
                        $result_thread_user = mysqli_fetch_assoc($data_thread_user);


                        echo '<div class="media my-4 pb-4">
                                <img src="'.$result_thread_user['user_pic'].'" width="50px" class="mr-3 rounded img-thumbnail" alt="user">
                                <div class="media-body">
                                    <h5 class="font-weight-bold">'.$result_thread_user['user_name'].'<span class="float-right">Posted on '.filter_dateTime($result_thread['timestamp']).'</span></h5>
                                    <h5 class="mt-0"><a href="threads.php?threadid='.$result_thread['thread_id'].'" class="text-dark font-weight-bold">'.$result_thread['thread_title'].'</a></h5>
                                    <p>'.$result_thread['thread_description'].'</p>
                                </div>
                            </div>';

                        $id = $result_thread['thread_id'];    
                    }
                } else {
                    echo '<h4 class=" pb-4"><span class="badge badge-danger">No Questions found!</span></h4>'; 
                }
            ?>
        </div>

        <div class="text-center pb-4" id="mainId">
            <input type="hidden" id="catid" value="<?php echo $catid; ?>">
            <input type="hidden" id="threadid" value="<?php echo $id; ?>">
            
            <?php
                if($rows_thread > 0) {
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
    <script src="js/load_threadlist.js"></script>
</body>

</html>