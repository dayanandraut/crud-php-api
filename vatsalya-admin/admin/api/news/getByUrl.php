<?php
// required headers
// * means anyone can access this api
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

// include database and object files
include_once '../config/database.php';
include_once '../model/news.php';

// instantiate database and news object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$news = new News($db);
//---------------------------------------------------------------------
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(!empty($data->url)) {
    

    // query news
    $stmt = $news->readByUrl($data->url);
    $num = $stmt->rowCount();
    
    // check if more than 0 record found
    if($num>0){
    
        // news array
        $news_arr=array();
        
    
        // retrieve our table contents
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
    
            $news_item=array(
                "id" => $id,
                "title" => $title,
                "date" => $date,
                "header" => $header,
                "url" => $url,
                "story" => $story,
                "author" => $author,
                "thumbnail_image_url" => $thumbnail_image_url
            );
    
            
            array_push($news_arr, $news_item);

        }
    
        // set response code - 200 OK
        http_response_code(200);
    
        // show news data in json format
        echo json_encode($news_arr);
    }
    

    // no records were found
    else{
        
        http_response_code(200);    
        // Send empty array
        echo json_encode(
            array()
        );
    }
}

// Bad Request
else{
    // set response code - 400 Bad Request
    http_response_code(400);
 
    // tell the user no products found. Send empty array
    echo json_encode(
        array("message"=>"Bad Request")
    );
}

?>