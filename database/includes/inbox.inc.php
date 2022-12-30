<?php


if(isset($_POST['messageid-submit'])){
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    session_start();

    $messageid = $_POST['messageid'];
    $email = $_SESSION["email"];

    if(emptyMessageID($messageid)!== false){
        header("Location: ../inbox.php?error=emptyinput");
        exit();
    }else if(!checkMessageID($conn, $messageid, $email)){
        header("Location: ../inbox.php?error=invalidid");
        exit();
    }

    openMessage($conn, $messageid);
    $row = $_SESSION["message"];
    echo $row['subject'];

}   
