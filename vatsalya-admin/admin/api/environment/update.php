<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();



 
// get id of env to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of env to be edited
// $id = $data->id;
 
// set env property values
    $contact_email_id = $data->contact_email_id;
    $appointment_email_id = $data->appointment_email_id;
    $youtube_api = $data->youtube_api;
    
// update the env
$update_status  = update($db, $contact_email_id, $appointment_email_id, $youtube_api );
if($update_status==1 || $update_status==0){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    if($update_status==1) echo json_encode(array("message" => "env is updated."));
    if($update_status==0) echo json_encode(array("message" => "No such env is found."));

}
 
// if unable to update the env, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update env."));
}

//-----------------------------------------------------------------------
    // update env
    function update($conn,  $contact_email_id, $appointment_email_id, $youtube_api){
        $table_name = "environment";
        // update query
        $query = "UPDATE " . $table_name . "                
                SET
                contact_email_id=:contact_email_id, appointment_email_id=:appointment_email_id, youtube_api=:youtube_api
                WHERE    id = 1";
     
        // prepare query statement
        $stmt = $conn->prepare($query);   
      
    
        // bind values
        //$stmt->bindParam(":id", "1");
        $stmt->bindParam(":contact_email_id", $contact_email_id);
        $stmt->bindParam(":appointment_email_id", $appointment_email_id);
        $stmt->bindParam(":youtube_api", $youtube_api);
        
        // execute the query
        if($stmt->execute()){
            $affected_rows = $stmt->rowCount();
            if($affected_rows>0) return 1; // updated successfully
            return 0; // executed but not updated
        }
     
        return -1; // didn't execute
    }

//------------------------------------------------------------------------------
?>