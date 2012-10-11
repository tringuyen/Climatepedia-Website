<?php

include ("inc.admin-user.connect.php");

$source_id = $_POST['edit_submit_feed_id'];
$source_sidebar = $db->real_escape_string($_POST['edit_submit_feed_sidebar']);
$source_title = $db->real_escape_string($_POST['edit_submit_feed_title']);
$source_description = $db->real_escape_string($_POST['edit_submit_feed_description']);
$source_url = $db->real_escape_string($_POST['edit_submit_feed_url']);
$source_name = $db->real_escape_string($_POST['edit_submit_feed_name']);
$source_link = $db->real_escape_string($_POST['edit_submit_feed_link']);
$source_active = $db->real_escape_string($_POST['edit_submit_feed_live']);
$source_special = $_POST['edit_submit_feed_special'];
$source_images = $_POST['edit_submit_feed_images'];


$query = ("UPDATE news_sources SET source_sidebar = '$source_sidebar', source_title = '$source_title', source_description = '$source_description', source_url = '$source_url', source_name = '$source_name', source_link = '$source_link', source_active = '$source_active', source_special = '$source_special', source_images = '$source_images' WHERE source_id = '$source_id'");

$result=$db->query($query);

header("Location:http://www.climatepedia.org/beta/newclimate/admin.php?console=news&action=success&type=edit&query=feeds&title=" . $source_sidebar);

?>