<?php
    require "header.php";
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
    <div class = "wrapper-main">
        <section class = "section-default">
            <h1>Signup</h1>
            <div>
                <form action="includes/signup.inc.php" method = "post">
                    <input type="text" name = "email" placeholder = "Email">
                    <input type="text" name = "fname" placeholder = "First Name">
                    <input type="text" name = "lname" placeholder = "Last Name">
                    <input type="password" name = "pwd" placeholder = "Password">
                    <input type="password" name = "cpwd" placeholder = "Confirm Password">
                    <input type="tel" name = "phone_number" placeholder = "Phone Number">
                    <div>
                        <input type="radio" id="client" name="role" value="Client" checked>
                        <label for="client">Client</label>
                    </div>
                    <div>
                        <input type="radio" id="independent_seller" name="role" value="Independent Seller">
                        <label for="independent_seller">Independent Seller</label>
                    </div>
                    <div>
                        <input type="radio" id="agent" name="role" value="Agent">
                        <label for="agent">Agent</label>
                        <select name="company-select" id="company-select">
                            <option value="arhum">Arhum Company</option>
                            <option value="desly">Desly Company</option>
                            <option value="tommy">Tommy Company</option>
                        </select>
                    </div>



                    <button type = "submit" name = "signup-submit">Signup</button>
                </form>
            </div>
            <?php
            if(isset($_GET["error"])){
                if($_GET["error"]=="emptyinput"){
                    echo "<p>Fill in all fields!</p>";
                }else if($_GET["error"]=="invalidemail"){
                    echo "<p>Invalid Email!</p>";
                }else if($_GET["error"]=="invalidphone"){
                    echo "<p>Invalid Phone Number!</p>";
                }else if($_GET["error"]=="invalidpassword"){
                    echo "<p>Passwords Do Not Match!</p>";
                }else if($_GET["error"]=="emailtaken"){
                    echo "<p>Account Already Exists!</p>";
                }else if($_GET["error"]=="stmtfailed"){
                    echo "<p>Something Went Wrong... Try Again.</p>";
                }else if($_GET["error"]=="none"){
                    echo "<p>Sign up Successful! Please Sign In.</p>";
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