<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../model/publication.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare publication object
$publication = new Publication($db);
 
// get id of publication to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of publication to be edited
$publication->id = $data->id;
 

// set publication property values
    $publication->publication_name = $data->publication_name;
    $publication->publication_url = $data->publication_url;
    

// update the publication
$update_status  = $publication->update();
if($update_status==1 || $update_status==0){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    if($update_status==1) echo json_encode(array("message" => "publication is updated."));
    if($update_status==0) echo json_encode(array("message" => "No such publication is found."));

}
 
// if unable to update the publication, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update publication."));
}
?>