<?php
    class User{
        private $conn;
        private $table_name = "user";

        public $idUser;
        public $email;
        public $userName;
        public $password;
        public $userLastname;
        public $address;

        public function __construct($db){
            $this->conn=$db;
        }

        function create(){
            $query = "INSERT INTO " . $this->table_name . "
            SET
                email = :email,
                userName = :userName,
                password = :password,
                userLastname = :userLastname,
                address = :address";
            $stmt = $this->conn->prepare($query);

            $stmt->email=htmlspecialchars(strip_tags($this->email));
            $stmt->userName=htmlspecialchars(strip_tags($this->userName));
            $stmt->password=htmlspecialchars(strip_tags($this->password));
            $stmt->userLastname=htmlspecialchars(strip_tags($this->userLastname));
            $stmt->address=htmlspecialchars(strip_tags($this->address));

            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':userName', $this->userName);
            $stmt->bindParam(':userLastname', $this->userLastname);
            $stmt->bindParam(':address', $this->address);

            //Hash mot de passe avant de sauvergarder dans la bdd
            $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
            $stmt->bindParam(':password', $password_hash);

            if($stmt->execute()){
                return true;
            }
            return false;
        }

        function emailExists(){
            $query = "SELECT * FROM " . $this->table_name . " WHERE email=?";
            $stmt = $this->conn->prepare($query);
            $stmt->email=htmlspecialchars(strip_tags($this->email));
            $stmt->bindParam(1, $this->email);
            $stmt->execute();
            $num=$stmt->rowCount();

            if($num>0){
                $row=$stmt->fetch(PDO::FETCH_ASSOC);
                $this->idUser = $row['idUser'];
                $this->userName = $row['userName'];
                $this->password = $row['password'];
                $this->userLastname = $row['userLastname'];
                $this->address = $row['address'];

                return true;
            }
            return false;
        }

        function readOne(){
            $query = "SELECT * FROM user AS u INNER JOIN product AS p ON u.idUser=p.User_idUser AND u.idUser=?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->idUser);
            $stmt->execute();
            return $stmt;
        }

        function readOrder(){
            $query = "SELECT * FROM user AS u INNER JOIN `order` AS o INNER JOIN product AS p
            ON u.idUser=o.User_idUser AND o.Product_idProduct=p.idProduct AND u.email=?";
            $stmt= $this->conn->prepare($query);
            $stmt->email=htmlspecialchars(strip_tags($this->email));
            $stmt->bindParam(1, $this->email);
            $stmt->execute();
            return $stmt;
        }

        function read(){
            $query ="SELECT * FROM " . $this->table_name;
            $stmt=$this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }



    }
?>