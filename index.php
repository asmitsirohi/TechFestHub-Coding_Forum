<?php
    include("partials/_connection.php");
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

    <!-- Slider -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/2400x700/?apple,coding" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?programming,microsoft" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?google,code" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="container mb-4">
        <h1 class=" text-center my-4">TechFestHub - Browse Categories</h1>
        <div class="row">

            <?php
                $query = "SELECT * FROM categories";
                $data = mysqli_query($conn,$query);
                $rows = mysqli_num_rows($data);

                if($rows > 0) {
                    while($result = mysqli_fetch_assoc($data)) {
                        echo '<div class="col-md-4">
                                <div class="card mb-4" style="width: 18rem;">
                                    <div class="card-body">
                                        <img src="https://source.unsplash.com/500x400/?coding,'.$result['category_name'].'" class="card-img-top rounded img-thumbnail" alt="image">
                                        <br><br>
                                        <h5 class="card-title"><a href="threadlist.php?catid='.$result['category_id'].'">'.$result['category_name'].'</a></h5>
                                        <p class="card-text">'.substr($result['category_description'],0,100).'...</p>
                                        <a href="threadlist.php?catid='.$result['category_id'].'" class="btn btn-primary">View Threads</a>
                                    </div>
                                </div>
                            </div>';
                    }
                }

                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    echo '<div class="col-md-4">
                            <div class="card mb-4 text-light bg-dark" style="width: 18rem; height:425px;">
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <p class="text-center mt-auto" id="plus">
                                        <i class="fas fa-plus-circle" id="plusBtn" data-toggle="modal" data-target="#categoryModal"></i>
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <p class="text-center font-weight-bolder" id="user">Add Category</p>
                                </div>
                            </div>
                        </div>';
                }
            ?>
        </div>
    </div>
    <?php require('partials/_footer.php');?>
</body>

</html>