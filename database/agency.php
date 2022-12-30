<?php
require "header.php";
include_once 'includes/dbh.inc.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agencies</title>
    <link rel="stylesheet" href="css/navigationbar.css">
    <link rel="stylesheet" href="css/buttons.css">
    <link rel="stylesheet" href="css/agency.css">
</head>
<body>
    <div id=agency-wrap>
        <div class="agency">
            <h2>Arhum Company</h2>
        <?php
            $arhum = 1;
            // get all that are in arhum company

            $sql = "SELECT * FROM agent WHERE cid=?;";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../inbox.php?error=stmtfailed");
                exit();
            }
            mysqli_stmt_bind_param($stmt, "i", $arhum);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while($row = mysqli_fetch_assoc($result)){
                $sql1 = "SELECT * FROM account WHERE email=?;";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql1)){
                    header("Location: ../inbox.php?error=stmtfailed");
                    exit();
                }
                mysqli_stmt_bind_param($stmt, "s", $row['email']);
                mysqli_stmt_execute($stmt);
                $result1 = mysqli_stmt_get_result($stmt);
                $row1 = mysqli_fetch_assoc($result1);
                echo "<p>".$row1['fname']." ".  $row1['lname'].": ". $row['email']. "</p>";
            }
        ?>
        </div>
        <div class="agency">
            <h2>Desly Company</h2>

            <?php
                $desly = 2;
                // get all that are in arhum company
                $sql = "SELECT * FROM agent WHERE cid=?;";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../inbox.php?error=stmtfailed");
                    exit();
                }
                mysqli_stmt_bind_param($stmt, "i", $desly);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while($row = mysqli_fetch_assoc($result)){
                    $sql1 = "SELECT * FROM account WHERE email=?;";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql1)){
                        header("Location: ../inbox.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmt, "s", $row['email']);
                    mysqli_stmt_execute($stmt);
                    $result1 = mysqli_stmt_get_result($stmt);
                    $row1 = mysqli_fetch_assoc($result1);
                    echo "<p>".$row1['fname']." ".  $row1['lname'].": ". $row['email']. "</p>";
                }
            ?>

        </div>
        <div class="agency">
            <h2>Tommy Company</h2>

            <?php
                $tommy = 3;
                // get all that are in arhum company
                $sql = "SELECT * FROM agent WHERE cid=?;";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../inbox.php?error=stmtfailed");
                    exit();
                }
                mysqli_stmt_bind_param($stmt, "i", $tommy);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while($row = mysqli_fetch_assoc($result)){
                    $sql1 = "SELECT * FROM account WHERE email=?;";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql1)){
                        header("Location: ../inbox.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmt, "s", $row['email']);
                    mysqli_stmt_execute($stmt);
                    $result1 = mysqli_stmt_get_result($stmt);
                    $row1 = mysqli_fetch_assoc($result1);
                    echo "<p>".$row1['fname']." ".  $row1['lname'].": ". $row['email']. "</p>";
                }
            ?>
        </div>
    </div>

</body>
</html>

<?php
require "footer.php";
?>