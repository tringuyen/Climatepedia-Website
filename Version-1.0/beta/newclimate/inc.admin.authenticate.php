<?php

include ("inc.admin-user.connect.php");

$username = $db->real_escape_string($_POST['submit_username']);
$password = $db->real_escape_string($_POST['submit_password']);

$query = "SELECT * FROM ucla_climatepedians where admin_username = '$username' AND admin_password = '$password'";

$result = $db->query($query);

if(!$result) {
	
	throw new Exception('Could not log you in.');
	
	}
	
	
if($result->num_rows>0) {

	session_start();
	$_SESSION['admin'] = $username;
	header("Location:http://www.climatepedia.org/beta/newclimate/admin.php?console=knowledge");
	
	}
	
	else
	header("Location:ucla-login.php?error=true");






?>