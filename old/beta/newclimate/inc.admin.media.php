<?php

?>
<div id="admin_left">
<div id="admin_actions">
<p>Actions</p>
<ul>
<li><a href="admin.php?console=media&action=new_photos" >New Photos</a></li>
<li><a href="admin.php?console=media&action=choose_photos" >Edit Photos</a></li>
<li><a href="admin.php?console=media&action=new_album" >New Album</a></li>
<li><a href="admin.php?console=media&action=choose_albums" >Edit Albums</a></li>
<li><a href="admin.php?console=media&action=new_video" >New Video</a></li>
<li><a href="admin.php?console=media&action=choose_video" >Edit Video</a></li>
</ul>
</div>
<div id="admin_directions">
<p id="directions_header">Help</p>
<?php if($_GET["action"] == "new_news") {
	
	echo $new_news_directions;
	
}

elseif($_GET["action"] == "choose_news") {
	
	echo $choose_news_directions;
	
}

elseif($_GET["action"] == "edit_news") {
	
	echo $edit_news_directions;
	
}


elseif($_GET["action"] == "edit_tags") {
	
	echo $edit_newstags_directions;
	
}

elseif($_GET["action"] == "new_feeds") {
	
	echo $new_feeds_directions;
	
}

elseif($_GET["action"] == "choose_feeds") {
	
	echo $choose_feeds_directions;
	
}

elseif($_GET["action"] == "edit_feeds") {
	
	echo $edit_feeds_directions;
	
}


elseif($_GET["action"] == "success") {
	
	echo $success_directions;	
	
}

?>

</div>


</div>
<div id="admin_right">
<div id="admin_command">
<div id="admin_media">
<?php 

// Check if the user just completed an action



if($_GET["action"] == "success") {

// Check if it was an edit

if($_GET["type"] == "edit") {



// Check if they edited news

if($_GET["query"] == "images") {

// check if they altered images (v.s. deleting later)

if($_GET["function"] == "alter") {

$image_id = $_GET["id"];

echo ("<div id=editing_images><p>The updated information is shown below</p>");

include ("inc.admin-user.connect.php");
$query = ("SELECT image_id, image_path, image_description, image_source  FROM media_images WHERE image_id='$image_id'");
$result=$db->query($query);

while($row=$result->fetch_array()) {

$image_description = htmlspecialchars($row['image_description'], ENT_QUOTES);
$image_source = htmlspecialchars($row['image_source'], ENT_QUOTES);


echo ("

<img class=editable_image src=http://www.climatepedia.org/beta/newclimate/images_media/images_full/" . $row['image_path'] . ">
<img class=editable_image src=http://www.climatepedia.org/beta/newclimate/images_media/images_thumbs/" . $row['image_id'] . ">
<a class=editable_image_link target=blank href=http://www.climatepedia.org/beta/newclimate/images_media/images_full/" . $row['image_path'] . ">Link to full-size version</a><p style=clear:none;padding-left:5px;line-height:20px;margin-top:0><small>(opens in a new tab)</small></p>
<p style=clear:left;padding-right:5px><strong>Description:</strong> </p><p class=editable_image_description>" . $image_description . "</p>
<p style=clear:left;padding-right:5px><strong>Source:</strong> </p><p class=editable_image_source>" . $image_source . "</p>
</div>
");

}

}

// check if they deleted an image

if($_GET["function"] == "delete") {
	
echo ("<p>Whatta <strong>BAMF</strong>, you sir/madam successfully deleted the image. In fact, it's SO gone that I can't even tell you which one it was. It's like Chuck Norris was here...</p>");
	
}




}

// Check if they edited a video

elseif($_GET["query"] == "video") {

$new_video = urldecode($_GET['title']);
$new_video_stripped = stripslashes($new_video);

echo ("

<h1>You successfully edited a video!</h1>
<p>You can find the video you edited here: <a href=/beta/newclimate/media/album/" . $_GET['albumurl'] . "/" . $_GET['videourl'] . " target=_blank>" . $new_video_stripped . "</a>.</p>

");




}


// Check if they edited an album

elseif($_GET["query"] == "album") {

$new_album = urldecode($_GET['title']);
$new_album_stripped = stripslashes($new_album);

echo ("

<h1>You successfully edited an album!</h1>
<p>The album you edited was: " . $new_album_stripped . ".</p>
");



}

// Catch error

else {

echo ("<p>There appears to have been an error, please go back and try again. Sorry about that.</p>");


}

} // Closes off "edit" check

// Check if they created a new something

elseif($_GET["type"] == "new") {





if($_GET["query"] == "photos") {


// check for plurality

$new_album = urldecode($_GET['title']);
$new_album_stripped = stripslashes($new_album);

if($_GET['total'] < 2) {

echo ("

<h1>Congrats, your new photo was uploaded.</h1>
<p>You can view the new photo in the album here: <a target=blank href=http://www.climatepedia.org/beta/newclimate/media/album/" . $_GET['url'] . ">" . $new_album_stripped . "</a>.</p>

");

}

else {
	
echo ("

<h1>Congrats, your new photos were uploaded.</h1>
<p>You can view the new photos in the album here: <a href=http://www.climatepedia.org/beta/newclimate/media/album/" . $_GET['url'] . ">" . $new_album_stripped . "</a>.</p>

");

}


}




// Did they create a video?

elseif($_GET["query"] == "video") {

$new_video = urldecode($_GET['title']);
$new_video_stripped = stripslashes($new_video);

echo ("

<h1>You successfully created a video!</h1>
<p>You can find the video you created here: <a href=/beta/newclimate/media/album/" . $_GET['albumurl'] . "/" . $_GET['videourl'] . " target=_blank>" . $new_video_stripped . "</a>.</p>

");

}



// did they create an album?

elseif($_GET["query"] == "album") {

$new_album = urldecode($_GET['title']);
$new_album_stripped = stripslashes($new_album);

echo ("

<h1>You successfully created an album!</h1>
<p>The album you created was: " . $new_album_stripped . ".</p>
");

}

// Missing variable, catch error

else {
	
	echo ("<p>There appears to have been an error, please go back and try again. Sorry about that.</p>");

}



} // closes off "new" check


} // closes off "success" check



//
//
// New Photos
//
//


elseif($_GET["action"] == "new_photos") {


echo ("

<h1 class=news_header>New Photos</h1>
<p style=padding-bottom:15px><small>(You can upload 5 photos at a time, and they must be .jpg (lowercase). Make sure to upload matching full-sized and thumbnail versions. Full-sized should have a maximum width of 1000px and size of 150kbs. Thumbnails should be exactly 135px by 110px and have a max size of 15kbs.)</small></p>



");


$upload_image_limit = 5; // How many images you want to upload at once?


echo ("

<form method=POST enctype=multipart/form-data action=inc.admin.new-media-photos.php>
<select id=check_select name=new_submit_photos_album><option value='N'>Choose an album to upload images to</option>
");

include ("inc.admin-user.connect.php");
$query = ("SELECT album_id, album_type, album_name, album_count FROM media_albums WHERE album_type = 1 ORDER by album_name ASC");
$result = $db->query($query);

while($row = $result->fetch_array()) {
	
	echo ("
	
		<option value=" . $row['album_id'] . ">" . $row['album_name'] . " (" . $row['album_count'] . ")</option>
	
	");
	
}

echo ("</select>");

$i = 1;
	while($i <= $upload_image_limit){
		
		echo 
		
		'<label style=margin-top:50px><strong>Image '.$i.': </strong></label><input style=margin-top:50px type="file" name=image' . $i . '>
		<label style=margin-top:4px><strong>Thumbnail '.$i.': </strong></label><input style=margin-top:4px type="file" name=thumbnail' . $i . '>
		<label style=margin-top: 4px>Image '. $i . ' description <small>(required)</small>: </label><input type=text name=new_submit_photos_description' . $i . '>
		<label style=margin-top: 4px>Image '. $i . ' source: </label><input type=text name=new_submit_photos_source' . $i . '>';
		
		include("inc.admin-user.connect.php");

		$query="SELECT tag_id, tag_name, tag_photos FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);

				echo ("<label>Tag " . $i . ":</label><select style=line-height:40px;margin-top:15px name=new_submit_photos_tag" . $i . "><option>Select Tag " . $i . "</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_photos"] . ")</option>");

				}
				
		echo ("</select>");
		
	$i++;
	}

echo ("

		<input name=Submit class=generic_admin_button type=submit value='Upload Photos!' style=margin-top:50px >
		</form>

	
");











}


//
//
// Choose Photo Albums for Photos
//
//


elseif($_GET["action"] == "choose_photos") {

echo ("

<h1 class=news_header>Choose which album's photos to edit</h1>
<p style=padding-bottom:15px><small>(Choose an album)</small></p>

");

include("inc.admin-user.connect.php");

$query="SELECT album_id, album_type, album_name, album_count FROM media_albums ORDER BY album_name ASC";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

				echo ("<a class=choose_media_link href=admin.php?console=media&action=edit_photos&albumid=" . $row["album_id"] . ">" . $row["album_name"] . "</a><p class=choose_media_date>Number of photos: " . $row['album_count'] . "</p>");
				
				}


}

//
//
// Edit Photos
//
//


elseif($_GET["action"] == "edit_photos") {

echo ("	
	
");

$album_id = $_GET['albumid'];

include("inc.admin-user.connect.php");

$query="SELECT album_id, album_name FROM media_albums WHERE album_id = '$album_id'";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

				$album_name = $row['album_name'];
					
				}
	
	
	
echo ("

<h1>Edit images for '" . $album_name . "'</h1>
<p style=padding-bottom:15px><small>(You can edit one image at a time. If you need to change an image or its thumbnail you must delete it and then re-upload it.)</small></p>
<div id=editing_images>

");



include ("inc.admin-user.connect.php");

$query = ("SELECT * FROM media_images WHERE image_album = '$album_id' ORDER BY image_order ASC");
$result=$db->query($query);

$image_number = 0;

while($row=$result->fetch_array()) {

$image_description = htmlspecialchars($row['image_description'], ENT_QUOTES);
$image_source = htmlspecialchars($row['image_source'], ENT_QUOTES);
$image_id = $row['image_id'];


echo ("
<form method=POST action=inc.admin.edit-media-photos.php style=float:left;clear:left>
<div id=image" . $image_number . ">

<img class=editable_image id=image_edit" . $image_number . " src=http://www.climatepedia.org/beta/newclimate/images_media/images_full/" . $row['image_path'] . ">
<img class=editable_image id=image_thumb" . $image_number . " src=http://www.climatepedia.org/beta/newclimate/images_media/images_thumbs/" . $row['image_counter'] . "_thumb.jpg>
<input type=hidden name=edit_submit_image_path value=" . $row['image_path'] . ">

<a class=editable_image_link target=blank href=http://www.climatepedia.org/beta/newclimate/images_media/images_full/" . $row['image_path'] . ">Link to full-size version</a><p style=clear:none;padding-left:5px;line-height:20px;margin-top:0><small>(opens in a new tab)</small></p>
<p style=clear:left;padding-right:5px><strong>Description:</strong> </p><p id=image" . $image_number . "_description class=editable_image_description>" . $image_description . "</p>
<p style=clear:left;padding-right:5px><strong>Source:</strong> </p><p id=image" . $image_number . "_source class=editable_image_source>" . $image_source . "</p>
<a id=edit_image". $image_number . "_trigger style=margin-top:5px title=" . $row['image_id'] . " class=editable_image_trigger href=image" . $image_number . ">&uarr; Edit this image</a>
<a id=delete_image". $image_number . "_trigger style=margin-bottom:30px;margin-top:5px class=delete_image_trigger href=" . $row["image_id"] . "><span style=color:red>X </span>Delete this image</a>

</div>
</form>
");

$image_number++;

}

echo ("
</div>

");
	










}




//
//
// Create New Album
//
//


elseif($_GET["action"] == "new_album") {

echo ("

<h1 class=news_header>Create a new album</h1>
<p style=padding-bottom:15px><small>(You can add one new photo or video album at a time.)</small></p>
<form method=POST action=inc.admin.new-album.php>

<label class=label_extratop>Album Type <span class=label_note></span></label><br>
<label style=margin-top:0;width:45px class=article_radio>Photos</label><input class=article_radio_input type=radio name=new_submit_album_type value=1>
<label style=margin-top:0;width:45px class=article_radio>Videos</label><input class=article_radio_input type=radio name=new_submit_album_type value=2>

<label>Album Name <span class=label_note></label><br>
<input class=input_clear type=text name=new_submit_album_name>

<label>Album Description <span class=label_note>(This is the title of the page in Google search)</label><br>
<div class=textarea_wrapper>
<textarea id=blogdescription_textarea name=new_submit_album_description></textarea>
</div>

<label>Album URL <span class=label_note>(words separated by dashes, cannot be changed. Ex: students-of-climate-change)</label><br>
<input class=input_clear type=text name=new_submit_album_url>

<input id=submit class=generic_admin_button type=submit value='Create the album'>
</form>




");

}


//
//
// Choose Album
//
//

elseif($_GET["action"] == "choose_albums") {
	
echo ("

<h1 class=news_header>Choose which album to edit</h1>
<p style=padding-bottom:15px><small>(Choose an album)</small></p>

");

include("inc.admin-user.connect.php");

$query="SELECT album_id, album_type, album_name, album_count FROM media_albums ORDER BY album_name ASC";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

				echo ("<a class=choose_media_link href=admin.php?console=media&action=edit_album&albumid=" . $row["album_id"] . ">" . $row["album_name"] . "</a><p class=choose_media_date>Type: "); if($row['album_type'] == 1) { echo "Photos"; } else { echo "Videos"; } echo ("</p>");
				
				}

	
}

//
//
// Edit Album
//
//

elseif($_GET["action"] == "edit_album") {
	
include("inc.admin-user.connect.php");

$album_id = $_GET['albumid'];

$query="SELECT album_id, album_type, album_name, album_description, album_url FROM media_albums WHERE album_id = '$album_id'";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

				$album_type = $row['album_type'];
				$album_name = htmlspecialchars($row['album_name'], ENT_QUOTES);
				$album_description = htmlspecialchars($row['album_description'], ENT_QUOTES);
				$album_url = $row['album_url'];			
				}
	
	
	
echo ("

<h1 class=news_header>Edit an album</h1>
<p style=padding-bottom:15px><small>(You can change the default picture of an album from the edit photos interface.)</small></p>
<form method=POST action=inc.admin.edit-album.php>
<input type=hidden name=edit_submit_album_id value='" . $album_id . "'>
");

if($album_type == 1) {

echo ("

<label class=label_extratop>Album Type <span class=label_note></span></label><br>
<label style=margin-top:0;width:45px class=article_radio>Photos</label><input class=article_radio_input type=radio name=edit_submit_album_type value=1 checked>
<label style=margin-top:0;width:45px class=article_radio>Videos</label><input class=article_radio_input type=radio name=edit_submit_album_type value=2>

");


} else {

echo ("

<label class=label_extratop>Album Type <span class=label_note></span></label><br>
<label style=margin-top:0;width:45px class=article_radio>Photos</label><input class=article_radio_input type=radio name=edit_submit_album_type value=1>
<label style=margin-top:0;width:45px class=article_radio>Videos</label><input class=article_radio_input type=radio name=edit_submit_album_type value=2 checked>

");

}

echo ("

<label>Album Name <span class=label_note></label><br>
<input class=input_clear type=text name=edit_submit_album_name value='" . $album_name . "'>

<label>Album Description <span class=label_note>(This is the title of the page in Google search)</label><br>
<div class=textarea_wrapper>
<textarea id=blogdescription_textarea name=edit_submit_album_description>" . $album_description . "</textarea>
</div>

<label>Album URL <span class=label_note>(Ask Alex to change this is needed)</span> " . $album_url . "</label>

<input id=submit class=generic_admin_button type=submit value='Submit your edits'>
</form>

");

}


//
//
//	New Video
//
//



elseif($_GET["action"] == "new_video") {

echo ("

<h1 class=news_header>Create a new video</h1>
<p style=padding-bottom:15px><small>(NOTE: All Youtube videos must have the code below added to the end of the src= part of the code within the quotes)<br><strong> ?wmode=opaque</strong></small></p>
<form method=POST action=inc.admin.new-video.php>
<select id=check_select name=new_submit_video_album><option value='N'>Choose an album to upload images to</option>
");

include ("inc.admin-user.connect.php");
$query = ("SELECT album_id, album_type, album_name, album_count FROM media_albums WHERE album_type = 2 ORDER by album_name ASC");
$result = $db->query($query);

while($row = $result->fetch_array()) {
	
	echo ("
	
		<option value=" . $row['album_id'] . ">" . $row['album_name'] . " (" . $row['album_count'] . ")</option>
	
	");
	
}

echo ("</select>");

echo ("

<label>Video Name <span class=label_note></label><br>
<input class=input_clear type=text name=new_submit_video_name>

<label>Video Code <span class=label_note>(You get this by clicking 'embed' in Youtube.)</label><br>
<div class=textarea_wrapper>
<textarea name=new_submit_video_code></textarea>
</div>

<label>Video Description <span class=label_note>(Try to make this as long and comprehensive as possible.)</label><br>
<div class=textarea_wrapper>
<textarea name=new_submit_video_description></textarea>
</div>

");

include("inc.admin-user.connect.php");

$query="SELECT tag_id, tag_name, tag_videos FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);

				echo ("<label style=margin-top:40px>Tag 1:</label><select style=line-height:40px;margin-top:45px name=new_submit_video_tag1><option>Select Tag 1</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_videos"] . ")</option>");

				}

$query="SELECT tag_id, tag_name, tag_videos FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);

				echo ("</select><label>Tag 2:</label><select style=line-height:40px;margin-top:15px name=new_submit_video_tag2><option>Select Tag 2</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_videos"] . ")</option>");

				}
				
$query="SELECT tag_id, tag_name, tag_videos FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);

				echo ("</select><label>Tag 3:</label><select style=line-height:40px;margin-top:15px name=new_submit_video_tag3><option>Select Tag 3</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_videos"] . ")</option>");

				}
				echo ("</select>");	



echo ("

<label style=margin-top:20px>Video URL <span class=label_note>(words separated by dashes, cannot be changed. Ex: dr-stephen-schneider-on-climate-change-science-expert-credibility)</label><br>
<input class=input_clear type=text name=new_submit_video_url>

<label style=margin-top:20px>Video Date <span class=label_note>(YYYY-MM-DD format. Ex: 2011-09-14)</label><br>
<input class=input_clear type=text name=new_submit_video_date>


<input id=submit class=generic_admin_button type=submit value='Create the video'>
</form>




");

}


//
//
// Choose Video
//
//


elseif($_GET["action"] == "choose_video") {

echo ("

<h1 class=news_header>Choose a Video to Edit</h1>
<p style=padding-bottom:15px><small>(Sorted by most recent)</small></p>
");

include("inc.admin-user.connect.php");

$query="SELECT video_id, video_name, video_date FROM media_videos ORDER BY video_date DESC";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

				echo ("<a class=choose_media_link href=admin.php?console=media&action=edit_video&videoid=" . $row["video_id"] . ">" . $row["video_name"] . "</a><p class=choose_media_date>posted: " . $row["video_date"] . "</p>");
				
				}

}







//
//
//	Edit Video
//
//



elseif($_GET["action"] == "edit_video") {

$video_id = $_GET['videoid'];

include("inc.admin-user.connect.php");
$query = ("SELECT * FROM media_videos WHERE video_id = '$video_id'");
$result=$db->query($query);
while($row=$result->fetch_array()) {

$video_name = htmlspecialchars($row['video_name'], ENT_QUOTES);
$video_album = $row['video_album'];
$video_description = $row['video_description'];
$video_tag1 = $row['video_tag1'];
$video_tag2 = $row['video_tag2'];
$video_tag3 = $row['video_tag3'];
$video_code = $row['video_code'];
$video_url = $row['video_url'];
$video_date = $row['video_date'];

}


echo ("

<h1 class=news_header>Edit a video</h1>
<p style=padding-bottom:15px><small>(NOTE: All Youtube videos must have the code below added to the end of the src= part of the code within the quotes)<br><strong> ?wmode=opaque</strong></small></p>
<form method=POST action=inc.admin.edit-video.php>
<input type=hidden name=edit_submit_video_id value='" . $video_id . "'>
<input type=hidden name=edit_submit_video_oldalbum value='" . $video_id . "'>
<input type=hidden name=edit_submit_video_oldtag1 value='" . $video_tag1 . "'>
<input type=hidden name=edit_submit_video_oldtag2 value='" . $video_tag2 . "'>
<input type=hidden name=edit_submit_video_oldtag3 value='" . $video_tag3 . "'>

");

include("inc.admin-user.connect.php");
$query = ("SELECT tag_id, tag_name, tag_videos FROM climate_tags WHERE tag_id = '$video_tag1'");
$result=$db->query($query);
while($row=$result->fetch_array()) {

$video_tag1_name = $row['tag_name'];
$video_tag1_count = $row['tag_videos'];

}

$query = ("SELECT tag_id, tag_name, tag_videos FROM climate_tags WHERE tag_id = '$video_tag2'");
$result=$db->query($query);
while($row=$result->fetch_array()) {

$video_tag2_name = $row['tag_name'];
$video_tag2_count = $row['tag_videos'];

}

$query = ("SELECT tag_id, tag_name, tag_videos FROM climate_tags WHERE tag_id = '$video_tag3'");
$result=$db->query($query);
while($row=$result->fetch_array()) {

$video_tag3_name = $row['tag_name'];
$video_tag3_count = $row['tag_videos'];

}

$query = ("SELECT album_id, album_name, album_count FROM media_albums WHERE album_id = '$video_album'");
$result=$db->query($query);
while($row=$result->fetch_array()) {
	
$video_album_name = $row['album_name'];
$video_album_count = $row['album_count'];

}

echo ("

<select id=check_select name=edit_submit_video_album><option value='" . $video_album . "'>" . $video_album_name . " (" . $video_album_count . ")</option>

");

include ("inc.admin-user.connect.php");
$query = ("SELECT album_id, album_type, album_name, album_count FROM media_albums WHERE album_type = 2 ORDER by album_name ASC");
$result = $db->query($query);

while($row = $result->fetch_array()) {
	
	echo ("
	
		<option value=" . $row['album_id'] . ">" . $row['album_name'] . " (" . $row['album_count'] . ")</option>
	
	");
	
}




echo ("</select>");

echo ("

<label>Video Name <span class=label_note></label><br>
<input class=input_clear type=text name=edit_submit_video_name value='" . $video_name . "'>

<label>Video Code <span class=label_note>(You get this by clicking 'embed' in Youtube.)</label><br>
<div class=textarea_wrapper>
<textarea name=edit_submit_video_code>" . $video_code . "</textarea>
</div>

<label>Video Description <span class=label_note>(Try to make this as long and comprehensive as possible.)</label><br>
<div class=textarea_wrapper>
<textarea name=edit_submit_video_description>" . $video_description . "</textarea>
</div>

");

include("inc.admin-user.connect.php");

$query="SELECT tag_id, tag_name, tag_videos FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);

				echo ("<label style=margin-top:40px>Tag 1:</label><select style=line-height:40px;margin-top:45px name=edit_submit_video_tag1><option value='" . $video_tag1 . "'>" . $video_tag1_name . " (" . $video_tag1_count . ")</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_videos"] . ")</option>");

				}

$query="SELECT tag_id, tag_name, tag_videos FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);

				echo ("</select><label>Tag 2:</label><select style=line-height:40px;margin-top:15px name=edit_submit_video_tag2><option value='" . $video_tag2 . "'>" . $video_tag2_name . " (" . $video_tag2_count . ")</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_videos"] . ")</option>");

				}
				
$query="SELECT tag_id, tag_name, tag_videos FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);

				echo ("</select><label>Tag 3:</label><select style=line-height:40px;margin-top:15px name=edit_submit_video_tag3><option value='" . $video_tag3 . "'>" . $video_tag3_name . " (" . $video_tag3_count . ")</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_videos"] . ")</option>");

				}
				echo ("</select>");	



echo ("

<label style=margin-top:20px>Video URL <span class=label_note>(Ask Alex if you need to chagne this)</span> " . $video_url . "</label><br>

<label style=margin-top:20px>Video Date <span class=label_note>(YYYY-MM-DD format. Ex: 2011-09-14)</label><br>
<input class=input_clear type=text name=edit_submit_video_date value=" . $video_date . ">


<input id=submit class=generic_admin_button type=submit value='Submit video edits'>
</form>




");

}






//
//
// That's all of the actions! Below are the scripts
//
//

?>

<!-- page scripts -->
<script type="text/javascript" >

$(document).ready(function(){
	
	
	
	
	
});

// Editing images script

$(".editable_image_trigger").live("click", function(){
	
	window.the_image_id = $(this).attr("title");
	window.the_image = $(this).attr("href").replace(/'/g, "&#39;");
	window.the_description = $("#" + window.the_image + "_description").text().replace(/'/g, "&#39;");
	window.the_source = $("#" + window.the_image + "_source").text();
	
	$("#" + window.the_image + "_description").replaceWith("<input id=description_input_" + window.the_image + " type=text name=edit_submit_image_description value='" + window.the_description + "'>");
	$("#" + window.the_image + "_source").replaceWith("<input id=source_input_" + window.the_image + " name=edit_submit_image_source type=text value='" + window.the_source + "'>");
	
	$(this).after("<input id=editing_image_id name=edit_submit_image_id type=hidden value=" + window.the_image_id + ">");
	$(this).after("<input id=submit_image_edits class=generic_admin_button type=submit value='Submit your changes'>");
	$("#edit_" + window.the_image + "_trigger").replaceWith("<a style=margin-top:5px;margin-bottom:30px id=stop_edit_" + window.the_image + "_trigger href=# class=stop_edit>&uarr; Stop editing this image</a>");
	
	
	
	return false;

});

$(".stop_edit").live("click", function(){
	
	$("#description_input_" + window.the_image).replaceWith("<p id=" + window.the_image + "_description  class=editable_image_source>" + window.the_description + "</p>");
	$("#source_input_" + window.the_image).replaceWith("<p id=" + window.the_image + "_source  class=editable_image_description>" + window.the_source + "</p>");
	
	$("#editing_image_id").remove();
	$("#submit_image_edits").remove();
	$("#stop_edit_" + window.the_image + "_trigger").replaceWith("<a style=margin-top:5px id=edit_" + window.the_image + "_trigger href=" + window.the_image + " class=editable_image_trigger>&uarr; Edit this image</a>");
	return false;
	

});



$(".delete_image_trigger").click(function(){
	
	window.button_clicked = $(this).attr("id")
	window.image_deleting = $(this).attr("href");

	function show_confirm()
		{		
			var r=confirm("Are you sure you want to delete this image?");
			if (r==true)
  		{

		$("#" + window.button_clicked).html("<span style=color:red>!! The image above will be deleted when you click the button below</span>");
		$("#" + window.button_clicked).after("<input type=hidden name=edit_submit_delete_image value=" + window.image_deleting + ">");
		$("#" + window.button_clicked).after("<input id=submit_image_edits class=generic_admin_button type=submit value='Submit your changes'>");
		return false;

  		}

	else
  		
  		{

		return false;

  		}
  		
		}
		
	show_confirm();
	
	return false;
	
});




</script>



</div> <!-- closes off admin_news -->
</div> <!-- closes off admin_command -->
</div> <!-- closes off admin_right -->