<?php
// required headers
// * means anyone can access this api
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 

// include database 
include_once '../config/database.php';


// instantiate database and env object
$database = new Database();
$db = $database->getConnection();
 
// form query
$table_name = "environment";
$query = "SELECT * FROM " . $table_name . " WHERE id = 1";        
        
$stmt = $db->prepare($query);
//$stmt->bindParam(1, $searchId);
// execute query
$stmt->execute();
$num = $stmt->rowCount();
        
        // check if more than 0 record found
        if($num>0){    
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($row);
        
                $env_item=array(
                    "id" => $id,
                    "contact_email_id" => $contact_email_id,
                    "appointment_email_id" => $appointment_email_id,
                    "youtube_api" => $youtube_api
                );
        
            // set response code - 200 OK
            http_response_code(200);
        
            // show env data in json format
            echo json_encode($env_item);

            }  
            

        

        else{
        
            
            http_response_code(200);
        
            // tell the user no env found
            echo json_encode(
                array()
            );
        }

?>