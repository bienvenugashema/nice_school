<?php
session_start();
header("Content-Type: application/json");

require_once '../config/config.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['message' => "Unauthorized access"]);
    exit;
}

$input = json_decode(file_get_contents("php://input"), true);

$required = ['names', 'email', 'gender', 'profile_year', 'proffesion', 'description', 'awards'];
foreach ($required as $field) {
    if (!isset($input[$field])) {
        http_response_code(400);
        echo json_encode(['message' => "Missing field: $field"]);
        exit;
    }
}

$names = trim($input['names']);
$email = trim($input['email']);
$gender = trim($input['gender']);
$profile_year = (int) trim($input['profile_year']);
$proffesion = trim($input['proffesion']);
$description = trim($input['description']);
$awards = trim($input['awards']);
$user_id = $_SESSION['user_id'];

try {
    $stmt = $conn->prepare("UPDATE alumni SET profile_year=?, names=?, email=?, gender=?, professional=?, description=?, award=? WHERE id=?");
    $success = $stmt->execute([$profile_year, $names, $email, $gender, $proffesion, $description, $awards, $user_id]);
    echo json_encode(['message' => $success ? "Alumni updated successfully." : "Failed to update."]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['message' => "Database error: " . $e->getMessage()]);
}
?>
