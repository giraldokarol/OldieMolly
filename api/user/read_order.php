<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');

    include_once '../config/database.php';
    include_once '../objects/user.php';

    $database = new Database();
    $db = $database->getConnection();

    $user= new User($db);
    $user->email= isset($_GET['email']) ? $_GET['email']:die();
    $stmt= $user->readOrder();
    $num=$stmt->rowCount();

    if($num>0){
        $arr= array();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $user_order=array(
                "idOrder" => $idOrder,
                "userName" => $userName,
                "email" => $email,
                "totalPrice" => $totalPrice,
                "date" => $date,
                "Product_idProduct" => $Product_idProduct,
                "prodName" => $prodName,
                "idCategory" => $idCategory,
                "nameProd" => $nameProd,
                "buyer" => $buyer
            );
            array_push($arr, $user_order);
        }
        http_response_code(200);
        echo json_encode($arr);
    } else{
        http_response_code(404);
        echo json_encode(array("message" => "Order not found"));
    }
?>