<?php

if(isset($_POST['send-submit'])){
    session_start();
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $senderEmail = $_SESSION["message"]['receiverEmail'];
    $receiverEmail = $_SESSION["message"]['senderEmail'];
    $subject = $_SESSION["message"]['subject'];
    $text = $_POST['text'];

    if(emptyRecipientMessage($receiverEmail, $subject, $text)!== false){
        header("Location: ../mail.php?error=emptyinput");
        exit();
    }
    composeMessage($conn, $senderEmail, $receiverEmail, $subject, $text);

    header("Location: ../inbox.php");
}


