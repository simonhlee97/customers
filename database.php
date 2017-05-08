/*<?php
// used to connect to the database
$host = "127.0.0.1";
$db_name = "ninja";
$username = "simonhlee97";
$password = "";
$port = 3306;
try {
    $con = new PDO("mysql:host={$host};dbname={$db_name};port={$port}", $username, $password);
}
// show error
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}
?>*/
<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["us-cdbr-iron-east-03.cleardb.net"];
$username = $url["b5458e0da66d5b"];
$password = $url["cba72f57"];
$db = substr($url["heroku_f131178ef9fabf6"], 1);

$con = new mysqli($server, $username, $password, $db);
?>