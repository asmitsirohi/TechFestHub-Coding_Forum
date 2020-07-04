<?php
    session_start();

    $userid = $_SESSION['user_id'];

    if(isset($_POST['submit_image'])) {
        include("_connection.php");
        include("_compressImage.php");


        $target_dir = "profile_pic/";
        $target_file = $target_dir . basename(time().$_FILES['image']['name']);
        $isImageAlert = false;
        $imageUploaded = false;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $check = getimagesize($_FILES['image']['tmp_name']);

        if($check !== false) {
            if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg") {
                
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                
                $query_profile = "UPDATE `users` SET `user_pic` = 'partials/$target_file' WHERE `user_id` = '$userid'";
                $data_profile = mysqli_query($conn,$query_profile);

                if($data_profile) {
                    $imageUploaded = true;
                    header("location:/techfesthub_forum/index.php?imageUploaded=".$imageUploaded."");
                    exit();
                }
            } else {
                $isImageAlert = "Sorry, only JPG, JPEG, PNG files are allowed.";
                header("location:/techfesthub_forum/index.php?isImageAlert=".$isImageAlert."");
                exit();
            }

        } else {
            $isImageAlert = "Please, upload a valid image file.";
            header("location:/techfesthub_forum/index.php?isImageAlert=".$isImageAlert."");
        }
    }
?>