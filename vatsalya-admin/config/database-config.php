
<?php 
  
  $server="localhost"; 
  $user="root"; 
  $pass="justsumant"; 
  $db="mydb";
    
  // connect to mysql 
    
  $conn = mysqli_connect($server, $user, $pass) or die("Sorry, can't connect to the localhost."); 
  if($conn){
    //   echo "Connected to $server <br>";
  }
    
  // select the db 
    
  $connect_to_db = mysqli_select_db($conn, $db) or die("Sorry, can't select the database."); 
  if($connect_to_db){
    //   echo "Connected to $db <br>";
  }

//-----------------function to prevent sql injection---------
  function format_input($s){
  global $conn;
  return mysqli_real_escape_string($conn,trim($s));  

}
//-------------------function to prevent xss----------------------------------------
 function format_output($s){   
  return htmlspecialchars(stripcslashes(trim($s)));    
}


?>