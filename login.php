<?php
    
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
            <form action="login.php" method="POST">
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
            </form>
        </div>
    </div>
    </section>
</body>
</html>