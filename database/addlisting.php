<!-- form for adding a house -->
<?php
    require_once 'header.php';
    include_once 'includes/dbh.inc.php';
    

    $userid = $_SESSION["userid"];
    $role = $_SESSION["role"];

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
                <h1>Add Listing</h1><br /><br />
                <?php
                if(isset($_GET["error"])){
                    if($_GET["error"]=="emptyinput"){
                        echo "<p>Fill in all fields!</p>";
                    }
                }
            ?>
                <div style="width: 90%; float: right;">
                <form action="includes/listing.inc.php" method = "post">
                    <label for="price">Price:</label>
                    <input type="text" name = "price" placeholder = "Price ($)" require><br /><br />
                    <label for="listingtype">Listing Type:</label>
                    <select name="listingtype" id="listingtype">
                            <option value="For Sale">For Sale</option>
                            <option value="For Rent">For Rent</option>
                    </select><br /><br />
                    <!-- <label for="housetype">House Type:</label>
                    <input type="text" name = "housetype" placeholder = "apartment, condo, basement, house, etc" require><br /><br /> -->
                    <label for="housetype">House Type:</label>
                    <select name="housetype" id="housetype">
                            <option value="Apartment">Apartment</option>
                            <option value="Bungalow">Bungalow</option>
                            <option value="Duplex">Duplex</option>
                            <option value="Townhouse">Townhouse</option>
                            <option value="Condo">Condo</option>

                    </select><br /><br />
                    <label for="bedroom">Bedrooms:</label>
                    <input type="text" name = "bedroom" placeholder = "no. of bedrooms" require><br /><br />
                    <label for="bathroom">Bathrooms:</label>
                    <input type="text" name = "bathroom" placeholder = "no. of bathrooms" require><br /><br />
                    <label for="floor">Floor:</label>
                    <input type="text" name = "floor" placeholder = "no. of floors" require><br /><br />
                    <label for="totalarea">Total Area:</label>
                    <input type="text" name = "totalarea" placeholder = "area in sq ft." require><br /><br />
                    <label for="furnishstate">Furnish State:</label>
                    <select name="furnishstate" id="furnishstate">
                            <option value="Yes">Furnished</option>
                            <option value="No">Not Furnished</option>
                    </select><br /><br />
                    <label for="number">Unit number:</label>
                    <input type="text" name = "number" placeholder = "unit no." require><br /><br />
                    <label for="streetname">Street Name:</label>
                    <input type="text" name = "streetname" placeholder = "name of the street" require><br /><br />
                    <label for="postalcode">Postal Code:</label>
                    <input type="text" name = "postalcode" placeholder = "A#A #A#" require><br /><br />
                    <label for="cityname">City:</label>
                    <input type="text" name = "cityname" placeholder = "name of the city" require><br /><br />
                    <label for="province">Province:</label>
                    <input type="text" name = "province" placeholder = "name of the province" require><br /><br />
                    <label for="neighbourhood">Neighbourhood:</label>
                    <input type="text" name = "neighbourhood" placeholder = "name of the neighbourhood" require><br /><br />
                    <!-- for quadrant -->
                    <label for="quadrant">Quadrant:</label>
                    <select name="quadrant" id="quadrant">
                            <option value="NE">NE</option>
                            <option value="NW">NW</option>
                            <option value="SE">SE</option>
                            <option value="SW">SW</option>

                    </select><br /><br />



                    <button type = "submit" name = "add-submit">Add Listing</button>
                    <button type = "submit" name = "cancel-submit">Cancel</button>
                    <br /><br />
                </form>
            </div>
        </section>
    </div>
</body>
</html>

<?php
    require "footer.php";
?>