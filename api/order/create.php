<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With");

    include_once '../config/database.php';
    include_once '../objects/order.php';

    $database = new Database();
    $db = $database->getConnection();

    $order = new Order($db);
    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->totalPrice) && !empty($data->User_idUser) && !empty($data->Product_idProduct) && !empty($data->buyer)){

        $order->totalPrice = $data->totalPrice;
        $order->User_idUser = $data->User_idUser;
        $order->Product_idProduct = $data->Product_idProduct;
        $order->buyer = $data->buyer;

        if($order->create()){
            http_response_code(201);
            echo json_encode(array("message"=>"Order Created"));
        } else{
            http_response_code(503);
            echo json_encode(array("message" => "Order doesn't created"));
        }
    } else{
        http_response_code(400);
        echo json_encode(array("message" => "Problem with creation, Data incomplet"));

    }
?>