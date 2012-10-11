<?php







if($_POST['new_submit_photos_description5'] != "") {

$total_images = 5;

}

elseif($_POST['new_submit_photos_description4'] != "") {

$total_images = 4;

}

elseif($_POST['new_submit_photos_description3'] != "") {

$total_images = 3;

}

elseif($_POST['new_submit_photos_description2'] != "") {

$total_images = 2;

}

else {

$total_images = 1;

}



//This function reads the extension of the file. It is used to determine if the file  is an image by checking the extension.
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }

//define a maxim size for the uploaded images in Kb
 define ("MAX_SIZE","500"); 

$i = 1;

//checks if the form has been submitted
 if(isset($_POST['Submit'])) 
 
 {
 	
 include("inc.admin-user.connect.php");
 $query = ("SELECT image_counter FROM media_images ORDER BY image_counter DESC LIMIT 1");
 $result=$db->query($query);
 	while($row=$result->fetch_array()) {
	
	$database_total = $row['image_counter'];
	
	}
	
 $query = ("SELECT image_selector FROM media_images ORDER BY image_selector DESC LIMIT 1");
 $result=$db->query($query);
 	while($row=$result->fetch_array()) {
	
	$image_selector = $row['image_selector'];
	
	}
	

	$database_total++;
	$c = $database_total;
	$g = $image_selector;

while($i <= $total_images) {

// 
//
// SCRIPT FOR MAIN IMAGE
//
//

//This variable is used as a flag. The value is initialized with 0 (meaning no error  found)  
//and it will be changed to 1 if an errro occures.  
//If the error occures the file will not be uploaded.
 $errors=0;


 	//reads the name of the file the user submitted for uploading
 	$image=$_FILES['image' . $i]['name'];
 	//if it is not empty
 	if ($image) 
 	{
 	//get the original name of the file from the clients machine
 		$filename = stripslashes($_FILES['image' . $i]['name']);
 	//get the extension of the file in a lower case format
  		$extension = getExtension($filename);
 		$extension = strtolower($extension);
 	//if it is not a known extension, we will suppose it is an error and will not  upload the file,  
	//otherwise we will do more tests
 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
 		{
		//print error message
 			$error_message = "Unknown extension!";
 			$errors=1;
 			header("Location:http://www.climatepedia.org/beta/newclimate/admin.php?console=media&action=failure&type=image&error_message=" . $error_message);
 		}
 		else
 		{
//get the size of the image in bytes
 //$_FILES['image']['tmp_name'] is the temporary filename of the file
 //in which the uploaded file was stored on the server
 $size=filesize($_FILES['image' . $i]['tmp_name']);

//compare the size with the maxim size we defined and print error if bigger
if ($size > MAX_SIZE*1024)
{
	$error_message = '<h1>You have exceeded the size limit!</h1>';
	$errors=1;
 	header("Location:http://www.climatepedia.org/beta/newclimate/admin.php?console=media&action=failure&type=image&error_message=" . $error_message);
}

//we will give an unique name, for example the time in unix time format
$image_name= $c .'.' . $extension;
//the new name will be containing the full path where will be stored (images folder)
$newname="images_media/images_full/".$image_name;
//we verify if the image has been uploaded, and print error instead
$copied = copy($_FILES['image' . $i]['tmp_name'], $newname);
if (!$copied) 
{
	$error_message = "Copy unsuccessfull!";
	$errors=1;
 	header("Location:http://www.climatepedia.org/beta/newclimate/admin.php?console=media&action=failure&type=image&error_message=" . $error_message);
}}

include ("inc.admin-user.connect.php");

$album_id = $_POST['new_submit_photos_album'];
$image_path = $image_name;
$image_description = $db->real_escape_string($_POST['new_submit_photos_description' . $i]);
$image_tag = $db->real_escape_string($_POST['new_submit_photos_tag' . $i]);
$image_source = $db->real_escape_string($_POST['new_submit_photos_source' . $i]);

$query = ("INSERT INTO media_images (image_counter, image_album, image_path, image_description, image_tag, image_source, image_selector) VALUES ('$c', '$album_id', '$image_path', '$image_description', '$image_tag', '$image_source', '$g')");
$result = $db->query($query);


}

//
//
//	UPDATE TAGS
//
//

include ("inc.admin-user.connect.php");
$tag = $_POST['new_submit_photos_tag' . $i];
$query = ("UPDATE climate_tags SET tag_photos = tag_photos+1 WHERE tag_id = '$tag'");
$result=$db->query($query);




//
//
//	SCRIPT FOR THUMBNAIL
//
//

//This variable is used as a flag. The value is initialized with 0 (meaning no error  found)  
//and it will be changed to 1 if an errro occures.  
//If the error occures the file will not be uploaded.
 $errors=0;


 	//reads the name of the file the user submitted for uploading
 	$image=$_FILES['thumbnail' . $i]['name'];
 	//if it is not empty
 	if ($image) 
 	{
 	//get the original name of the file from the clients machine
 		$filename = stripslashes($_FILES['thumbnail' . $i]['name']);
 	//get the extension of the file in a lower case format
  		$extension = getExtension($filename);
 		$extension = strtolower($extension);
 	//if it is not a known extension, we will suppose it is an error and will not  upload the file,  
	//otherwise we will do more tests
 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
 		{
		//print error message
 			$error_message = "Unknown extension!";
 			$errors=1;
 			header("Location:http://www.climatepedia.org/beta/newclimate/admin.php?console=media&action=failure&type=image&error_message=" . $error_message);
 		}
 		else
 		{
//get the size of the image in bytes
 //$_FILES['image']['tmp_name'] is the temporary filename of the file
 //in which the uploaded file was stored on the server
 $size=filesize($_FILES['thumbnail' . $i]['tmp_name']);

//compare the size with the maxim size we defined and print error if bigger
if ($size > MAX_SIZE*1024)
{
	$error_message = '<h1>You have exceeded the size limit!</h1>';
	$errors=1;
 	header("Location:http://www.climatepedia.org/beta/newclimate/admin.php?console=media&action=failure&type=image&error_message=" . $error_message);
}

//we will give an unique name, for example the time in unix time format
$image_name= $c . '_thumb.' . $extension;
//the new name will be containing the full path where will be stored (images folder)
$newname="images_media/images_thumbs/".$image_name;
//we verify if the image has been uploaded, and print error instead
$copied = copy($_FILES['thumbnail' . $i]['tmp_name'], $newname);
if (!$copied) 
{
	$error_message = "Copy unsuccessfull!";
	$errors=1;
 	header("Location:http://www.climatepedia.org/beta/newclimate/admin.php?console=media&action=failure&type=image&error_message=" . $error_message);
}}



}









$i++;
$c++; // used to keep track of unique identifier names for images

}




}



	$album_id = $_POST['new_submit_photos_album'];
 	include ("inc.admin-user.connect.php");
 	$query = ("UPDATE media_albums SET album_count = album_count+'$total_images' WHERE album_id = '$album_id'");
 	$result=$db->query($query);
 	
 	$query = ("SELECT album_id, album_name, album_url FROM media_albums WHERE album_id='$album_id'");
	$result=$db->query($query);
 	
 	while($row=$result->fetch_array()) {
 	
	$album_url = $row['album_url']; 	
	$album_name = $row['album_name']; 	 	
 	}
 
 	
 	
	header("Location:http://www.climatepedia.org/beta/newclimate/admin.php?console=media&action=success&type=new&query=photos&url=" . $album_url . "&title=" . $album_name . "&total=" . $total_images);


 ?>