<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../model/testimonial.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare testimonial object
$testimonial = new Testimonial($db);
 
// get id of testimonial to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of testimonial to be edited
$testimonial->id = $data->id;
 

// set testimonial property values
    $testimonial->provider_name = $data->provider_name;
    $testimonial->testimonials = $data->testimonials;
    

// update the testimonial
$update_status  = $testimonial->update();
if($update_status==1 || $update_status==0){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    if($update_status==1) echo json_encode(array("message" => "Testimonial is updated."));
    if($update_status==0) echo json_encode(array("message" => "No such Testimonial is found."));

}
 
// if unable to update the testimonial, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update testimonial."));
}
?>