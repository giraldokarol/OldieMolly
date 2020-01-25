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

 $user = new User($db);
 $user->email = isset($_GET['email']) ? $_GET['email'] : die();
 $user->emailExists();

 if($user->email!=null){
     $user_array=array(
         "email" =>$user->email,
         "userName" =>$user->userName,
         "password" => $user->password,
         "userLastname" => $user->userLastname,
         "address" =>$user->address
     );
     http_response_code(200);
     echo json_encode($user_array);
 }else{
     http_response_code(404);
     echo json_encode(array("message" => "User doesn't exists."));
 }

?>