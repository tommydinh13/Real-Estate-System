<!-- form for individual house displaying its picture and information -->
<?php
    require_once 'header.php';
    include_once 'includes/dbh.inc.php';

    $userid = $_SESSION["userid"];
    $role = $_SESSION["role"];

    $house_id = $_GET['id'] ?? 0;
    $_SESSION["hid"] = $house_id;

    $sql = "SELECT * FROM house AS h JOIN address AS a ON h.addressid = a.addressid
                        JOIN city AS c ON h.cityid = c.cityid
                        WHERE h.hid = $house_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
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
    <div class = "wrapper-main">
        <section class = "section-default">
            <div style = "width = 100%">
                <h1>House Details</h1>
                <br />
                <div class="row">
                    <div class="column half">
                        <div class="card">
                            <div style="width: 50%; float: right;">
                            <div style="text-align:center">
                                <?php echo'<img height="350" width="600" src="data:image;base64,'.$row['photo'].'">';
                                //echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>'; ?>
                                    <!-- <img src="<?= $row['photo'] ?>" width="80%" class="main-photo"> -->
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="column half">
                    <div style="text-align:center">
                                <h2><?= $row['listingtype'] ?> $<?= $row['price'] ?></h2>
                                <br />
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
                        <div style="width: 50%; float: right;">
                            <div style="text-align:center">
                            <br />
                            <?php if ($role == "Agent" || $role == "Independent Seller") { ?>
                                <button type = button><a href="updatehouse.php?id=<?= $row['hid']; ?>">Update Listing >></a></button>
                                <button type = button><a href="deletehouse.php?id=<?= $row['hid']; ?>">Delete this Listing >></a></button>
                            <?php } else { ?>
                                <button type = button><a href="message.php">Send Message</a></button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
</body>
</html>

<?php
    require "footer.php";
?>