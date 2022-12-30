<!-- house listing -->
<?php
    require_once 'header.php';
    include_once 'includes/dbh.inc.php';

    $userid = $_SESSION["userid"];
    $role = $_SESSION["role"];

    if ($role == "Independent Seller") {
        $sql = "SELECT * FROM house AS h JOIN address AS a ON h.addressid = a.addressid
                        JOIN city AS c ON h.cityid = c.cityid
                        WHERE sellerid = '$userid'";
    } else if ($role == "Agent") {
        $sql = "SELECT * FROM house AS h JOIN address AS a ON h.addressid = a.addressid
                        JOIN city AS c ON h.cityid = c.cityid
                        WHERE agentid = '$userid'";
    } else {
        $sql = "SELECT * FROM house AS h JOIN address AS a ON h.addressid = a.addressid
                        JOIN city AS c ON h.cityid = c.cityid";
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
            <?php if ($role == "Agent" || $role == "Independent Seller") { ?>
                <div style= "float: right">
                    <button type = button><a href="addlisting.php">Add a House </a></button>
                </div>
            <?php } else {?>
                <div style= "float: right">
                    <button type = button><a href="filterhouse.php">Filter Houses </a></button>
                    <button type = button><a href="comparehouse.php">Compare Houses </a></button>
                </div>
            <?php } ?>

            <h1>Listings</h1>
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