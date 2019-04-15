<?php
// required headers
// * means anyone can access this api
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 

// include database and object files
include_once '../config/database.php';
include_once '../model/news.php';

// instantiate database and news object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$news = new News($db);

// check parameter is set or not. If not, send bad request
if(!isset($_GET['id'])){
    http_response_code(400);
 
    // tell the user no news found
    echo json_encode(
        array()
    );
}

else{

        $searchId = $_GET['id'];


        // query news
        $stmt = $news->readById($searchId);
        $num = $stmt->rowCount();
        
        // check if more than 0 record found
        if($num>0){    
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
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
        
            // set response code - 200 OK
            http_response_code(200);
        
            // show news data in json format
            echo json_encode($news_item);

            }
        
            

        

        else{
        
            // set response code - 404 Not found
            http_response_code(404);
        
            // tell the user no news found
            echo json_encode(
                array()
            );
        }
}
?>