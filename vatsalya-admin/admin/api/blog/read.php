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
//---------------------------------------------------------------------
// query blog
$stmt = $blog->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // blog array
    $blog_arr=array();
    //$blog_arr["records"]=array();
 
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
 
        //array_push($blog_arr["records"], $blog_item);
        array_push($blog_arr, $blog_item);

    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show blog data in json format
    echo json_encode($blog_arr);
}
 

else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found. Send empty array
    echo json_encode(
        array()
    );
}

?>