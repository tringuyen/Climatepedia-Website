<?php

include ("inc.admin-user.connect.php");

$blog_id = $_POST['edit_submit_blog_id'];
$blog_sidebar = $db->real_escape_string($_POST['edit_submit_blog_sidebar']);
$blog_name = $db->real_escape_string($_POST['edit_submit_blog_name']);
$blog_url = $db->real_escape_string($_POST['edit_submit_blog_url']);
$blog_description = $db->real_escape_string($_POST['edit_submit_blog_description']);
$blog_stance = $db->real_escape_string($_POST['edit_submit_blog_stance']);
$blog_tag = $db->real_escape_string($_POST['edit_submit_blog_tag']);
$blog_active = $db->real_escape_string($_POST['edit_submit_blog_live']);


$query = ("UPDATE blogs_sources SET blog_sidebar = '$blog_sidebar', blog_name = '$blog_name', blog_url = '$blog_url', blog_description = '$blog_description', blog_stance = '$blog_stance', blog_tag = '$blog_tag', blog_active = '$blog_active' WHERE blog_id = '$blog_id'");

$result=$db->query($query);

header("Location:http://www.climatepedia.org/beta/newclimate/admin.php?console=blogs&action=success&type=edit&query=blog&title=" . $blog_sidebar);

?>