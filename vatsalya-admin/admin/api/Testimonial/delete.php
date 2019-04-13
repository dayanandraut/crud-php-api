<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and model file
include_once '../config/database.php';
include_once '../model/testimonial.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare testimonial object
$testimonial = new Testimonial($db);
 
// get testimonial id
$data = json_decode(file_get_contents("php://input"));
 
// set testimonial id to be deleted
$testimonial->id = $data->id;
 
// delete the testimonial
$rows_affected  = $testimonial->delete();
if($rows_affected==1|| $rows_affected==0){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    if($rows_affected==1)   echo json_encode(array("message" => "testimonial is deleted."));
    if($rows_affected==0)   echo json_encode(array("message" => "No such testimonial is found."));
}

 
// if unable to delete the testimonial
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to delete testimonial."));
}
?>