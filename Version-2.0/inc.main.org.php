<?php

include("inc.main.connect.php");
$query = ("SELECT * FROM group_pages WHERE page_url = '$page_url'");
$result=$db->query($query);
while($row=$result->fetch_array()) {

$page_title = $row['page_title'];
$page_meta = $row['page_description'];
$page_name = $row['page_name'];
$page_content = $row['page_content'];


}


$location = "org";
$location_title = "Org";
$css1 = "main.org.css";
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
		<h1 id="focus_title"><?php echo $page_name; ?></h1>
		<a href="" id="focus_feedback" >Feedback &#43;</a>
		<div id="focus_sort">
			<a href="#" id="org_sort_button" >More Info <img src="/css/images/arrow_down.png" alt="" ></a>
			<div id="org_sort_wrapper">
				<div id="org_sort_list" class="shadow">
					<ul>
						<li><a href="/organization/about-climatepedia" >About Us</a></li>					
						<li><a href="/organization/how-to-contribute" >Contributing</a></li>		
						<li><a href="/org/organization/faq" >FAQ</a></li>								
					</ul>
				</div>
			</div>				
		</div>
	</div>


	<!-- Left Section -->
	<div id="left">
	
		<!-- Site-wide navigation -->
		<?php include ("inc.main.nav.php"); ?>
		<div id="org_nav">
		<p>Recent Professor Posts</p>	
		<ul style="line-height:18px">
		<?php		
		$professor_post_limit = 10;
		include ("inc.main.connect.php");

			$query = ("SELECT post_title, post_url, post_date FROM podium_posts ORDER BY post_date DESC LIMIT $professor_post_limit");
			$result=$db->query($query);


			while($row=$result->fetch_array()) {
			echo ("
			<li style='padding:4px 0;'><a href=/podium/" . $row['post_url'] . ">" . $row['post_title'] . "</a></li>
			");
			}
		?>
		</ul>	
	</div>


	</div>







	<!-- Middle content, pulling news feeds -->
	<div id="middle">
		<div id="org_content">
			<?php echo $page_content; ?>
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

		
		<div id="org_images" class="right_section">
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

<!-- script for org sorting -->
$("#org_sort_button").click(function(){
	
	if($('#org_sort_wrapper').is(':visible')){
		$(this).removeClass("org_sort_button_active");
		$('#org_sort_wrapper').hide();
	}
		
	else {		
		$(this).addClass("org_sort_button_active");
		$("#org_sort_wrapper").show();
	}
	return false;
});
	
$('html').click(function() {
	$("#org_sort_button").removeClass("org_sort_button_active");
	$('#org_sort_wrapper').hide();
});

$('#org_sort_button').click(function(event){
	event.stopPropagation();
});
	
$('#org_sort_list').click(function(event){
	event.stopPropagation();
});
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

<img src="http://www.climatepedia.org/css/images/knowledge-buttons-bg-active.png" alt="" style="display:none;">









<?php

include ("inc.main.footer.php");

?>