<?php

include("inc.admin-user.connect.php");
include("inc.admin.functions.php");

$post_title = $db->real_escape_string($_POST['new_submit_post_title']);
$post_description = $db->real_escape_string($_POST['new_submit_post_description']);
$post_name = $db->real_escape_string($_POST['new_submit_post_name']);
$post_summary = convert_smart_quotes($_POST['new_submit_post_summary']);
$post_summary = $db->real_escape_string($post_summary);
$post_content = $db->real_escape_string($_POST['new_submit_post_content']);
$post_images = $db->real_escape_string($_POST['new_submit_post_images']);
$post_tag1 = $db->real_escape_string($_POST['new_submit_post_tag1']);
$post_tag2 = $db->real_escape_string($_POST['new_submit_post_tag2']);
$post_tag3 = $db->real_escape_string($_POST['new_submit_post_tag3']);
$post_professor = $db->real_escape_string($_POST['new_submit_post_professor']);
$post_url = $db->real_escape_string($_POST['new_submit_post_url']);
$post_date = $db->real_escape_string($_POST['new_submit_post_date']);



$query = ("INSERT INTO podium_posts (post_title, post_description, post_name, post_url, post_summary, post_content, post_images, post_professor, post_tag1, post_tag2, post_tag3, post_date) VALUES ('$post_title', '$post_description', '$post_name', '$post_url', '$post_summary', '$post_content', '$post_images', '$post_professor', '$post_tag1', '$post_tag2', '$post_tag3', '$post_date')");
$result=$db->query($query);


// update climate tag counts
$query = ("UPDATE climate_tags SET tag_professoritems=tag_professoritems+1 WHERE tag_id = '$post_tag1' OR tag_id = '$post_tag2' OR tag_id = '$post_tag3'");
$result=$db->query($query);

// update blog source counts
$query = ("UPDATE podium_professors SET professor_posts = professor_posts+1 WHERE professor_id = '$post_professor'");
$result=$db->query($query);

header("Location:http://www.climatepedia.org/beta/newclimate/admin.php?console=podium&action=success&type=new&query=post&title=" . $post_name . "&url=" . $post_url);

?>