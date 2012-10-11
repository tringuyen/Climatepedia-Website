<?php

include ("inc.admin-user.connect.php");
include ("inc.admin.functions.php");

$professor_id = $db->real_escape_string($_POST['edit_submit_professor_id']);
$professor_title = $db->real_escape_string($_POST['edit_submit_professor_title']);
$professor_firstname = $db->real_escape_string($_POST['edit_submit_professor_firstname']);
$professor_lastname = $db->real_escape_string($_POST['edit_submit_professor_lastname']);
$professor_university = $db->real_escape_string($_POST['edit_submit_professor_university']);
$professor_olduniversity = $db->real_escape_string($_POST['edit_submit_professor_olduniversity']);
$professor_department = $db->real_escape_string($_POST['edit_submit_professor_department']);
$professor_bio = convert_smart_quotes($_POST['edit_submit_professor_bio']);
$professor_bio = $db->real_escape_string($professor_bio);
$professor_cv = $db->real_escape_string($_POST['edit_submit_professor_cv']);
$professor_picture = $db->real_escape_string($_POST['edit_submit_professor_images']);
$professor_specialty = $db->real_escape_string($_POST['edit_submit_professor_specialty']);
$professor_tag = $db->real_escape_string($_POST['edit_submit_professor_tag']);
$professor_oldtag = $db->real_escape_string($_POST['edit_submit_professor_oldtag']);
$professor_active = $db->real_escape_string($_POST['edit_submit_professor_active']);

$query = ("UPDATE podium_professors SET professor_title = '$professor_title', professor_firstname = '$professor_firstname', professor_lastname = '$professor_lastname', professor_university = '$professor_university', professor_department = '$professor_department', professor_bio = '$professor_bio', professor_cv = '$professor_cv', professor_picture = '$professor_picture', professor_specialty = '$professor_specialty', professor_tag = '$professor_tag', professor_active = '$professor_active' WHERE professor_id = '$professor_id'");
$result=$db->query($query);

if($professor_olduniversity !== $professor_university) {
	
$query = ("UPDATE podium_universities SET university_professors=university_professors+1 WHERE university_id = '$professor_university'");
$result=$db->query($query);

$query = ("UPDATE podium_universities SET university_professors=university_professors-1 WHERE university_id = '$professor_olduniversity'");
$result=$db->query($query);

}

header("Location:http://www.climatepedia.org/admin?console=podium&action=success&type=edit&query=professor&title=" . $professor_firstname . "%20" . $professor_lastname);



?>