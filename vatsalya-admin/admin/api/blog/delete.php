<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE, POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and model file
include_once '../config/database.php';
include_once '../model/blog.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare blog object
$blog = new Blog($db);
 
// get blog id
$data = json_decode(file_get_contents("php://input"));
 
// set blog id to be deleted
$blog->id = $data->id;
 
// delete the blog
$rows_affected  = $blog->delete();
if($rows_affected==1|| $rows_affected==0){    
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    if($rows_affected==1)   echo json_encode(array("message" => "blog is deleted."));
    if($rows_affected==0)   echo json_encode(array("message" => "No such blog is found."));
}

 
// if unable to delete the blog
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to delete blog."));
}
?>