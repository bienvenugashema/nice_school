<?php 

error_reporting(E_ALL);
ini_set('display_errors',1);
// Configurations
include __DIR__ . '/../config/config.php';
// funtion that will be used to sanitize inputs

function sanitize_input($text){
    $text = trim($text);
    $text = stripslashes($text);
    $text = strip_tags($text);
    $text = htmlspecialchars($text);

    return $text;
}

class NiceSchool {

    public static function comment($names, $email, $phone, $program, $comment){
        include 'config/config.php';

        $stmt = $conn -> prepare("INSERT INTO `request_info`(`names`, `email`, `phone_number`, `program`, `comment`) VALUES (?,?,?,?,?)");
        $stmt->execute([$names,$email,$phone,$program,$comment]);
        // if ($inser_info){
        //     $_SESSION['message'] = "Request Sent Well";
        //     echo '<script> alert("Request Sent")</script>';
        // } else {
        //     $_SESSION['message'] = "Failed to send request";
        //     echo "failes user";
        // }
    }

    public  function login($email, $pass) {
            
        $host = 'localhost';
        $user = "root";
        $password = "php123";
        $database = "nice_school";

        $conn = mysqli_connect($host, $user, $password, $database);
        $get_admin = "select * from admin where email='$email'";
        $query = mysqli_query($conn, $get_admin);
        $row = mysqli_fetch_assoc($query);
        if($get_admin){
        if($pass == $row['password']){
            $_SESSION['email'] = $email;
            $_SESSION['success'] = "Logged in";
            header("Location: dashboard.php");
        } else {
            $_SESSION['error'] = "Invalid Email or Password";
        }}
         else {
            echo "Un able to get the content";
        }
    }

}

function add_alumna($names, $email, $gender, $proffesional, $awards, $profile_year, $profile_picture, $description){
    global $conn;
$stmt = $conn -> prepare("INSERT INTO `alumni`(`profile_year`, `names`,`gender`, `email`, `professional`, `description`, `award`, `profile_picture`) VALUES (?,?,?,?,?,?,?,?)");
$stmt->execute([$profile_year, $names, $email, $gender, $proffesional, $description, $awards, $profile_picture]);
}

?>