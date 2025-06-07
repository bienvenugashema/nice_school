<?php
include_once '../config/config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $stmt = $conn->prepare("SELECT * FROM alumni WHERE id = ?");
    try{
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        if ($row) {
            $_SESSION['user_id'] = $row['id'];
            echo "
            <div class='mb-3 mt-3'>
            <b>Names:</b><p>" . $row['names'] . "</p>
            <b>Email:</b><p>" . $row['email'] ."</p>
            <b>Gender:</b> <p>" . $row['gender'] ."</p>
            <b>Preffesion:</b><p>".$row['professional']."</p>
            <b>Profile Year:</b><p>".$row['profile_year']."</p>
            <b>Bio:</b><p>".$row['description']."</p>
            <b>Profile picture</b><p></p>
            <button class='btn btn-primary' onclick=loadContent(".$row['id'].")>Edit user</button>
            <button class='btn btn-secondary' onclick=closeDiv()>Close</button>
            <button class='btn btn-warning' onclick=downloadUserInfo(".$row['id'].")>Download User Info</button>
            </div>
            ";
        } else {
            echo "User not found";
        }
    } catch (PDOException $e) {
        echo "Error is: " . $e;
    }
} else {
    echo "Invalid request.";
}
?>
