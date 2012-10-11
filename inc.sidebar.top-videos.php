<?php include("inc.main.connect.php");
	$query = ("SELECT media_videos.video_album, media_videos.video_name, media_videos.video_url, media_albums.album_id, media_albums.album_url FROM media_videos LEFT JOIN media_albums ON media_videos.video_album = media_albums.album_id LIMIT $video_result_limit");
	$result=$db->query($query);
	while($row=$result->fetch_array()) {
		echo ("
				
			<li style='padding:4px 0;'><a href=/media/album/" . $row['album_url'] . "/" . $row['video_url'] . ">" . $row['video_name'] . "</a><li>
					
			");

	}
?>