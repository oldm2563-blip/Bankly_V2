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
    <link rel="stylesheet" href="styles/a.css">
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
            <table>
                <thead>
                    <tr>
                        <th>transaction_id</th>
                        <th>transaction_type</th>
                        <th>amount</th>
                        <th>account_number</th>
                        <th>full_name</th>
                        <th>transaction_date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach($transactions as $tr){
                        echo "<tr>" . "<td>" . $tr['transaction_id'] . "</td>" . "<td>" . $tr['transaction_type'] . "</td>" . "<td>" . $tr['amount'] . "dh </td>" . "<td>" . $tr['account_number'] . "</td>" . "<td>" . $tr['full_name'] . "</td>" . "<td>" . $tr['transaction_date'] . "</td>" . "</tr>";
                    }
                ?>
                </tbody>
            </table>
            <a href="make_transaction.php">Make A Transaction</a>
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
