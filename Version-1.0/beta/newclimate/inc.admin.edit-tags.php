<?php

// connect to db

include ("inc.admin-user.connect.php");

$tag_id[0] = $db->real_escape_string($_POST['edit_submit_tag0_id']);
$tag_name[0] = $db->real_escape_string($_POST['edit_submit_tag0_name']);

$tag_total = 0;

// Test for 2 tags

if(isset($_POST['edit_submit_tag1_id'])) {
	
$tag_id[1] = $db->real_escape_string($_POST['edit_submit_tag1_id']);
$tag_name[1] = $db->real_escape_string($_POST['edit_submit_tag1_name']);

$tag_total++;
		
}	

// Test for 3 tags

if(isset($_POST['edit_submit_tag2_id'])) {
	
$tag_id[2] = $db->real_escape_string($_POST['edit_submit_tag2_id']);
$tag_name[2] = $db->real_escape_string($_POST['edit_submit_tag2_name']);

$tag_total++;
		
}	

// Test for 4 tags

if(isset($_POST['edit_submit_tag3_id'])) {
	
$tag_id[3] = $db->real_escape_string($_POST['edit_submit_tag3_id']);
$tag_name[3] = $db->real_escape_string($_POST['edit_submit_tag3_name']);

$tag_total++;
		
}	

// Test for 5 tags

if(isset($_POST['edit_submit_tag4_id'])) {
	
$tag_id[4] = $db->real_escape_string($_POST['edit_submit_tag4_id']);
$tag_name[4] = $db->real_escape_string($_POST['edit_submit_tag4_name']);

$tag_total++;
		
}	

// Test for 6 tags

if(isset($_POST['edit_submit_tag5_id'])) {
	
$tag_id[5] = $db->real_escape_string($_POST['edit_submit_tag5_id']);
$tag_name[5] = $db->real_escape_string($_POST['edit_submit_tag5_name']);

$tag_total++;
		
}	

// Test for 7 tags

if(isset($_POST['edit_submit_tag6_id'])) {
	
$tag_id[6] = $db->real_escape_string($_POST['edit_submit_tag6_id']);
$tag_name[6] = $db->real_escape_string($_POST['edit_submit_tag6_name']);

$tag_total++;
		
}	

// Test for 8 tags

if(isset($_POST['edit_submit_tag7_id'])) {
	
$tag_id[7] = $db->real_escape_string($_POST['edit_submit_tag7_id']);
$tag_name[7] = $db->real_escape_string($_POST['edit_submit_tag7_name']);

$tag_total++;
		
}	

// Test for 9 tags

if(isset($_POST['edit_submit_tag8_id'])) {
	
$tag_id[8] = $db->real_escape_string($_POST['edit_submit_tag8_id']);
$tag_name[8] = $db->real_escape_string($_POST['edit_submit_tag8_name']);

$tag_total++;
		
}

// Test for 10 tags

if(isset($_POST['edit_submit_tag9_id'])) {
	
$tag_id[9] = $db->real_escape_string($_POST['edit_submit_tag9_id']);
$tag_name[9] = $db->real_escape_string($_POST['edit_submit_tag9_name']);

$tag_total++;
		
}

// run loop of queries

$queries = 0;

while($queries <= $tag_total) {

$edit_tag_name = $tag_name[$queries];
$edit_tag_id = $tag_id[$queries];

$query = ("UPDATE climate_tags SET tag_name = '$edit_tag_name' WHERE tag_id = '$edit_tag_id'");
$result=$db->query($query);

$queries++;

}

$i = 0;

while($i <= $tag_total) {

$location .= "&tag" . $i . "=" . $tag_name[$i];

$i++;

}

$location .= "&total=" . $tag_total;

header("Location:admin.php?console=knowledge&action=success&type=edit&query=tags" . $location);




?>