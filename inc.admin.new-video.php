<?php

include("inc.admin-user.connect.php");

$video_album = $db->real_escape_string($_POST['new_submit_video_album']);
$video_name = $db->real_escape_string($_POST['new_submit_video_name']);
$video_description = $db->real_escape_string($_POST['new_submit_video_description']);
$video_tag1 = $db->real_escape_string($_POST['new_submit_video_tag1']);
$video_tag2 = $db->real_escape_string($_POST['new_submit_video_tag2']);
$video_tag3 = $db->real_escape_string($_POST['new_submit_video_tag3']);
$video_code = $db->real_escape_string($_POST['new_submit_video_code']);
$video_date = $db->real_escape_string($_POST['new_submit_video_date']);
$video_url = $db->real_escape_string($_POST['new_submit_video_url']);

$query = ("INSERT INTO media_videos (video_album, video_name, video_description, video_tag1, video_tag2, video_tag3, video_code, video_url, video_date) VALUES ('$video_album', '$video_name', '$video_description', '$video_tag1', '$video_tag2', '$video_tag3', '$video_code', '$video_url', '$video_date')");
$result=$db->query($query);

// update climate tag counts
$query = ("UPDATE climate_tags SET tag_videos=tag_videos+1 WHERE tag_id = '$video_tag1' OR tag_id = '$video_tag2' OR tag_id = '$video_tag3'");
$result=$db->query($query);

$query = ("SELECT album_id, album_url FROM media_albums WHERE album_id = '$video_album'");
$result=$db->query($query);

while($row=$result->fetch_array()) {
		
	$album_url = $row['album_url'];
	
}

header("Location:http://www.climatepedia.org/admin?console=media&action=success&type=new&query=video&title=" . $video_name . "&albumurl=" . $album_url . "&videourl=" . $video_url);







?>