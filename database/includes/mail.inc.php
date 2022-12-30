<?php
session_start();
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(isset($_POST['delete-submit'])){
    $messageid = $_SESSION["message"]['messageid'];
    $senderEmail = $_SESSION["message"]['senderEmail'];
    deleteMessage($conn, $messageid);
    header("Location: ../inbox.php");
}else if(isset($_POST['back-submit'])){
    header("Location: ../inbox.php");

}else if(isset($_POST['reply-submit'])){
    // replyMessage($conn, $senderEmail);
    header("Location: ../mail.php?error=send");
    
}