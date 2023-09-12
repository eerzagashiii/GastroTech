<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "yajman";

    $con = mysqli_connect($server,$user,$password,$db);

    if(!($con))
    {
        echo "Connection Error";
    }
?>