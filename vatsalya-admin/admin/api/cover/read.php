<?php
// required headers
// * means anyone can access this api
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 

// include database and object files
include_once '../config/database.php';
include_once '../model/cover.php';

// instantiate database and cover object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$cover = new Cover($db);
//---------------------------------------------------------------------
// query cover
$stmt = $cover->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // cover array
    $cover_arr=array();
    //$cover_arr["records"]=array();
 
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $cover_item=array(
            "id" => $id,
            "image_name" => $image_name,
            "image_url" => $image_url
        );
 
        //array_push($cover_arr["records"], $cover_item);
        array_push($cover_arr, $cover_item);

    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show cover data in json format
    echo json_encode($cover_arr);
}
 

else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    
    echo json_encode(
        array()
    );
}

?>