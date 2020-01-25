<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../objects/user.php';

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $data = json_decode(file_get_contents("php://input"));
   

    if(!empty($data->email) && !empty($data->userName) && !empty($data->password)
        && !empty($data->userLastname) && !empty($data->address)){
            $user->email = $data->email;
            $user->userName = $data->userName;
            $user->password = $data->password;
            $user->userLastname = $data->userLastname;
            $user->address = $data->address;

            if($user->create()){
                http_response_code(200);
                echo json_encode(array("message" => "User created"));
            }else{
                http_response_code(503);
                echo json_encode(array("message" => "User NOT created"));
            }
        } else{
            http_response_code(400);
            echo json_encode(array("message" => "Can't create user"));
        }
?>