<?php

include_once '../config/config.php';
if(isset($_GET['id'])){
    $id = (int) $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM request_info WHERE id = ?");
    $stmt->execute([$id]);
    if($stmt){
        $_SESSION['delete_request'] = "Request with id: $id Deleted"; 
        header('Location: view_response.php');
    }
} else {
    echo "Nothing on this page";
}
?>
