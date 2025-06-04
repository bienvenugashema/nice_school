<?php
include_once '../config/config.php';
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<?php include 'header.php'; ?>
<style>
    .box{
        display: flex;
        justify-content: center;
        height: 100vh;
    }
</style>
<body>
    <?php include 'navbar.php'; ?>
    <div class="box">
        <div class="container">
            <h3 class="title">Requests</h3>
            <table class="table" border="1">
                <tr>
                    <th>ID</th>
                    <th>Names</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Request</th>
                    <th>Actions</th>
                </tr>
                
                <?php 
                $select_response = mysqli_query($conn, "select * from request_info");
                if (mysqli_num_rows($select_response) > 0) {
                    $count = 0;
                    while ($row = mysqli_fetch_assoc($select_response)){
                        $count += 1;
                    ?>
                    <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $row['names']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone_number']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['comment']; ?></td>
                    <td>
                        <a href="reply_request.php?id=<?php echo $row['id'] ?>" class="link text-primary">
                            <?php if($row['status'] == "solved") {} else { echo "Reply" ;} ?></a>
                        &nbsp;
                        <a href="delete_request.php?id=<?php echo $row['id']; ?>" class="link text-danger">Delete</a>
                    </td>
                    </tr>
                    <?php
                } }?>
                

            </table>
        </div>
    </div>
</body>
</html>