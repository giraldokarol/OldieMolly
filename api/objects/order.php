<?php
class Order{
    private $conn;
    private $table_name = 'Orders';

    public $id;
    public $totalPrice;
    public $date;
    public $buyer;
    public $idCategory;
    public $idUser;
    public $idProduct;
    public $prodName;

    public function __construct($db){
        $this->conn = $db;
    }

    function create(){
        $query = "INSERT INTO 
                " . $this->table_name . " SET 
                totalPrice=:totalPrice, 
                date=CURRENT_TIMESTAMP(),
                buyer=:buyer, 
                prodName=:prodName,
                idCategory=:idCategory,
                idUser=:idUser, 
                idProduct=:idProduct";

        $stmt = $this->conn->prepare($query);
        $this->totalPrice=htmlspecialchars(strip_tags($this->totalPrice));
        $this->idUser=htmlspecialchars(strip_tags($this->idUser));
        $this->idProduct=htmlspecialchars(strip_tags($this->idProduct));
        $this->buyer=htmlspecialchars(strip_tags($this->buyer));
        $this->prodName=htmlspecialchars(strip_tags($this->prodName));

        $stmt->bindParam(":totalPrice", $this->totalPrice);
        $stmt->bindParam(":idUser" , $this->idUser);
        $stmt->bindParam(":idProduct", $this->idProduct);
        $stmt->bindParam(":buyer", $this->buyer);
        $stmt->bindParam(":idCategory", $this->idCategory);
        $stmt->bindParam(":prodName", $this->prodName);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function delete(){
        $query="DELETE FROM " . $this->table_name . " WHERE id=?";
        $stmt=$this->conn->prepare($query);
        $this->id=htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function readBuyer(){
        $query="SELECT * FROM " .$this->table_name. " AS o WHERE o.buyer=?";
        $stmt= $this->conn->prepare($query);
        $stmt->buyer=htmlspecialchars(strip_tags($this->buyer));
        $stmt->bindParam(1, $this->buyer);
        $stmt->execute();
        return $stmt;
    }
    
}
?>