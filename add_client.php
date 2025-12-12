<?php
    session_start();
    if(empty($_SESSION)){
        session_destroy();
        header("Location: login.php");
        exit();
    }
 include('db.php');
 if(isset($_POST['subb'])){
    $name = $_POST['name'];
    $email = $_POST['emai'];
    $cin = $_POST['cin'];
    $phone = $_POST['phone'];
    $adder = "INSERT INTO customers (full_name, email, CIN, phone) VALUES ('{$name}', '{$email}', '{$cin}', '{$phone}')";
    mysqli_query($connect, $adder);
    header("Location: list_clients.php");
    exit();
 }
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add client</title>
</head>
<body>
    <form action="add_client.php" method="POST">
        <input type="text" name="name" required>
        <input type="email" name="emai" required>
        <input type="text" name="cin" required>
        <input type="number" name="phone" required>
        <input type="submit" name="subb" required>
    </form>
</body>
</html>