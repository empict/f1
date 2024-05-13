<?php
final class dbHandler
{
    private $pdo;
    private $dataSource = "mysql:dbname=f2;host=localhost";
    private $username = "root";
    private $password = "";

    public function selectDrivers()
    {
        try 
        { 
            $pdo = new PDO($this->dataSource, $this->username, $this->password);
            $statement = $pdo->prepare("SELECT * FROM drivers;");
            $statement->execute();
            return $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $exception) 
        {
            return false;
        }
    }

    public function insertDriver($naam, $points, $position)
    {
        try 
        { 
            $pdo = new PDO($this->dataSource, $this->username, $this->password);
            $statement = $pdo->prepare("INSERT INTO drivers (Naam, Points, Position) VALUES (:naam, :points, :position)");
            $statement->execute(array(':naam' => $naam, ':points' => $points, ':position' => $position));
            return true;
        }
        catch (PDOException $exception) 
        {
            return false;
        }
    }

    public function deleteDriver($id) 
    {
        try 
        {
            $pdo = new PDO($this->dataSource, $this->username, $this->password);
            $statement = $pdo->prepare("DELETE FROM drivers WHERE ID = :id");
            $statement->execute(array(':id' => $id));
            return true;
        } catch (PDOException $exception) 
        {
            return false;
        }
    }
    
    
    
    public function updateDriver($id, $naam, $points, $position) 
    {
        try 
        {
            $pdo = new PDO($this->dataSource, $this->username, $this->password);
            $statement = $pdo->prepare("UPDATE drivers SET Naam = :naam, Points = :points, Position = :position WHERE ID = :id");
            $statement->execute(array(':naam' => $naam, ':points' => $points, ':position' => $position, ':id' => $id));
            return true;
        } 
        catch (PDOException $exception) 
        {
            return false;
        }
    }

    public function getDriverById($id) 
    {
        try 
        {
            $pdo = new PDO($this->dataSource, $this->username, $this->password);
            $statement = $pdo->prepare("SELECT * FROM drivers WHERE ID = :id");
            $statement->execute(array(':id' => $id));
            return $statement->fetch(PDO::FETCH_ASSOC);
        } 
        catch (PDOException $exception) 
        {
        return false;
        }
    }


    
}
?>