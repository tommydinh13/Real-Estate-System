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
                <h1>Update House Details</h1>
                <br />
                <div class="row">
              
                    
                            <div style="width: 50%; float: right;">
                            <div style="text-align:center">
                                <?php echo'<img height="350" width="600" src="data:image;base64,'.$row['photo'].'">';
                                //echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>'; ?>
                                    <!-- <img src="<?= $row['photo'] ?>" width="80%" class="main-photo"> -->
                            </div>
                            </div>
                      
                   

               
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
                        <br /><br /><br />
                        <div style="width: 50%; float: left;">
                        <form action="includes/updatehouse.inc.php" method = "post">
                            <label for="price"> Update Price:</label>
                            <input type="text" name = "price" placeholder = "New Price ($)" require><br /><br />
                            <label for="listingtype">Update Listing Type:</label>
                            <select name="listingtype" id="listingtype">
                                <option value="For Sale">For Sale</option>
                                <option value="For Rent">For Rent</option>
                            </select><br /><br />
                            <label for="furnishstate">Furnish State:</label>
                            <select name="furnishstate" id="furnishstate">
                                <option value="Yes">Furnished</option>
                                <option value="No">Not Furnished</option>
                            </select><br /><br />
                            <button type = "submit" name = "update-submit">Confirm Update</button>
                            <button type = "submit" name = "cancel-submit">Cancel</button>
                        </form>
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