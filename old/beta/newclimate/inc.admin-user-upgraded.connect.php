<?php  

$server = 'localhost';  
$db_user   = 'virtus_user10';  
$db_password   = ' D9v!$61^';  
$db_name   = 'virtus_climate';  
  
  
$db = new mysqli($server, $db_user, $db_password, $db_name);
  
  
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}  
  
?>