<?php

include_once '../../config/config.php';

?>

<html>
    <?php include_once '../header.php'; ?>
    
    <body>
        <?php include '../navbar.php'; ?>
        <div class="m-4">
            <div class="shadow-sm w-75 p-4">
                <div>
                    <h2>Creating a new alumna</h2>
                </div>
                <hr>
                <div>
                    <form action="create_alumna.php" method="post" class="form" enctype="multipart/form-data">
                        <div class="d-flex gap-3 mb-3">
                            <b>Names:</b> <input type="text" class="form-control"  placeholder="names......." name="names">
                            <b>Email:</b> <input type="email" name="email" id="" placeholder="names@example.com" class="form-control">
                            <b>Proffesional:</b>  <input type="text" name="proffesion" id="" placeholder="Proffesion" class="form-control">
                        </div>
                        <div class="d-flex gap-3 mb-3">
                            <b>Awards:</b> <input type="text" class="form-control" placeholder="Awards" name="awards">
                            <b>Profile Year:</b> <input type="number" name="profile_year" id="" class="form-control">
                            <b>Gender:</b> <select name="gender" id="" class="form-select">
                                <option selected disabled>Select Gender.....</option>
                                <option value="female">Female</option>
                                <option value="male">Male</option>
                            </select>

                        </div>
                        <div class="d-flex gap-3 mb-3">
                            <b>Profile Picture:</b>
                            <input type="file" class="form-control w-25" name="profile_picture" accept="image/*"> 
                        </div>
                        <div class="d-flex gap-3 mb-3">
                            <b>Description:</b> <textarea type="text" class="form-control" rows="4" placeholder="Asimple Detailed info" name="description"></textarea>
            
                        </div>
                        <hr>
                        <div class="d-flex gap-3 mb-3 m-4">
                            <button type="submit" name="add_alumna" class="btn btn-primary">Click to Add New Alumna</button>
                            <a class="btn btn-secondary" href="manage_almni.php">
                                Cancel Progress
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <?php 
            
            include_once '../../controls/controller.php';

            if(isset($_POST['add_alumna'])){
                $names = sanitize_input($_POST['names'] ?? "");
                $email = sanitize_input($_POST['email'] ?? "");
                $gender = sanitize_input($_POST['gender'] ?? "");
                $proffesional = sanitize_input($_POST['proffesion'] ?? "");
                $awards = sanitize_input($_POST['awards'] ?? "");
                $profile_year = sanitize_input($_POST['profile_year'] ?? "");
                $description = sanitize_input($_POST['description'] ?? "");
                $file_name = $_FILES['profile_picture']['name'];
                $fileTmp = $_FILES['profile_picture']['tmp_name'];
                $file_size = $_FILES['profile_picture']['size'];
                $file_type = $_FILES['profile_picture']['type'];

                $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                if(!in_array($file_type, $allowed)){
                    echo "<script>alert('Invalid image type')</script>";
                }
                if($file_size > 2 * 1024 * 1024){
                    echo "<script>alert('Image is too larger')</script>";
                }
                $new_name = uniqid() . "_" . basename($file_name);
                $upload_path = "alumni_profiles/". $new_name;
                if(move_uploaded_file($fileTmp, $upload_path)){                
                    if(add_alumna($names, $email, $gender, $proffesional, $awards, $profile_year, $upload_path,$description)){
                        echo "<script>
                        alert('New alumna Created Well')
                        window.location.href='manage_almni.php'
                        </script>";
                    }
                
            }
        }
            
            ?>
        </div>
    </body>
</html>    