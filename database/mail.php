<!-- inbox of user -->
<!-- does this change? -->

<?php
    require_once 'header.php';
    include_once 'includes/dbh.inc.php';
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
            <h1>Mail</h1>
            <div>
                <!-- going to have to change this to listings.inc.php when with arhum -->
                <form action="includes/mail.inc.php" method = "post"> 
                    <button type = "submit" name = "delete-submit">Delete</button>
                    <button type = "submit" name = "back-submit">Back</button>
                    <button type = "submit" name = "reply-submit">Reply</button>

                </form>
            </div>
            <div>
                <?php
                $message = $_SESSION["message"];
                echo "<p>Date: ". $message["date"] ."</p>";
                echo "<p>Time: ". $message["time"] ."</p>";

                echo "<p>From: ". $message["senderEmail"] ."</p>";
                echo "<p>Subject: ". $message["subject"] ."</p>";
                echo "<p>Message: ". $message["text"] ."</p>";

                if(isset($_GET["error"])){
                    if($_GET["error"]=="send"){
                        echo "<form action='includes/reply.inc.php' method = 'post'>";
                        echo "<input type='text' name = 'text' placeholder = 'Reply'>";
                        echo "<button type = 'submit' name = 'send-submit'>Send</button>";
                        echo "</form>";
                    }else if($_GET["error"]=="emptyinput"){
                        echo "<form action='includes/reply.inc.php' method = 'post'>";
                        echo "<input type='text' name = 'text' placeholder = 'Reply'>";
                        echo "<button type = 'submit' name = 'send-submit'>Send</button>";
                        echo "</form>";
                        echo "<p>Fill in all Fields!</p>";
                    }
                }
                ?>
            </div>
        </section>

    </div>
</body>
</html>


<?php
    require "footer.php";
?>