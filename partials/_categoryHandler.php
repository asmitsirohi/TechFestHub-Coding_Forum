<?php
    $update = false;
    $errorAlert = false;

    if(isset($_POST['submit_category'])) {
        include("_connection.php");
        include("_userDataValid.php");

        $categoryTitle = test_input($_POST['categoryTitle']);
        $categoryDesc = test_input($_POST['categoryDesc']);

        $query_category = "INSERT INTO `categories` (`category_name`, `category_description`, `created`) VALUES ('$categoryTitle', '$categoryDesc', CURRENT_TIMESTAMP())";

        $data_category = mysqli_query($conn,$query_category);

        if($data_category) {
            $update = "Category created successfully.";
            header("location:/techfesthub_forum/index.php?update=".$update."");
        } else {
            $errorAlert = "Category is not created.";
            header("location:/techfesthub_forum/index.php?errorAlert=".$errorAlert."");
        }
    }
?>