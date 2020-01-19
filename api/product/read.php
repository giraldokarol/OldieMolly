<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");


    include_once '../config/database.php';
    include_once '../objects/product.php';
    

    $database = new Database();
    $db = $database->getConnection();
    
    $product = new Product($db);
    
    $stmt = $product->read();
    $num = $stmt->rowCount();
    
    if($num>0){
        $products_arr=array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $product_item=array(
                "idProduct" => $idProduct,
                "prodName" => $prodName,
                "price" => $price,
                "quantity" => $quantity,
                "type" => $type,
                "description"=> $description,
                "image" => $image,
                "image2" => $image2,
                "image3" => $image3,
                "Category_idCategory" => $Category_idCategory,
                "User_idUser" => $User_idUser
            );
    
            array_push($products_arr, $product_item);
        }
    
        // 200 OK
        http_response_code(200);
        echo json_encode($products_arr);
    }else{
        // 404 Not found
        http_response_code(404);
        echo json_encode(
            array("message" => "No products found.")
        );
    }
 

?>