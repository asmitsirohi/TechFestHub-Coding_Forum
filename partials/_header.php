<?php
    session_start();
?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <a class="navbar-brand" href="index.php">TechFestHub</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/techfesthub_forum/index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/techfesthub_forum/about.php">About</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Top Category
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                    <?php
                        $query = "SELECT * FROM categories LIMIT 3";
                        $data = mysqli_query($conn,$query);
                        $rows = mysqli_num_rows($data);
        
                        if($rows > 0) {
                            while($result = mysqli_fetch_assoc($data)) {
                                echo '<a class="dropdown-item" href="/techfesthub_forum/threadlist.php?catid='.$result['category_id'].'">'.$result['category_name'].'</a>';
                            }
                        }    
                    ?>

                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/techfesthub_forum/contact.php">Contact</a>
            </li>
        </ul>
        <div class="row">
            <form class="form-inline my-2 my-lg-0 mx-2" action="search.php" method="GET">
                <div class="input-group">
                    <input type="search" id="query"  name="query" class="form-control" placeholder="Search" aria-label="Search" required>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-success" >Search</button>
                    </div>
                </div>
            </form>
            <?php 
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    echo '<div class="dropdown mx-4">
                                <button class="btn dropdown-toggle rounded-circle" type="button" id="userFunction" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <img src="'.$_SESSION['user_pic'].'" alt="image" width="35px" class="rounded rounded-circle">
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userFunction">
                                <a type="button" data-toggle="modal" data-target="#imageModal">
                                    <img src="'.$_SESSION['user_pic'].'" alt="image" width="45px" class="rounded rounded-circle mx-auto d-block">
                                </a>
                
                                <h5 class="text-center mt-3">
                                    <span class="badge badge-success">
                                        '.$_SESSION['user_name'].'
                                    </span>
                                </h5>
                            
                                    <a class="btn mx-2" href="partials/_logout.php">
                                        <i class="fas fa-sign-out-alt" style="font-size:25px;" data-toggle="tooltip" data-placement="bottom"
                                            title="Logout">
                                        </i>
                                    </a>
                                    <a class="btn mx-2 float-right" href="manageAccount.php">
                                        <i class="fas fa-user-cog" style="font-size:25px;" data-toggle="tooltip" data-placement="bottom"
                                            title="Manage account">
                                        </i>
                                    </a>
                                </div>
                            </div>';
                } else {
                    echo '<button class="btn ml-2" data-toggle="modal" data-target="#loginModal"><i class="fas fa-sign-in-alt text-light" style="font-size:25px;"data-toggle="tooltip" data-placement="bottom" title="Login"></i></button>

                    <button class="btn mx-2" data-toggle="modal" data-target="#signupModal"><i class="fas fa-user-plus text-light" style="font-size:23px;"data-toggle="tooltip" data-placement="bottom" title="Signup"></i></button>';
                }
            ?>

        </div>

    </div>
</nav>

<?php
    include("loginModal.php");
    include("signupModal.php");
    include("_imageModal.php");

    if(isset($_GET['errorAlert'])) {
        $errorAlert = $_GET['errorAlert'];
        echo '<div class="alert alert-danger alert-dismissible fade show sticky-top my-0" role="alert">
                        <strong>Error: </strong> '.$errorAlert.' 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
    }

    if(isset($_GET['insertAlert'])) {
        echo '<div class="alert alert-success alert-dismissible fade show sticky-top my-0" role="alert">
                    <strong>Success: </strong> Your Account created successfully. Now you can login.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    }

    if(isset($_GET['loggedinAlert'])) {
        echo '<div class="alert alert-success alert-dismissible fade show sticky-top my-0" role="alert">
                    <strong>Success: </strong> You loggedin Successfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    }

    if(isset($_GET['logoutAlert'])) {
        echo '<div class="alert alert-success alert-dismissible fade show sticky-top my-0" role="alert">
                    <strong>Success: </strong> You logout Successfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    }

    if(isset($_GET['imageUploaded'])) {
        echo '<div class="alert alert-success alert-dismissible fade show sticky-top my-0" role="alert">
                    <strong>Success: </strong> Profile picture updated successfully. Login again to see update.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    }
    
    if(isset($_GET['update'])) {
        $update = $_GET['update'];
        echo '<div class="alert alert-success alert-dismissible fade show sticky-top my-0" role="alert">
                    <strong>Success: </strong>'. $update .'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    }

    if(isset($_GET['isImageAlert'])) {
        $isImageAlert = $_GET['isImageAlert'];
        echo '<div class="alert alert-danger alert-dismissible fade show sticky-top my-0" role="alert">
                    <strong>Error: </strong>'. $isImageAlert .'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    }
    
?>