<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../model/news.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare news object
$news = new News($db);
 
// get id of news to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of news to be edited
$news->id = $data->id;
 
// set news property values
    $news->title = $data->title;
    $news->date = $data->date;
    $news->header = $data->header;
    $news->author = $data->author;
    $news->story = $data->story;
    $news->url = $data->url;
// update the news
if($news->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "news was updated."));
}
 
// if unable to update the news, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update news."));
}
?>