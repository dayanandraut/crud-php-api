<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$uploadOk = 1;
$message = "";

if($_FILES['file']){
    $path = '../../../assets/images/gallery-images/';
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }
    $originalName = $_FILES['file']['name'];
    $ext = strtolower('.'.pathinfo($originalName, PATHINFO_EXTENSION));

    // Check if file already exists
    $filePath = $path.$originalName;
    if (file_exists($filePath)) {
        $message = $message. " file already exists.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($ext != ".jpg" && $ext != ".png" && $ext != ".jpeg"
    && $ext != ".gif" ) {
        $message = $message. " Only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["file"]["size"] > 7340032) {
        $message = $message." file is should be less than 7MB";
        $uploadOk = 0;
    }
    
    $filePath = $path.$originalName;

    // No errors till now
    if($uploadOk==1){
        if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
            $message = " File uploaded successfully";
            $uploadOk = 1;
            //success
            http_response_code(200);
            echo json_encode(array(
                'result' => 'success',
                'status' => true,
                'message' => $message
            ));            
        } 
    } 
   else{
        //error
        http_response_code(500);
        echo json_encode(array(
            'result' => 'failed',
            'status' => false,
            'message' => $message
        ));
    }
}
?>