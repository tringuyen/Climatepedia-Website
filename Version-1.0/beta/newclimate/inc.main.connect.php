<?php  

$server = 'localhost';  
$db_user   = 'virtus_user9';  
$db_password   = 'A@Sp!NT9';  
$db_name   = 'virtus_climate';  
  
  
$db = new mysqli($server, $db_user, $db_password, $db_name);
  
  
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}  
  
?>