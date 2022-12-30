<?php
    require_once 'header.php';
    include_once 'includes/dbh.inc.php';
    // session_start();

    $pricemin = $_SESSION['pricemin'];
    $pricemax = $_SESSION['pricemax'];
    $bedroommin = $_SESSION['bedroommin'];
    $bedroommax = $_SESSION['bedroommax'];
    $bathroommin = $_SESSION['bathroommin'];
    $bathroommax = $_SESSION['bathroommax'];
    $floormin = $_SESSION['floormin'];
    $floormax = $_SESSION['floormax'];
    $listingtype = $_SESSION['listingtype'];
    $furnishstate = $_SESSION['furnishstate'];
    $cityname = $_SESSION['cityname'];
    $province = $_SESSION['province'];
    $neighbourhood = $_SESSION['neighbourhood'];


    if ($cityname == NULL && $province == NULL && $neighbourhood == NULL) {
        $sql = "SELECT * FROM house AS h JOIN address AS a ON h.addressid = a.addressid
                    JOIN city AS c ON h.cityid = c.cityid
                    WHERE h.price BETWEEN '$pricemin' AND '$pricemax'
                    AND h.bedroom BETWEEN '$bedroommin' AND '$bedroommax'
                    AND h.bathroom BETWEEN '$bathroommin' AND '$bathroommax'
                    AND h.floor BETWEEN '$floormin' AND '$floormax'
                    AND h.listingtype = '$listingtype'
                    AND h.furnishstate = '$furnishstate'";
    } else if ($cityname == NULL && $province == NULL) {
        $sql = "SELECT * FROM house AS h JOIN address AS a ON h.addressid = a.addressid
                    JOIN city AS c ON h.cityid = c.cityid
                    WHERE h.price BETWEEN '$pricemin' AND '$pricemax'
                    AND h.bedroom BETWEEN '$bedroommin' AND '$bedroommax'
                    AND h.bathroom BETWEEN '$bathroommin' AND '$bathroommax'
                    AND h.floor BETWEEN '$floormin' AND '$floormax'
                    AND h.listingtype = '$listingtype'
                    AND h.furnishstate = '$furnishstate'
                    AND h.neighbourhood = '$neighbourhood'";
    } else if ($cityname == NULL && $neighbourhood == NULL) {
        $sql = "SELECT * FROM house AS h JOIN address AS a ON h.addressid = a.addressid
                    JOIN city AS c ON h.cityid = c.cityid
                    WHERE h.price BETWEEN '$pricemin' AND '$pricemax'
                    AND h.bedroom BETWEEN '$bedroommin' AND '$bedroommax'
                    AND h.bathroom BETWEEN '$bathroommin' AND '$bathroommax'
                    AND h.floor BETWEEN '$floormin' AND '$floormax'
                    AND h.listingtype = '$listingtype'
                    AND h.furnishstate = '$furnishstate'
                    AND c.province = '$province'";
    } else if ($province == NULL && $neighbourhood == NULL) {
        $sql = "SELECT * FROM house AS h JOIN address AS a ON h.addressid = a.addressid
                    JOIN city AS c ON h.cityid = c.cityid
                    WHERE h.price BETWEEN '$pricemin' AND '$pricemax'
                    AND h.bedroom BETWEEN '$bedroommin' AND '$bedroommax'
                    AND h.bathroom BETWEEN '$bathroommin' AND '$bathroommax'
                    AND h.floor BETWEEN '$floormin' AND '$floormax'
                    AND h.listingtype = '$listingtype'
                    AND h.furnishstate = '$furnishstate'
                    AND c.cityname = '$cityname'";
    } else if ($province == NULL) {
        $sql = "SELECT * FROM house AS h JOIN address AS a ON h.addressid = a.addressid
                    JOIN city AS c ON h.cityid = c.cityid
                    WHERE h.price BETWEEN '$pricemin' AND '$pricemax'
                    AND h.bedroom BETWEEN '$bedroommin' AND '$bedroommax'
                    AND h.bathroom BETWEEN '$bathroommin' AND '$bathroommax'
                    AND h.floor BETWEEN '$floormin' AND '$floormax'
                    AND h.listingtype = '$listingtype'
                    AND h.furnishstate = '$furnishstate'
                    AND c.cityname = '$cityname'
                    AND h.neighbourhood = '$neighbourhood'";
    } else if ($cityname == NULL) {
        $sql = "SELECT * FROM house AS h JOIN address AS a ON h.addressid = a.addressid
                    JOIN city AS c ON h.cityid = c.cityid
                    WHERE h.price BETWEEN '$pricemin' AND '$pricemax'
                    AND h.bedroom BETWEEN '$bedroommin' AND '$bedroommax'
                    AND h.bathroom BETWEEN '$bathroommin' AND '$bathroommax'
                    AND h.floor BETWEEN '$floormin' AND '$floormax'
                    AND h.listingtype = '$listingtype'
                    AND h.furnishstate = '$furnishstate'
                    AND c.province = '$province'
                    AND h.neighbourhood = '$neighbourhood'";
    } else if ($neighbourhood == NULL) {
        $sql = "SELECT * FROM house AS h JOIN address AS a ON h.addressid = a.addressid
                    JOIN city AS c ON h.cityid = c.cityid
                    WHERE h.price BETWEEN '$pricemin' AND '$pricemax'
                    AND h.bedroom BETWEEN '$bedroommin' AND '$bedroommax'
                    AND h.bathroom BETWEEN '$bathroommin' AND '$bathroommax'
                    AND h.floor BETWEEN '$floormin' AND '$floormax'
                    AND h.listingtype = '$listingtype'
                    AND h.furnishstate = '$furnishstate'
                    AND c.province = '$province'
                    AND c.cityname = '$cityname'";
    }

    $result = $conn->query($sql);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/navigationbar.css">
    <link rel="stylesheet" href="css/buttons.css">
</head>
<body>

    <div class = "wrapper-main;">
        <section class = "section-default;">
                <div style= "float: right">
                    <button type = button><a href="filterhouse.php">New Filter Search </a></button>
                    <button type = button><a href="listing.php">Cancel </a></button>
                </div>
            <h1>Filtered Result</h1>
            <br />
            <div style="text-align:center">
            <?php if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()): ?>
                        
                    <div class="column;">
                             <a href="house.php?id=<?= $row['hid']; ?>">
                            <?php echo'<img height="300" width="500" src="data:image;base64,'.$rows['photo'].'">';
                            //echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>'; ?>
                                <!-- <img src="<?= $row['photo'] ?>" width="80%" class="main-photo"> -->
                            </a>
                            <h2><?= $row['listingtype'] ?> $<?= $row['price'] ?></h2>
                            <p><?= $row['housetype'] ?></p>
                            <p><?= $row['bedroom'] ?> bd / <?= $row['bathroom'] ?> ba </p>
                            <p><?= $row['neighbourhood'] ?></p>
                            <p><?= $row['quadrant'] ?> <?= $row['cityname'] ?>, <?= $row['province'] ?> <?= $row['postalcode'] ?></p>
                            <button type = button><a href="house.php?id=<?= $row['hid']; ?>">More Details >></a></button>
                            <br />
                            <h1> ---------------------------------------------------------------------------------------------------------------------------</h1>
                    </div>
                    <br />
                <?php  endwhile;
            } else {
                echo "No Listings found!";
                } ?>
            </div>
        </section>
    </div>
</body>
</html>

<?php
    require "footer.php";
?>