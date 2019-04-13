<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// get directory here
$dir = "../../homepage/gallery";

// get file name here
$file = $dir . "/gori.jpg";
if (!unlink($file))
  {
    http_response_code(400);
    echo json_encode(array("message" => "$file is not deleted."));
  }
else
  {
    http_response_code(200);
    echo json_encode(array("message" => "$file is deleted."));
    
  }
?>