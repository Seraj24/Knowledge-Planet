<?php
class CreateData {
    private $connection = null;
    private $database = null;

    public function __construct(Database $database) {
        $this->database = $database;
        $this->connection = $this->database->connectToMySQL("localhost", "root", "");

        if ($this->connection) {
            $this->createDatabase();
            $this->createTables();
        } else {
            die("Connection Failed");
        }
        $this->database->closeMySql();
    }

    public function createDatabase() {
        $sql ="CREATE DATABASE IF NOT EXISTS php_game";
        try {
            $this->database->executeQuery($sql);
        } catch (Exception $e) {
            die("Error creating database: " . $e->getMessage());
        }
    }

    public function createTables() {
        $this->database->selectDatabase("php_game");
        $txtFile = file_get_contents('db/tables.txt');
    
        $sql = $txtFile;
        try {
            $this->database->executeMultiQuery($sql);
        } catch (Exception $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }
}

class Database {
    private $connection;

    public function connectToMySQL($hostName, $userName, $passWord){
        //Attempt to connect to MySQL using MySQLi
        $this->connection = new mysqli($hostName, $userName, $passWord);
        //If connection to MySQL failed, throw an exception
        if ($this->connection->connect_error){
            throw new Exception("Connection to MySQL failed! " . $this->connection->connect_error);
        }
        return true;
    }

    public function selectDatabase($dbName){
        //Attempt to connect to the database 
        $select = mysqli_select_db($this->connection, $dbName);
        //If selection of the database failed, throw an exception
        if ($select === FALSE){
            throw new Exception("Selection of the database $dbName failed! " . mysqli_connect_error());
        }
    }

    public function executeQuery($sqlCode){
        //Attempt do execute a query
        $execute =  $this->connection->query($sqlCode);
        //If execution of the query failed, throw an exception
        if ($execute === FALSE) {
            throw new Exception("Execution of the SQL query [$sqlCode] failed! " .  $this->connection->error);
        }
        return $execute; // Return the result of the query execution
    }
    
    function executeMultiQuery($sqlcode)
    {
        //Attempt to execute the query
        $invokeQuery =  $this->connection->multi_query($sqlcode);
        //If query execution failed save the system error message  
        if ($invokeQuery === FALSE) {
            throw new Exception("Multi query execution failed! " .  $this->connection->error);
        }
        return $invokeQuery;
    } 

    public function closeMySQL(){
        if (isset( $this->connection)) { 
            $this->connection->close();
        }
    }
}

?>
