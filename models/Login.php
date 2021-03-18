<?php
require_once '../../jwt/constants.php';
require_once '../../jwt/jwt.php';
class Login{
    
    private $conn;
    private $table = 'users';

    public $email;
    public $password;

    public function __construct($db){
            $this->conn = $db;
    }
    public function getData(){
		try {
				$stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email AND password = :pass");
				$stmt->bindParam(":email", $this->email);
				$stmt->bindParam(":pass", $this->password);
				$stmt->execute();
				$user = $stmt->fetch(PDO::FETCH_ASSOC);
				if(!is_array($user)) {
					$this->returnResponse(INVALID_USER_PASS, "Email or Password is incorrect.");
				}

				if( $user['active'] == 0 ) {
					$this->returnResponse(USER_NOT_ACTIVE, "User is not activated. Please contact to admin.");
				}

				$paylod = [
					'iat' => time(),
					'iss' => 'localhost',
					'exp' => time() + (15*60),
					'userId' => $user['id']
				];

				$token = JWT::encode($paylod, SECRETE_KEY);
				
				$data = ['token' => $token];
				$this->returnResponse(SUCCESS_RESPONSE, $data);
			} catch (Exception $e) {
				$this->throwError(JWT_PROCESSING_ERROR, $e->getMessage());
			}
    }

    public function throwError($code, $message){
        header("content-type: application/json");
        $errorMsg = json_encode(['error' => ['status' => $code, 'message' => $message]]);
        echo $errorMsg; exit;
    }
    public function returnResponse($code, $data){
        header("content-type: application/json");
        $response = json_encode(['response' => ['status' => $code, 'result' => $data]]);
        echo $response; exit;
    }
}