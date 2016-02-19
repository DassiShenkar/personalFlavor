<?php
    $dbhost = "166.62.8.11";
    $dbuser = "auxstudDB5";
    $dbpass = "auxstud5DB1!";
    $dbname = "auxstudDB5";
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if(mysqli_connect_errno()) {
        die("The database is down is down: " . "(" . mysqli_connect_errno() . ")");
    }
?>