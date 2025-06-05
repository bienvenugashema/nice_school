<?php

include_once '../../config/config.php';
?>

<html>
    <?php include_once '../header.php'; ?>
    
    <body>
        <?php include '../navbar.php'; ?>
        <div class="d-flex justify-content-center" style="height: 100vh;">
            <div class="container">
            <h3 class="text-left">Alumni Managment Panel</h3>
            <div>
                <ul class="list-unstyled">
                    <li>
                        <a href="create_alumna.php">Create New Alumna</a>
                    </li>
                </ul>
            </div>
            <div>
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>Names</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Profile Year</th>
                        <th>Proffesion</th>
                        <th>Profile Picture</th>
                        <th>Actions</th>
                    </tr>
                    <?php 
                    $stmt = $conn -> prepare("select * from alumni");
                    $stmt -> execute();

                    $result = $stmt -> get_result();
                    $count = 0;
                    while($row = $result->fetch_assoc()){
                        $count++;
                        ?>
                        <tr>
                            <td>
                                <?php echo $count;?>
                            </td>
                            <td>
                                <?php echo $row['names']; ?>
                            </td>
                            
                            <td>
                                <?php echo $row['email']; ?>
                            </td>
                            <td>
                            <?php echo $row['gender']; ?>
                            </td>
                            <td>
                                <?php echo $row['profile_year']; ?>
                            </td>
                            <td>
                                <?php echo $row['professional'] ?> 
                            </td>
                            <td>
                                <img src="<?php echo $row['profile_picture'] ?>" width="30" style="border-radius: 10px"/>
                            </td>
                            <td>
                                <a href="edit_alumna.php?id=<?php echo $row['id'];?>" class="text-primary">Edit</a>
                                <a href="delete_alumna.php?id=<?php echo $row['id']; ?>" class="text-danger">Delete</a>
                                <a href="view_alumna.php?id=<?php echo $row['id']; ?>" class="text-warning">View</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
            </div>
        </div>
    </body>
</html>