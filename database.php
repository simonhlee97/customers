<?php
// used to connect to the database
$host = "127.0.0.1";
$db_name = "ninja";
$username = "simonhlee97";
$password = "";
$port = 3306;
try {
    $con = new PDO('mysql:host={$host};dbname={$db_name};port={$port}', $username, $password);
}
// show error
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}
?>