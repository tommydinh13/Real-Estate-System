<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/navigationbar.css">
    <link rel="stylesheet" href="css/buttons.css">
</head>
<body>
    <nav>
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="agency.php">Agencies</a></li>
                <?php
                    if(isset($_SESSION["email"])){
                        echo "<li><a href='listing.php'>Listings</a></li>";
                        echo "<li><a href='inbox.php'>Inbox</a></li>";
                        echo "<li><a href='includes/logout.inc.php'>Logout</a></li>";

                    }else{
                        echo "<li><a href='signup.php'>Sign Up</a></li>";
                        echo "<li><a href='login.php'>Login</a></li>";

                    }
                ?>
            </ul>
        </div>
    </nav>
</body>
</html>