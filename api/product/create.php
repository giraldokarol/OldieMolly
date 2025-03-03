<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    // get database connection
    include_once '../config/database.php';
 
    // instantiate product object
    include_once '../objects/product.php';

    $database = new Database();
    $db = $database->getConnection();
 
    $product = new Product($db);
    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->prodName) && !empty($data->price) && !empty($data->quantity) &&
        !empty($data->type) && !empty($data->description) && !empty($data->image) &&
        !empty($data->image2) && !empty($data->image3) && !empty($data->idCategory) &&
        !empty($data->idUser)){
     
        // set product property values
        $product->prodName = $data->prodName;
        $product->price = $data->price;
        $product->quantity = $data->quantity;
        $product->type = $data->type;
        $product->description = $data->description;
        $product->image = $data->image;
        $product->image2 = $data->image2;
        $product->image3 = $data->image3;
        $product->idCategory = $data->idCategory;
        $product->idUser = $data->idUser;

        if($product->create()){
            http_response_code(201);
            echo json_encode(array("message" => "Product was created."));
        } else{
            http_response_code(503);
            echo json_encode(array("message" => "Unable to create product."));
        }
    }else{
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
    }


?>