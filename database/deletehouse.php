<?php
    //session_start();
    require_once 'header.php';
    include_once 'includes/dbh.inc.php';

    //$userid = $_SESSION["userid"];
    //$role = $_SESSION["role"];

    $delete_id = $_GET['id'] ?? 0;

    $sql = "SELECT * FROM house WHERE hid=?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../inbox.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $delete_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row =  mysqli_fetch_assoc($result);

    $addressid = $row['addressid'];

    $sql = "DELETE FROM house WHERE hid=". $delete_id;
    $result = $conn->query($sql);

    $sql = "DELETE FROM address WHERE addressid=". $addressid;
    $result = $conn->query($sql);





    if ($result === TRUE) {
        header("Location: ./listing.php");
        exit();
    }

?>
