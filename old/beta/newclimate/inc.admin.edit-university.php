<?php

include ("inc.admin-user.connect.php");

$university_id = $db->real_escape_string($_POST['edit_submit_university_id']);
$university_name = $db->real_escape_string($_POST['edit_submit_university_name']);
$university_abbr = $db->real_escape_string($_POST['edit_submit_university_abbr']);
$university_location = $db->real_escape_string($_POST['edit_submit_university_location']);
$university_web = $db->real_escape_string($_POST['edit_submit_university_web']);
$university_images = $db->real_escape_string($_POST['edit_submit_university_images']);

$query = ("UPDATE podium_universities SET university_name = '$university_name', university_abbr = '$university_abbr', university_location = '$university_location', university_web = '$university_web', university_images = '$university_images' WHERE university_id = '$university_id'");
$result = $db->query($query);

header("Location:http://www.climatepedia.org/beta/newclimate/admin?console=podium&action=success&type=edit&query=university&title=" . $university_name);








?>