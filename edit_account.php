<?php
session_start();
if(empty($_SESSION)){
    session_destroy();
    header("Location: login.php");
    exit();
}
include('db.php');

if(empty($_GET['id'])){
    die("No account ID provided.");
}

$account_id = $_GET['id'];
$account_result = mysqli_query($connect, "SELECT * FROM accounts WHERE account_id=$account_id");
$account = mysqli_fetch_assoc($account_result);
if(!$account) die("Account not found.");

$customers = mysqli_query($connect, "SELECT customers_id, full_name FROM customers");

if(isset($_POST['sub'])){
    $account_number = $_POST['account_number'];
    $account_type = $_POST['account_type'];
    $balance = $_POST['balance'];
    $customer_id = $_POST['customer_id'];

    $sql = "UPDATE accounts SET account_number='$account_number', account_type='$account_type', balance='$balance', customers_id='$customer_id' WHERE account_id=$account_id";
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
    <input type="text" name="account_number" value="<?= $account['account_number'] ?>" required>
    <input type="text" name="account_type" value="<?= $account['account_type'] ?>" required>
    <input type="number" name="balance" value="<?= $account['balance'] ?>" required>
    <select name="customer_id" required>
        <?php
    while ($c = mysqli_fetch_assoc($customers)) {
        echo "<option value='" . $c['customers_id'] . "'>" . $c['full_name'] . "</option>";
    }
    ?>
    </select>
    <input type="submit" name="sub" value="Update Account">
</form>
</body>
</html>
