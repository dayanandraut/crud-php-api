<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../model/blog.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare blog object
$blog = new Blog($db);
 
// get id of blog to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of blog to be edited
$blog->id = $data->id;
 
// set blog property values
    $blog->title = $data->title;
    $blog->date = $data->date;
    $blog->header = $data->header;
    $blog->author = $data->author;
    $blog->story = $data->story;
    $blog->url = $data->url;
    $blog->thumbnail_image_url = $data->thumbnail_image_url;

// update the blog
$update_status  = $blog->update();
if($update_status==1 || $update_status==0){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    if($update_status==1) echo json_encode(array("message" => "blog is updated."));
    if($update_status==0) echo json_encode(array("message" => "No such blog is found."));

}
 
// if unable to update the blog, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update blog."));
}
?>