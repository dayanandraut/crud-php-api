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
 
// check if more than 0 record found
if($num>0){
 
    // gallery array
    $gallery_arr=array();
    //$gallery_arr["records"]=array();
 
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
 
        //array_push($gallery_arr["records"], $gallery_item);
        array_push($gallery_arr, $gallery_item);

    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show gallery data in json format
    echo json_encode($gallery_arr);
}
 

else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No gallery found.")
    );
}

?>