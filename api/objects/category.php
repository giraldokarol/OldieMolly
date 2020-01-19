<?php
class Category{
    private $conn;
    private $table_name = "category";
 
    //Objet propietes. Category
    public $idCategory;
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
        $query = "SELECT * FROM category AS c INNER JOIN product AS p ON c.idCategory = p.Category_idCategory AND c.idCategory = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->idCategory);
        $stmt->execute();
        return $stmt;      
    }
}
?>