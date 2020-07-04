<?php
    $insertAlert = false;
    $errorAlert = false;

    if(isset($_POST['signup'])) {
        include("_connection.php");
        include("_userDataValid.php");

        $username = test_input($_POST['username']);
        $useremail = test_input($_POST['useremail']);
        $password = test_input($_POST['password']);
        $cpassword = test_input($_POST['cpassword']);

        $query = "SELECT * FROM users WHERE user_email = '$useremail'";
        $data = mysqli_query($conn,$query);
        $rows = mysqli_num_rows($data);
        

        if($rows <= 0) {
            if($password == $cpassword) {
                $rndno = rand(100000,999999);
    
                $to = $useremail;

                $subject = "OTP for TechFestHub-CodingForum account verification";

                $txt = "OTP: ".$rndno."\n\nThis OTP is sent by TechFestHub-CodingForum for account verification.\nDo not share your OTP to anyone.";

                $headers = "From: TechFestHub-CodingForum otp@techfesthub_CodingForum.com";

                mail($to,$subject,$txt,$headers);
                
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['useremail'] = $useremail;
                $_SESSION['password'] = $password;
                $_SESSION['otp'] = $rndno;

                header("location:_verify_otp.php");
            } else {
                $errorAlert = "Password doesn't match.";
                header("location:/techfesthub_forum/index.php?errorAlert=".$errorAlert."");
            }
        } else {
            $errorAlert = "Username Already exists.";
            header("location:/techfesthub_forum/index.php?errorAlert=".$errorAlert."");
        }
    }
?>