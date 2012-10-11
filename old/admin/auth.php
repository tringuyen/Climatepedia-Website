<?php


if (isset($_POST['user']) && isset($_POST['pass']))

{

$user = $_POST['user'];
$pass = $_POST['pass'];

$server = 'localhost';  
$username   = 'virtus_climate';  
$password   = 'C1im@t364';  
$database   = 'virtus_discussion';  
  
  
$db = mysqli_connect($server, $username, $password, $database);
  
$query = "select * from admin where '$user'=admin_name and '$pass'=admin_pass";


$result = $db->query($query);

if(!$result) {
	
	throw new Exception('Could not log you in.');
	
	}
	
	
if($result->num_rows>0) {

	session_start();
	$_SESSION['admin'] = $user;
	header('location:index.php');
	
	}
	
	else
	header('location:login.php?error=true');


}






?>