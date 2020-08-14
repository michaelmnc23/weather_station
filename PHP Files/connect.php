<?php
// database
    $dbname = 'weather_station';
    $dbuser = 'root';  
    $dbpass = ''; 
    $dbhost = 'localhost'; 

    $connect = @mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

    if(!$connect){
        echo "Error: " . mysqli_connect_error();
        exit();
    }

    // echo "Connection Success!<br><br>";
