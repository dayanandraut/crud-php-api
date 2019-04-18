<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';

$table_name = 'user_details';
$database = new Database();
$conn = $database->getConnection();
$data = json_decode(file_get_contents("php://input"));
$uid = $data->username;
$upas = $data->password;

if($uid!='' && $upas!=''){

    $query = "SELECT * FROM $table_name WHERE uname LIKE :uid AND upass LIKE :upas";    

    // prepare query statement
    $stmt = $conn->prepare($query);

// bind values
    $stmt->bindParam(":uid", $uid);
    $stmt->bindParam(":upas", $upas);

    $stmt->execute();
    $num = $stmt->rowCount();
    
    if($num>0){
 
        // set response code - 200 created
        http_response_code(200);
 
        // valid user
        echo json_encode(array("message" => "true"));
    }else{
        // set response code - 404 not found
        http_response_code(404);
 
        // valid user
        echo json_encode(array("message" => "false"));
    }

  }else{
      // set response code - 400 bad request
      http_response_code(400);
 
      // valid user
      echo json_encode(array("message" => "false"));
  }

?>