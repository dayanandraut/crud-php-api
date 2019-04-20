<?php
// required headers
// * means anyone can access this api
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 

// include database and object files
include_once '../config/database.php';
include_once '../model/publication.php';

// instantiate database and publication object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$publication = new Publication($db);
//---------------------------------------------------------------------
// query publication
$stmt = $publication->read();
$num = $stmt->rowCount();
// publication array
$publication_arr=array();
// check if more than 0 record found
if($num>0){
     // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row); 
        $publication_item=array(
            "id" => $id,
            "publication_name" => $publication_name,
            "publication_url" => $publication_url
        );
        array_push($publication_arr, $publication_item);
    }
}
// set response code - 200 OK
http_response_code(200);
 
// show publication data in json format
echo json_encode($publication_arr);
?>