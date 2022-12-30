<!-- listings of multiple houses that will have search criteria and all -->

<?php
    require_once 'header.php';
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
            <h1>Message</h1>
            <div>
                <!-- going to have to change this to listings.inc.php when with arhum -->
                <form action="includes/message.inc.php" method = "post"> 
                    <!-- <input type="text" name = "email" placeholder = "To:"> -->
                    <input type="text" name = "subject" placeholder = "Subject">
                    <input type="text" name = "text" placeholder = "Message">
                    <button type = "submit" name = "message-submit">Send</button>
                </form>
                <form action="inbox.php" method = "post">
                    <button type = "submit" name = "message-submit">Check Inbox</button>
                </form>
            </div>
            <?php
            if(isset($_GET["error"])){
                if($_GET["error"]=="emptyinput"){
                    echo "<p>Fill in all fields!</p>";
                }else if($_GET["error"]=="emaildne"){
                    echo "<p>Recipient Email Address Does not Exist!</p>";
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