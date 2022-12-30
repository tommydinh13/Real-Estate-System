<!-- form for comparing houses -->
<?php
    require_once 'header.php';
    include_once 'includes/dbh.inc.php';

    $userid = $_SESSION["userid"];
    $role = $_SESSION["role"];

    
    $sql = "SELECT * FROM house AS h JOIN address AS a ON h.addressid = a.addressid
                    JOIN city AS c ON h.cityid = c.cityid";
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
        <h1>Compare Houses</h1>
            <div style="text-align:center">
            <form action="includes/comparehouse.inc.php" method = "post">
                <input type="text" name = "houseid1" placeholder = "House ID 1" require>
                <p><< Compare >></p>
                <input type="text" name = "houseid2" placeholder = "House ID 2" require><br /><br />
                <button type = "submit" name = "compare-submit">Compare</button>
                <button type = "submit" name = "cancel-submit">Cancel</button>
            </form>
            <?php
            if(isset($_GET["error"])){
                if($_GET["error"]=="emptyinput"){
                    echo "<p>Fill in all fields!</p>";
                }else if($_GET["error"]=="invalidhid"){
                    echo "<p>Please Enter House ID From Below!</p>";
                }
            }
            ?>
            <br /><br />
            <h1> Please select houses to compare!</h1>
            <br /><br />
            <?php if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()): ?>   
                    <div class="column;">
                            <?php echo'<img height="300" width="500" src="data:image;base64,'.$row['photo'].'">';
                            //echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>'; ?>
                                <!-- <img src="<?= $row['photo'] ?>" width="80%" class="main-photo"> -->
                            <h2>House ID: <?= $row['hid'] ?></h2>
                            <h3><?= $row['listingtype'] ?> $<?= $row['price'] ?></h3>
                            <p><?= $row['housetype'] ?></p>
                            <p><?= $row['bedroom'] ?> bd / <?= $row['bathroom'] ?> ba </p>
                            <p><?= $row['neighbourhood'] ?></p>
                            <p><?= $row['quadrant'] ?> <?= $row['cityname'] ?>, <?= $row['province'] ?> <?= $row['postalcode'] ?></p>
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