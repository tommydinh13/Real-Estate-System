<?php

require_once 'dbh.inc.php';
session_start();

if(isset($_POST['filter-submit'])){

    $pricemin = $_POST['pricemin'];
    $pricemax = $_POST['pricemax'];
    $bedroommin = $_POST['bedroommin'];
    $bedroommax = $_POST['bedroommax'];
    $bathroommin = $_POST['bathroommin'];
    $bathroommax = $_POST['bathroommax'];
    $floormin = $_POST['floormin'];
    $floormax = $_POST['floormax'];
    $listingtype = $_POST['listingtype'];
    $furnishstate = $_POST['furnishstate'];
    $cityname = $_POST['cityname'];
    $province = $_POST['province'];
    $neighbourhood = $_POST['neighbourhood'];


    if ($pricemin == NULL) {
        $pricemin = 0;
    }
    if ($pricemax == NULL) {
        $pricemax = 99999999999;
    }

    if ($bedroommin == NULL) {
        $bedroommin = 0;
    }
    if ($bedroommax == NULL) {
        $bedroommax = 99999999999;
    }

    if ($bathroommin == NULL) {
        $bathroommin = 0;
    }
    if ($bathroommax == NULL) {
        $bathroommax = 99999999999;
    }

    if ($floormin == NULL) {
        $floormin = 0;
    }
    if ($floormax == NULL) {
        $floormax = 99999999999;
    }



    $_SESSION['pricemin'] = $pricemin;
    $_SESSION['pricemax'] = $pricemax;
    $_SESSION['bedroommin'] = $bedroommin;
    $_SESSION['bedroommax'] = $bedroommax;
    $_SESSION['bathroommin'] = $bathroommin;
    $_SESSION['bathroommax'] = $bathroommax;
    $_SESSION['floormin'] = $floormin;
    $_SESSION['floormax'] = $floormax;
    $_SESSION['listingtype'] = $listingtype;
    $_SESSION['furnishstate'] = $furnishstate;
    $_SESSION['cityname'] = $cityname;
    $_SESSION['province'] = $province;
    $_SESSION['neighbourhood'] = $neighbourhood;


    header("location: ../filtered.php");
    exit();

}else {
    header("location: ../listing.php");
    exit();
}