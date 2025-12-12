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
if(!$account){
     die("Account not found.");
}

    $sql = "DELETE FROM accounts WHERE account_id=$account_id";
    mysqli_query($connect, $sql);


    header("Location: list_accounts.php");
    exit();

?>
