<?php

include ("inc.admin-user.connect.php");

$feed_sidebar = $db->real_escape_string($_POST['new_submit_feed_sidebar']);
$feed_title = $db->real_escape_string($_POST['new_submit_feed_title']);
$feed_description = $db->real_escape_string($_POST['new_submit_feed_description']);
$feed_url = $db->real_escape_string($_POST['new_submit_feed_url']);
$feed_name = $db->real_escape_string($_POST['new_submit_feed_name']);
$feed_link = $db->real_escape_string($_POST['new_submit_feed_link']);
$feed_active = $db->real_escape_string($_POST['new_submit_feed_live']);
$feed_used = 0;
$feed_special = $_POST['new_submit_feed_special'];
$feed_images = $_POST['new_submit_feed_images'];


$query = ("INSERT INTO news_sources (source_sidebar, source_title, source_description, source_url, source_name, source_link, source_active, source_used, source_special, source_images) VALUES ('$feed_sidebar', '$feed_title', '$feed_description', '$feed_url', '$feed_name', '$feed_link', '$feed_active', '$feed_used', '$feed_special', '$feed_images')");
$result=$db->query($query);

header("Location:http://www.climatepedia.org/admin.php?console=news&action=success&type=new&query=feeds&title=" . $feed_sidebar);

?>