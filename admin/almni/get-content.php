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
        
         <div class='mb-3 mt-4' method='post'>
            <b>Names:</b> <input type='text' id='names' value=' ". $row['names'] . " '/>
            <b>Email:</b> <input type='text' id='email' class='form-conrol' value=' ". $row['email'] . " '/>
            <b>Gender:</b> <select  id='gender'>
                <option values='". $row['gender'] . "'>
                ".$row['gender']."
                </option>
                <option values='male'>Male</option>
                <option values='female'>Female</option>
            </select>
        </div>    
            <div class='mb-3 mt-4'>
            <b>Proffesion:</b> <input type='text' id='proffesion' value=' ". $row['professional'] . " '/>
            <b>Awards:</b> <input type='text' id='awards' class='form-conrol' value=' ". $row['award'] . " '/>
            <b>Profile Year:</b>  <input type='number' id='profile_year' class='form-conrol' value=' ". $row['profile_year'] . " '/>
        </div> 
         <div class='mb-3 mt-4'>
            <b>Description:</b><br/>
             <textarea id='description'>". $row['description'] . " </textarea>
        </div> 
        <div>
            <button type='submit' id='updated' class='btn btn-primary'>Update Alumni</button>
        </div>
        
        ".$_SESSION['user_id']."
        </div>
        ";
    } else {
        echo "User not found";
    }

} else {
    echo "Invalid request.";
}


?>

