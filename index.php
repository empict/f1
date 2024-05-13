<?php
include "classes/dbhandler.php";


$dbHandler = new dbHandler();

// Controleer of het formulier voor het verwijderen van de bestuurder is verzonden
if(isset($_POST['deleteDriver'])) {
    // Haal de ID van de te verwijderen bestuurder op uit het formulier
    $idToDelete = $_POST['id'];

    // Roep de deleteDriver-functie aan met de ID van de te verwijderen bestuurder
    $success = $dbHandler->deleteDriver($idToDelete);

    // Controleer of het verwijderen van de bestuurder succesvol was
    if($success) {
        // Geef een succesbericht weer of voer andere acties uit
        echo "Weg is weg";
    } else {
        // Geef een foutbericht weer of voer andere foutafhandeling uit
        echo "Failed to delete driver.";
    }
}

if(isset($_POST['updateDriver'])) {
    $id = $_POST['id'];
    $naam = $_POST['naam'];
    $points = $_POST['points'];
    $position = $_POST['position'];
    
    // Voer hier de updatequery uit om de bestuurdergegevens bij te werken
    // Gebruik bijvoorbeeld PDO of MySQLi om de databasequery veilig uit te voeren

    // Voorbeeld met PDO
    try {
        $pdo = new PDO($dataSource, $username, $password);
        $statement = $pdo->prepare("UPDATE drivers SET Naam = :naam, Points = :points, Position = :position WHERE ID = :id");
        $statement->execute(array(':naam' => $naam, ':points' => $points, ':position' => $position, ':id' => $id));
        // Redirect naar index.php na de update
        header("Location: index.php");
        exit(); // Stop het script na de redirect
    } catch (PDOException $exception) {
        // Foutafhandeling
        echo "Update failed: " . $exception->getMessage();
    }

    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Formule 1</title>
</head>
<body>
    
    <?php include "header.php"?>
    <div class="container">
        <div class="background">
        <div class="hg">
        <div class="tenor-gif-embed" data-postid="16890874512241116786" data-share-method="host" data-aspect-ratio="1.83088" data-width="100%"><a href="https://tenor.com/view/richard-attenborough-whip-whipped-whiplash-whiplashed-gif-16890874512241116786">Richard Attenborough Whip GIF</a>from <a href="https://tenor.com/search/richard+attenborough-gifs">Richard Attenborough GIFs</a></div> <script type="text/javascript" async src="https://tenor.com/embed.js"></script>
        </div>
   
    <table class="tabel">
        <tr>
            <th>ID</th>
            <th>Naam</th>
            <th>Points</th>
            <th>Position</th>
        </tr>
   
                <?php
                // Haal de bestuurdersgegevens op uit de database
                $dbHandler = new dbHandler();
                $drivers = $dbHandler->selectDrivers();

                // Loop door elke bestuurder en voeg een rij toe aan de tabel
                foreach ($drivers as $driver) 
                {
                    echo "<tr>";
                    echo "<td>" . $driver['ID'] . "</td>";
                    echo "<td>" . $driver['Naam'] . "</td>";
                    echo "<td>" . $driver['Points'] . "</td>";
                    echo "<td>" . $driver['Position'] . "</td>";
                ?>
                    <td>
                    <form method="POST" action="index.php">
                        <input type="hidden" name="id" value="<?php echo $driver['ID']; ?>" />
                        <button class="verwijder" type="submit" name="deleteDriver">Delete</button>
                    </form>
                    </td>
                    <?php

                    echo "<td>
                              <form method='POST' action='update.php'>
                                    <input type='hidden' name='id' value='" . $driver['ID'] . "' />
                                    <button type='submit' name='update'>Update</button>
                              </form>
                          </td>";
                    echo "</tr>";
                }
                ?>

        <th>
            <a href="create.php" class="create">Create new driver</a>
        </th>

    </table>
    
    </div>
</div>
<?php include "footer.php"?>

</body>
</html>