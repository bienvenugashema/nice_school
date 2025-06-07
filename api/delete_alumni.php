<?php
include_once '../config/config.php';

session_start();
header("Content-Type: application/json");
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $input = json_decode(file_get_contents("php://input"), true);
    if(isset($input['id'])){
    $id = intval($input['id']);
    $stmt = $conn->prepare("DELETE FROM alumni WHERE id = ?");
    try{
        $stmt -> execute([$id]);
        if($stmt->rowCount()){
            echo json_encode(["message" => "Alumni deleted well"]);
        } else {
            echo json_encode(['message' => "Alumna not deleted"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["message" => "Database Error " . $e->getMessage()]);
    }
} else {
    echo json_encode(["message" => "Invalid Id"]);
}
} else {
    http_response_code(405);
    echo json_encode(["message" => "Invalid request method"]);
}
?>
