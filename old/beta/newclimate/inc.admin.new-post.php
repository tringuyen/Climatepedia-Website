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
$post_source = $db->real_escape_string($_POST['new_submit_post_source']);
$post_url = $db->real_escape_string($_POST['new_submit_post_url']);
$post_date = $db->real_escape_string($_POST['new_submit_post_date']);
$post_now = date('Y-m-d');


$query = ("INSERT INTO blogs_posts (post_title, post_description, post_name, post_summary, post_content, post_images, post_tag1, post_tag2, post_tag3, post_source, post_url, post_date, post_update) VALUES ('$post_title', '$post_description', '$post_name', '$post_summary', '$post_content', '$post_images', '$post_tag1', '$post_tag2', '$post_tag3', '$post_source', '$post_url', '$post_date', '$post_now')");
$result=$db->query($query);
$post_id = $db->insert_id;

// update climate tag counts
$query = ("UPDATE climate_tags SET tag_blogitems=tag_blogitems+1 WHERE tag_id = '$post_tag1' OR tag_id = '$post_tag2' OR tag_id = '$post_tag3'");
$result=$db->query($query);

// update blog source counts
$query = ("UPDATE blogs_sources SET blog_posts = blog_posts+1, blog_latest = '$post_now' WHERE blog_id = '$post_source'");
$result=$db->query($query);

header("Location:http://www.climatepedia.org/beta/newclimate/admin.php?console=blogs&action=success&type=new&query=post&title=" . $post_name . "&postid=" . $post_id);

?>