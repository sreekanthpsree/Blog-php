<?php
require_once __DIR__ . "\config.php";
class Database
{
    private $host = DB_HOST;
    private $username = DB_USER;
    private $password = DB_PASSWORD;
    private $dbName = DB_NAME;

    private $connection;
    private $errors;
    private $stmt;
    private $dbConnected = false;
    function __construct()
    {
        $dns = "mysql:host=$this->host;dbname=$this->dbName";
        try {
            $this->connection = new PDO($dns, $this->username, $this->password);
            $this->dbConnected = true;
        } catch (Exception $error) {
            $this->errors = $error->getMessage();
            $this->dbConnected = false;
            error_log($this->errors, 3, 'error.log'); // Log the error message to a file
            die();
        }
    }

    function getError()
    {
        return $this->errors;
    }
    function isConnected()
    {
        return $this->dbConnected;
    }
    function connected()
    {
        if ($this->dbConnected) {
            echo "Connected ";
        } else {
            echo "Not connected";
        }
    }
    function query($query)
    {
        $this->stmt = $this->connection->prepare($query);

    }
    function query1($query)
    {
        return $this->stmt = $this->connection->prepare($query);

    }
    function execute()
    {
        return $this->stmt->execute();
    }
    function results()
    {
        $this->execute();
        return $this->stmt->fetchAll();
    }
    function single()
    {
        $this->stmt->execute();
        return $this->stmt->fetch();
    }
    function rowCount()
    {
        return $this->stmt->rowCount();
    }
    function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
}


?>