<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// get directory here
$dir = "../../homepage/gallery";
chdir ($dir);

$current_dir = getCwd();

//echo "Current directory is now $current_dir";

//files are sorted alphabetically
$array = scandir(".", 0);
http_response_code(200);
echo json_encode(array_slice($array,2));
?>