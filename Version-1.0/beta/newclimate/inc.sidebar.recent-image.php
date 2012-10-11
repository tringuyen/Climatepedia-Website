<?php include ("inc.main.connect.php");
			
		$query = ("SELECT image_selector FROM media_images ORDER BY image_selector DESC LIMIT 1");
		$result=$db->query($query);
		while($row=$result->fetch_array()) {
			$max = $row['image_selector'];
		}			
			
		$random = rand(1,	$max);
			
			
		$query="SELECT media_images.image_id, media_images.image_album, media_images.image_path, media_images.image_description, media_images.image_source, media_images.image_selector, media_albums.album_id, media_albums.album_url, media_albums.album_name, media_albums.album_url FROM media_images LEFT JOIN media_albums ON media_images.image_album = media_albums.album_id WHERE media_images.image_selector = '$random' LIMIT $image_sidebar_limit";
		$result=$db->query($query);

		echo ("<h3 class=right_header>Recent media</h3>");

		while($row = $result->fetch_array()) {

		$image_path = $row['image_path'];
		$image_description = htmlspecialchars($row['image_description'], ENT_QUOTES);
		$image_description .= " <a href=http://www.climatepedia.org/beta/newclimate/media/album/" . $row['album_url'] . ">View more in the " . $row['album_name'] . " album</a> in the media gallery of Climatepedia.";
		$image_source = htmlspecialchars($row['image_source'], ENT_QUOTES);
		list($image_width, $image_height, $type, $attr) = getimagesize("http://www.climatepedia.org/beta/newclimate/images_media/images_full/" . $image_path);


		echo ("<a class='sidebar_image' href='http://www.climatepedia.org/beta/newclimate/images_media/images_full/" . $image_path . "' title='" . $image_source . "'><img src='http://www.climatepedia.org/beta/newclimate/images_media/images_full/" . $image_path . "' width=160px title='" . $image_description . "'><div class=image_width>" . $image_width . "</div><div class=image_height>" . $image_height . "</div></a>");



		} 
								
?>