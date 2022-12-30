<?php
    require_once 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/navigationbar.css">
    <link rel="stylesheet" href="css/buttons.css">
</head>
<body>
    <div class = "wrapper-main">
        <section class = "section-default">
            <h1>Login</h1>
            <div>
                <form action="includes/login.inc.php" method = "post">
                    <input type="text" name = "email" placeholder = "Email">
                    <input type="password" name = "pwd" placeholder = "Password">

                    <button type = "submit" name = "login-submit">Login</button>
                </form>
            </div>
            <?php
            if(isset($_GET["error"])){
                if($_GET["error"]=="emptyinput"){
                    echo "<p>Fill in all fields!</p>";
                }else if($_GET["error"]=="loginfailed"){
                    echo "<p>Failed to Login!</p>";
                }else if($_GET["error"]=="incorrectpassword"){
                    echo "<p>Wrong Password!</p>";
                }
            }
            ?>
        </section>

    </div>
</body>
</html>


<?php
    require "footer.php";
?>