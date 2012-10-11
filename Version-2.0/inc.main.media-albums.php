<?php


if($_GET['type'] !== "single") {

if($_GET['sort'] == "photos") {

// we're only viewing photos

echo ("<p id=section_note>Click on an album title to see the photos/videos inside of it.</p>");

echo ("<h1 style=font-size:150%;font-weight:100 class=album_header>Climate Change Photo Albums:</h1><div id=photo_albums>");

include("inc.main.connect.php");
$query = ("SELECT * FROM media_albums WHERE album_type = '1'");
$result = $db->query($query);
while($row=$result->fetch_array()) {

echo ("

<div class=album_entry>
<h3><a href=/media/album/" . $row['album_url'] . ">" . $row['album_name'] . "</a> (" . $row['album_count'] . ")</h3>
<p>" . $row['album_description'] . "</p>
</div>
");

}

// photo album for all of our knowledgepedia images

include("inc.main.connect.php");
$query = ("SELECT image_id FROM pedia_images");
$result=$db->query($query);
$count = $result->num_rows;

echo ("

<div class=album_entry>
<h3><a href=/media/album/knowledgepedia-images>Knowledgepedia Images</a> (" . $count . ")</h3>
<p>Images from Climatepedia's Knowledgepedia articles. Topics ranging from aerosols to climate change and nuclear energy.</p>
</div>
");


// photo album for all of our professor post images

include("inc.main.connect.php");
$query = ("SELECT image_id FROM podium_images WHERE image_type = '3'");
$result=$db->query($query);
$count = $result->num_rows;

echo ("

<div class=album_entry>
<h3><a href=/media/album/podium-images>Professor's Podium Images</a> (" . $count . ")</h3>
<p>Images from Climatepedia's Professor posts.</p>
</div>
");


// photo album for all of our blog post images

include("inc.main.connect.php");
$query = ("SELECT image_id FROM blogs_images");
$result=$db->query($query);
$count = $result->num_rows;

echo ("

<div class=album_entry>
<h3><a href=/media/album/blog-images>Stack o' Blogs Images</a> (" . $count . ")</h3>
<p>Images from Climatepedia's Stack o' Blogs, climate change and environmental commentary aggregated from a variety of sources across the web..</p>
</div>
");

echo ("</div>");


}

elseif($_GET['sort'] == "videos") {

// we're only viewing videos

echo ("<p id=section_note>Click on an album title to see the photos/videos inside of it.</p>");
echo ("<div id=video_albums><h1 style=font-size:150%;font-weight:100 class=album_header>Climate Change Video Albums:</h1>");

include("inc.main.connect.php");
$query = ("SELECT * FROM media_albums WHERE album_type = '2'");
$result = $db->query($query);
while($row=$result->fetch_array()) {

echo ("

<div class=album_entry>
<h3><a href=/media/album/" . $row['album_url'] . ">" . $row['album_name'] . "</a> (" . $row['album_count'] . ")</h3>
<p>" . $row['album_description'] . "</p>
</div>
");



}

echo ("</div>");














}

else {

// we're on the landing page

echo ("<p id=section_note>Click on an album title to see the photos/videos inside of it.</p>");

echo ("<h1 style=font-size:150%;font-weight:100 class=album_header>Climate Change Photo Albums:</h1><div id=photo_albums>");

include("inc.main.connect.php");
$query = ("SELECT * FROM media_albums WHERE album_type = '1'");
$result = $db->query($query);
while($row=$result->fetch_array()) {

echo ("

<div class=album_entry>
<h3><a href=/media/album/" . $row['album_url'] . ">" . $row['album_name'] . "</a> (" . $row['album_count'] . ")</h3>
<p>" . $row['album_description'] . "</p>
</div>
");

}

// photo album for all of our knowledgepedia images

include("inc.main.connect.php");
$query = ("SELECT image_id FROM pedia_images");
$result=$db->query($query);
$count = $result->num_rows;

echo ("

<div class=album_entry>
<h3><a href=/media/album/knowledgepedia-images>Knowledgepedia Images</a> (" . $count . ")</h3>
<p>Images from Climatepedia's Knowledgepedia articles. Topics ranging from aerosols to climate change and nuclear energy.</p>
</div>
");


// photo album for all of our professor post images

include("inc.main.connect.php");
$query = ("SELECT image_id FROM podium_images WHERE image_type = '3'");
$result=$db->query($query);
$count = $result->num_rows;

echo ("

<div class=album_entry>
<h3><a href=/media/album/podium-images>Professor's Podium Images</a> (" . $count . ")</h3>
<p>Images from Climatepedia's Professor posts.</p>
</div>
");


// photo album for all of our blog post images

include("inc.main.connect.php");
$query = ("SELECT image_id FROM blogs_images");
$result=$db->query($query);
$count = $result->num_rows;

echo ("

<div class=album_entry>
<h3><a href=/media/album/blog-images>Stack o' Blogs Images</a> (" . $count . ")</h3>
<p>Images from Climatepedia's Stack o' Blogs, climate change and environmental commentary aggregated from a variety of sources across the web..</p>
</div>
");


// video albums

echo ("</div><div id=video_albums><h1 style=font-size:150%;font-weight:100 class=album_header>Climate Change Video Albums:</h1>");

include("inc.main.connect.php");
$query = ("SELECT * FROM media_albums WHERE album_type = '2'");
$result = $db->query($query);
while($row=$result->fetch_array()) {

echo ("

<div class=album_entry>
<h3><a href=/media/album/" . $row['album_url'] . ">" . $row['album_name'] . "</a> (" . $row['album_count'] . ")</h3>
<p>" . $row['album_description'] . "</p>
</div>
");



}

echo ("</div>");







}

}

else {
	

$album_url = $_GET['album'];	
	
if($album_url == "knowledgepedia-images" || $album_url == "blog-images" || $album_url == "podium-images" ) {
	
$album_type = "special";
	
}

else {
	
include("inc.main.connect.php");
$query = ("SELECT album_id, album_type, album_name, album_description, album_url FROM media_albums WHERE album_url = '$album_url'");
$result=$db->query($query);
while($row=$result->fetch_array()) {

$album_id = $row['album_id'];
$album_type = $row['album_type'];
$album_name = $row['album_name'];
$album_description = $row['album_description'];

}

}

if($album_type == 1) {
	
$sidebar_type = "professor";

echo ("<p id=section_note><a style=font-weight:100 href=/media>&larr; Go back to the main media gallery page</a></p>");

// we're dealing with photos

echo "<h1 class=album_header>" . $album_name . "</h1><div id=media_items>";

$query = ("SELECT image_id, image_counter, image_album, image_path, image_description, image_source FROM media_images WHERE image_album = '$album_id'");
$result=$db->query($query);

$i = 1;
while($row=$result->fetch_array()) {

$image_counter = $row['image_counter'];
$image_path = $row['image_path'];
$image_description = htmlspecialchars($row['image_description'], ENT_QUOTES);
$image_source = $row['image_source'];
list($image_width, $image_height, $type, $attr) = getimagesize("http://www.climatepedia.org/images_media/images_full/" . $image_path);

echo ("

<a id=image" . $i . " rel=" . $i . " class=media_thumb href=/images_media/images_full/" . $image_path . " title='" . $image_source . "'>
	<img width=135px src=/images_media/images_thumbs/" . $image_counter . "_thumb.jpg title='" . $image_description . "'>
	<div class=image_width>" . $image_width . "</div>
	<div class=image_height>" . $image_height . "</div>
</a>

");

$i++;
}

echo "</div><p class=album_description><span class=description_header>Album description: </span>" . $album_description . "</p>";

}

elseif($album_type == "special") {

// we're viewing one of the section's photo albums

if($album_url == "knowledgepedia-images") {

// knowledgepedia section

$sidebar_type = "professor";

echo ("<p id=section_note><a style=font-weight:100 href=/media>&larr; Go back to the main media gallery page</a></p>");

// we're dealing with photos

echo "<h1 class=album_header>Knowledgepedia Images</h1><div id=media_items>";

$query = ("SELECT image_article, image_path, image_description, image_source FROM pedia_images");
$result=$db->query($query);

$i = 1;
while($row=$result->fetch_array()) {

$image_path = $row['image_path'];
$image_description = $row['image_description'];
$image_source = $row['image_source'];
list($image_width, $image_height, $type, $attr) = getimagesize("http://www.climatepedia.org/images_pedia/" . $image_path);

echo ("

<div class=thumb_wrapper>
<a id=image" . $i . " rel=" . $i . " class=media_thumb href=/images_pedia/" . $image_path . " title='" . $image_source . "'>
	<img width=135px src=/images_pedia/" . $image_path . " title='" . $image_description . "'>
	<div class=image_width>" . $image_width . "</div>
	<div class=image_height>" . $image_height . "</div>
</a>
</div>
");

$i++;
}

echo "</div><p class=album_description><span class=description_header>Album description: </span>" . $album_description . "</p>";




}

elseif($album_url == "podium-images") {

// podium is the section



}


elseif($album_url == "blog-images") {

// blog is the section





}



}

else {
	

// we're dealing with videos
	
if(isset($_GET['url'])) {

echo ("<p id=section_note><a style=font-weight:100 href=/media/album/" . $album_url . ">&larr; Go back to the " . $album_name . " album</a></p>");

$sidebar_type = "news";

// we're looking at a specific video

$video_url = $_GET['url'];

include("inc.main.connect.php");

$query = ("SELECT video_id, video_album, video_name, video_description, video_tag1, video_code, video_url, video_date FROM media_videos WHERE video_url = '$video_url'");
$result=$db->query($query);
while($row=$result->fetch_array()) {

$page_tag = $row['video_tag1'];

echo "<h2 class=album_header>Video: " . $row['video_name'] . "</h2><div id=media_items>";

echo "<div style='width:560px;padding-left:5px'>" . $row['video_code'] . "</div>";

echo "</div><p class=album_description><span class=description_header>Video description: </span>" . $row['video_description'] . "</p>";



}

} else {

$sidebar_type = "media";

echo ("<p id=section_note><a style=font-weight:100 href=/media>&larr; Go back to the main media gallery page</a></p>");

echo "<h1 class=album_header>" . $album_name . "</h1><div id=media_items>";
	
include("inc.main.connect.php");

$query = ("SELECT video_album, video_name, video_description, video_url, video_date FROM media_videos WHERE video_album = '$album_id' ORDER BY video_date DESC");
$result=$db->query($query);
$i = 1;
while($row=$result->fetch_array()) {	
	
$video_date = strtotime($row['video_date']);
$video_date = date("D M d, Y", $video_date);
	
echo ("

<div class=video_entry>
<h3><a href=/media/album/" . $album_url . "/" . $row['video_url'] . ">" . $row['video_name'] . "</a> (" . $video_date . ")</h3>
<p>" . $row['video_description'] . "</p>
</div>
");	
	
}
	

echo "</div><p class=album_description><span class=description_header>Album description: </span>" . $album_description . "</p>";



}

}
	
	
	
}




















?>