<?php

// connect to db

include ("inc.admin-user.connect.php");

$tag_id[0] = $db->real_escape_string($_POST['edit_submit_tag_id0']);
$tag_news[0] = $db->real_escape_string($_POST['edit_submit_tag_trigger0']);

$tag_total = 0;

// Test for 2 tags

if(isset($_POST['edit_submit_tag_id1'])) {
	
$tag_id[1] = $db->real_escape_string($_POST['edit_submit_tag_id1']);
$tag_news[1] = $db->real_escape_string($_POST['edit_submit_tag_trigger1']);

$tag_total++;
		
}	

// Test for 3 tags

if(isset($_POST['edit_submit_tag_id2'])) {
	
$tag_id[2] = $db->real_escape_string($_POST['edit_submit_tag_id2']);
$tag_news[2] = $db->real_escape_string($_POST['edit_submit_tag_trigger2']);

$tag_total++;
		
}	

// Test for 4 tags

if(isset($_POST['edit_submit_tag_id3'])) {
	
$tag_id[3] = $db->real_escape_string($_POST['edit_submit_tag_id3']);
$tag_news[3] = $db->real_escape_string($_POST['edit_submit_tag_trigger3']);

$tag_total++;
		
}	

// Test for 5 tags

if(isset($_POST['edit_submit_tag_id4'])) {
	
$tag_id[4] = $db->real_escape_string($_POST['edit_submit_tag_id4']);
$tag_news[4] = $db->real_escape_string($_POST['edit_submit_tag_trigger4']);

$tag_total++;
		
}	

// Test for 6 tags

if(isset($_POST['edit_submit_tag_id5'])) {
	
$tag_id[5] = $db->real_escape_string($_POST['edit_submit_tag_id5']);
$tag_news[5] = $db->real_escape_string($_POST['edit_submit_tag_trigger5']);

$tag_total++;
		
}	

// Test for 7 tags

if(isset($_POST['edit_submit_tag_id6'])) {
	
$tag_id[6] = $db->real_escape_string($_POST['edit_submit_tag_id6']);
$tag_news[6] = $db->real_escape_string($_POST['edit_submit_tag_trigger6']);

$tag_total++;
		
}	

// Test for 8 tags

if(isset($_POST['edit_submit_tag_id7'])) {
	
$tag_id[7] = $db->real_escape_string($_POST['edit_submit_tag_id7']);
$tag_news[7] = $db->real_escape_string($_POST['edit_submit_tag_trigger7']);

$tag_total++;
		
}	

// Test for 9 tags

if(isset($_POST['edit_submit_tag_id8'])) {
	
$tag_id[8] = $db->real_escape_string($_POST['edit_submit_tag_id8']);
$tag_news[8] = $db->real_escape_string($_POST['edit_submit_tag_trigger8']);

$tag_total++;
		
}

// Test for 10 tags

if(isset($_POST['edit_submit_tag_id9'])) {
	
$tag_id[9] = $db->real_escape_string($_POST['edit_submit_tag_id9']);
$tag_news[9] = $db->real_escape_string($_POST['edit_submit_tag_trigger9']);

$tag_total++;
		
}

// run loop of queries

$queries = 0;

while($queries <= $tag_total) {

$edit_tag_news = $tag_news[$queries];
$edit_tag_id = $tag_id[$queries];

$query = ("UPDATE climate_tags SET tag_news = '$edit_tag_news' WHERE tag_id = '$edit_tag_id'");
$result=$db->query($query);

$queries++;

}


$location .= "&total=" . $tag_total;

header("Location:admin.php?console=news&action=success&type=edit&query=tags" . $location);




?>