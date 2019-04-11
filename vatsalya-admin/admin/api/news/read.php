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
$news = new news($db);
//---------------------------------------------------------------------
// query news
$stmt = $news->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // news array
    $news_arr=array();
    //$news_arr["records"]=array();
 
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
            "author" => $author
        );
 
        //array_push($news_arr["records"], $news_item);
        array_push($news_arr, $news_item);

    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show news data in json format
    echo json_encode($news_arr);
}
 

else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No news found.")
    );
}

?>