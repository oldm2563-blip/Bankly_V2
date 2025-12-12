<?php
session_start();
if(empty($_SESSION)){
    session_destroy();
    header("Location: login.php");
    exit();
}

include('db.php');

$accounts = mysqli_query($connect, "SELECT account_id, account_number, full_name, balance FROM accounts");

if(isset($_POST['submit'])){
    $from_id = $_POST['from_account'];
    $to_id = $_POST['to_account'];
    $amount = $_POST['amount'];

    mysqli_query($connect, "UPDATE accounts SET balance = balance - $amount WHERE account_id=$from_id");
    mysqli_query($connect, "UPDATE accounts SET balance = balance + $amount WHERE account_id=$to_id");

    mysqli_query($connect, "INSERT INTO transactions (from_account, to_account, amount) VALUES ($from_id, $to_id, $amount)");

    header("Location: list_transactions.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Make Transaction</title>
</head>
<body>
    <form method="POST">
        <select name="from_account" required>
            <?php while($acc = mysqli_fetch_assoc($accounts)) {
                echo "<option value='" . $acc['account_id'] . "'>" . $acc['account_number'] . " - " . $acc['full_name'] . "</option>";
            } ?>
        </select>

        <select name="to_account" required>
            <?php
            $accounts = mysqli_query($connect, "SELECT account_id, account_number, full_name, balance FROM accounts"); // reload for second dropdown
            while($acc = mysqli_fetch_assoc($accounts)) {
                echo "<option value='" . $acc['account_id'] . "'>" . $acc['account_number'] . " - " . $acc['full_name'] . "</option>";
            }
            ?>
        </select>

        <input type="number" name="amount" placeholder="Amount" required>
        <input type="submit" name="submit" value="Send">
    </form>
</body>
</html>
