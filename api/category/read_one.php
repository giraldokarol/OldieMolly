<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');

    include_once '../config/database.php';
    include_once '../objects/category.php';
    include_once '../objects/product.php';
 

    $database = new Database();
    $db = $database->getConnection();

    $category = new Category($db);
    $product = new Product($db);

    $category->idCategory = isset($_GET['idCategory']) ? $_GET['idCategory'] : die();
   

    $stmt = $category->readOne();
    $num = $stmt->rowCount();

    if($num>0){
        $arr = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $products_arr=array(
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
                "User_idUser" => $User_idUser,
                "nameCategory" => $nameCategory
            );
            array_push($arr, $products_arr);   
        }

        //Bonne reponse OK
        http_response_code(200);
        //Convertir en json form
        echo json_encode($arr);
    } else{
        //Mauvaise reponse - NOT FOUND
        http_response_code(404);
        //Reponse not found
        echo json_encode(array("message" => "Categorie doesnt exists."));
    }


?>