<?php
session_start();
if(empty($_SESSION)){
    session_destroy();
    header("Location: login.php");
    exit();
}
include('db.php');
$customers = mysqli_query($connect, "SELECT customers_id, full_name FROM customers");

if(isset($_POST['subb'])){
    $account_number = $_POST['account_number'];
    $account_type = $_POST['account_type'];
    $balance = $_POST['balance'];
    $customer_id = $_POST['customer_id'];

    $sql = "INSERT INTO accounts (account_number, account_type, balance, customers_id)
            VALUES ('$account_number', '$account_type', '$balance', '$customer_id')";
    mysqli_query($connect, $sql);
    header("Location: list_accounts.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
    <input type="text" name="account_number" required>
    <select name="account_type" required>
    <option value="savings">savings</option>
    <option value="business">Business</option>
    <option value="checking">Checking</option>
</select>
    <input type="number" name="balance" required>
    <select name="customer_id" required>
        <?php
    while ($c = mysqli_fetch_assoc($customers)) {
        echo "<option value='" . $c['customers_id'] . "'>" . $c['full_name'] . "</option>";
    }
    ?>
    </select>
    <input type="submit" name="subb" value="Add Account">
</form>

</body>
</html>