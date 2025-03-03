<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');

    include_once '../config/database.php';
    include_once '../objects/product.php';

    $database = new Database();
    $db = $database->getConnection();

    $product = new Product($db);

    $product->id = isset($_GET['id']) ? $_GET['id'] : die();

    $product->readOne();

    if($product->prodName!=null){
        //Creation array
        $product_arr = array(
            "id" => $product->id,
            "prodName" => $product->prodName,
            "price" => $product->price,
            "quantity" => $product->quantity,
            "type" => $product->type,
            "description"=> $product->description,
            "image" => $product->image,
            "image2" => $product->image2,
            "image3" => $product->image3,
            "idCategory" => $product->idCategory,
            "idUser" => $product->idUser
        );
        //Bonne reponse OK
        http_response_code(200);

        //Convertir en json form
        echo json_encode($product_arr);
    } else{
        //Mauvaise reponse - NOT FOUND
        http_response_code(404);

        //Reponse not found
        echo json_encode(array("message" => "Product doesnt exist"));
    }
?>