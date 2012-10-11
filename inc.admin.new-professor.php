<?php

include ("inc.admin-user.connect.php");
include ("inc.admin.functions.php");

$professor_title = $db->real_escape_string($_POST['new_submit_professor_title']);
$professor_firstname = $db->real_escape_string($_POST['new_submit_professor_firstname']);
$professor_lastname = $db->real_escape_string($_POST['new_submit_professor_lastname']);
$professor_university = $db->real_escape_string($_POST['new_submit_professor_university']);
$professor_department = $db->real_escape_string($_POST['new_submit_professor_department']);
$professor_bio = convert_smart_quotes($_POST['new_submit_professor_bio']);
$professor_bio = $db->real_escape_string($professor_bio);
$professor_cv = $db->real_escape_string($_POST['new_submit_professor_cv']);
$professor_picture = $db->real_escape_string($_POST['new_submit_professor_images']);
$professor_specialty = $db->real_escape_string($_POST['new_submit_professor_specialty']);
$professor_tag = $db->real_escape_string($_POST['new_submit_professor_tag']);
$professor_active = $db->real_escape_string($_POST['new_submit_professor_active']);
$professor_url = $professor_firstname . " " . $professor_lastname;
$professor_url = str_replace(" ", "-", $professor_url);


// add to professor table
$query = ("INSERT INTO podium_professors (professor_title, professor_firstname, professor_lastname, professor_university, professor_department, professor_bio, professor_cv, professor_picture, professor_specialty, professor_tag, professor_active, professor_url) VALUES ('$professor_title', '$professor_firstname', '$professor_lastname', '$professor_university', '$professor_department', '$professor_bio', '$professor_cv', '$professor_picture', '$professor_specialty', '$professor_tag', '$professor_active', '$professor_url')");
$result = $db->query($query);

// update count in their university

$query = ("UPDATE podium_universities SET university_professors = university_professors+1 WHERE university_id = '$professor_university'");
$result=$db->query($query);

header("Location:http://www.climatepedia.org/admin?console=podium&action=success&type=new&query=professor&title=" . $professor_firstname . "%20" . $professor_lastname);



?>