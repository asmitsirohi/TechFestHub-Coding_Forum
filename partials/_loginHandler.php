<?php
    $loggedinAlert = false;
    $errorAlert = false;

    if(isset($_POST['submit_login'])) {
        include("_connection.php");
        include("_userDataValid.php");

        $loginEmail = test_input($_POST['loginEmail']);
        $loginPassword = test_input($_POST['loginPassword']);

        $query_login = "SELECT * FROM users WHERE user_email= '$loginEmail'";
        $data_login = mysqli_query($conn,$query_login);
        $row_login = mysqli_num_rows($data_login);

        if($row_login == 1) {
            $result_login = mysqli_fetch_assoc($data_login);
            if(password_verify($loginPassword , $result_login['user_password'])) {
                $loggedinAlert = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['user_name'] = $result_login['user_name'];
                $_SESSION['user_id'] = $result_login['user_id'];
                $_SESSION['user_pic'] = $result_login['user_pic'];
                $_SESSION['user_email'] = $result_login['user_email'];
                
                header("location:/techfesthub_forum/index.php?loggedinAlert=".$loggedinAlert."");
            } else {
                $errorAlert = "Invalid Password.";
                header("location:/techfesthub_forum/index.php?errorAlert=".$errorAlert."");
            }
            
        } else {
            $errorAlert = "Invalid Username and Password.";
            header("location:/techfesthub_forum/index.php?errorAlert=".$errorAlert."");
        }

    }
?>