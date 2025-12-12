<?php
    session_start();
    if(empty($_SESSION)){
        session_destroy();
        header("Location: login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/c.css">
    <link rel="stylesheet" href="styles/scr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <title>clients</title>
</head>
<body>
    <div class="hero">
        <form action="dashboard.php" method="$_GET">
            <input type="submit" name="sub" value="Log Out">
        </form>
        <h1>Clients</h1>
    </div>
    <div>

    </div>
</body>
</html>
<?php 
    if(isset($_GET['sub'])){
        session_destroy();
        header("Location: login.php");
        exit();
    }
?>