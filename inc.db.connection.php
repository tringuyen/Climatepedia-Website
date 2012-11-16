<?php
	$dbhost = 'localhost';
	$dbuser   = 'virtus_user9';  
	$dbpwd   = 'A@Sp!NT9';
	$dbname = 'climatepedia_database'; 

	#$dbuser = "climatepedia";
	#$dbpwd = "2aJq5NNstWD7c7hN"; 
	#$db_name   = 'virtus_climate'; 
	$con = mysql_connect($dbhost, $dbuser, $dbpwd);
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	  
	mysql_select_db($dbname, $con);
?>