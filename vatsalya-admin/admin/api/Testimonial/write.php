<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate testimonial object
include_once '../model/testimonial.php';
 
$database = new Database();
$db = $database->getConnection();
 
$testimonial = new Testimonial($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->provider_name) &&
    !empty($data->testimonials) 
){
 
    // set testimonial property values
    $testimonial->provider_name = $data->provider_name;
    $testimonial->testimonials = $data->testimonials;
    
    if($testimonial->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Testimonial is created successfully."));
    }
 
    // if unable to create the testimonial, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create testimonial."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create testimonial. Data is incomplete."));
}
?>