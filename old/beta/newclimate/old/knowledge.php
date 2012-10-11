<?php 

// Set static variables

$location = "knowledge";
$location_title = "Knowledge-base";
$css1 = "global.knowledge.css";
$css2 = "";
$css3 = "";

// Gather info from database

include ("inc.connect.php");

$query="SELECT article_name, article_pagetitle, article_pagemeta, article_contents, article_toc, article_tag1, article_tag2, article_tag3, article_discussion, article_images FROM pedia_articles WHERE article_id='$pageid'";
$result=$db->query($query);

while($row = $result->fetch_array()) {

$article_name = $row['article_name'];
$page_title = $row['article_pagetitle'];
$page_meta = $row['article_pagemeta'];
$article_contents = $row['article_contents'];
$article_toc = $row['article_toc'];
$article_tag1 = $row['article_tag1'];
$article_tag2 = $row['article_tag2'];
$article_tag3 = $row['article_tag3'];
$article_discussion = $row['article_discussion'];
$article_images = $row['article_images'];


}

// Load templates

include ("inc.header.php");

?>

<!-- CSS-trick for extending bar across screen dynamically -->
<div id="focus_bg"></div>
<div id="wrapper"> <!-- Wraps whole page content -->

	<!-- Bar at the top of the page showing page title -->
	<div id="focus_bar">
		<h1 id="focus_title">Knowledge: <?php echo ("$article_name"); ?></h1>
		<a href="" id="focus_action" >Discuss this &rarr;</a>
		<a href="" id="focus_feedback" >Feedback &#43;</a>
		<a href="" id="focus_all" >All Articles<img src="css/images/arrow_down.png" alt="" ></a>
	</div>



	<!-- Left Section -->
	<div id="left">
	
		<!-- Site-wide navigation -->
		<?php include ("inc.nav.php"); ?>

		<!-- Table of Contents for the article -->
		<div id="knowledge_contents">
			<p>Contents</p>
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
		<div id="social" class="right_section">
			<a href="" id="social_fb" ><img src="css/images/button_fb.png" alt="" ></a>
			<a href="" id="social_google" ><img src="css/images/button_google.png" alt="" ></a>
			<a href="" id="social_twitter" ><img src="css/images/button_twitter.png" alt="" ></a>
		</div>
		<div id="intro" class="right_section">
			<h3 class="right_header">Shout it out!</h3>
			<p id="intro_about">Climatepedia.org is a university student-run program providing a modern and balanced connection point between researchers and the public about climate change.</p>
			<p><a href="" >FAQ &#187;</a> | <a href="" >About &#187;</a></p>
		</div>
		
		<!-- Knowledgepedia Image Script: check if any exist, then pull file paths -->
		<?php if($article_images == 1) {
		echo "<div id=knowledge_images class=right_section>"; ?>
			<h3 class="right_header"><?php echo("$article_name"); ?> images</h3>
				<?php include ("inc.connect.php");
			
				$query="SELECT image_path, image_order, image_description FROM pedia_images WHERE image_article='$pageid' ORDER BY image_order ASC";
				$result=$db->query($query);

				while($row = $result->fetch_array()) {

				$image_path = $row['image_path'];
				$image_description = $row['image_description'];

				echo ("<a href=#><img src=http://www.climatepedia.org/beta/newclimate/images_pedia/" . $image_path . " width=160px alt=" . $image_description . "></a>");

				} ?>
				
		</div>
		<?php } ?>
		<div id="suggestions" class="right_section">
			<h3 class="right_header">Suggested for you</h3>
		</div>
		<div id="popular" class="right_section">
			<h3 class="right_header">Most popular</h3>
		</div>
		<div id="recent" class="right_section">
			<h3 class="right_header">Recent activity</h3>
		</div>
	</div>
</div>

<!-- Script that builds table of contents links on page load -->

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


<!-- Standard Footer -->
<?php include ("inc.footer.php"); ?>