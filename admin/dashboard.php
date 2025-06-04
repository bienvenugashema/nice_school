<?php
include_once '../config/config.php';
?>

<html>
    <?php include_once 'header.php'; ?>
    <style>
                .box{
                    width: 300px;
                    box-sizing: border-box;
                    border-radius: 5px;
                    background-color: #08915e;
                    margin: 10px;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.9);
                }
            </style>
    <body>
        <?php include 'navbar.php'; ?>
        <div class="box text-light p-4">
                <h3 class="text-center text-light">Requests</h3>
                <p class="text-left" style="font-size: large;">Total Request: 
                <?php 
                $select_count = "select count(*) AS total_requests FROM request_info";
                $res = mysqli_query($conn, $select_count);
                $row = mysqli_fetch_assoc($res);
                echo $row['total_requests'];
                ?>
                </p>
                <p style="font-size:large;">Pending requests:
                    <?php 
                    $select_status = "select count(*) AS total_pending from request_info where status='pending'";
                    $res = mysqli_query($conn, $select_status);
                    $row = mysqli_fetch_assoc($res);
                    echo $row['total_pending'];
                    ?>
                </p>

                 <p style="font-size: large;">Solved requests:
                    <?php 
                    $select_status = "select count(*) AS total_solved from request_info where status='solved'";
                    $res = mysqli_query($conn, $select_status);
                    $row = mysqli_fetch_assoc($res);
                    echo $row['total_solved'];
                    ?>
                </p>
                <p><a href="view_response.php" class="text-warning ">View full info....</a></p>
        </div>
    </body>

</html>