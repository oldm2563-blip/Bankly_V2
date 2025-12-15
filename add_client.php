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
<<<<<<< Updated upstream
    <link rel="stylesheet" href="styles/form.css">
=======
>>>>>>> Stashed changes
    <title>add client</title>
</head>
<body>
    <form action="add_client.php" method="POST">
<<<<<<< Updated upstream
        <div>
            <input type="text" name="name" required placeholder=" ">
            <label for="name">Full Name</label>
        </div>
        <div>
            <input type="email" name="emai" required placeholder=" ">
            <label for="emai">Email</label>
        </div>
        <div>
            
            <input type="text" name="cin" required placeholder=" ">
            <label for="cin">C.I.N</label>
        </div>
        <div>
        
        <input type="number" name="phone" required placeholder=" ">
        <label for="phone">Phone Number</label>
        </div>
        
        <input type="submit" name="subb" required placeholder=" ">
=======
        <input type="text" name="name" required>
        <input type="email" name="emai" required>
        <input type="text" name="cin" required>
        <input type="number" name="phone" required>
        <input type="submit" name="subb" required>
>>>>>>> Stashed changes
    </form>
</body>
</html>