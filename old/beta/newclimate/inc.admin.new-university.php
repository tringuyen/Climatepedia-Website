<?php

include ("inc.admin-user.connect.php");

$university_name = $db->real_escape_string($_POST['new_submit_university_name']);
$university_abbr = $db->real_escape_string($_POST['new_submit_university_abbr']);
$university_location = $db->real_escape_string($_POST['new_submit_university_location']);
$university_web = $db->real_escape_string($_POST['new_submit_university_web']);
$university_images = $db->real_escape_string($_POST['new_submit_university_images']);

$query = ("INSERT INTO podium_universities (university_name, university_abbr, university_location, university_web, university_images) VALUES ('$university_name', '$university_abbr', '$university_location', '$university_web', '$university_images')");
$result = $db->query($query);

header("Location:http://www.climatepedia.org/beta/newclimate/admin?console=podium&action=success&type=new&query=university&title=" . $university_name);








?>