<?php

require_once 'dbh.inc.php';
include_once 'functions.inc.php';


session_start();
$userid = $_SESSION["userid"];
$role = $_SESSION["role"];

if(isset($_POST['add-submit'])){

    $price = $_POST['price'];
    $listingtype = $_POST['listingtype'];
    $housetype = $_POST['housetype'];
    $bedroom = $_POST['bedroom'];
    $bathroom = $_POST['bathroom'];
    $floor = $_POST['floor'];
    $totalarea = $_POST['totalarea'];
    $furnishstate = $_POST['furnishstate'];
    $number = $_POST['number'];
    $streetname = $_POST['streetname'];
    $postalcode = $_POST['postalcode'];
    $cityname = $_POST['cityname'];
    $province = $_POST['province'];
    $neighbourhood = $_POST['neighbourhood'];
    $quadrant = $_POST['quadrant'];

    if(emptyListingsCheck($price, $bedroom, $bathroom, $floor, $totalarea, $number, $streetname, $postalcode, $cityname, $province, $neighbourhood)!== false){
        header("Location: ../addlisting.php?error=emptyinput");
        exit();
    }

    $sql = "INSERT INTO address (number, postalcode, streetname)
            VALUES ('$number','$postalcode','$streetname')";
    $result = $conn->query($sql);

    $sql = "SELECT * FROM address
                WHERE number = '$number'
                AND postalcode = '$postalcode'
                AND streetname = '$streetname'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $addressid = $row['addressid'];


    $sql = "SELECT * FROM city
                WHERE province = '$province'
                AND cityname = '$cityname'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $cityid = $row['cityid'];

    if ($cityid == NULL) {
    $sql = "INSERT INTO city (province, cityname)
            VALUES ('$province','$cityname')";
    $result = $conn->query($sql);

    $sql = "SELECT * FROM city
                WHERE province = '$province'
                AND cityname = '$cityname'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $cityid = $row['cityid'];
    }

    if ($role == "Agent") {
        $sql = "INSERT INTO house(bathroom, bedroom, floor, listingtype, totalarea, furnishstate, price, agentid, housetype, addressid, cityid, neighbourhood, quadrant)
                    VALUES ('$bathroom', '$bedroom', '$floor', '$listingtype', '$totalarea', '$furnishstate', '$price', '$userid', '$housetype', '$addressid', '$cityid', '$neighbourhood', '$quadrant')";
        $conn->query($sql);
    } else {
        $sql = "INSERT INTO house(bathroom, bedroom, floor, listingtype, totalarea, furnishstate, price, sellerid, housetype, addressid, cityid, neighbourhood, quadrant)
                    VALUES ('$bathroom', '$bedroom', '$floor', '$listingtype', '$totalarea', '$furnishstate', '$price', '$userid', '$housetype', '$addressid', '$cityid', '$neighbourhood', '$quadrant')";
        $conn->query($sql);
    }

    header("location: ../listing.php");
    exit();

}else{
    header("location: ../listing.php");
    exit();
}