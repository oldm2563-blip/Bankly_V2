<?php
    session_start();
    if(empty($_SESSION)){
        session_destroy();
        header("Location: login.php");
        exit();
    }
    include("db.php");
    $accounts = "SELECT accounts.account_id, accounts.account_number, accounts.balance, accounts.account_type, customers.full_name FROM accounts JOIN customers ON accounts.customers_id = customers.customers_id ";
    $db_accounts = mysqli_query($connect, $accounts);
    $acc_amm = [];
    while($rowe = mysqli_fetch_assoc($db_accounts)){
        $acc_amm[] = $rowe;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/r.css">
    <link rel="stylesheet" href="styles/scr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <title>customers</title>
</head>
<body>
    <div class="hero">
        <form action="dashboard.php" method="GET">
            <a href="dashboard.php">Home</a>
            <input type="submit" name="sub" value="Log Out">
        </form>
        <h1>Accounts</h1>
    </div>
    <div class="container">
            <div class="accounts-list">
                <h1><i class="fas fa-wallet"></i>     list of accounts:</h1>
                <ul>
                <?php 
                    foreach($acc_amm as $ac){
                        echo "<li>" . $ac['account_id'] . " - " . $ac['account_number'] . " - " . $ac['account_type'] . " - " . $ac['balance'] . "dh  - " . $ac['full_name'] . " <a href='edit_account.php?id=" . $ac['account_id'] . "'>Edit</a>" . " <a href='delete_account.php?id=" . $ac['account_id'] . "'>Delete</a>" ."</li>";
                    }
                ?>
                
                </ul>
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