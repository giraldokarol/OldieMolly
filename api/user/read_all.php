<?php
     header("Access-Control-Allow-Origin: *");
     header("Content-Type: application/json; charset=UTF-8");

     include_once '../config/database.php';
     include_once '../objects/user.php';

     $database = new Database();
     $db = $database->getConnection();

     $user = new User($db);

     $stmt = $user->read();
     $num = $stmt->rowCount();

     if($num>0){
         $users_array=array();
         while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
             extract($row);
             $user_item=array(
                 "id" => $id,
                 "email" => $email,
                 "userName" => $userName,
                 "userLastname" => $userLastname,
                 "address" => $address
             );

             array_push($users_array, $user_item);
         }
         http_response_code(200);
         echo json_encode($users_array);
     } else{
         json_encode(404);
         echo json_encode(array("message" => "No users"));
     }
?>