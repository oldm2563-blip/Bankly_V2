<?php
    session_start();
    if(empty($_SESSION)){
        session_destroy();
        header("Location: login.php");
        exit();
    }
    include('db.php');
    if(empty($_GET['id'])){
        die("no id");
        header("Location: list_clients.php");
        exit();
    }
    $customer_id = $_GET['id'];

    $checker_f = "SELECT * FROM customers WHERE customers_id = {$customer_id}";
    $fcheck = mysqli_query($connect, $checker_f);
    $f = mysqli_fetch_assoc($fcheck);

    if(!$f){
        die("no clients with that id");
    }
    if(isset($_POST['sub'])){
        $name = $_POST['name'];
        $email = $_POST['emai'];
        $cin = $_POST['cin'];
        $phone = $_POST['phone'];
        $sqlupdat = "UPDATE customers SET full_name = '$name' , email = '$email', CIN = '$cin', phone = '$phone' WHERE customers_id=$customer_id";
        mysqli_query($connect, $sqlupdat);
        header("Location: list_clients.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/form.css">
    <title>edit client</title>
</head>
<body>
    <form action="edit_client.php?id=<?php echo $customer_id; ?>" method="POST">
        <div>
            <input type="text" name="name" required placeholder=" " value=<?php echo"'{$f['full_name']}'"?>>
            <label for="name">Full Name</label>
        </div>
        <div>
            <input type="email" name="emai" required placeholder=" " value=<?php echo"'{$f['email']}'"?>>
            <label for="emai">Email</label>
        </div>
        <div><input type="text" name="cin" required placeholder=" " value=<?php echo"'{$f['CIN']}'"?>>
             <label for="cin">C.I.N</label>
        </div>
        <div>
            <input type="number" name="phone" required placeholder=" " value=<?php echo"'{$f['phone']}'"?>>
            <label for="phone">phone</label>
        </div>

        <input type="submit" name="sub" required>
    </form>
</body>
</html>