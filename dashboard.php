<?php
    session_start();
    if(empty($_SESSION)){
        session_destroy();
        header("Location: login.php");
        exit();
    }
    include("db.php");
    $cus_num = "SELECT COUNT(*) AS total FROM customers";
    $number = mysqli_query($connect, $cus_num);
    $amount_c = 0;
    if($row = mysqli_fetch_assoc($number)){
        $amount_c = $row['total'];

    }
?>
<?php
    $acc_num = "SELECT COUNT(*) AS acc FROM accounts";
    $number_a = mysqli_query($connect, $acc_num);
    $amount_a = 0;
    if($row_a = mysqli_fetch_assoc($number_a)){
        $amount_a = $row_a['acc'];
    }
?> 
<?php
    $tra_num = "SELECT COUNT(*) AS amm FROM transactions WHERE DATE(transaction_date) = CURDATE()";
    $number_t = mysqli_query($connect, $tra_num);
    $amount_t = 0;
    if($row_t = mysqli_fetch_assoc($number_t)){
        $amount_t = $row_t['amm'];
    }
?> 
<?php
    $latest_num = "SELECT * FROM transactions ORDER BY transaction_date DESC, transaction_date DESC LIMIT 5";
    $number_l = mysqli_query($connect, $latest_num);
    $amount_l = [];
    while($row_l = mysqli_fetch_assoc($number_l)){
        $amount_l[] = $row_l;
    }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/dashboard.css">
    <link rel="stylesheet" href="styles/scr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Welcome to bankly_v2</title>
</head>
<body>
    <div class="hero">
        <form action="dashboard.php" method="$_GET">
            <input type="submit" name="sub" value="Log Out">
        </form>
        <h1>Welcome Back</h1>
        <?php echo "<p>{$_SESSION['username']}</p>" ?>
    </div>
    <div class="board-container">
        <div class="the-board">
            <div class="cus con"><i class="fas fa-user"></i>    Total customers:
            <?php echo "<h1>{$amount_c}</h1>" ?>
            <div class="btn"><a href="list_clients.php">View clients </a></div>
        </div>
            <div class="acc  con"><i class="fas fa-piggy-bank"></i>    Total accounts:
            <?php echo "<h1>{$amount_a}</h1>" ?>
            <div class="btn"><a href="list_accounts.php">View Accounts </a></div>
            
        </div>
            <div class="trans con"><i class="fas fa-exchange-alt"></i>    Total transactions today:
            <?php echo "<h1>{$amount_t}</h1>" ?>
            <div class="btn"><a href="list_trasactions.php">View Transactions </a></div>
        </div>
            <div class="latest con"><i class="fas fa-history"></i>    Latest transactions:
            <ul>
            <?php
            foreach($amount_l as $t){
                echo "<li>" . $t['transaction_id'] . " - " . $t['amount'] . "</li>";
            }
            ?>
            </ul>
        </div>
         </div>
    </div>
    
</body>
</html>
<?php 
    if(isset($_GET['sub'])){
        session_destroy();
        header("Location: login.php");
        exit();
    }
?>