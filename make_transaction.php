<?php
session_start();
if(empty($_SESSION)){
    session_destroy();
    header("Location: login.php");
    exit();
}

include('db.php');

$accounts = mysqli_query($connect, "SELECT account_id, account_number FROM accounts");

if(isset($_POST['submit'])){
    $account_id = $_POST['account'];
    $amount = $_POST['amount'];
    $type = $_POST['transaction_type'];

    if($type === 'debit'){
        
        mysqli_query($connect, "UPDATE accounts SET balance = balance - $amount WHERE account_id = $account_id");
    } else {
        // Add amount to the account
        mysqli_query($connect, "UPDATE accounts SET balance = balance + $amount WHERE account_id = $account_id");
    }

    // Record transaction
    mysqli_query($connect, "INSERT INTO transactions (amount, transaction_type, account_id, transaction_date) 
        VALUES ($amount, '$type', $account_id, NOW())");

    header("Location: list_trasactions.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/form.css">
    <title>Make Transaction</title>
</head>
<body>
    <form method="POST">
        <select name="account" required>
            <?php while($acc = mysqli_fetch_assoc($accounts)) {
                echo "<option value='" . $acc['account_id'] . "'>" . $acc['account_number'] . "</option>";
            } ?>
        </select>

        <select name="transaction_type" required>
            <option value="debit">Debit</option>
            <option value="credit">Credit</option>
        </select>

        <div>
            <input type="number" name="amount" placeholder=" " required>
            <label for="amount">Amount Of Money</label>
        </div>

        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
