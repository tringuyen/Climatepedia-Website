<?php 

// Define variables, include templates

include ("inc.main.connect.php");

if($pagekeyword !== "highlights") {
$query = ("SELECT * FROM climate_tags WHERE tag_name = '$pagekeyword'");
$result=$db->query($query);
// check type of page - keyword v.s. specific feed
$item_number = $result->num_rows;
if($item_number > 0) {
while($row=$result->fetch_array()) {

$query_type = "keyword";
$pagekeyword = $row['tag_name'];
$stream_title = $pagekeyword . " News Stream";
$page_title = $row['tag_name'] . " News";
$page_meta = $row['tag_name'] . " News";


}
}

else {


$query = ("SELECT source_sidebar, source_title, source_description, source_name, source_images FROM news_sources WHERE source_sidebar = '$pagekeyword'");
$result=$db->query($query);
while($row=$result->fetch_array()) {

$pagekeyword = $row['source_sidebar'];
$stream_title = $pagekeyword . " News Stream";
$page_title = $row['source_title'];
$page_meta = $row['source_description'];
$pagesource_name = $row['source_name'];
$pagesource_images = $row['source_images'];
}
}
}
else {
// we're on the index page
$stream_title = "Climatepedia News Highlights";
$page_title = "Climate Change and Environmental Topics News Highlights | Climatepedia.org";
$page_meta = "View a digest of the top news from around the world on climate change, alternative energies, environmental law, and more.";
}

	
if(isset($_GET['page'])) {$page_number = $_GET['page'];}
else {$page_number = 1;}

if(isset($_GET['sort'])) {
	if($_GET['sort'] == "newest") {$sort_special = 0; $feed_sort = "DESC";}
	elseif($_GET['sort'] == "oldest") {$sort_special = 0; $feed_sort = "ASC";}
	elseif($_GET['sort'] == "alphabetical") {$sort_special = 1; $feed_sort = "ASC";}
	elseif($_GET['sort'] == "inverse") {$sort_special = 1; $feed_sort = "DESC";}
	else {$sort_special = 0; $feed_sort = "DESC";}
}

else {
	$sort_special = 0;
	$feed_sort = "DESC";
}



	
	
$location = "news";
$location_title = "News";
$css1 = "main.news.css";
$css2 = "";
$css3 = "";
// set above via query $page_title = "Climate Change News Digest | Climatepedia.org";
// set above via query $page_meta = "";

// Load templates

include ("inc.main.header.php");

?>

<!-- CSS-trick for extending bar across screen dynamically -->
<div id="focus_bg"></div>
<div id="image_overlay"></div>
<div id="wrapper"> <!-- Wraps whole page content -->

	<!-- Bar at the top of the page showing page title -->
	<div id="focus_bar">
		<h1 id="focus_title"><?php echo $stream_title; ?></h1>
		<a href="" id="focus_feedback" >Feedback &#43;</a>
		<div id="focus_sort">
			<a href="#" id="feed_sort_button" >Sort News by<img src="/css/images/arrow_down.png" alt="" ></a>
			<div id="feed_sort_wrapper">
				<div id="feed_sort_list" class="shadow">
					<ul>
						<li><a href="/news/highlights" >Highlights</a></li>					
						<li><a href="/news/<?php echo $_GET['keyword'] . '/page/' . $page_number; ?>&sort=newest" >Newest</a></li>		
						<li><a href="/news/<?php echo $_GET['keyword'] . '/page/' . $page_number; ?>&sort=oldest" >Oldest</a></li>
						<li><a href="/news/<?php echo $_GET['keyword'] . '/page/' . $page_number; ?>&sort=alphabetical" >A - Z</a></li>
						<li><a href="/news/<?php echo $_GET['keyword'] . '/page/' . $page_number; ?>&sort=inverse" >Z - A</a></li>								
					</ul>
				</div>
			</div>				
		</div>
	</div>


	<!-- Left Section -->
	<div id="left">
	
		<!-- Site-wide navigation -->
		<?php include ("inc.main.nav.php"); ?>

		<!-- List of news topics and streams -->
		<div id="news_topics">
			<p>Topics:</p>
				<ul>
					<?php // pull system-wide tags that are enabled for the news feed
					
							include ("inc.main.connect.php");
							$query = ("SELECT tag_name, tag_news FROM climate_tags WHERE tag_news = '1' ORDER BY tag_name");
							$result=$db->query($query);
							while($row=$result->fetch_array()) {
								$raw_keyword = strtolower($row['tag_name']);
								$list_keyword = str_replace(" ", "-", $raw_keyword);
								echo ("<li><a href=/news/" . $list_keyword . ">" . $row['tag_name'] . "</a></li>");
							}
					?>
				</ul>
			<p>Special streams:</p>
				<ul>
				<?php
							include ("inc.main.connect.php");
							$query = ("SELECT source_sidebar, source_title, source_description, source_url, source_name, source_link, source_active FROM news_sources WHERE source_active = '1' AND source_special = '1' ORDER BY source_title ASC");
							$result=$db->query($query);
							while($row=$result->fetch_array()) {
								$raw_source = strtolower($row['source_sidebar']);
								$list_source = str_replace(" ", "-", $raw_source);
								echo ("<li><a href=/news/" . $list_source . ">" . $row['source_sidebar'] . "</a></li>");
							}
				?>
				</ul>
			<p>Main streams:</p>
				<ul>
				<?php
							include ("inc.main.connect.php");
							$query = ("SELECT source_sidebar, source_title, source_description, source_url, source_name, source_link, source_active FROM news_sources WHERE source_active = '1' AND source_special = '0' ORDER BY source_title ASC");
							$result=$db->query($query);
							while($row=$result->fetch_array()) {
								$raw_source = strtolower($row['source_sidebar']);
								$list_source = str_replace(" ", "-", $raw_source);
								echo ("<li><a href=/news/" . $list_source . ">" . $row['source_sidebar'] . "</a></li>");
							}
				
				?>
				</ul>
		</div>
	</div>







	<!-- Middle content, pulling news feeds -->
	<div id="middle">
		<div id="news_command">

		</div>
		<div id="news_content">
			<?php include("inc.main.rss-feeds.php"); ?>
		</div>
	</div>





	<!-- Right Section -->
	<div id="right">
	
		<?php
			// include social media
			include ("inc.sidebar.social.php");
			// include about info
			include ("inc.sidebar.shout.php");
		?>
		<!--<div id="images_ng" class="right_section">
			<h3 class="right_header">National Geographic photos</h3>
				<?php// include("inc.main.connect.php");
					//$query = ("SELECT item_title, item_link, item_date, item_description, item_source FROM news_items WHERE item_source = 'National Geographic Photo of the Day' ORDER BY item_date DESC LIMIT 3");
					//$result=$db->query($query);
					//while($row=$result->fetch_array()) {
					//	$images_description = preg_replace('/<img src=\"http:\/\/feeds[^>]+\>/i', '', $row["item_description"]); 
					//	echo $images_description;
					//}
				?>
			<a id="images_gallery_link" href="" >Go to image galleries &rarr;</a>
		</div>-->
		<div id="images_nasa" class="right_section">
			<h3 class="right_header">Recent NASA images</h3>
				<?php include("inc.main.connect.php");
					$query = ("SELECT item_title, item_link, item_date, item_description, item_source FROM news_items WHERE item_source = 'NASA Earth Observatory Natural Hazard Images' ORDER BY item_date DESC LIMIT 10");
					$result=$db->query($query);
					while($row=$result->fetch_array()) {
						$images_description = preg_replace('/<img src=\"http:\/\/feeds[^>]+\>/i', '', $row["item_description"]); 
						echo $images_description;
					}
				?>
			<!--<a id="images_gallery_link" href="" >Go to image galleries &rarr;</a>-->
		</div>
		<div id="suggestions" class="right_section">
			<!--<h3 class="right_header">Suggested for you</h3>-->
		</div>
	</div>
	
<!-- script for NASA images -->
<script type="text/javascript" >
$(window).load(function(){
$("#images_ng a").attr("target", "_blank");
$("#images_nasa a").attr("target", "_blank");

$("#images_ng p").each(function(){$(this).insertAfter($(this).next())});





});


<!-- script for news sorting -->
$("#feed_sort_button").click(function(){
	
	if($('#feed_sort_wrapper').is(':visible')){
		$(this).removeClass("feed_sort_button_active");
		$('#feed_sort_wrapper').hide();
	}
		
	else {		
		$(this).addClass("feed_sort_button_active");
		$("#feed_sort_wrapper").show();
	}
	return false;
});
	
$('html').click(function() {
	$("#feed_sort_button").removeClass("feed_sort_button_active");
	$('#feed_sort_wrapper').hide();
});

$('#feed_sort_button').click(function(event){
	event.stopPropagation();
});
	
$('#feed_sort_list').click(function(event){
	event.stopPropagation();
});

</script>
<!-- Preload button hover -->

<img src="http://www.climatepedia.org/css/images/knowledge-buttons-bg-active.png" alt="" style="display:none;">

<?php

include ("inc.main.footer.php");

?>