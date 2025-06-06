<?php 
include_once '../config/config.php';

if(isset($_GET['id'])){
    $id = (int) $_GET['id'];
} else {
    include 'header.php';
    echo "<h1>No information</h1>";
}

?>
<html lang="en">
<?php include 'header.php'; ?>
<style>
    .container{
        display: flex;
        justify-content: center;
        height: 100vh;
    }
    .box{
        
        box-shadow: 0 4px 6px rgba(0,0,0,0.6);
        width: 90%;
    }
</style>
<body>
    <?php include 'navbar.php'; ?>
    <h3>Repling Request</h3>
    <div class="container">
    <div class="box">
        <?php 
        $stmt = $conn -> prepare("select * from request_info where id=?");
        $stmt->execute([$id]);
        $row = $stmt -> fetch();
        if($row){
        ?>
        <div class="info m-5 p-10">
            <b>Names:</b> <p><?php echo $row['names']; ?></p>
            <b>Email:</b> <p><?php echo $row['email'];?></p>
            <b>Request:</b> <p><?php echo $row['comment'] ?></p>
            <b>Response:</b>
            <form action="reply_request.php?id=<?php echo (int) $_GET['id']; ?>" method="post">
                <div>
                <textarea name="reply_comment" class="form-control" rows="4" width="300"></textarea>
                </div>
                <div>
                <button type="submit" class="btn btn-primary m-3" name="reply_request">Click to Reply</button>
                <a href="dashboard.php" class="btn btn-secondary">Ignore</a>
                </div>
            </form>
            <?php 
            if(isset($_POST['reply_request'])){
                $id = (int) $_GET['id'];
                $message = strip_tags($_POST['reply_comment']);
                $solved = 'solved';
                $stmt = $conn->prepare("update request_info set status= ?, reply = ? WHERE id= ? ");
                if($stmt->execute([$solved,$message,$id])){
                    echo "<script>alert('Reply Sent');
                        window.location.href='view_response.php'
                    </script>";
                    
                }
                exit;
            }
            ?>
        </div>
        <?php } else {
            echo "<h3 class='text-center text-danger'>User not found</h3>";
        } ?>
    </div>

    </div>
</body>
</html>