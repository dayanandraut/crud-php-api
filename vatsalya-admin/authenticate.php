<?php

include("config/database-config.php");
session_start();
$table = 'user_details';
if(isset($_POST['loginbtn'])){
  $uid = format_input($_POST['username']);
  $upas = format_input($_POST['userpassword']);
  

  if($uid!='' && $upas!=''){
    $sql = "SELECT * FROM $table WHERE `uname` LIKE '$uid' AND `upass` LIKE '$upas'";
    
    $res1 = mysqli_query($conn,$sql);
    if($res1){
      $row=mysqli_fetch_assoc($res1);
        
            if($row>=1)
            { 
              $_SESSION['loggeduser'] = format_output($row['uname']);
              // echo $_SESSION['loggeduser'];
              header("Location:./admin");

            }else{
              echo "InValid credentials";
            }
  }
  }
}
?>