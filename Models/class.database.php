<?php
require_once './Includes/config.php';
class Database
{
    private $conn;
    public function connect()
    {
        try{
            $this->conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER , DB_PASSWORD,array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
              ));
            return $this->conn;
        }catch(PDOException $ex)
        {
            die("Connection failed: " . $ex->getMessage());
        }
    }
    function closeConnection()
    {
        $status = $this->conn->getAttribute(PDO::ATTR_CONNECTION_STATUS);
        if($status)
        {
            $this->conn = NULL;
        }
    }
}


?>