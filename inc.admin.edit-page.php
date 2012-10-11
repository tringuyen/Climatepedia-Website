<?php

include ("inc.admin-user.connect.php");

$page_id = $db->real_escape_string($_POST['edit_submit_page_id']);
$page_url = $db->real_escape_string($_POST['edit_submit_page_url']);
$page_title = $db->real_escape_string($_POST['edit_submit_page_title']);
$page_description = $db->real_escape_string($_POST['edit_submit_page_description']);
$page_name = $db->real_escape_string($_POST['edit_submit_page_name']);
$page_content = $db->real_escape_string($_POST['edit_submit_page_content']);

$query = ("UPDATE group_pages SET page_title = '$page_title', page_description = '$page_description', page_name = '$page_name', page_content = '$page_content' WHERE page_id = '$page_id'");
$result=$db->query($query);

header("Location:http://www.climatepedia.org/admin?console=group&action=success&type=edit&query=page&title=" . $page_name . "&url=" . $page_url);






















?>