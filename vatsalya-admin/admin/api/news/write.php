<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate news object
include_once '../model/news.php';
 
$database = new Database();
$db = $database->getConnection();
 
$news = new news($db);
 
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
 
    // set news property values
    $news->title = $data->title;
    $news->date = $data->date;
    $news->header = $data->header;
    $news->author = $data->author;
    $news->story = $data->story;
    $news->url = $data->url;
   // $news->created = date('Y-m-d H:i:s');
   $news->thumbnail_image_url = $data->thumbnail_image_url;
    // create the news
    if($news->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "News is created successfully."));
    }
 
    // if unable to create the news, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create news."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create news. Data is incomplete."));
}
?>