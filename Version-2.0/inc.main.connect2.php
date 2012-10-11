<?php  

$server2 = 'localhost';  
$db_user2   = 'virtus_user9';  
$db_password2   = 'A@Sp!NT9';  
$db_name2   = 'virtus_climate';  
  
  
$db2 = new mysqli($server2, $db_user2, $db_password2, $db_name2);
  
  
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}  
  
?>