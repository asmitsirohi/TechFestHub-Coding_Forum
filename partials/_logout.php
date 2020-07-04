<?php
    session_start();
    session_unset();
    session_destroy();

    // $logoutAlert = true;

    header("location:/techfesthub_forum/index.php?logoutAlert=logout");
?>