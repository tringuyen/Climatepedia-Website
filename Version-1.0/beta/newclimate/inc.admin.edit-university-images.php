<?php

// check if we're deleting an image

if(isset($_POST['edit_submit_delete_image'])) {

$image_path = "images_podium/universities/" . $_POST['edit_submit_image_path'];
$image_id = $_POST['edit_submit_delete_image'];

$fh = fopen($image_path, 'w') or die("can't open file");
fclose($fh);
unlink($image_path);

include ("inc.admin-user-upgraded.connect.php");

$query = ("DELETE FROM podium_images WHERE image_id = '$image_id'");
$result=$db->query($query);

header("Location:http://www.climatepedia.org/beta/newclimate/admin.php?console=podium&action=success&type=edit&query=images&function=delete");

}

else {

include ("inc.admin-user.connect.php");
	
$image_description = $db->real_escape_string($_POST['edit_submit_image_description']);
$image_source = $db->real_escape_string($_POST['edit_submit_image_source']);
$image_id = $_POST['edit_submit_image_id'];
	
$query = ("UPDATE podium_images SET image_description = '$image_description' WHERE image_id = '$image_id'");
$result=$db->query($query);
	
$query = ("UPDATE podium_images SET image_source = '$image_source' WHERE image_id = '$image_id'");
$result=$db->query($query);
	
header("Location:http://www.climatepedia.org/beta/newclimate/admin.php?console=podium&action=success&type=edit&query=images&function=alter&id=" . $image_id);
	
}











?>