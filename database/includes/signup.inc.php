<?php
if(isset($_POST['signup-submit'])){

    // link with our databse
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';


    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $password = $_POST['pwd'];
    $cpassword = $_POST['cpwd'];
    $phone_number = $_POST['phone_number'];
    $role = $_POST['role'];
    $company = $_POST['company-select'];


    // if one of the boxes are empty
    if(emptyInputSignup($email, $fname, $lname, $password, $cpassword, $phone_number)!== false){
        header("Location: ../signup.php?error=emptyinput");
        exit();

    }if(invalidEmail($email)!== false){
        header("Location: ../signup.php?error=invalidemail");
        exit();

    }if(invalidPhone($phone_number)!== false){
        header("Location: ../signup.php?error=invalidphone");
        exit();

    }if(passwordMatch($password, $cpassword)!== false){
        header("Location: ../signup.php?error=invalidpassword");
        exit();

    }if(emailExists($conn, $email)!== false){
        header("Location: ../signup.php?error=emailtaken");
        exit();

    }
    echo $company;
    createAccount($conn, $email, $fname, $lname, $password, $phone_number, $role);
    createRoleAccount($conn, $email, $role, $company);
}else{
    header("location: ../signup.php");
}