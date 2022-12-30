<?php

if(isset($_POST['login-submit'])){
    $email = $_POST['email'];
    $password = $_POST['pwd'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    
    if(emptyInputLogin($email, $password)!== false){
        header("Location: ../login.php?error=emptyinput");
        exit();
    }
    loginUser($conn, $email, $password);
}else{
    header("location: ../login.php");
    exit();
}