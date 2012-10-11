<?php

?>
<div id="admin_left">
<div id="admin_actions">
<p>Actions</p>
<ul>
<li><a href="admin.php?console=news&action=new_news" >Create News</a></li>
<li><a href="admin.php?console=news&action=choose_news" >Edit News</a></li>
<li><a href="admin.php?console=news&action=edit_tags" >Edit Topics</a></li>
<li><a href="admin.php?console=news&action=new_feeds" >Add Feed</a></li>
<li><a href="admin.php?console=news&action=choose_feeds" >Edit Feeds</a></li>
</ul>
</div>
<div id="admin_directions">
<p id="directions_header">Help</p>
<?php if($_GET["action"] == "new_news") {
	
	echo $new_news_directions;
	
}

elseif($_GET["action"] == "choose_news") {
	
	echo $choose_news_directions;
	
}

elseif($_GET["action"] == "edit_news") {
	
	echo $edit_news_directions;
	
}


elseif($_GET["action"] == "edit_tags") {
	
	echo $edit_newstags_directions;
	
}

elseif($_GET["action"] == "new_feeds") {
	
	echo $new_feeds_directions;
	
}

elseif($_GET["action"] == "choose_feeds") {
	
	echo $choose_feeds_directions;
	
}

elseif($_GET["action"] == "edit_feeds") {
	
	echo $edit_feeds_directions;
	
}


elseif($_GET["action"] == "success") {
	
	echo $success_directions;	
	
}

?>

</div>


</div>
<div id="admin_right">
<div id="admin_command">
<div id="admin_news">
<?php 

// Check if the user just completed an action



if($_GET["action"] == "success") {

// Check if it was an edit

if($_GET["type"] == "edit") {



// Check if they edited news

if($_GET["query"] == "news") {

$new_item = urldecode($_GET['title']);
$new_item_stripped = stripslashes($new_item);

echo ("

<h1>Congratulations! You edited news!</h1>
<p>The title is '" . $new_item_stripped . "' and it should be live on our news page now. Go check it out! =)</p>

");



}

// Check if they edited the tags

elseif($_GET["query"] == "tags") {
	
$total_edits = $_GET['total'] + 1;



// Did they only edit one tag? (singular v.s. plural verbage changes)

if($total_edits < 2) {

echo ("<h1>Congrats! You edited " . $total_edits . " news topic!</h1>");
	
}

// If not then they edited more than one, use plural

else {

echo ("<h1>Congrats! You edited " . $total_edits . " news topics total!</h1>");

}

echo ("<p>Your edits should be reflected in the sidebar of the news section now.</p>");

}

// Check if they edited the feeds

elseif($_GET["query"] == "feeds") {

$edited_feed = urldecode($_GET['title']);
$edited_feed_stripped = stripslashes($edited_feed);

echo ("

<h1>You successfully edited a feed!</h1>
<p>The feed you edited was: " . $edited_feed_stripped . ". Your udpates should be showing now.</p>

");




}

// Catch error

else {

echo ("<p>There appears to have been an error, please go back and try again. Sorry about that.</p>");


}

} // Closes off "edit" check

// Check if they created a new something

elseif($_GET["type"] == "new") {





if($_GET["query"] == "news") {

$new_item = urldecode($_GET['title']);
$new_item_stripped = stripslashes($new_item);

echo ("

<h1>Congratulations! You created a news item!</h1>
<p>The title is '" . $new_item_stripped . "' and it should be live on our news page now. Go check it out! =)</p>

");


}


// Did they create a feed?

elseif($_GET["query"] == "feeds") {

$new_feed = urldecode($_GET['title']);
$new_feed_stripped = stripslashes($new_feed);

echo ("

<h1>You successfully created a feed!</h1>
<p>The feed you created was: " . $new_feed_stripped . ". Our feed aggregator runs once an hour, so check back at the top of the hour to see whether it collected the news correctly.</p>

");

}

// Missing variable, catch error

else {
	
	echo ("<p>There appears to have been an error, please go back and try again. Sorry about that.</p>");

}



} // closes off "new" check


} // closes off "success" check



//
//
// New News
//
//


elseif($_GET["action"] == "new_news") {


echo ("

<h1 class=news_header>Create News Item</h1>
<p>Fill out the fields below.</p>
<form method=POST action=inc.admin.new-news.php>
");


echo ("

<label>News Title <span class=label_note>(The title of the news post that shows up in our news section)</label><br>
<input class=input_clear type=text name=new_submit_news_title>

");

include("inc.admin-user.connect.php");

$query="SELECT tag_id, tag_name, tag_count FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);

				echo ("<label>Tag 1:</label><select style=line-height:40px;margin-top:15px name=new_submit_news_tag><option>Select a Tag</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_count"] . ")</option>");

				}	
				
echo ("
</select>

<label>News Date <span class=label_note>(The date this news became public - YYYYMMDD i.e. 20110907)</label><br>
<input class=input_clear type=text name=new_submit_news_date>

<label>News Source <span class=label_note>(The full publication name and section of the news, or the home page URL with http:// in it)</label><br>
<input class=input_clear type=text name=new_submit_news_source>

<label>News link <span class=label_note>(The link to the article)</label><br>
<input class=input_clear type=text name=new_submit_news_link>

<label>News Summary <span class=label_note>(This is the content that shows up in our news section)</label><br>
<textarea name=new_submit_news_description></textarea>

<input id=submit class=generic_admin_button type=submit value='Submit new feed'>
</form>

");






}


//
//
// Choose News
//
//


elseif($_GET["action"] == "choose_news") {

echo ("

<h1 class=news_header>Choose News to Edit</h1>
<p style=padding-bottom:15px><small>(Sorted by most recent)</small></p>
");

include("inc.admin-user.connect.php");

$query="SELECT article_id, article_title, article_date FROM news_articles ORDER BY article_date DESC";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {
					
					$year = substr($row['article_date'],0,4);
					$month = substr($row['article_date'],4,2);
					$day = substr($row['article_date'],6,2);
					$nice_date = date("D M d, Y",mktime(0,0,0,$month,$day,$year));

					echo ("<a class=choose_feed_link href=admin.php?console=news&action=edit_news&article=" . $row["article_id"] . ">" . $row["article_title"] . "</a><p class=choose_feed_date>News Date: " . $nice_date . "</p>");
				
				}

}

//
//
// Edit News
//
//


elseif($_GET["action"] == "edit_news") {

$article_id = $_GET['article'];

include("inc.admin-user.connect.php");
$query = ("SELECT * FROM news_articles WHERE article_id = '$article_id'");
$result=$db->query($query);
while($row=$result->fetch_array()) {

$article_title = htmlspecialchars($row['article_title'], ENT_QUOTES);
$article_source = htmlspecialchars($row['article_source'], ENT_QUOTES);
$article_link = htmlspecialchars($row['article_link'], ENT_QUOTES);
$article_description = $row['article_description'];
$article_date = $row['article_date'];
$article_tag = $row['article_tag'];

}

$query = ("SELECT tag_id, tag_name, tag_count FROM climate_tags WHERE tag_id = '$article_tag'");
$result=$db->query($query);
while($row=$result->fetch_array()) {
	$article_tag_name = $row['tag_name'];
	$article_tag_count = $row['tag_count'];
}


echo ("

<h1 class=news_header>Editing News</h1>
<p>Fill out the fields below.</p>
<form method=POST action=inc.admin.edit-news.php>
");


echo ("
<input type=hidden name=new_submit_news_id value=" . $article_id . ">
<label>News Title <span class=label_note>(The title of the news post that shows up in our news section)</label><br>
<input class=input_clear type=text name=new_submit_news_title value='" . $article_title . "'>

");

include("inc.admin-user.connect.php");

$query="SELECT tag_id, tag_name, tag_count FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);

				echo ("<label>Tag 1:</label><select style=line-height:40px;margin-top:15px name=new_submit_news_tag><option value=" . $article_tag . ">" . $article_tag_name . " (" . $article_tag_count . ")</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_count"] . ")</option>");

				}	
				
echo ("
</select>

<label>News Date <span class=label_note>(The date this news became public - YYYYMMDD i.e. 20110907)</label><br>
<input class=input_clear type=text name=new_submit_news_date value=" . $article_date . ">

<label>News Source <span class=label_note>(The full publication name and section of the news, or the home page URL with http:// in it)</label><br>
<input class=input_clear type=text name=new_submit_news_source value='" . $article_source . "'>

<label>News link <span class=label_note>(The link to the article)</label><br>
<input class=input_clear type=text name=new_submit_news_link value='" . $article_link . "'>

<label>News Summary <span class=label_note>(This is the content that shows up in our news section)</label><br>
<textarea name=new_submit_news_description>" . $article_description . "</textarea>

<input id=submit class=generic_admin_button type=submit value='Submit new feed'>
</form>

");








}

//
//
// Edit tags
//
//

elseif($_GET["action"] == "edit_tags") {

echo ("


<h1 class=news_header>Edit News Feed Topics</h1>
<p style=padding-bottom:15px><small>(You can enable or disable up to 10 tags at a time. So far you have edited <span id=tag_counter>0</span> tags.)</small></p>
<form method=POST action=inc.admin.edit-news-tags.php>
<input class=generic_admin_button type=submit value='Submit your edits'>

");


include ("inc.admin-user.connect.php");

$query = ("SELECT * FROM climate_tags ORDER by tag_name ASC");
$result = $db->query($query);

while($row = $result->fetch_array()) {

$tag_id = $row["tag_id"];
$tag_name = $row["tag_name"];
$tag_news = $row['tag_news'];
$tag_count = $row["tag_newsitems"];

if($tag_news == 1) {

echo ("

<p class=news_tag_edit><a class=news_tag_trigger title=1 href=# id=" . $tag_id . ">Deactivate</a>" . $tag_name . " <small>(" . $tag_count . ")</small></p>

");

}

else {
	
echo ("

<p class=news_tag_edit><a class=news_tag_trigger title=0 href=# id=" . $tag_id . ">Activate</a>" . $tag_name . " <small>(" . $tag_count . ")</small></p>

");

}	

}


echo ("

</form>

");

}


//
//
// Create new feeds
//
//


elseif($_GET["action"] == "new_feeds") {

echo ("

<h1 class=news_header>Add news feed</h1>
<p style=padding-bottom:15px><small>(You can add one RSS news feed at a time.)</small></p>
<form method=POST action=inc.admin.new-feeds.php>
<label>Feed Sidebar Title <span class=label_note>(This will show up in the sidebar so make it short)</label><br>
<input class=input_clear type=text name=new_submit_feed_sidebar>

<label>Feed Title <span class=label_note>(This is the title of the page in Google search)</label><br>
<div id=textarea_wrapper>

<input id=pagetitle_input class=input_clear type=text name=new_submit_feed_title>
</div>

<label>Feed Description <span class=label_note>(This is the description in Google search)</label><br>
<div class=textarea_wrapper>
<textarea id=description_textarea name=new_submit_feed_description></textarea>
</div>

<label>Feed URL <span class=label_note>(The RSS feed URL)</label><br>
<input class=input_clear type=text name=new_submit_feed_url>

<label>Feed source <span class=label_note>(The full name of the source, including things like the section of the website)</label><br>
<input class=input_clear type=text name=new_submit_feed_name>

<label>Feed link <span class=label_note>(a link to the source's website)</label><br>
<input class=input_clear type=text name=new_submit_feed_link>

<label class=label_extratop>Is this a special feed? <span class=label_note>(MIT News = special, NYT = not special)</span></label><br>
<label style=margin-top:0; class=article_radio>Yes</label><input class=article_radio_input type=radio name=new_submit_feed_special value=1>
<label style=margin-top:0; class=article_radio>No</label><input class=article_radio_input type=radio name=new_submit_feed_special value=0>

<label class=label_extratop>Enable images? <span class=label_note>(Images have the potential to really mess up the formatting, only select yes if you're 100% sure)</span></label><br>
<label style=margin-top:0; class=article_radio>Yes</label><input class=article_radio_input type=radio name=new_submit_feed_images value=1>
<label style=margin-top:0; class=article_radio>No</label><input class=article_radio_input type=radio name=new_submit_feed_images value=0>

<label class=label_extratop>Make active? <span class=label_note>(Selecting no will not put the feed in the live page)</span></label><br>
<label style=margin-top:0; class=article_radio>Yes</label><input class=article_radio_input type=radio name=new_submit_feed_live value=1>
<label style=margin-top:0; class=article_radio>No</label><input class=article_radio_input type=radio name=new_submit_feed_live value=0>

<input id=submit class=generic_admin_button type=submit value='Submit new feed'>
</form>




");

}


//
//
// Choose a news feed to edit
//
//

elseif($_GET["action"] == "choose_feeds") {
	
echo ("

<h1 class=news_header>Choose which news feed to edit</h1>
<p style=padding-bottom:15px><small>(Choose a feed, sorted by type and alphabetically)</small></p>

");

include("inc.admin-user.connect.php");

$query="SELECT source_id, source_sidebar, source_special, source_update FROM news_sources WHERE source_special = '1' ORDER BY source_sidebar ASC";
				
				$result=$db->query($query);
				echo ("<p style=margin-top:20px class=choose_feed_header><strong>Special Streams:</strong></p>");				
				
				while($row = $result->fetch_array()) {

				echo ("<a class=choose_feed_link href=admin.php?console=news&action=edit_feeds&sourceid=" . $row["source_id"] . ">" . $row["source_sidebar"] . "</a><p class=choose_feed_date>last update: " . date("D M d, Y", strtotime($row["source_update"])) . "</p>");
				
				}
				
				echo ("<br><br>");
				
$query="SELECT source_id, source_sidebar, source_special, source_update FROM news_sources WHERE source_special = '0' ORDER BY source_sidebar ASC";
				
				$result=$db->query($query);
				echo ("<p style=margin-top:30px class=choose_feed_header><strong>Main Streams:</strong></p>");				
				
				while($row = $result->fetch_array()) {

				echo ("<a class=choose_feed_link href=admin.php?console=news&action=edit_feeds&sourceid=" . $row["source_id"] . ">" . $row["source_sidebar"] . "</a><p class=choose_feed_date>last update: " . date("D M d, Y", strtotime($row["source_update"])) . "</p>");
				
				}
				

}

//
//
// Edit Feeds
//
//

elseif($_GET["action"] == "edit_feeds") {
	
include("inc.admin-user.connect.php");

$news_source = $_GET['sourceid'];

$query="SELECT source_id, source_sidebar, source_title, source_description, source_url, source_name, source_link, source_active, source_special, source_images FROM news_sources WHERE source_id = '$news_source'";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

				$source_id = $row['source_id'];
				$source_sidebar = htmlspecialchars($row['source_sidebar'], ENT_QUOTES);
				$source_title = htmlspecialchars($row['source_title'], ENT_QUOTES);
				$source_description = $row['source_description'];
				$source_url = $row['source_url'];
				$source_name = htmlspecialchars($row['source_name'], ENT_QUOTES);
				$source_link = $row['source_link'];
				$source_active = $row['source_active'];
				$source_special = $row['source_special'];
				$source_images = $row['source_images'];

				}

echo ("

<h1 class=news_header>Editing the " . $source_sidebar . " news feed</h1>
<p style=padding-bottom:15px><small>(Make any changes you need to then click the submit button at the bottom of the page.)</small></p>

<form method=POST action=inc.admin.edit-feeds.php>
<input type=hidden name=edit_submit_feed_id value=" . $source_id . ">
<label>Feed Sidebar Title <span class=label_note>(This will show up in the sidebar so make it short)</label><br>
<input class=input_clear type=text name=edit_submit_feed_sidebar value='" . $source_sidebar . "'>

<label>Feed Title <span class=label_note>(This is the title of the page in Google search)</label><br>
<div id=textarea_wrapper>

<input id=pagetitle_input class=input_clear type=text name=edit_submit_feed_title value='" . $source_title . "'>
</div>

<label>Feed Description <span class=label_note>(This is the description in Google search)</label><br>
<div class=textarea_wrapper>
<textarea id=description_textarea name=edit_submit_feed_description>" . $source_description . "</textarea>
</div>

<label>Feed URL <span class=label_note>(The RSS feed URL)</label><br>
<input class=input_clear type=text name=edit_submit_feed_url value=" . $source_url . ">

<label>Feed source <span class=label_note>(The full name of the source, including things like the section of the website)</label><br>
<input class=input_clear type=text name=edit_submit_feed_name value='" . $source_name . "'>

<label>Feed link <span class=label_note>(a link to the source's website)</label><br>
<input class=input_clear type=text name=edit_submit_feed_link value=" . $source_link . ">");

if($source_special == 0) {

echo ("

<label class=label_extratop>Is this a special feed? <span class=label_note>(MIT News = special, NYT = not special)</span></label><br>
<label style=margin-top:0; class=article_radio>Yes</label><input class=article_radio_input type=radio name=edit_submit_feed_special value=1>
<label style=margin-top:0; class=article_radio>No</label><input class=article_radio_input type=radio name=edit_submit_feed_special value=0 checked>

");

}

else {
	
echo ("

<label class=label_extratop>Is this a special feed? <span class=label_note>(MIT News = special, NYT = not special)</span></label><br>
<label style=margin-top:0; class=article_radio>Yes</label><input class=article_radio_input type=radio name=edit_submit_feed_special value=1 checked>
<label style=margin-top:0; class=article_radio>No</label><input class=article_radio_input type=radio name=edit_submit_feed_special value=0>

");

}

if($source_images == 0) {
	
echo ("

<label class=label_extratop>Enable images? <span class=label_note>(Images have the potential to really mess up the formatting, only select yes if you're 100% sure)</span></label><br>
<label style=margin-top:0; class=article_radio>Yes</label><input class=article_radio_input type=radio name=edit_submit_feed_images value=1>
<label style=margin-top:0; class=article_radio>No</label><input class=article_radio_input type=radio name=edit_submit_feed_images value=0 checked>

");

}

else {
	
echo ("
	
<label class=label_extratop>Enable images? <span class=label_note>(Images have the potential to really mess up the formatting, only select yes if you're 100% sure)</span></label><br>
<label style=margin-top:0; class=article_radio>Yes</label><input class=article_radio_input type=radio name=edit_submit_feed_images value=1 checked>
<label style=margin-top:0; class=article_radio>No</label><input class=article_radio_input type=radio name=edit_submit_feed_images value=0>

");

}

if($source_active == 0) {

echo ("

<label class=label_extratop>Make active? <span class=label_note>(Selecting no will not put the feed in the live page)</span></label><br>
<label style=margin-top:0; class=article_radio>Yes</label><input class=article_radio_input type=radio name=edit_submit_feed_live value=1>
<label style=margin-top:0; class=article_radio>No</label><input class=article_radio_input type=radio name=edit_submit_feed_live value=0 checked>

");

}

else {

echo ("

<label class=label_extratop>Make active? <span class=label_note>(Selecting no will not put the feed in the live page)</span></label><br>
<label style=margin-top:0; class=article_radio>Yes</label><input class=article_radio_input type=radio name=edit_submit_feed_live value=1 checked>
<label style=margin-top:0; class=article_radio>No</label><input class=article_radio_input type=radio name=edit_submit_feed_live value=0>

");

}

echo ("

<input id=submit class=generic_admin_button type=submit value='Submit edit feed'>
</form>

");





} // closes off edit feeds




//
//
// That's all of the actions! Below are the scripts
//
//

?>

<!-- page scripts -->
<script type="text/javascript" >

$(document).ready(function(){
	
// activating/deactivating news tags

window.tag_counter = 0;

$(".news_tag_trigger").click(function() {
	
	if($(this).attr("title") == 1) {
	// the tag was active, make it inactive
		$(this).fadeOut();
		$(this).text("Activate");
		$(this).fadeIn();
		$(this).attr("title", "0");
		var tag_id = $(this).attr("id");
		if($(this).attr("href") == "#"){
			if(window.tag_counter >= 10) {
				alert("You've already changed the status of 10 tags, please submit your edits before changing anything else.");
			}
			else {
				// it hasn't been clicked
				$(this).after("<input type=hidden id=edit_submit_tag_trigger" + window.tag_counter + " name=edit_submit_tag_trigger" + window.tag_counter + " value=0>");
				$(this).attr("href", window.tag_counter);
				$(this).after("<input type=hidden name=edit_submit_tag_id" + window.tag_counter + " value=" + tag_id + ">");
				window.tag_counter++;
				$("#tag_counter").text(window.tag_counter);
			}
		}
		else {
			// it's already been clicked
			var input_target = $(this).attr("href");
			$(this).text("Activate");
			$("#edit_submit_tag_trigger" + input_target).val("0");	
		}
		
	}	
	
	else if($(this).attr("title") == 0) {
	// the tag was inactive, make it active
		$(this).fadeOut();
		$(this).text("Deactivate");
		$(this).fadeIn();
		$(this).attr("title", "1");
		var tag_id = $(this).attr("id");
		if($(this).attr("href") == "#"){
			if(window.tag_counter >= 10) {
				alert("You've already changed the status of 10 tags, please submit your edits before changing anything else.");
			}
			else {
				// it hasn't been clicked
				$(this).after("<input type=hidden id=edit_submit_tag_trigger" + window.tag_counter + " name=edit_submit_tag_trigger" + window.tag_counter + " value=1>");
				$(this).attr("href", window.tag_counter);
				$(this).after("<input type=hidden name=edit_submit_tag_id" + window.tag_counter + " value=" + tag_id + ">");
				window.tag_counter++;
				$("#tag_counter").text(window.tag_counter);
			}
		}
		else {
			// it's already been clicked
			var input_target = $(this).attr("href");
			$(this).text("Deactivate");
			$("#edit_submit_tag_trigger" + input_target).val("1");	
		}	
	}	
	
	
return false;
});
	
	
	
	
});






</script>



</div> <!-- closes off admin_news -->
</div> <!-- closes off admin_command -->
</div> <!-- closes off admin_right -->