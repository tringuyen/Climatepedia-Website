<?php

$page_title = "Blogs - Read a variety of climate change blogs";
$page_meta = "Read from many different authors.";
$location = "blogs";
$location_title = "Blogs";
$css1 = "main.blogs.css";
$css2 = "";
$css3 = "";
$js1 = "";
$js2 = "";
$js3 = "";
// set above via query $page_title = "Climate Change News Digest | Climatepedia.org";
// set above via query $page_meta = "";

if(isset($_GET['page'])) {
// set the page

$blog_page = $_GET['page'];

}

else {
	
$blog_page = 1;

}



// Load templates

include ("inc.main.header.php");





?>


<!-- CSS-trick for extending bar across screen dynamically -->
<div id="focus_bg"></div>
<div id="image_overlay"><div id="image_information"></div></div>
<div id="wrapper"> <!-- Wraps whole page content -->

	<!-- Bar at the top of the page showing page title -->
	<div id="focus_bar">
		<h1 id="focus_title">Climate Change Blogs - Stack o' Authors</h1>
		<a href="" id="focus_feedback" >Feedback &#43;</a>
		<div id="focus_sort">
			<a href="#" id="blogs_sort_button" >Sort Posts by<img src="/css/images/arrow_down.png" alt="" ></a>
			<div id="blogs_sort_wrapper">
				<div id="blogs_sort_list" class="shadow">
					<ul>
						<li><a href="/blogs" >View All</a></li>					
						<li><a href="/blogs/page/<?php echo $blog_page; ?>&sort=newest" >Newest</a></li>		
						<li><a href="/blogs/page/<?php echo $blog_page; ?>&sort=oldest" >Oldest</a></li>
						<li><a href="/blogs/page/<?php echo $blog_page; ?>&sort=alphabetical" >A - Z</a></li>
						<li><a href="/blogs/page/<?php echo $blog_page; ?>&sort=inverse" >Z - A</a></li>								
					</ul>
				</div>
			</div>				
		</div>
	</div>


	<!-- Left Section -->
	<div id="left">
	
		<!-- Site-wide navigation -->
		<?php include ("inc.main.nav.php"); ?>
<div id="blogs_roll">
		<p>Featured Blogs</p>	
		<ul>
		<?php
			include("inc.main.connect.php");
			$query = ("SELECT blog_sidebar, blog_url, blog_active FROM blogs_sources WHERE blog_active = '1' ORDER BY blog_sidebar ASC");
				$result=$db->query($query);
				while($row=$result->fetch_array()) {
					echo ("<li><a target=_blank href=" . $row['blog_url'] . ">" . $row['blog_sidebar'] . "</a></li>");
				}
			?>	
		</ul>	
	</div>



	</div>







	<!-- Middle content, pulling news feeds -->
	<div id="middle">
		<div id="blogs_content">
			<?php include("inc.main.blog-posts.php"); ?>
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
		
		<?php if($post_images == 1) {
		echo "<div id=blog_images class=right_section>"; ?>
			<h3 class="right_header">Images with this post</h3>
				<?php $post_images_id = $_GET['postid']; include ("inc.main.connect.php");
			
				$query="SELECT image_path, image_order, image_description, image_source FROM blogs_images WHERE image_post='$post_images_id' ORDER BY image_order ASC";
				$result=$db->query($query);

				while($row = $result->fetch_array()) {

		
				$image_path = $row['image_path'];
				$image_description = htmlspecialchars($row['image_description'], ENT_QUOTES);
				$image_source = htmlspecialchars($row['image_source'], ENT_QUOTES);
				list($image_width, $image_height, $type, $attr) = getimagesize("http://www.climatepedia.org/images_blog/" . $image_path);


				echo ("<a class='sidebar_image' href='http://www.climatepedia.org/images_blog/" . $image_path . "' title='" . $image_source . "' rel=gallery ><img src='http://www.climatepedia.org/images_blog/" . $image_path . "' width=160px title='" . $image_description . "'><div class=image_width>" . $image_width . "</div><div class=image_height>" . $image_height . "</div></a>");



				} 
				
				} else {
					
		echo "<div id=blog_images class=right_section>"; ?>
				<?php 
				$image_sidebar_limit = 1;
				include ("inc.sidebar.recent-image.php");					
				?>
		<?php } ?>
		</div>

		
		<div id="popular" class="right_section">
		<?php $professor_post_limit = 5;
				include("inc.sidebar.professor-posts.php");
		?>
		</div>
		<!--
		<div id="recent" class="right_section">
			<h3 class="right_header">Recent activity</h3>
		</div>
		
		<div id="suggestions" class="right_section">
			<h3 class="right_header">Suggested for you</h3>
		</div>
		-->
	</div>
	
<!-- page scripts -->
<script type="text/javascript" >
$(window).load(function(){

<!-- script for media sorting -->
$("#blogs_sort_button").click(function(){
	
	if($('#blogs_sort_wrapper').is(':visible')){
		$(this).removeClass("blogs_sort_button_active");
		$('#blogs_sort_wrapper').hide();
	}
		
	else {		
		$(this).addClass("blogs_sort_button_active");
		$("#blogs_sort_wrapper").show();
	}
	return false;
});
	
$('html').click(function() {
	$("#blogs_sort_button").removeClass("blogs_sort_button_active");
	$('#blogs_sort_wrapper').hide();
});

$('#blogs_sort_button').click(function(event){
	event.stopPropagation();
});
	
$('#blogs_sort_list').click(function(event){
	event.stopPropagation();
});

});

// script for images zooming

	
$(".sidebar_image").click(function(){
	
	var window_width = $(window).width();
	var window_height = $(window).height();
	
	if($(this).attr("title") == ""){
		var image_source = "";
	}
	else {
		var image_source = "Image source: " + $(this).attr("title");
	}
	var image_description = $("img", this).attr("title");
	var image_location = $(this).attr("href");
	var zoomed_width = $(".image_width", this).text();
	var zoomed_height = $(".image_height", this).text();
	
	
	if(zoomed_width > window_width) { // make the width smaller
	
	mod_zoomed_width = window_width * 0.8;
	mod_ratio = mod_zoomed_width / zoomed_width;
	mod_zoomed_height = zoomed_height * mod_ratio;
	var mod_zoomed_info_width = mod_zoomed_width - 20;
	
	$("#image_overlay").html("<div id=image_information><p class=zoomed_source>" + image_source + "</p><a id=image_close></a></div><div id=zoomed_image><image id=zoomed src=" + image_location + "><p class=zoomed_title style=width:" + mod_zoomed_info_width + "px>" + image_description + "</p></div>");
	$("#image_close").text("Close");

	var zoomed_marginleft = mod_zoomed_width * -0.5;
	var zoomed_margintop = mod_zoomed_height * -0.5;
	
	$("#zoomed_image").css({"margin-left" : zoomed_marginleft, "margin-top" : zoomed_margintop});
	$("#zoomed").width(mod_zoomed_width);

	}
	
	
	if(zoomed_height > window_height) { // make the height smaller
	
	mod_zoomed_height = window_height * 0.8;
	mod_ratio = mod_zoomed_height / zoomed_height;
	mod_zoomed_width = zoomed_width * mod_ratio;
	var mod_zoomed_info_width = mod_zoomed_width - 20;
	
	$("#image_overlay").html("<div id=image_information><p class=zoomed_source>" + image_source + "</p><a id=image_close></a></div><div id=zoomed_image><image id=zoomed src=" + image_location + "><p class=zoomed_title style=width:" + mod_zoomed_info_width + "px>" + image_description + "</p></div>");
	$("#image_close").text("Close");

	var zoomed_marginleft = mod_zoomed_width * -0.5;
	var zoomed_margintop = mod_zoomed_height * -0.5;
	
	$("#zoomed_image").css({"margin-left" : zoomed_marginleft, "margin-top" : zoomed_margintop});
	$("#zoomed").width(mod_zoomed_width);

	}
		
	else { 	// we don't need to do anything	
	
	var zoomed_info_width = zoomed_width - 20;
		
	$("#image_overlay").html("<div id=image_information><p class=zoomed_source>" + image_source + "</p><a id=image_close></a></div><div id=zoomed_image><image id=zoomed src=" + image_location + "><p class=zoomed_title style=width:" + zoomed_info_width + "px>" + image_description + "</p></div>");
	$("#image_close").text("Close");
	
	var zoomed_marginleft = zoomed_width * -0.5;
	var zoomed_margintop = zoomed_height * -0.5;
	
	$("#zoomed_image").css({"margin-left" : zoomed_marginleft, "margin-top" : zoomed_margintop});
			
	}

	$("#image_overlay").fadeIn(200, function() {
		$("#image_information").fadeIn(200);
		$("#zoomed_image").fadeIn(200);
		});
	return false;
		
	
});

$("#image_overlay").click(function() {
	
	$("#image_overlay").fadeOut(100);
	
});

$("#image_close").click(function() {
	
	$("#image_overlay").fadeOut(100);
	return false;
	
});

</script>
<!-- Preload button hover -->

<img src="http://www.climatepedia.org/css/images/knowledge-buttons-bg-active.png" alt="" style="display:none;">









<?php

include ("inc.main.footer.php");

?>