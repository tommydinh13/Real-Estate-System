<?php
    require_once 'header.php';
    include_once 'includes/dbh.inc.php';

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
                <h1>Filter Houses</h1><br /><br />
                <div style="width: 90%; float: right;">
                <form action="includes/filterhouse.inc.php" method = "post">
                    <label for="pricemin">Price:</label>
                    <input type="text" name = "pricemin" placeholder = "min. price">
                    <input type="text" name = "pricemax" placeholder = "max. price"><br /><br />
                    <label for="listingtype">Listing Type:</label>
                    <select name="listingtype" id="listingtype">
                            <option value="For Sale">For Sale</option>
                            <option value="For Rent">For Rent</option>
                    </select><br /><br />
                    <label for="bedroommin">Bedrooms:</label>
                    <input type="text" name = "bedroommin" placeholder = "min. bedrooms">
                    <input type="text" name = "bedroommax" placeholder = "max. bedrooms"><br /><br />
                    <label for="bathroommin">Bathrooms:</label>
                    <input type="text" name = "bathroommin" placeholder = "min. bathrooms">
                    <input type="text" name = "bathroommax" placeholder = "max. bathrooms"><br /><br />
                    <label for="floormin">Floor:</label>
                    <input type="text" name = "floormin" placeholder = "min. floors">
                    <input type="text" name = "floormax" placeholder = "max. floors"><br /><br />
                    <label for="furnishstate">Furnish State:</label>
                    <select name="furnishstate" id="furnishstate">
                            <option value="Yes">Furnished</option>
                            <option value="No">Not Furnished</option>
                    </select><br /><br />
                    <label for="cityname">City:</label>
                    <input type="text" name = "cityname" placeholder = "name of the city"><br /><br />
                    <label for="province">Province:</label>
                    <input type="text" name = "province" placeholder = "name of the province"><br /><br />
                    <label for="neighbourhood">Neighbourhood:</label>
                    <input type="text" name = "neighbourhood" placeholder = "name of the neighbourhood" require><br /><br />


                    <button type = "submit" name = "filter-submit">Filter</button>
                    <button type = "submit" name = "cancel-submit">Cancel</button>

                </form>
            </div>
        </section>
    </div>
</body>
</html>

<?php
    require "footer.php";
?>