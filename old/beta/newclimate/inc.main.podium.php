<?php

$page_title = "Podium - Read a variety of climate change posts";
$page_meta = "Read from many different authors.";
$location = "podium";
$location_title = "Podium";
$css1 = "main.podium.css";
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
		<h1 id="focus_title">Professor's <?php if(isset($_GET['posturl'])) {echo "Podium";} elseif($_GET['directory'] == "all") {echo "Academic Network";} elseif($_GET['directory'] == "single") { echo "Academic Network";} else {echo "Podium - All Posts";}?></h1>
		<a href="" id="focus_feedback" >Feedback &#43;</a>
		<div id="focus_sort">
			<?php if(isset($_GET['directory'])) { ?>
			<a href="#" id="media_sort_button" >Sort Professors<img src="/beta/newclimate/css/images/arrow_down.png" alt="" ></a>
			<div id="media_sort_wrapper">
				<div id="media_sort_list" class="shadow">
					<ul>					
						<li><a href="/beta/newclimate/podium/network/sort/first-name-alphabetical" >First Name<br>A - Z</a></li>
						<li><a href="/beta/newclimate/podium/network/sort/last-name-alphabetical" >Last Name<br>A - Z</a></li>
						<li><a href="/beta/newclimate/podium/network/sort/first-name-inverse" >First Name<br>Z - A</a></li>
						<li><a href="/beta/newclimate/podium/network/sort/last-name-inverse" >Last Name<br>Z - A</a></li>
			<?php } else { ?>
			<a href="#" id="media_sort_button" >Sort Posts by<img src="/beta/newclimate/css/images/arrow_down.png" alt="" ></a>
			<div id="media_sort_wrapper">
				<div id="media_sort_list" class="shadow">
					<ul>
						<li><a href="/beta/newclimate/podium" >Most Popular</a></li>					
						<li><a href="/beta/newclimate/podium" >Newest</a></li>		
						<li><a href="/beta/newclimate/podium/sort/oldest" >Oldest</a></li>
						<li><a href="/beta/newclimate/podium/sort/alphabetical" >A - Z</a></li>
						<li><a href="/beta/newclimate/podium/sort/inverse" >Z - A</a></li>
			<?php }?>								
					</ul>
				</div>
			</div>				
		</div>
	</div>


	<!-- Left Section -->
	<div id="left">
	
		<!-- Site-wide navigation -->
		<?php include ("inc.main.nav.php"); ?>



	<div id="professor_nav">
		<p>Professor Links</p>	
		<ul>
			<li><a href="/beta/newclimate/podium" >Podium Posts</a></li>
			<li><a href="/beta/newclimate/podium/network" >Academic Network</a></li>
			<li><a href="" >About Contributing</a></li>				
		</ul>	

	
	</div>

	</div>







	<!-- Middle content, pulling news feeds -->
	<div id="middle">
		<div id="podium_content">
			<?php include ("inc.main.podium-posts.php"); ?>
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
		<div id="suggestions" class="right_section">
			<?php $image_sidebar_limit = 1;
					include("inc.sidebar.recent-image.php");
			?>
		</div>
		<div id="recent" class="right_section">
				<?php $page_news_limit = 10;
						include("inc.sidebar.recent-news.php");
				?>		
		</div>
		
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

<img src="http://www.climatepedia.org/beta/newclimate/css/images/knowledge-buttons-bg-active.png" alt="" style="display:none;">









<?php

include ("inc.main.footer.php");

?>