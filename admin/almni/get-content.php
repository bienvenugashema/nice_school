<?php
include_once '../../config/config.php';
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])){
    $id = intval($_POST['id']);

    $stmt = $conn -> prepare("select * from alumni where id = ?");
    $stmt->execute([$id]);
    $row = $stmt-> fetch();
    if ($row){
        $_SESSION['user_id'] = $row['id'];
        echo "
        <div>
         <form action=''>
         <div class='mb-3 mt-4'>
            <b>Names:</b> <input type='text' value=' ". $row['names'] . " '/>
            <b>Emails:</b> <input type='text' class='form-conrol' value=' ". $row['email'] . " '/>
            <b>Gender:</b> <select name='gender'>
                <option values='". $row['gender'] . "'>
                ".$row['gender']."
                </option>
                <option values='male'>Male</option>
                <option values='female'>Female</option>
            </select>
        </div>    
            <div class='mb-3 mt-4'>
            <b>Proffesion:</b> <input type='text' value=' ". $row['professional'] . " '/>
            <b>Awards:</b> <input type='text' class='form-conrol' value=' ". $row['award'] . " '/>
            <b>Profile Year:</b>  <input type='number' class='form-conrol' value=' ". $row['profile_year'] . " '/>
        </div> 
         <div class='mb-3 mt-4'>
            <b>Description:</b><br/>
             <textarea />". $row['description'] . " </textarea>
        </div> 
        <div>
            <button type='submit' class='btn btn-primary'>Update Alumni</button>
        </div>
        </form>
        </div>
        ";
    } else {
        echo "User not found";
    }

} else {
    echo "Invalid request.";
}


?>

