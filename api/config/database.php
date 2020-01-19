<?php
class Database{
 
    // specify your own database credentials
    private $host = "eu-cdbr-west-02.cleardb.net"; //"localhost"
    private $db_name = "heroku_1ace2ff26d7733b"; // "baby_store" localhost
    private $username = "b85f4b12d27bbe"; // "root" localhost
    private $password = "27520628"; // "" localhost
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>