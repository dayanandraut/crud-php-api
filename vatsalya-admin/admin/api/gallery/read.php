<?php
// required headers
// * means anyone can access this api
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 

// include database and object files
include_once '../config/database.php';
include_once '../model/gallery.php';

// instantiate database and gallery object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$gallery = new gallery($db);
//---------------------------------------------------------------------
// query gallery
$stmt = $gallery->read();
$num = $stmt->rowCount();
// gallery array
$gallery_arr=array();
// check if more than 0 record found
if($num>0){
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row); 
        $gallery_item=array(
            "id" => $id,
            "image_name" => $image_name,
            "image_url" => $image_url
        );
        array_push($gallery_arr, $gallery_item);

    }   
}
 // set response code - 200 OK
 http_response_code(200);
 
 // show gallery data in json format
 echo json_encode($gallery_arr);

?>