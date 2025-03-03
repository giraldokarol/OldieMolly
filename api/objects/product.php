<?php
class Product{
 
    // Basse de donnes connexion.
    private $conn;
    private $table_name = "product";

    

   //Objet propietes.
    public $id;
    public $prodName;
    public $price;
    public $quantity;
    public $type;
    public $description;
    public $image;
    public $image2;
    public $image3;
    public $idCategory;
    public $idUser;

   
 
    //Consctructor Base de donnees.
    public function __construct($db){
        $this->conn = $db;
    }


    /////////// Lire tous les produits
    function read(){
        $query = "SELECT * FROM " .$this->table_name;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }


    ///////// Create un produit
    function create(){
        $query = "INSERT INTO
                " . $this->table_name . " SET 
                prodName=:prodName, 
                price=:price, 
                quantity=:quantity, 
                type=:type, 
                description=:description, 
                image=:image, 
                image2=:image2, 
                image3=:image3, 
                idCategory=:idCategory, 
                idUser=:idUser";


        $stmt = $this->conn->prepare($query);
        $this->prodName=htmlspecialchars(strip_tags($this->prodName));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->quantity=htmlspecialchars(strip_tags($this->quantity));
        $this->type=htmlspecialchars(strip_tags($this->type));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->image=htmlspecialchars(strip_tags($this->image));
        $this->image2=htmlspecialchars(strip_tags($this->image2));
        $this->image3=htmlspecialchars(strip_tags($this->image3));
        $this->idCategory=htmlspecialchars(strip_tags($this->idCategory));
        $this->idUser=htmlspecialchars(strip_tags($this->idUser));

        $stmt->bindParam(":prodName", $this->prodName);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":image2", $this->image2);
        $stmt->bindParam(":image3", $this->image3);
        $stmt->bindParam(":idCategory", $this->idCategory);
        $stmt->bindParam(":idUser", $this->idUser);

        if($stmt->execute()){
            return true;
        }

        return false;
    }


    //////Lire un seul produit
    function readOne(){
        $query = "SELECT * FROM " . $this->table_name . " AS p WHERE p.id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->prodName = $row['prodName'];
        $this->price = $row['price'];
        $this->quantity = $row['quantity'];
        $this->type = $row['type'];
        $this->description = $row['description'];
        $this->image = $row['image'];
        $this->image2 = $row['image2'];
        $this->image3 = $row['image3'];
        $this->Category_idCategory = $row['idCategory'];
        $this->User_idUser = $row['idUser'];

    }


    //Eliminer un produit
    function delete(){ 
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        // Pouvoir utiliser id avec characters specials
        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

}
?>