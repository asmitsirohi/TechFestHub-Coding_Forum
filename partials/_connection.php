<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "techfesthub";

    $conn = mysqli_connect($servername,$username,$password,$dbname);

    if(!$conn) {
        die("Connection Failed because of ".mysqli_connect_error());
    }
?>