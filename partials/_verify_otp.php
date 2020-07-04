<?php
    include("_connection.php");
    $insertAlert = false;
    $errorAlert = false;
    
    if(!isset($_POST['otp'])) {
        header("location:/techfesthub_forum/index.php");
    } 

    if(isset($_POST['verify'])) {
        session_start();
        $otp = $_POST['otp'];
        $username = $_SESSION['username']; 
        $useremail = $_SESSION['useremail'];
        $password = $_SESSION['password'];
        $otpToVerify = $_SESSION['otp'];
        $image = "partials/profile_pic/user.jpg";

        if($otp == $otpToVerify) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $query_insert = "INSERT INTO `users` (`user_name`, `user_email`, `user_password`,`user_pic`, `user_time`) VALUES ('$username', '$useremail', '$hash', '$image', CURRENT_TIMESTAMP())";

            $data_insert = mysqli_query($conn,$query_insert);

            if($data_insert) {
                $insertAlert = true;
                session_unset();
                session_destroy();
                header("location:/techfesthub_forum/index.php?insertAlert=".$insertAlert."");
            }
        } else {
            $errorAlert = "OTP is not verify. Try agian.";
        }

    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assests/icon.ico" type="image/x-icon">
    <title>TechFestHub - Coding Forums</title>
    <link rel="stylesheet" href="/techfesthub_forum/libs/css/bootstrap.min.css">
    <script src="/techfesthub_forum/libs/jquery-3.4.1.min.js"></script>
    <script src="/techfesthub_forum/libs/popper.min.js"></script>
    <script src="/techfesthub_forum/libs/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <script src="js/script.js"></script>
</head>

<body>
    <?php require('_header.php');?>

    <div class="container">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <h1 class="my-3">Verify OTP</h1>
                <br>
                <h3>OTP is sent at <?php echo $_SESSION['useremail']; ?></h3>
                <br>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="form-group">
                        <label for="otp">Enter OTP</label>
                        <input type="text" class="form-control" id="otp" name="otp" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted" required>Do not share your OTP with anyone
                            else.</small>
                    </div>

                    <button type="submit" class="btn btn-primary" name="verify">Verify OTP</button>
                </form>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>
    <?php require('_footer.php');?>
</body>

</html>