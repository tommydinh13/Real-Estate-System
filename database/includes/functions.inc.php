<!-- fucntiosn to reference to in order to use our website -->

<?php

function emptyInputSignup($email, $fname, $lname, $password, $cpassword, $phone_number){
    $result;
    if(empty($email) || empty($fname) || empty($lname) || empty($password) || empty($cpassword) || empty($phone_number)){
        $result = true;
    }else{
        $result = false;
    }

    return $result;
}

function invalidEmail($email){
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function invalidPhone($phone_number){
    $result;
    if(!filter_var($phone_number, FILTER_VALIDATE_INT)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function passwordMatch($password, $cpassword){
    $result = false;
    if($password !== $cpassword){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function emailExists($conn, $email){
    $sql = "SELECT * FROM account WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);    // get result from database
    if($row  = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createAccount($conn, $email, $fname, $lname, $password, $phone_number, $role){
    $sql = "INSERT INTO account (email, fname, lname, password, phone_number, role) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssssis", $email, $fname, $lname, $password, $phone_number, $role);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../signup.php?error=none");
    // exit();
}

function createRoleAccount($conn, $email, $role, $company){
    if($role === "Client"){
        $sql = "INSERT INTO client (email) VALUES (?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../signup.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: ../signup.php?error=none");
        exit();
    }else if($role === "Independent Seller"){
        $sql = "INSERT INTO independent_seller (email) VALUES (?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../signup.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: ../signup.php?error=none");
        exit();

    }else if($role === "Agent"){
        if($company === "arhum"){
            $cemail = "arhum@company.com";
            $sql = "SELECT * FROM company WHERE cemail = ?;";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../signup.php?error=stmtfailed");
                exit();
            }
            mysqli_stmt_bind_param($stmt, "s", $cemail);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);    // get result from database
            $row  = mysqli_fetch_assoc($result);
            $cid = $row['cid'];
        }else if($company === "desly"){
            $cemail = "desly@company.com";
            $sql = "SELECT * FROM company WHERE cemail = ?;";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../signup.php?error=stmtfailed");
                exit();
            }
            mysqli_stmt_bind_param($stmt, "s", $cemail);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);    // get result from database
            $row  = mysqli_fetch_assoc($result);
            $cid = $row['cid'];
        }else if($company === "tommy"){
            $cemail = "tommy@company.com";
            $sql = "SELECT * FROM company WHERE cemail = ?;";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../signup.php?error=stmtfailed");
                exit();
            }
            mysqli_stmt_bind_param($stmt, "s", $cemail);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);    // get result from database
            $row  = mysqli_fetch_assoc($result);
            $cid = $row['cid'];

        }
        $sql = "INSERT INTO agent (email, cid) VALUES (?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../signup.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "ss", $email, $cid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: ../signup.php?error=none");
        exit();

    }
}

function emptyInputLogin($email, $password){
    $result;
    if(empty($email) || empty($password)){
        $result = true;
    }else{
        $result = false;
    }

    return $result;
}

function loginUser($conn, $email, $password){
    $email_exists =  emailExists($conn, $email);

    if($email_exists === false){
        header("Location: ../login.php?error=loginfailed");
        exit();
    }
    $dbpwd = $email_exists["password"];
    // $checkpwd = password_verify($password, $dbpwd);

    if($dbpwd !== $password){
        header("Location: ../login.php?error=incorrectpassword");
        exit();
    }else if($dbpwd === $password){
        $role = $email_exists["role"];
        $id = userID($conn, $email, $role);
        session_start();
        $_SESSION["email"] = $email_exists["email"];
        $_SESSION["role"] = $email_exists["role"];
        $_SESSION["userid"] = $id;

        header("Location: ../listing.php");
        echo "\nafter header";

        exit();
    }
}

// also look at emailExists to find out how to pull info
function userID($conn, $email, $role){
    $id;
    if($role === "Independent Seller"){
        // search independent seller table to find the id 
        $sql = "SELECT * FROM independent_seller WHERE email=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../message.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $id = $row['sellerid'];
        
    }else if($role === "Client"){
         // search client table to find the id 
        $sql = "SELECT * FROM client WHERE email=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../message.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $id = $row['clientid'];
                
    }else if($role === "Agent"){
         // search client table to find the id 
        $sql = "SELECT * FROM agent WHERE email=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../message.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $resid = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($resid);
        $id = $row['agentid'];
                
    }
    return $id;
}

function emptyRecipientMessage($email, $subject, $text){
    $result;
    if(empty($email) || empty($subject) || empty($text)){
        $result = true;
    }else{
        $result = false;
    }

    return $result;
}

function composeMessage($conn, $email1, $email2, $subject, $text){
    $email_exists = emailExists($conn, $email2);
    if($email_exists === false){
        header("Location: ../message.php?error=emaildne");
        exit();
    }
    $date = date("Y/m/d");
    $time = date("h:i:sa");


    $sql = "INSERT INTO message (date, time, senderEmail, receiverEmail, subject, text) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../message.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssssss", $date, $time, $email1, $email2, $subject, $text);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // insertMessageRole($conn, $email2);

    header("Location: ../message.php?error=none");   // going to have to change error
    // will also need a query to send message into recipient database as well 
}

// get role of account from email
function emailToRole($conn, $email){
    // must find role of email we sent to 
    $sql = "SELECT * FROM account WHERE email=?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../message.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $role = $row['role'];

    return $role;
}

// get the last message sent
function getLastMessage($conn){
    // must find role of email we sent to 
    $sql = "SELECT MAX(messageid) AS largest_mid FROM message;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../message.php?error=stmtfailed");
        exit();
    }
    // mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $messageid = $row['largest_mid'];

    return $messageid;
}


function emptyMessageID($id){
    $result;
    if(empty($id)){
        $result = true;
    }else{
        $result = false;
    }

    return $result;
}

function openMessage($conn, $messageid){
    $email = $_SESSION["email"];

    $sql = "SELECT * FROM message WHERE messageid=?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../inbox.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $messageid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $_SESSION["message"] = $row;
    
    header("Location: ../mail.php");
    exit();
}

function checkMessageID($conn, $messageid, $email){
    $bool = false;
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
        if($row['messageid'] == $messageid){
            $bool = true;
        }
    }
    // return $row['receiverEmail'];
    // return $email;
    return $bool;
}

function deleteMessage($conn, $messageid){
     // insert into client message table the message id and the client's id
    $sql = "DELETE FROM message WHERE messageid=?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../message.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $messageid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function getEmailFromHID($conn, $hid){
    $sql = "SELECT * FROM house WHERE hid=?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../inbox.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $hid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row =  mysqli_fetch_assoc($result);
    $agentid = $row['agentid'];
    $sellerid = $row['sellerid'];

    if($agentid === NULL){
        // do seller sql
        $sql = "SELECT * FROM independent_seller WHERE sellerid=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../inbox.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $sellerid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row =  mysqli_fetch_assoc($result);
        return $row['email'];
    }else if($sellerid === NULL){
        // do agent functions
        $sql = "SELECT * FROM agent WHERE agentid=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../inbox.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $agentid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row =  mysqli_fetch_assoc($result);
        return $row['email'];
    }
}

function emptyListingsCheck($price, $bedroom, $bathroom, $floor, $totalarea, $number, $streetname, $postalcode, $cityname, $province, $neighbourhood){
    $result;
    if(empty($price) || empty($bedroom) ||empty($bathroom) || empty($floor) ||empty($totalarea) ||empty($number) ||empty($streetname) ||empty($postalcode) ||empty($cityname) ||empty($province) ||empty($neighbourhood)){
        $result = true;
    }else{
        $result = false;
    }

    return $result;
}

