<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate blog object
include_once '../model/blog.php';
 
$database = new Database();
$db = $database->getConnection();
 
$blog = new Blog($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->title) &&
    !empty($data->date) &&
    !empty($data->header) &&
    //!empty($data->author) &&
    !empty($data->story) &&
    !empty($data->url)
){
 
    // set blog property values
    $blog->title = $data->title;
    $blog->date = $data->date;
    $blog->header = $data->header;
    $blog->author = $data->author;
    $blog->story = $data->story;
    $blog->url = $data->url;
   // $blog->created = date('Y-m-d H:i:s');
   $blog->thumbnail_image_url = $data->thumbnail_image_url;
    // create the blog
    if($blog->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "blog is created successfully."));
    }
 
    // if unable to create the blog, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create blog."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create blog. Data is incomplete."));
}
?>