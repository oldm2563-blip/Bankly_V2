<?php
    include("db.php");
    session_start(); 
    $error = "";   
    if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $password = $_POST["pass"];
    $data = "SELECT username, passwords FROM user WHERE username = '{$username}'";
    $founddata = mysqli_query($connect, $data);

        if(mysqli_num_rows($founddata)>0){
        $row = mysqli_fetch_assoc($founddata);
        if($password === $row["passwords"]){
            $_SESSION["username"] = $row["username"];
            header("Location: dashboard.php");
            exit;
        }
        else{
            $error = "wrong password";
        }
        }
        else{
            $error = "user doesn't exist";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> 
    <title>Document</title>
</head>
<body>
    <section class="menu">
        <div class="image">
        <img src="banhead.png" alt="logo">
        </div>
    <div class="login_container">
        <div class="login_box">
            <form action="login.php" method="post">
                <h3>Login</h3>
                <div class="input_box">
                    <input type="text" id="username" name="username" placeholder=" " required>
                     <label for="username">User Name</label>
                </div>
                <div class="input_box">
                <input type="password" id="pass" name="pass" placeholder=" " required>
                 <label for="pass">Password</label>
                 </div>
                 <div>
                    <input type="submit" name="submit" id="submit" value="Login Now">
                 </div>
                 <?php if(!empty($error)){
                    echo "<p>{$error}</p>";
                 } ?>
            </form>
        </div>
    </div>
    </section>
</body>
</html>
