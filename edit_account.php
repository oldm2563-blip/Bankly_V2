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
    <link rel="stylesheet" href="styles/form.css">
    <title>Document</title>
</head>
<body>
    <form method="POST">
    <div>
        <input type="text" name="account_number" value="<?= $account['account_number'] ?>" required placeholder=" ">
        <label for="account_number">account number</label>
    </div>
    <select name="account_type">
    <option value="savings" <?php if($account['account_type'] === 'Savings'){echo "selected";} ?>>Savings</option>
    <option value="business" <?php if($account['account_type'] === 'Business'){echo "selected";} ?>>Business</option>
    <option value="checking" <?php if($account['account_type'] === 'Checking'){echo "selected";} ?>>Checking</option>
</select>
    
    <div>
        <input type="number" name="balance" value="<?= $account['balance'] ?>" required placeholder=" ">
        <label for="balance">Balance</label>
    </div>
    <select name="customer_id" required>
        <?php
    while ($c = mysqli_fetch_assoc($customers)) {
         if ($c['customers_id'] == $account['customers_id']) {
        echo "<option value='{$c['customers_id']}' selected>{$c['full_name']}</option>";
    } else {
        echo "<option value='{$c['customers_id']}'>{$c['full_name']}</option>";
    }
    }
    ?>
    </select>
    <input type="submit" name="sub" value="Update Account">
</form>
</body>
</html>
