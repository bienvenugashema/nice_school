<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

$host = 'localhost';
$user = "root";
$password = "php123";
$database = "nice_school";

$dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try{
$conn = new PDO($dsn, $user, $password, $options);
} catch (PDOException $e){
    die("Database connection failed:" . $e->getMessage());
}

?>