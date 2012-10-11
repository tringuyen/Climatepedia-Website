<?php

$page_title = "Media - Climate Change Pictures, Videos, Interviews and More | Climatepedia.org";
$page_meta = "View pictures, photo galleries, videos, interviews and more.";
$location = "media";
$location_title = "News";
$css1 = "main.media.css";
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
		<p id="focus_title">Media Gallery</p>
		<a href="" id="focus_feedback" >Feedback &#43;</a>
		<div id="focus_sort">
			<a href="#" id="media_sort_button" >Sort Media by<img src="/beta/newclimate/css/images/arrow_down.png" alt="" ></a>
			<div id="media_sort_wrapper">
				<div id="media_sort_list" class="shadow">
					<ul>
						<li><a href="/beta/newclimate/media" >All</a></li>					
						<li><a href="/beta/newclimate/media/sort/photos" >Photos</a></li>		
						<li><a href="/beta/newclimate/media/sort/videos" >Videos</a></li>								
					</ul>
				</div>
			</div>				
		</div>
	</div>


	<!-- Left Section -->
	<div id="left">
	
		<!-- Site-wide navigation -->
		<?php include ("inc.main.nav.php"); ?>
		<div id="media_nav">
		<p>Top Videos</p>	
		<ul style="line-height:18px">
		<?php $video_result_limit = 10;
				include("inc.sidebar.top-videos.php");
		?>
		</ul>	
	</div>


	</div>







	<!-- Middle content, pulling news feeds -->
	<div id="middle">
		<div id="media_content">
			<?php include("inc.main.media-albums.php");?>
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
		
		<div id="media_images" class="right_section">
			<?php
			
			if($sidebar_type == "news") {
					$page_news_limit = 10;	
					include("inc.sidebar.recent-news.php");
				} 
				
			elseif($sidebar_type == "professor") {
				
				$professor_post_limit = 5;
				include("inc.sidebar.professor-posts.php");
		
				
				}
				
				else {
					$image_sidebar_limit = 1;	
					include("inc.sidebar.recent-image.php");
					}
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
$("#media_sort_button").click(function(){
	
	if($('#media_sort_wrapper').is(':visible')){
		$(this).removeClass("media_sort_button_active");
		$('#media_sort_wrapper').hide();
	}
		
	else {		
		$(this).addClass("media_sort_button_active");
		$("#media_sort_wrapper").show();
	}
	return false;
});
	
$('html').click(function() {
	$("#media_sort_button").removeClass("media_sort_button_active");
	$('#media_sort_wrapper').hide();
});

$('#media_sort_button').click(function(event){
	event.stopPropagation();
});
	
$('#media_sort_list').click(function(event){
	event.stopPropagation();
});
});



// Script for zooming in on images

$(".media_thumb").click(function(){
	
	if(window.next_image == 1){
		
	// they clicked the next button


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
	
	$(".zoomed_source").text(image_source);
	$("#zoomed_image").html("<image id=zoomed src=" + image_location + "><p class=zoomed_title style=width:" + mod_zoomed_info_width + "px>" + image_description + "</p>");
	
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
	
	$(".zoomed_source").text(image_source);
	$("#zoomed_image").html("<image id=zoomed src=" + image_location + "><p class=zoomed_title style=width:" + mod_zoomed_info_width + "px>" + image_description + "</p>");

	var zoomed_marginleft = mod_zoomed_width * -0.5;
	var zoomed_margintop = mod_zoomed_height * -0.5;
	
	$("#zoomed_image").css({"margin-left" : zoomed_marginleft, "margin-top" : zoomed_margintop});
	$("#zoomed").width(mod_zoomed_width);



	}
		
	else { 	// we don't need to do anything	

	
	var zoomed_info_width = zoomed_width - 20;
		
	$(".zoomed_source").text(image_source);
	$("#zoomed_image").html("<image id=zoomed src=" + image_location + "><p class=zoomed_title style=width:" + zoomed_info_width + "px>" + image_description + "</p>");

	
	var zoomed_marginleft = zoomed_width * -0.5;
	var zoomed_margintop = zoomed_height * -0.5;
	
	$("#zoomed_image").css({"margin-left" : zoomed_marginleft, "margin-top" : zoomed_margintop});
			
	}
	


		$("#zoomed_image").delay(500).fadeIn(200);

	return false;
	

	}
	
	
	
	
	
	else {
	
	// they clicked a thumbnail
	
	window.current_image = $(this).attr("rel");

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
	
	$("#image_overlay").html("<div id=image_information><p class=zoomed_source>" + image_source + "</p><a id=image_close></a><div id=image_navigation><a href=# id=image_previous></a><a href=# id=image_next></a></div></div><div id=zoomed_image><image id=zoomed src=" + image_location + "><p class=zoomed_title style=width:" + mod_zoomed_info_width + "px>" + image_description + "</p></div>");
	$("#image_previous").text("Previous");
	$("#image_next").text("Next");
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
	
	$("#image_overlay").html("<div id=image_information><p class=zoomed_source>" + image_source + "</p><a id=image_close></a><div id=image_navigation><a href=# id=image_previous></a><a href=# id=image_next></a></div></div><div id=zoomed_image><image id=zoomed src=" + image_location + "><p class=zoomed_title style=width:" + mod_zoomed_info_width + "px>" + image_description + "</p></div>");
	$("#image_previous").text("Previous");
	$("#image_next").text("Next");
	$("#image_close").text("Close");

	var zoomed_marginleft = mod_zoomed_width * -0.5;
	var zoomed_margintop = mod_zoomed_height * -0.5;
	
	$("#zoomed_image").css({"margin-left" : zoomed_marginleft, "margin-top" : zoomed_margintop});
	$("#zoomed").width(mod_zoomed_width);

	}
		
	else { 	// we don't need to do anything	
	
	var zoomed_info_width = zoomed_width - 20;
		
	$("#image_overlay").html("<div id=image_information><p class=zoomed_source>" + image_source + "</p><a id=image_close></a><div id=image_navigation><a href=# id=image_previous></a><a href=# id=image_next></a></div></div><div id=zoomed_image><image id=zoomed src=" + image_location + "><p class=zoomed_title style=width:" + zoomed_info_width + "px>" + image_description + "</p></div>");
	$("#image_previous").text("Previous");
	$("#image_next").text("Next");
	$("#image_close").text("Close");
	
	var zoomed_marginleft = zoomed_width * -0.5;
	var zoomed_margintop = zoomed_height * -0.5;
	
	$("#zoomed_image").css({"margin-left" : zoomed_marginleft, "margin-top" : zoomed_margintop});
			
	}

	$("#image_overlay").fadeIn(200, function() {
		$("#image_information").fadeIn(200);
		$("#zoomed_image").delay(500).fadeIn(200);
		});
	return false;
		
	}
});


// they clicked the next button

$("#image_next").live("click", function(){
	
	window.current_image++;
	window.next_image = 1;

	$("#zoomed_image").fadeOut(200, function(){

	$("#image" + window.current_image).click();
	
	});
	
	return false;
		
	
});

// they clicked the previous button

$("#image_previous").live("click", function(){
	
	window.current_image--;
	window.next_image = 1;

	$("#zoomed_image").fadeOut(200, function(){

	$("#image" + window.current_image).click();
	
	});
	
	return false;
		
	
});



// they clicked the close button

$("#image_close").live("click", function() {
	
	$("#image_overlay").fadeOut(200);
	window.next_image = 0;
	
});


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



</script>
<!-- Preload button hover -->

<img src="http://www.climatepedia.org/beta/newclimate/css/images/knowledge-buttons-bg-active.png" alt="" style="display:none;">









<?php

include ("inc.main.footer.php");

?>