<?php

include ("inc.admin-user.connect.php");

$album_id = $db->real_escape_string($_POST['edit_submit_album_id']);
$album_name = $db->real_escape_string($_POST['edit_submit_album_name']);
$album_type = $db->real_escape_string($_POST['edit_submit_album_type']);
$album_description = $db->real_escape_string($_POST['edit_submit_album_description']);

$query = ("UPDATE media_albums SET album_name = '$album_name', album_type = '$album_type', album_description = '$album_description' WHERE album_id = '$album_id'");
$result=$db->query($query);

header("Location:http://www.climatepedia.org/beta/newclimate/admin?console=media&action=success&type=edit&query=album&title=" . $album_name);












?>