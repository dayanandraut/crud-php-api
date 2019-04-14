<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));

// go back to admin folder. change if required
$host = "../../";
// get directory here
$dir = $host . $data->path;
//echo $dir;
chdir ($dir);

$current_dir = getCwd();

//echo "Current directory is now $current_dir";

//files are sorted alphabetically
$array = scandir(".", 0);
http_response_code(200);
echo json_encode(array_slice($array,2));
?>