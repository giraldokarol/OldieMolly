<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, Access-Control-Allow-Headers");

	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        http_response_code(200); 
        exit();
    }

    include_once '../config/database.php';
    include_once '../objects/user.php';

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);

    $data = json_decode(file_get_contents("php://input"));
    
    $user->email = $data->email;
    $email_exists = $user->emailExists();

    //Differents libs pour l'utilisation de Json web token
    include_once '../config/core.php';
    include_once '../libs/php-jwt-master/src/BeforeValidException.php';
    include_once '../libs/php-jwt-master/src/ExpiredException.php';
    include_once '../libs/php-jwt-master/src/SignatureInvalidException.php';
    include_once '../libs/php-jwt-master/src/JWT.php';
    use \Firebase\JWT\JWT;

    if($email_exists) {
    	$passwordIngresado = trim($data->password);
    	$passwordHash = trim($user->password);
    	    	
    	if(password_verify($passwordIngresado, $passwordHash)){
    		$token = array(
            		"iss" => $iss,
            		"aud" => $aud,
            		"iat" => $iat,
            		"nbf" => $nbf,
            		"data" => array(
                		"id" => $user->id,
                		"email" => $user->email,
                		"userName" => $user->userName,
                		"userLastname" => $user->userLastname,
                		"address" => $user->address
            		)
        	);
        	http_response_code(200);

        	//Creation de jwt
        	$jwt = JWT::encode($token, $key);
        	echo json_encode(
            		array(
                		"message" => "Succefull login",
                		"jwt" => $jwt
            		)
        	);
    	}else{
    	  echo "Password no coincide";
    	}
    
    } else{
        http_response_code(401);
        echo json_encode(array("message" => "Login Failed"));
    }

?>