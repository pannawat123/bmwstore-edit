<?php
    // error_reporting(0);

    session_start();

    require_once 'function.php';
    //error_reporting(0);
    // $db = new mysqli("88.99.243.101" ,"bikeshop_root","lY59mn2*2", "bikeshop");
    $db = new mysqli("localhost" ,"root","", "bmwstore");

    // echo mysqli_connect_errno();

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    // echo "Connected successfully";
    
    
?>