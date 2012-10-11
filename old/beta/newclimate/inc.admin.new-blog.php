<?php

include ("inc.admin-user.connect.php");

$blog_sidebar = $db->real_escape_string($_POST['new_submit_blog_sidebar']);
$blog_name = $db->real_escape_string($_POST['new_submit_blog_title']);
$blog_url = $db->real_escape_string($_POST['new_submit_blog_url']);
$blog_description = $db->real_escape_string($_POST['new_submit_blog_description']);
$blog_stance = $db->real_escape_string($_POST['new_submit_blog_stance']);
$blog_tag = $db->real_escape_string($_POST['new_submit_blog_tag']);
$blog_active = $db->real_escape_string($_POST['new_submit_blog_active']);


$query = ("INSERT INTO blogs_sources (blog_sidebar, blog_name, blog_url, blog_description, blog_stance, blog_tag, blog_active) VALUES ('$blog_sidebar', '$blog_name', '$blog_url', '$blog_description', '$blog_stance', '$blog_tag', '$blog_active')");
$result=$db->query($query);

header("Location:http://www.climatepedia.org/beta/newclimate/admin.php?console=blogs&action=success&type=new&query=blog&title=" . $blog_sidebar);

?>