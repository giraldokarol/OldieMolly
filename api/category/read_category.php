<?php
     header("Access-Control-Allow-Origin: *");
     header("Access-Control-Allow-Headers: access");
     header("Access-Control-Allow-Methods: GET");
     header("Access-Control-Allow-Credentials: true");
     header('Content-Type: application/json');

     include_once '../config/database.php';
     include_once '../objects/category.php';

     $database= new Database();
     $db = $database->getConnection();

     $category= new Category($db);
     $category->id = isset($_GET['id'])? $_GET['id'] :die();
     $category->readCategory();

     if($category->nameCategory != null){
         $category_name = array(
             "nameCategory" => $category->nameCategory
         );
         http_response_code(200);
         echo json_encode($category_name);
     } else{
         http_response_code(404);
         echo json_encode(array("message" => "Category doesn't exists."));
     }
?>