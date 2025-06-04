<?php

include_once '../config/config.php';
if(isset($_GET['id'])){
    $id = (int) $_GET['id'];
    $delete = mysqli_query($conn, "delete from request_info where id='$id'");
    if($delete){
        $_SESSION['delete_request'] = "Request with id: $id Deleted"; 
        header('Location: view_response.php');
    }
} else {
    echo "Nothing on this page";
}
?>
