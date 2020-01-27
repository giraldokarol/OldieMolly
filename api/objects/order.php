<?php
class Order{
    private $conn;
    private $table_name = 'heroku_1ace2ff26d7733b.order';

    public $idOrder;
    public $totalPrice;
    public $date;
    public $buyer;
    public $idCategory;
    public $User_idUser;
    public $Product_idProduct;
    public $nameProd;

    public function __construct($db){
        $this->conn = $db;
    }

    function create(){
        $query = "INSERT INTO 
                " . $this->table_name . " SET totalPrice=:totalPrice, date=CURRENT_TIMESTAMP(),
                User_idUser=:User_idUser, Product_idProduct=:Product_idProduct, buyer=:buyer, 
                idCategory=:idCategory, nameProd=:nameProd";
        $stmt = $this->conn->prepare($query);
        $this->totalPrice=htmlspecialchars(strip_tags($this->totalPrice));
        $this->User_idUser=htmlspecialchars(strip_tags($this->User_idUser));
        $this->Product_idProduct=htmlspecialchars(strip_tags($this->Product_idProduct));
        $this->buyer=htmlspecialchars(strip_tags($this->buyer));
        $this->nameProd=htmlspecialchars(strip_tags($this->nameProd));

        $stmt->bindParam(":totalPrice", $this->totalPrice);
        $stmt->bindParam(":User_idUser" , $this->User_idUser);
        $stmt->bindParam(":Product_idProduct", $this->Product_idProduct);
        $stmt->bindParam(":buyer", $this->buyer);
        $stmt->bindParam(":idCategory", $this->idCategory);
        $stmt->bindParam(":nameProd", $this->nameProd);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function delete(){
        $query="DELETE FROM " . $this->table_name . " WHERE idOrder=?";
        $stmt=$this->conn->prepare($query);
        $this->idOrder=htmlspecialchars(strip_tags($this->idOrder));
        $stmt->bindParam(1, $this->idOrder);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
    
}
?>