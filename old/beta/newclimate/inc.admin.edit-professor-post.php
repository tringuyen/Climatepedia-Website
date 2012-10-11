<?php

include("inc.admin-user.connect.php");
include("inc.admin.functions.php");

$post_id = $db->real_escape_string($_POST['edit_submit_post_id']);
$post_title = $db->real_escape_string($_POST['edit_submit_post_title']);
$post_description = $db->real_escape_string($_POST['edit_submit_post_description']);
$post_name = $db->real_escape_string($_POST['edit_submit_post_name']);
$post_summary = convert_smart_quotes($_POST['edit_submit_post_summary']);
$post_summary = $db->real_escape_string($post_summary);
$post_content = $db->real_escape_string($_POST['edit_submit_post_content']);
$post_images = $db->real_escape_string($_POST['edit_submit_post_images']);
$post_tag1 = $db->real_escape_string($_POST['edit_submit_post_tag1']);
$post_tag2 = $db->real_escape_string($_POST['edit_submit_post_tag2']);
$post_tag3 = $db->real_escape_string($_POST['edit_submit_post_tag3']);
$post_oldtag1 = $db->real_escape_string($_POST['edit_submit_post_oldtag1']);
$post_oldtag2 = $db->real_escape_string($_POST['edit_submit_post_oldtag2']);
$post_oldtag3 = $db->real_escape_string($_POST['edit_submit_post_oldtag3']);
$post_professor = $db->real_escape_string($_POST['edit_submit_post_professor']);
$post_oldprofessor = $db->real_escape_string($_POST['edit_submit_post_oldprofessor']);
$post_date = $db->real_escape_string($_POST['edit_submit_post_date']);
$post_url = $db->real_escape_string($_POST['edit_submit_post_url']);


$query = ("UPDATE podium_posts SET post_title = '$post_title', post_description = '$post_description', post_name = '$post_name', post_summary = '$post_summary', post_content = '$post_content', post_images = '$post_images', post_professor = '$post_professor', post_tag1 = '$post_tag1', post_tag2 = '$post_tag2', post_tag3 = '$post_tag3', post_date = '$post_date' WHERE post_id = '$post_id'");
$result=$db->query($query);


// update climate tag counts

if($post_oldtag1 !== $post_tag1) {
	
$query = ("UPDATE climate_tags SET tag_professoritems=tag_professoritems+1 WHERE tag_id = '$post_tag1'");
$result=$db->query($query);

$query = ("UPDATE climate_tags SET tag_professoritems=tag_professoritems-1 WHERE tag_id = '$post_oldtag1'");
$result=$db->query($query);

}

if($post_oldtag2 !== $post_tag2) {
	
$query = ("UPDATE climate_tags SET tag_professoritems=tag_professoritems+1 WHERE tag_id = '$post_tag2'");
$result=$db->query($query);

$query = ("UPDATE climate_tags SET tag_professoritems=tag_professoritems-1 WHERE tag_id = '$post_oldtag2'");
$result=$db->query($query);

}

if($post_oldtag1 !== $post_tag3) {
	
$query = ("UPDATE climate_tags SET tag_professoritems=tag_professoritems+1 WHERE tag_id = '$post_tag3'");
$result=$db->query($query);

$query = ("UPDATE climate_tags SET tag_professoritems=tag_professoritems-1 WHERE tag_id = '$post_oldtag3'");
$result=$db->query($query);

}

if($post_oldprofessor !== $post_professor) {
	
$query = ("UPDATE podium_professors SET professor_posts=professor_posts+1 WHERE blog_id = '$post_professor'");
$result=$db->query($query);

$query = ("UPDATE podium_professors SET professor_posts=professor_posts-1 WHERE tag_id = '$post_oldprofessor'");
$result=$db->query($query);

}


header("Location:http://www.climatepedia.org/beta/newclimate/admin.php?console=podium&action=success&type=edit&query=post&title=" . $post_name . "&url=" . $post_url);

?>