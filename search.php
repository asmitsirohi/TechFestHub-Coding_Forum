<?php
    include("partials/_connection.php");

    $search = $_GET['query'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assests/icon.ico" type="image/x-icon">
    <title>TechFestHub - Search Forums</title>
    <link rel="stylesheet" href="libs/css/bootstrap.min.css">
    <script src="libs/jquery-3.4.1.min.js"></script>
    <script src="libs/popper.min.js"></script>
    <script src="libs/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <script src="js/script.js"></script>
</head>

<body>
    <?php require('partials/_header.php');?>

    <div class="container">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <h1 class="my-4">Search results for <em>"<?php echo $search; ?>"</em></h1>
                
                <?php
                    $query_thread = "SELECT * FROM `threads` WHERE MATCH (`thread_title`,`thread_description`) against ('$search')";

                    $data_thread = mysqli_query($conn,$query_thread);
                    $rows_thread = mysqli_num_rows($data_thread);
                 
                    if($rows_thread > 0) {
                        while($result_thread = mysqli_fetch_assoc($data_thread)) {
                            echo '<h5 class="mt-0"><a href="threads.php?threadid='.$result_thread['thread_id'].'" class="text-dark font-weight-bold">'.$result_thread['thread_title'].'</a></h5>
                                <p>'.$result_thread['thread_description'].'</p>';
                        }
                    } else {
                        echo '<h4 class=" pb-4"><span class="badge badge-danger">No Results found!</span></h4>';
                    }    
         
                ?>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>

    <?php require('partials/_footer.php');?>
</body>

</html>