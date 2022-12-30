<?php
session_start();

if(isset($_POST['message-submit'])){
    // $email2 = $_POST['email'];
    $hid = $_SESSION["hid"];
    $text = $_POST['text'];
    $email1 = $_SESSION["email"];
    $role = $_SESSION["role"];
    $subject = $_POST['subject'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $email2 = getEmailFromHID($conn, $hid);
    if(emptyRecipientMessage($email2, $subject, $text)!== false){
        header("Location: ../message.php?error=emptyinput");
        exit();
    }

    composeMessage($conn, $email1, $email2, $subject, $text);
    // insertRoleMessage($conn, $email2);

}else if(isset($_POST['inbox-submit'])){
    header("Location: ../inbox.php");
    exit();
    

}else{
    header("location: ../login.php");
    exit();
}