<?php
include_once '../config/config.php';
?>

<html>
    <?php include_once 'header.php'; ?>

    <style>
        .containers{
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 10px;
        }
                .box{
                    width: 300px;
                    box-sizing: border-box;
                    border-radius: 5px;
                    margin: 5px;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.9);
                }
            </style>
    <body>
        <?php include 'navbar.php'; ?>
        <div class="row">
            <div class="col-3">
            <div class="box text-dark p-0">
                <div>
                    <h3 class="text-center text-light bg-primary p-2">Requests</h3>
                </div>
                <div class="m-2">
                    <p class="text-left" style="font-size: large;"><b>Total Request: </b>
                    <?php 
                    $stmt = $conn -> query("select count(*) AS total_requests FROM request_info");
                    $row = $stmt -> fetch();
                    echo $row['total_requests'];
                    ?>
                    </p>
                    <p style="font-size:large;"><b>Pending requests:</b>
                        <?php 
                        $pending = 'pending';
                        $stmt = $conn -> prepare("select count(*) AS total_pending from request_info where status=?");
                        $stmt->execute([$pending]);
                        $row = $stmt -> fetch();
                        echo $row['total_pending'];
                        ?>
                    </p>

                    <p style="font-size: large;"><b>Solved requests:</b>
                        <?php 
                        $stmt =  $conn -> prepare("select count(*) AS total_solved from request_info where status=?");
                        $solved = 'solved';
                        $stmt->execute([$solved]);
                        $row = $stmt -> fetch();
                        echo $row['total_solved'];
                        ?>
                    </p>
                    <p><a href="view_response.php" class="btn btn-primary m-1">View full info....</a></p>
                </div>
            </div>
            </div>
            <div class="col-3">
            <div class="box text-dark p-0">
                <div>
                    <h3 class="text-center text-light p-2" style="background-color: #08915e;">Alumni</h3>
                </div>
                <div class="m-2">
                    <p><b>Total Almuni:</b> 
                    <?php
                        $stmt = $conn -> prepare("select count(*) AS total_alumni from alumni ");
                        $stmt->execute();
                        $row = $stmt -> fetch();
                        echo $row['total_alumni']
                        ?>
                </p>
                    <p><b>Males:</b>
                        <?php 
                        $males = 'male';
                        $stmt = $conn -> prepare("select count(*) AS total_males from alumni where gender=?");
                        $stmt->execute([$males]);
                        $row = $stmt -> fetch();
                        echo $row['total_males'];
                    ?>
                </p>
                    <p><b>Females:</b>
                    <?php 
                        $females = 'female';
                        $stmt = $conn -> prepare("select count(*) AS total_females from alumni where gender=?");
                        $stmt->execute([$females]);
                        $row = $stmt -> fetch();
                        echo $row['total_females'];
                    ?>
                </p>
                    <p>
                        <a href="almni/manage_almni.php" class="btn btn-primary m-1">Manage Almni</a>
                    </p>
                </div>
            </div>
            </div>
        </div>
    </body>

</html>