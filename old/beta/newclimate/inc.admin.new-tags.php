<?php

// connect to db

include ("inc.admin-user.connect.php");

$tag_name[0] = $db->real_escape_string($_POST['new_submit_tag0']);

$tag_total = 0;

// Test for 2 tags

if(isset($_POST['new_submit_tag1'])) {
	
$tag_name[1] = $db->real_escape_string($_POST['new_submit_tag1']);

$tag_total++;
		
}	

// Test for 3 tags

if(isset($_POST['new_submit_tag2'])) {
	
$tag_name[2] = $db->real_escape_string($_POST['new_submit_tag2']);

$tag_total++;
		
}	

// Test for 4 tags

if(isset($_POST['new_submit_tag3'])) {
	
$tag_name[3] = $db->real_escape_string($_POST['new_submit_tag3']);

$tag_total++;
		
}	

// Test for 5 tags

if(isset($_POST['new_submit_tag4'])) {
	
$tag_name[4] = $db->real_escape_string($_POST['new_submit_tag4']);

$tag_total++;
		
}	

// Test for 6 tags

if(isset($_POST['new_submit_tag5'])) {
	
$tag_name[5] = $db->real_escape_string($_POST['new_submit_tag5']);

$tag_total++;
		
}	

// Test for 7 tags

if(isset($_POST['new_submit_tag6'])) {
	
$tag_name[6] = $db->real_escape_string($_POST['new_submit_tag6']);

$tag_total++;
		
}	

// Test for 8 tags

if(isset($_POST['new_submit_tag7'])) {
	
$tag_name[7] = $db->real_escape_string($_POST['new_submit_tag7']);

$tag_total++;
		
}	

// Test for 9 tags

if(isset($_POST['new_submit_tag8'])) {
	
$tag_name[8] = $db->real_escape_string($_POST['new_submit_tag8']);

$tag_total++;
		
}

// Test for 10 tags

if(isset($_POST['new_submit_tag9'])) {
	
$tag_name[9] = $db->real_escape_string($_POST['new_submit_tag9']);

$tag_total++;
		
}

// run loop of queries

$queries = 0;

while($queries <= $tag_total) {

$new_tag_name = $tag_name[$queries];

$query = ("INSERT INTO climate_tags (tag_name) VALUES ('$new_tag_name')");
$result=$db->query($query);

$queries++;

}

$i = 0;

while($i <= $tag_total) {

$location .= "&tag" . $i . "=" . $tag_name[$i];

$i++;

}

$location .= "&total=" . $tag_total;

header("Location:admin.php?console=knowledge&action=success&type=new&query=tags" . $location);




?>