<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header("Content-Type: application/json");

    include_once '../config/database.php';
    include_once '../objects/user.php';
    include_once '../objects/product.php';

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $product = new Product($db);
    $user->id = isset($_GET['id'])? $_GET['id'] :die();

    $stmt= $user->readOne();
    $num = $stmt->rowCount();

    if($num>0){
        $arr = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $products_user =array(
                "id" => $id,
                "prodName" => $prodName,
                "price" => $price,
                "quantity" => $quantity,
                "type" => $type,
                "description"=> $description,
                "image" => $image,
                "image2" => $image2,
                "image3" => $image3,
                "idCategory" => $idCategory,
                "idUser" => $idUser,
                "userName" => $userName,
                "email" => $email
            );
            array_push($arr, $products_user);
        }
        http_response_code(200);
        echo json_encode($arr);
    } else{
        http_response_code(404);
        echo json_encode(array("message" => "This user doesn't have products"));
    }
?>