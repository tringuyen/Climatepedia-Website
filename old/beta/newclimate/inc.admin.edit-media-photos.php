<?php

// check if we're deleting an image

if(isset($_POST['edit_submit_delete_image'])) {

$image_path = "images_media/images_full/" . $_POST['edit_submit_image_path'];
$image_id = $_POST['edit_submit_delete_image'];

$fh = fopen($image_path, 'w') or die("can't open file");
fclose($fh);
unlink($image_path);

$thumb_path = "images_media/images_thumbs/" . $_POST['edit_submit_delete_image'];
$fh = fopen($thumb_path, 'w') or die("can't open file");
fclose($fh);
unlink($thumb_path);


include ("inc.admin-user-upgraded.connect.php");

$query = ("SELECT image_id, image_album, image_selector FROM media_images WHERE image_id = '$image_id'");
$result=$db->query($query);
while($row=$result->fetch_array()) {

$image_selector = $row['image_selector'];
$image_album = $row['image_album'];

}

$query = ("DELETE FROM media_images WHERE image_id = '$image_id'");
$result=$db->query($query);

$query = ("UPDATE media_albums SET album_count = album_count-1 WHERE album_id = '$image_album'");
$result=$db->query($query);

$query = ("UPDATE media_images SET image_selector = image_selector-1 WHERE image_selector > '$image_counter'");
$result=$db->query($query);


header("Location:http://www.climatepedia.org/beta/newclimate/admin.php?console=media&action=success&type=edit&query=images&function=delete");

}

else {

include ("inc.admin-user.connect.php");
	
$image_description = $db->real_escape_string($_POST['edit_submit_image_description']);
$image_source = $db->real_escape_string($_POST['edit_submit_image_source']);
$image_id = $_POST['edit_submit_image_id'];

	
$query = ("UPDATE media_images SET image_description = '$image_description' WHERE image_id = '$image_id'");
$result=$db->query($query);
	
$query = ("UPDATE media_images SET image_source = '$image_source' WHERE image_id = '$image_id'");
$result=$db->query($query);
	
header("Location:http://www.climatepedia.org/beta/newclimate/admin.php?console=media&action=success&type=edit&query=images&function=alter&id=" . $image_id);
	
}











?>