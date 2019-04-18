<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../model/cover.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare cover object
$cover = new Cover($db);
 
// get id of cover to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of cover to be edited
$cover->id = $data->id;
 

// set cover property values
    $cover->image_name = $data->image_name;
    $cover->image_url = $data->image_url;
    

// update the cover
$update_status  = $cover->update();
if($update_status==1 || $update_status==0){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    if($update_status==1) echo json_encode(array("message" => "cover is updated."));
    if($update_status==0) echo json_encode(array("message" => "No such cover is found."));

}
 
// if unable to update the cover, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update cover."));
}
?>