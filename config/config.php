<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

$host = 'localhost';
$user = "root";
$password = "php123";
$database = "nice_school";

$conn = mysqli_connect($host, $user, $password, $database);

if($conn -> connect_error ) {
    die("Connection failed: " . $conn->connect_error);
}


?>