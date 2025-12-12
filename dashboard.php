<?php
    session_start();
    if(empty($_SESSION)){
        session_destroy();
        header("Location: login.php");
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/dashboard.css">
    <title>Welcome to bankly_v2</title>
</head>
<body>
    <div class="hero">
        <h1>Welcome Back</h1>
        <?php echo "<p>{$_SESSION['username']}</p>" ?>
    </div>
    <div class="board-container">
        <div class="the-board">
            <div class="cus con">Total customers</div>
            <div class="acc  con">Total accounts</div>
            <div class="trans con">Total transactions today</div>
            <div class="latest con">Latest transactions</div>
         </div>
    </div>
    
</body>
</html>