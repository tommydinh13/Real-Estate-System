<?php

require_once 'dbh.inc.php';
include_once 'functions.inc.php';


session_start();
$hid = $_SESSION["hid"];

if(isset($_POST['update-submit'])){

    $price = $_POST['price'];
    $listingtype = $_POST['listingtype'];
    $furnishstate = $_POST['furnishstate'];
    

    if ($price == !NULL){
        $sql = "UPDATE house SET price = '$price' WHERE hid = '$hid'"; 
        $result = $conn->query($sql);
    }

    $sql = "UPDATE house SET listingtype = '$listingtype' WHERE hid = '$hid'"; 
    $result = $conn->query($sql);

    $sql = "UPDATE house SET furnishstate = '$furnishstate' WHERE hid = '$hid'"; 
    $result = $conn->query($sql);

    header('location: ../house.php?id='. $hid);
    exit();

}else{
    header('location: ../house.php?id='. $hid);
    exit();
}