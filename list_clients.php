<?php
    session_start();
    if(empty($_SESSION)){
        session_destroy();
        header("Location: login.php");
        exit();
    }
    include("db.php");
    $clients = "SELECT * FROM customers";
    $db_clients = mysqli_query($connect, $clients);
    $cli_amm = [];
    while($rowr = mysqli_fetch_assoc($db_clients)){
        $cli_amm[] = $rowr;
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
    <link rel="shortcut icon" href="https://i.pinimg.com/736x/81/e2/cb/81e2cb082f344dc0dd2040cf20ac506b.jpg">

    <title>clients</title>
</head>
<body>
    <div class="hero">
        <form action="dashboard.php" method="GET">
            <a href="dashboard.php">Home</a>
            <input type="submit" name="sub" value="Log Out">
        </form>
        <h1>Clients</h1>
    </div>
    <div class="container">
            <div class="customers-list">
                <h1><i class="fas fa-user"></i>    list of customers:</h1>
                <ul>
                <?php 
                    foreach($cli_amm as $cl){
                        echo "<li>" . $cl['customers_id'] . " - " . $cl['full_name'] . " - " . $cl['email'] . " - " . $cl['CIN'] . " - " . $cl['phone'] . " <a href='edit_client.php?id=" .$cl['customers_id']. "'>Edit</a>" ."</li>";
                    }
                ?>
                
                </ul>

                <a href="add_client.php">Add A Client</a>

            </div>
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