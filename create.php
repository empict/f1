<?php
include "classes/dbhandler.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) 
{
   
    $naam = $_POST['naam'];
    $points = $_POST['points'];
    $position = $_POST['position'];

    $dbHandler = new dbHandler();
    
    if ($dbHandler->insertDriver($naam, $points, $position)) 
    {
    header("Location: index.php");
    exit; 
    } else 
    {
    echo "Er is een fout opgetreden bij het toevoegen van de bestuurder.";
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
    <title class="driver">Create New Driver</title>
</head>
<body>
    
    <?php include "header.php"; ?>
    
<div class="container">
    <div class="background">
    <br>
        <a href="index.php" class="back-button">&#8249;</a>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="naam">Naam:</label>
            <input type="text" id="naam" name="naam" required><br><br>
            
            <label for="points">Points:</label>
            <input type="number" id="points" name="points" required><br><br>
            
            <label for="position">Position:</label>
            <input type="number" id="position" name="position" required><br><br>

            <button type="submit" name="submit">Create Driver</button>
        </form>
       
    </div>
</div>
    <?php include "footer.php"?>
</body>
</html>