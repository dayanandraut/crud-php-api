<?php
// required headers
// * means anyone can access this api
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
 

// include database and object files
include_once '../config/database.php';
include_once '../model/testimonial.php';

// instantiate database and testimonial object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$testimonial = new Testimonial($db);
//---------------------------------------------------------------------
// query testimonial
$stmt = $testimonial->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // testimonial array
    $testimonial_arr=array();
    //$testimonial_arr["records"]=array();
 
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        

        $testimonial_item=array(
            "id" => $id,
            "provider_name" => $provider_name,
            "testimonials" => $testimonials,
            
        );
 
        //array_push($testimonial_arr["records"], $testimonial_item);
        array_push($testimonial_arr, $testimonial_item);

    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show testimonial data in json format
    echo json_encode($testimonial_arr);
}
 

else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array()
    );
}

?>