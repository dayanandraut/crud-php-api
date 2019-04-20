<?php
// required headers
// * means anyone can access this api
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 

// include database and object files
include_once '../config/database.php';
include_once '../model/blog.php';

// instantiate database and blog object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$blog = new Blog($db);
// query blog
$stmt = $blog->read();
$num = $stmt->rowCount();
//---------------------------------------------------------------------
// blog array
$blog_arr=array();
// check if more than 0 record found
if($num>0){     
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row); 
        $blog_item=array(
            "id" => $id,
            "title" => $title,
            "date" => $date,
            "header" => $header,
            "url" => $url,
            "story" => $story,
            "author" => $author,
            "thumbnail_image_url" => $thumbnail_image_url
        ); 
        array_push($blog_arr, $blog_item);
    } 
    
}

// set response code - 200 OK
http_response_code(200);
 
// show blog data in json format
echo json_encode($blog_arr);

?>