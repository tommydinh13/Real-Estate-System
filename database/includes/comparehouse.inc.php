<?php

require_once 'dbh.inc.php';
session_start();

if(isset($_POST['compare-submit'])){

    $house_id1 = $_POST['houseid1'];
    $house_id2 = $_POST['houseid2'];

    $_SESSION['houseid1'] = $house_id1;
    $_SESSION['houseid2'] = $house_id2;

    header("location: ../comparision.php");
    exit();

}else {
    header("location: ../listing.php");
    exit();
}