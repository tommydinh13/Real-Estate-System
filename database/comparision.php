<!-- form for comparing houses - displaying its picture and information side by side -->
<?php

require_once 'header.php';
include_once 'includes/dbh.inc.php';



$house_id1 = $_SESSION['houseid1'];
$house_id2 = $_SESSION['houseid2'];

$sql = "SELECT * FROM house AS h JOIN address AS a ON h.addressid = a.addressid
                    JOIN city AS c ON h.cityid = c.cityid
                    WHERE h.hid = '$house_id1'";
$result = $conn->query($sql);

$sql1 = "SELECT * FROM house AS h JOIN address AS a ON h.addressid = a.addressid
                    JOIN city AS c ON h.cityid = c.cityid
                    WHERE h.hid = '$house_id2'";
$newresult = $conn->query($sql1);

$row = $result->fetch_assoc();
$row1 = $newresult->fetch_assoc();
if($row === NULL || $row1 === NULL){
    header("Location: ./comparehouse.php?error=invalidhid");
    exit();
}
$hid = $row['hid'];
$hid1 = $row1['hid'];
?>

<!DOCTYPE html>
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
    <div class = "wrapper-main">
        <section class = "section-default">
                <h1>Comparison</h1><br /><br />
                <?php if ($hid == NULL || $hid1 == NULL) { ?>
                    <div style="text-align:center">
                        <p>Invalid House ID entered!</p>
                        <button type = button><a href="comparehouse.php">Try Again </a></button>
                        <button type = button><a href="listing.php">Cancel </a></button>
                    </div>
                <?php } else { ?>

                <div class="column half">
                    <div style="width: 50%; float: right;">
                        <?php echo'<img height="350" width="600" src="data:image;base64,'.$row['photo'].'">';
                        //echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>'; ?>
                            <!-- <img src="<?= $row['photo'] ?>" width="80%" class="main-photo"> -->
                        <h2><?= $row['listingtype'] ?></h2>
                        <br />
                        <h3>Price: $<?= $row['price'] ?></h3>
                        <p>House Type: <?= $row['housetype'] ?></p>
                        <p>Bedrooms: <?= $row['bedroom'] ?></p>
                        <p>Bathrooms: <?= $row['bathroom'] ?> </p>
                        <p>Floors: <?= $row['floor'] ?> </p>
                        <p>Total Area: <?= $row['totalarea'] ?> </p>
                        <p>Furnished?: <?= $row['furnishstate'] ?> </p>
                        <p>Neighbourhood: <?= $row['neighbourhood'] ?></p>
                        <p>Address: <?= $row['number']?>, <?= $row['streetname']?>, <?= $row['cityname']?>, <?= $row['province'] ?> <?= $row['postalcode'] ?> </p>
                    </div>
                </div>

                <div class="column half">
                    <?php echo'<img height="350" width="600" src="data:image;base64,'.$row1['photo'].'">';
                    //echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>'; ?>
                        <!-- <img src="<?= $row['photo'] ?>" width="80%" class="main-photo"> -->
                    <h2><?= $row1['listingtype'] ?></h2>
                    <br />
                    <h3>Price: <?= $row1['price'] ?></h3>
                    <p>House Type: <?= $row1['housetype'] ?></p>
                    <p>Bedrooms: <?= $row1['bedroom'] ?></p>
                    <p>Bathrooms: <?= $row1['bathroom'] ?> </p>
                    <p>Floors: <?= $row1['floor'] ?> </p>
                    <p>Total Area: <?= $row1['totalarea'] ?> </p>
                    <p>Furnished?: <?= $row1['furnishstate'] ?> </p>
                    <p>Neighbourhood: <?= $row1['neighbourhood'] ?></p>
                    <p>Address: <?= $row1['number']?>, <?= $row1['streetname']?>, <?= $row1['cityname']?>, <?= $row1['province'] ?> <?= $row1['postalcode'] ?> </p>
                </div>
                <br /><br />
                <div style="width: 55%; float: right;">
                <button type = button><a href="listing.php">Done </a></button><br /><br />
                </div>
                <?php } ?>
        </section>
    </div>
</body>
</html>

<?php
    require "footer.php";
?>