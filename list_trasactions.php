<?php
session_start();
if(empty($_SESSION)){
    session_destroy();
    header("Location: login.php");
    exit();
}
include('db.php');

$transactions_query = "
    SELECT t.transaction_id, t.transaction_type, t.amount, t.transaction_date, 
           a.account_number, c.full_name
    FROM transactions t
    JOIN accounts a ON t.account_id = a.account_id
    JOIN customers c ON a.customers_id = c.customers_id
    ORDER BY t.transaction_date DESC
";
$transactions_result = mysqli_query($connect, $transactions_query);
$transactions = [];
while($t = mysqli_fetch_assoc($transactions_result)){
    $transactions[] = $t;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/c.css">
    <link rel="stylesheet" href="styles/scr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Transaction History</title>
</head>
<body>
    <div class="hero">
        <form action="dashboard.php" method="GET">
            <a href="dashboard.php">Home</a>
            <input type="submit" name="sub" value="Log Out">
        </form>
        <h1>Transactions</h1>
    </div>

    <div class="container">
        <div class="customers-list">
            <h1><i class="fas fa-history"></i> List of Transactions:</h1>
            <ul>
                <?php 
                    foreach($transactions as $tr){
                        echo "<li>" . $tr['transaction_id'] . " - " . $tr['transaction_type'] . " - " . $tr['amount'] . "dh - " . $tr['account_number'] . " - " . $tr['full_name'] . " - " . $tr['transaction_date'] . "</li>";
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
