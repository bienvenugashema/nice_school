<?php

header("Content-Type: application/json");

require_once '../config/config.php';

if(!isset($_SESSION['user_id'])){
    echo json_encode(['message'=> "Unauthorized access"]);
    http_response_code(401);
    exit;
}

$input = json_decode(file_get_contents("php//input"), true);

$names = trim($input['names']);
$email = trim($input['email']);
$gender = trim($input['gender']);
$profile_year = trim($input['profile_year']);
$proffesion = trim($input['proffesion']);
$description = trim($input['description']);
$awards = trim($input['awards']);
$user_id = $_SESSION['user_id'];

if(!$names || !$email){
    echo json_encode(['message'=>"Name and Email are required"]);
    exit;
}

try{
    $stmt = $conn -> prepare("UPDATE `alumni` SET `profile_year`=?,`names`=?,`email`=?,`gender`=?,`professional`=?,`description`=?,`award`=?, WHERE id=?");
    $stmt->execute([]);
} catch ()
