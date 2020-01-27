<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../objects/order.php';

    $database = new Database();
    $db = $database->getConnection();

    $order= new Order($db);

    $order->buyer= isset($_GET['buyer']) ? $_GET['buyer']:die();
    $stmt= $order->readBuyer();
    $num=$stmt->rowCount();

    if($num>0){
        $arr= array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $buyer_order=array(
                "idOrder" => $idOrder,
                "totalPrice" => $totalPrice,
                "date" => $date,
                "Product_idProduct" => $Product_idProduct,
                "idCategory" => $idCategory,
                "nameProd" => $nameProd,
                "buyer" => $buyer
            );
            array_push($arr, $buyer_order);
        }
        http_response_code(200);
        echo json_encode($arr);   
    }else{
        http_response_code(404);
        echo json_encode(array("message" => "Order not found"));
    }
?>