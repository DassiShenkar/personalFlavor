<?php
    $dbhost = "166.62.8.11";
    $dbuser = "auxstudDB5";
    $dbpass = "auxstud5DB1!";
    $dbname = "auxstudDB5";
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if(mysqli_connect_errno()) {
        die("Failed to connect to MySQL: "  . mysqli_connect_errno());
    }

    mysqli_set_charset($connection,"utf8");
?>