<?php

class Database{

    /* !CHANGE CONNECTION DATA HERE! */
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "magebit_task";
    public $conn;
    

    public function getConnection()
    {
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=$this->hostname;dbname=$this->database", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
        return $this->conn;
    }

    public function createDatabaseAndTable()
    {
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=$this->hostname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "CREATE DATABASE $this->database";          
            $this->conn->exec($sql);                              // create the database
            echo "Database created successfully<br>";

            $sql = "use $this->database";                      
            $this->conn->exec($sql);                              // use the database

            $sql = "CREATE TABLE subscriptions(                             
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(50) NOT NULL,
                date TIMESTAMP)";
            $this->conn->exec($sql);                              // create subscriptions table
            echo "Subscriptions table created successfully<br>";

        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }
}


?>