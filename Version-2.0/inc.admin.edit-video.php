<?php

include("inc.admin-user.connect.php");

$video_id = $db->real_escape_string($_POST['edit_submit_video_id']);
$video_album = $db->real_escape_string($_POST['edit_submit_video_album']);
$video_name = $db->real_escape_string($_POST['edit_submit_video_name']);
$video_description = $db->real_escape_string($_POST['edit_submit_video_description']);
$video_tag1 = $db->real_escape_string($_POST['edit_submit_video_tag1']);
$video_tag2 = $db->real_escape_string($_POST['edit_submit_video_tag2']);
$video_tag3 = $db->real_escape_string($_POST['edit_submit_video_tag3']);
$video_code = $db->real_escape_string($_POST['edit_submit_video_code']);
$video_date = $db->real_escape_string($_POST['edit_submit_video_date']);

$video_oldalbum = $db->real_escape_string($_POST['edit_submit_video_oldalbum']);
$video_oldtag1 = $db->real_escape_string($_POST['edit_submit_video_oldtag1']);
$video_oldtag2 = $db->real_escape_string($_POST['edit_submit_video_oldtag2']);
$video_oldtag3 = $db->real_escape_string($_POST['edit_submit_video_oldtag3']);

// update the video entry

$query = ("UPDATE media_videos SET video_album = '$video_album', video_name = '$video_name', video_description = '$video_description', video_tag1 = '$video_tag1', video_tag2 = '$video_tag2', video_tag3 = '$video_tag3', video_code = '$video_code', video_date = '$video_date' WHERE video_id = '$video_id'");
$result=$db->query($query);



// check if we have to update climate tag counts

if($video_oldtag1 !== $video_tag1) {
	
$query = ("UPDATE climate_tags SET tag_videos=tag_videos+1 WHERE tag_id = '$video_tag1'");
$result=$db->query($query);

$query = ("UPDATE climate_tags SET tag_videos=tag_videos-1 WHERE tag_id = '$video_oldtag1'");
$result=$db->query($query);

}

if($video_oldtag2 !== $video_tag2) {
	
$query = ("UPDATE climate_tags SET tag_videos=tag_videos+1 WHERE tag_id = '$video_tag2'");
$result=$db->query($query);

$query = ("UPDATE climate_tags SET tag_videos=tag_videos-1 WHERE tag_id = '$video_oldtag2'");
$result=$db->query($query);

}

if($video_oldtag1 !== $video_tag3) {
	
$query = ("UPDATE climate_tags SET tag_videos=tag_videos+1 WHERE tag_id = '$video_tag3'");
$result=$db->query($query);

$query = ("UPDATE climate_tags SET tag_videos=tag_videos-1 WHERE tag_id = '$video_oldtag3'");
$result=$db->query($query);

}

// check if we have to update the album count

if($video_oldalbum !== $video_album) {
	
$query = ("UPDATE media_albums SET album_count = album_count+1 WHERE album_id = '$video_album'");
$result=$db->query($query);

$query = ("UPDATE media_albums SET album_count = album_count-1 WHERE album_id = '$video_oldalbum'");
$result=$db->query($query);

}

$query = ("SELECT album_id, album_url FROM media_albums WHERE album_id = '$video_album'");
$result=$db->query($query);

while($row=$result->fetch_array()) {
		
	$album_url = $row['album_url'];
	
}



header("Location:http://www.climatepedia.org/admin?console=media&action=success&type=edit&query=video&title=" . $video_name . "&albumurl=" . $album_url . "&videourl=" . $video_url);
















?>