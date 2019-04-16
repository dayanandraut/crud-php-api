<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../model/gallery.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare gallery object
$gallery = new Gallery($db);
 
// get id of gallery to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of gallery to be edited
$gallery->id = $data->id;
 

// set gallery property values
    $gallery->image_name = $data->image_name;
    $gallery->image_url = $data->image_url;
    

// update the gallery
$update_status  = $gallery->update();
if($update_status==1 || $update_status==0){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    if($update_status==1) echo json_encode(array("message" => "gallery is updated."));
    if($update_status==0) echo json_encode(array("message" => "No such gallery is found."));

}
 
// if unable to update the gallery, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update gallery."));
}
?>