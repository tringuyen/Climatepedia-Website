<?php 

//session_start();

//if(isset($_SESSION['admin'])) {

// Set static variables

$location = "knowledge";
$location_title = "Knowledge-base";
$css1 = "main.knowledge.css";
$css2 = "";
$css3 = "";

// Gather info from database

include ("inc.main.connect.php");

$query="SELECT article_name, article_pagetitle, article_pagemeta, article_contents, article_toc, article_tag1, article_tag2, article_tag3, article_discussion, article_images FROM pedia_articles WHERE article_id='$pageid'";
$result=$db->query($query);

while($row = $result->fetch_array()) {

$main_article_name = htmlentities($row['article_name'], ENT_QUOTES);
$page_title = $row['article_pagetitle'];
$page_meta = $row['article_pagemeta'];
$article_contents = $row['article_contents'];
$article_toc = $row['article_toc'];
$article_tag1 = $row['article_tag1'];
$article_tag2 = $row['article_tag2'];
$article_tag3 = $row['article_tag3'];
$article_discussion = $row['article_discussion'];
$article_images = $row['article_images'];
$page_tag = $article_tag1;

}

// Load templates

include ("inc.main.header.php");

?>

<!-- CSS-trick for extending bar across screen dynamically -->
<div id="focus_bg"></div>
<div id="image_overlay"></div>
<div id="wrapper"> <!-- Wraps whole page content -->

	<!-- Bar at the top of the page showing page title -->
	<div id="focus_bar">
		<h1 id="focus_title"><?php echo ("$main_article_name"); ?>: Knowledge</h1>
		<a href="" id="focus_feedback" >Feedback &#43;</a>
		<div id="focus_all">
			<a href="" id="focus_all_button" >All Articles<img src="css/images/arrow_down.png" alt="" ></a>
			<div id="article_directory_wrapper">
				<div id="article_directory_list" class="shadow">
					<?php include ("inc.main.knowledge-list.php"); ?>
				</div>
			</div>				
		</div>
	</div>


	<!-- Left Section -->
	<div id="left">
	
		<!-- Site-wide navigation -->
		<?php include ("inc.main.nav.php"); ?>

		<!-- Table of Contents for the article -->
		<div id="knowledge_contents">
			<?php echo ("$article_toc"); ?>
		</div>
	</div>







	<!-- Middle content, pulling Knowledgepedia article -->
	<div id="middle">
		<div id="knowledge_article">
		<?php echo ("$article_contents"); ?>
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
		
		<!-- Knowledgepedia Image Script: check if any exist, then pull file paths -->
		<?php if($article_images == 1) {
		echo "<div id=knowledge_images class=right_section>"; ?>
			<h3 class="right_header"><?php echo("$main_article_name"); ?> images</h3>
				<?php include ("inc.main.connect.php");
			
				$query="SELECT image_path, image_order, image_description, image_source FROM pedia_images WHERE image_article='$pageid' ORDER BY image_order ASC";
				$result=$db->query($query);

				while($row = $result->fetch_array()) {

		
				$image_path = $row['image_path'];
				$image_description = htmlspecialchars($row['image_description'], ENT_QUOTES);
				$image_source = htmlspecialchars($row['image_source'], ENT_QUOTES);
				list($image_width, $image_height, $type, $attr) = getimagesize("http://www.climatepedia.org/beta/newclimate/images_pedia/" . $image_path);


				echo ("<a class=knowledge_image href=http://www.climatepedia.org/beta/newclimate/images_pedia/" . $image_path . " title='" . $image_source . "'><img src=http://www.climatepedia.org/beta/newclimate/images_pedia/" . $image_path . " width=160px title='" . $image_description . "'><div class=image_width>" . $image_width . "</div><div class=image_height>" . $image_height . "</div></a>");



				} ?>
				
		</div>
		<?php } ?>
		<div id="suggestions" class="right_section">

				<?php $page_news_limit = 10;
						include("inc.sidebar.recent-news.php");
				?>			

		
		
		</div>
		
		<!--
		<div id="popular" class="right_section">
			<h3 class="right_header">Most popular</h3>
		</div>
		<div id="recent" class="right_section">
			<h3 class="right_header">Recent activity</h3>
		</div>
		-->
	</div>
</div>

<!-- Script that builds table of contents links on page load | DEPRECATED 

<script type="text/javascript" >

$(window).load(function(){

list_number = 0;

$("#knowledge_contents .top_level").each(function(){
var list_text = $(this).text().replace(/\d+([,.]\d+)?/g, '').trim();


$(this).attr("href", "#" + list_number);
$("<a name='" + list_number + "'></a>").insertBefore("h2:contains(" + list_text + ")");



list_number++;

});

$("#knowledge_contents .internal a").each(function(){
var list_text = $(this).text().replace(/\d+([,.]\d+)?/g, '').trim();

$(this).attr("href", "#" + list_number);
$("<a name='" + list_number + "'></a>").insertBefore("h3:contains(" + list_text + ")");

list_number++;

});



});

</script>
-->
<script type="text/javascript" >

// Script for zooming in on images

$(".knowledge_image").click(function(){
	
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



// Scripts for "focus all button"

$("#focus_all_button").click(function(){
	
	if($('#article_directory_wrapper').is(':visible')){
		$(this).removeClass("focus_all_button_active");
		$('#article_directory_wrapper').hide();
	}
		
	else {		
		$(this).addClass("focus_all_button_active");
		$("#article_directory_wrapper").show();
	}
	return false;
});
	
$('html').click(function() {
	$("#focus_all_button").removeClass("focus_all_button_active");
	$('#article_directory_wrapper').hide();
});

$('#focus_all_button').click(function(event){
	event.stopPropagation();
});
	
$('#article_directory_list').click(function(event){
	event.stopPropagation();
});

</script>
<!-- Preload button hover -->

<img src="http://www.climatepedia.org/beta/newclimate/css/images/knowledge-buttons-bg-active.png" alt="" style="display:none;">



<!-- Standard Footer -->
<?php include ("inc.main.footer.php");  ?>