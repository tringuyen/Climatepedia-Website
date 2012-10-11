<?php

include ("inc.admin-user.connect.php");

$album_name = $db->real_escape_string($_POST['new_submit_album_name']);
$album_type = $db->real_escape_string($_POST['new_submit_album_type']);
$album_description = $db->real_escape_string($_POST['new_submit_album_description']);
$album_url = $db->real_escape_string($_POST['new_submit_album_url']);


$query = ("INSERT INTO media_albums (album_type, album_name, album_description, album_url) VALUES ('$album_type', '$album_name', '$album_description', '$album_url')");
$result=$db->query($query);

header("Location:http://www.climatepedia.org/admin?console=media&action=success&type=new&query=album&title=" . $album_name);












?>