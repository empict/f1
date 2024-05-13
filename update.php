<?php
include "classes/dbhandler.php";

$dbHandler = new dbHandler();

if(isset($_POST['id'])) 
{
    $id = $_POST['id'];
    $driver = $dbHandler->getDriverById($id);

    if($driver) 
    {
        $naam = $driver['Naam'];
        $points = $driver['Points'];
        $position = $driver['Position'];
    } else 
    {
        echo "Driver not found.";
        exit(); 
    }
} else 
{
    echo "No driver ID provided.";
    exit(); 
}

if(isset($_POST['updateDriver'])) 
{
    $id = $_POST['id'];
    $naam = $_POST['naam'];
    $points = $_POST['points'];
    $position = $_POST['position'];
    
    $updateSuccess = $dbHandler->updateDriver($id, $naam, $points, $position);
    

    if($updateSuccess) {
        header("Location: index.php");
        exit();
    } else {
        echo "Update failed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/createStyle.css">
    <title>Update Driver</title>
</head>
<body>
    
    <?php include "header.php"; ?>
    <div class="container">
        <div class="background">
            <br>
            <a href="index.php" class="back-button">&#8249;</a>


            
            <form method="POST" action="update.php">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <label for="naam">Naam:</label>
                <input type="text" id="naam" name="naam" value="<?php echo $naam; ?>" required><br><br>
                <label for="points">Points:</label>
                <input type="number" id="points" name="points" value="<?php echo $points; ?>" required><br><br>
                <label for="position">Position:</label>
                <input type="number" id="position" name="position" value="<?php echo $position; ?>" required><br><br>
                <button class="update" type="submit" name="updateDriver">Update Driver</button>
            </form>

        </div>
    </div>

    <?php include "footer.php"?>
</body>
</html>
