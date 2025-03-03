<?php
class Category{
    private $conn;
    private $table_name = "category";
 
    //Objet propietes. Category
    public $id;
    public $nameCategory;

    //Consctructor Base de donnees.
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        $query= "SELECT * FROM " . $this->table_name;
        $stmt= $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function readOne(){
        $query = "SELECT * FROM category AS c INNER JOIN product AS p ON c.id = p.idCategory AND c.id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        return $stmt;      
    }

    function readCategory(){
        $query = "SELECT * FROM " . $this->table_name . " AS c WHERE c.id=?";
        $stmt=$this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row= $stmt->fetch(PDO::FETCH_ASSOC);

        $this->nameCategory=$row['nameCategory'];
    }
}
?>