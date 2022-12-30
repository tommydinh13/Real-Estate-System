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
            <h1>Inbox</h1>
            <div>
                <!-- going to have to change this to listings.inc.php when with arhum -->
                <form action="includes/inbox.inc.php" method = "post"> 
                    <input type="text" name = "messageid" placeholder = "Message ID">
                    <button type = "submit" name = "messageid-submit">Enter</button>
                </form>
            </div>
            <div>
            <?php
                if(isset($_GET["error"])){
                    if($_GET["error"]=="emptyinput"){
                        echo "<p>Fill in all fields!</p>";
                    }else if($_GET["error"] == "invalidid"){
                        echo "<p>Invalid Message ID!</p>";
                        
                    }
                }
                ?>
            </div>
            <div>
                <!-- <p>MessageID    From    Subject</p> -->
            </br>

                <?php
                // session_start();

                if(isset($_SESSION["userid"])){
                    $userid = $_SESSION["userid"];
                    $role = $_SESSION["role"];
                    $email = $_SESSION["email"];

                        // search independent seller table to find the id 
                        $sql = "SELECT * FROM message WHERE receiverEmail=?;";
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            header("Location: ../inbox.php?error=stmtfailed");
                            exit();
                        }
                        mysqli_stmt_bind_param($stmt, "s", $email);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                    
                        while($row = mysqli_fetch_assoc($result)){
                            $msgid = $row['messageid'];
                            $sender = $row['senderEmail'];
                            $text = $row['text'];
                            $subject = $row['subject'];
                            echo "<p>MessageID: ". $msgid . "   From: ". $sender. "   Subject: ". $subject."</p>";
                            echo "</br>";
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