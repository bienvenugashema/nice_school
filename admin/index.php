<?php
include '../controls/controller.php';

if(isset($_POST['admin_login'])){
 $email = $_POST['email'];
 $password = $_POST['password'];

 $obj = new NiceSchool();
 $obj -> login($email, $password);
}
?>

<html>
    <head>
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/css/main.css" rel="stylesheet">
  <title>
    Admin Panel
  </title>
  <style>
    body{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f1f5f4;
    }
    .container{
        /* background-color: rgba(95, 170, 193, 0.4); */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 1);
        width: 30%;
        border-radius: 10px;
    }
    h3{
        color: #2d465e;
    }
  </style>
    </head>
    <body>
        <div class="container">
            <h3 class="text-center">Admin Panel</h3>
            <form class="php-email-form mt-4" method="POST" action="index.php">
                    <div class="mb-3">
                      <input type="email" name="email" class="form-control" placeholder="Email" required="">
                    </div> 
                    <div class="mb-3">
                      <input type="password" name="password" class="form-control" placeholder="Password" required="">
                    </div>
                    <p class="text-danger">
                        <?php 
                        if(isset($_SESSION['error'])){
                            $message = $_SESSION['error'];
                            echo $message;
                        } 
                        ?>
                    </p>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="admin_login">CLick To Login</button>
                    </div>
            </form>
        </div>
    </body>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</html>