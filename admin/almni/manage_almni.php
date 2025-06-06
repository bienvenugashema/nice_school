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

                    $results = $stmt -> fetchAll();
                    $count = 0;
                    foreach($results as $result){
                        $count++;
                        ?>
                        <tr>
                            <td>
                                <?php echo $count;?>
                            </td>
                            <td>
                                <?php echo $result['names']; ?>
                            </td>
                            
                            <td>
                                <?php echo $result['email']; ?>
                            </td>
                            <td>
                            <?php echo $result['gender']; ?>
                            </td>
                            <td>
                                <?php echo $result['profile_year']; ?>
                            </td>
                            <td>
                                <?php echo $result['professional'] ?> 
                            </td>
                            <td>
                                <img src="<?php echo $result['profile_picture'] ?>" width="30" style="border-radius: 10px"/>
                            </td>
                            <td>
                                <button class="btn btn-primary btn-sm" onclick="loadContent(<?php echo $result['id'];?>)" class="text-primary">Edit</button>
                                <a href="delete_alumna.php?id=<?php echo $result['id']; ?>" class="text-danger">Delete</a>
                                <a href="view_alumna.php?id=<?php echo $result['id']; ?>" class="text-warning">View</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
            <div class="mt-4 p-4 border rounded shadow" id="disply" style="min-height: 100px; display: none;"></div>
            </div>
            <script>
                function loadContent(id) {
                    const xhr = new XMLHttpRequest();
                    xhr.open("POST", "get-content.php", true);
                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhr.onload = function () {
                        const displDiv = document.getElementById("disply");
                        displDiv.innerHTML = this.responseText;

                        displDiv.style.display = "block";

                    }
                    xhr.send("id=" + id);
                }
            </script>
        </div>

    </body>
</html>