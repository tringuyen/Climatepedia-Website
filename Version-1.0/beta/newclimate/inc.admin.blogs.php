<?php

?>
<div id="admin_left">
<div id="admin_actions">
<p>Actions</p>
<ul>
<li><a href="admin.php?console=blogs&action=new_post" >New Blog Post</a></li>
<li><a href="admin.php?console=blogs&action=choose_post" >Edit Blog Post</a></li>
<li><a href="admin.php?console=blogs&action=new_images" >Add Images</a></li>
<li><a href="admin.php?console=blogs&action=choose_images" >Edit Images</a></li>
<li><a href="admin.php?console=blogs&action=new_blog" >Add New Blog</a></li>
<li><a href="admin.php?console=blogs&action=choose_blog" >Edit Blog Info</a></li>
<li><a href="admin.php?console=blogs&action=edit_tags" >Edit Tags</a></li>
<li><a href="admin.php?console=blogs&action=blogs_schedule" >Blogs Schedule</a></li>
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
<div id="admin_blogs">
<?php 

// Check if the user just completed an action



if($_GET["action"] == "success") {

// Check if it was an edit

if($_GET["type"] == "edit") {



// Check if they edited news

if($_GET["query"] == "post") {

$edit_post = urldecode($_GET['title']);
$edit_post_stripped = stripslashes($edit_post);
$post_id = $_GET['postid'];

echo ("

<h1>You successfully edited a blog post!</h1>
<p>The post you edited was: <a target=_blank href=http://www.climatepedia.org/beta/newclimate/blogs/post/" . $post_id . ">" . $edit_post_stripped . "</a>.</p>

");
	






}

// Check if they edited the tags

elseif($_GET["query"] == "tags") {

// Did they only edit one tag? (singular v.s. plural verbage changes)

$total_edits = $_GET['total'] + 1;

if($total_edits < 2) {

echo ("<h1>Congrats! You edited " . $total_edits . " blog topic!</h1>");
	
}

// If not then they edited more than one, use plural

else {

echo ("<h1>Congrats! You edited " . $total_edits . " blog topics total!</h1>");

}

echo ("<p>Your edits should be reflected in the sidebar of the blogs section now.</p>");





}


// Check if they edited the feeds

elseif($_GET["query"] == "blog") {

$edited_blog = urldecode($_GET['title']);
$edited_blog_stripped = stripslashes($edited_blog);

echo ("

<h1>You successfully edited a blog!</h1>
<p>The feed you edited was: " . $edited_blog_stripped . ". Your udpates should be showing now.</p>

");





}

// did they edit images?

// check if they edited some images

elseif($_GET["query"] == "images") {

// check if they altered images (v.s. deleting later)

if($_GET["function"] == "alter") {

$image_id = $_GET["id"];

echo ("<div id=editing_images><p>The updated information is shown below</p>");

include ("inc.admin-user.connect.php");
$query = ("SELECT image_id, image_path, image_description, image_source  FROM blogs_images WHERE image_id='$image_id'");
$result=$db->query($query);

while($row=$result->fetch_array()) {

$image_description = htmlspecialchars($row['image_description'], ENT_QUOTES);
$image_source = htmlspecialchars($row['image_source'], ENT_QUOTES);


echo ("

<img class=editable_image src=http://www.climatepedia.org/beta/newclimate/images_blog/" . $row['image_path'] . ">
<a class=editable_image_link target=blank href=http://www.climatepedia.org/beta/newclimate/images_blog/" . $row['image_path'] . ">Link to full-size version</a><p style=clear:none;padding-left:5px;line-height:20px;margin-top:0><small>(opens in a new tab)</small></p>
<p style=clear:left;padding-right:5px><strong>Description:</strong> </p><p class=editable_image_description>" . $image_description . "</p>
<p style=clear:left;padding-right:5px><strong>Source:</strong> </p><p class=editable_image_source>" . $image_source . "</p>
</div>
");

}

}

// check if they deleted an image

if($_GET["function"] == "delete") {
	
echo ("<p>Whatta <strong>BAMF</strong>, you sir/madam successfully deleted the image. In fact, it's SO gone that I can't even tell you which one it was. It's like Chuck Norris was here...</p>");
	
}

}

// Catch error

else {

echo ("<p>There appears to have been an error, please go back and try again. Sorry about that.</p>");


}

} // Closes off "edit" check

// Check if they created a new something

elseif($_GET["type"] == "new") {





if($_GET["query"] == "post") {

	
$new_post = urldecode($_GET['title']);
$new_post_stripped = stripslashes($new_post);
$post_id = $_GET['postid'];

echo ("

<h1>You successfully added a blog post!</h1>
<p>The post you created was: <a target=_blank href=http://www.climatepedia.org/beta/newclimate/blogs/post/" . $post_id . ">" . $new_post_stripped . "</a>.</p>

");
	




}


// Did they create a blog?

elseif($_GET["query"] == "blog") {
	
	
$new_blog = urldecode($_GET['title']);
$new_blog_stripped = stripslashes($new_blog);

echo ("

<h1>You successfully added a blog!</h1>
<p>The blog you created was: " . $new_blog_stripped . ". You should now see this blog in our Stack o' Blogs sidebar: <a target=_blank href=http://www.climatepedia.org/beta/newclimate/blogs>Stack o' Blogs main page</a>.</p>

");
	
}

// did they add images?

elseif($_GET['query'] == "images") {
	
// check for plurality

$new_blog = urldecode($_GET['title']);
$new_blog_stripped = stripslashes($new_blog);

if($_GET['total'] > 1) {

echo ("

<h1>Congrats, your new image was uploaded.</h1>
<p>You can view the new image in the article here: <a target=blank href=http://www.climatepedia.org/beta/newclimate/blogs/post/" . $_GET['id'] . ">" . $new_blog_stripped . "</a>. If you don't see your new image double-check that 'Enable images' is checked for your post in the 'Edit Post' menu.</p>

");

}

else {
	
echo ("

<h1>Congrats, your new images were uploaded.</h1>
<p>You can view the new image in the article here: <a href=http://www.climatepedia.org/beta/newclimate/blogs/post/" . $_GET['id'] . ">" . $new_blog_stripped . "</a>. If you don't see your new image double-check that 'Enable images' is checked for your post in the 'Edit Post' menu.</p>

");

}

}
	
	

// Missing variable, catch error

else {
	
	echo ("<p>There appears to have been an error, please go back and try again. Sorry about that.</p>");

}



} // closes off "new" check


} // closes off "success" check

//
//
// Blog Schedule
//
//


elseif($_GET["action"] == "blogs_schedule") {

echo "<h1>This hasn't been created yet because we haven't signed up any blogs!</h1>";

}







//
//
// New Post
//
//


elseif($_GET["action"] == "new_post") {


echo ("

<h1 class=blog_header>Create New Blog Post</h1>
<p style=padding-bottom:15px><small>(Make sure to check that the blog you're creating a post for hasn't had a post in at least 30 days.)</small></p>

<form method=POST action=inc.admin.new-post.php>
<label>Post name <span class=label_note>(On the web page)</span></label><input style=margin-top:15px type=text name=new_submit_post_name>

<label>Page title <span class=label_note>(In web browser - limit 70 chars)</span></label>
<div class=textarea_wrapper><input id=pagetitle_input type=text name=new_submit_post_title></div>

<label>Page description <span class=label_note>(In the web browser - limit 150 chars)</span></label>
<div class=textarea_wrapper><textarea name=new_submit_post_description id=description_textarea></textarea></div>

<label>Summary <span class=label_note>(This is the excerpt shown on our Stack o' Blogs page)</span></label>
<textarea name=new_submit_post_summary></textarea>


");

include("inc.admin-user.connect.php");

$query="SELECT blog_id, blog_sidebar, blog_posts FROM blogs_sources ORDER BY blog_sidebar ASC";
				$result=$db->query($query);

				echo ("<label style=margin-bottom:20px;margin-top:40px>Source:</label><select style=line-height:40px;margin-top:45px name=new_submit_post_source><option>Select blog source</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["blog_id"] . ">" . $row["blog_sidebar"] . " (" . $row["blog_posts"] . ")</option>");

				}
				
echo ("

</select>
<label class=label_extratop>Content  <span class=label_note>(Please read the directions to the left if you are unfamiliar with our required formatting)</span></label><br style=clear:both>
<textarea name=new_submit_post_content id=new_post_content></textarea>

");

include("inc.admin-user.connect.php");

$query="SELECT tag_id, tag_name, tag_blogitems FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);

				echo ("<label style=margin-top:40px>Tag 1:</label><select style=line-height:40px;margin-top:45px name=new_submit_post_tag1><option>Select Tag 1</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_blogitems"] . ")</option>");

				}

$query="SELECT tag_id, tag_name, tag_blogitems FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);

				echo ("</select><label>Tag 2:</label><select style=line-height:40px;margin-top:15px name=new_submit_post_tag2><option>Select Tag 2</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_blogitems"] . ")</option>");

				}
				
$query="SELECT tag_id, tag_name, tag_blogitems FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);

				echo ("</select><label>Tag 3:</label><select style=line-height:40px;margin-top:15px name=new_submit_post_tag3><option>Select Tag 3</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_blogitems"] . ")</option>");

				}
				echo ("</select>");		

echo ("

<label style=margin-top:40px>Post date <span class=label_note>(YYYY-MM-DD format, i.e. 2011-09-01)</span></label>
<input type=text name=new_submit_post_date>

<label style=margin-top:40px>Post URL <span class=label_note>(Link back to the individual post)</span></label>
<input type=text name=new_submit_post_url>

<label style=margin-top:40px>Enable images? <span class=label_note>(If you select yes make sure to upload your images from the 'Add Images' page right away)</span></label><br>
<label style=margin-top:0; class=article_radio>Yes</label><input class=article_radio_input type=radio name=new_submit_post_images value=1>
<label style=margin-top:0; class=article_radio>No</label><input class=article_radio_input type=radio name=new_submit_post_images value=0>

<input style=margin-top:40px class=generic_admin_button type=submit value='Publish the post!'>
</form>
</div>

");







	


// Initialize CKEDITOR

echo ("

<script type='text/javascript'>

	CKEDITOR.replace( 'new_post_content' );
	
</script>	

");

}


//
//
// Choose Posts
//
//


elseif($_GET["action"] == "choose_post") {

echo ("

<h1 class=news_header>Choose a Blog Post to Edit</h1>
<p style=padding-bottom:15px><small>(Sorted by most recent)</small></p>
");

include("inc.admin-user.connect.php");

$query="SELECT post_id, post_name, post_update FROM blogs_posts ORDER BY post_update DESC";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

				echo ("<a class=choose_post_link href=admin.php?console=blogs&action=edit_post&post=" . $row["post_id"] . ">" . $row["post_name"] . "</a><p class=choose_post_date>posted: " . $row["post_update"] . "</p>");
				
				}

}

//
//
// Edit Post
//
//


elseif($_GET["action"] == "edit_post") {

$post_id = $_GET['post'];

include("inc.admin-user.connect.php");
$query = ("SELECT * FROM blogs_posts WHERE post_id = '$post_id'");
$result=$db->query($query);
while($row=$result->fetch_array()) {
	
	$post_title = htmlspecialchars($row['post_title'], ENT_QUOTES);
	$post_description = htmlspecialchars($row['post_description'], ENT_QUOTES);
	$post_name = htmlspecialchars($row['post_name'], ENT_QUOTES);
	$post_summary = htmlspecialchars($row['post_summary'], ENT_QUOTES);
	$post_content = htmlspecialchars($row['post_content'], ENT_QUOTES);
	$post_images = htmlspecialchars($row['post_images'], ENT_QUOTES);
	$post_tag1_id = htmlspecialchars($row['post_tag1'], ENT_QUOTES);	
	$post_tag2_id = htmlspecialchars($row['post_tag2'], ENT_QUOTES);
	$post_tag3_id = htmlspecialchars($row['post_tag3'], ENT_QUOTES);
	$post_source = htmlspecialchars($row['post_source'], ENT_QUOTES);
	$post_url = htmlspecialchars($row['post_url'], ENT_QUOTES);
	$post_date = htmlspecialchars($row['post_date'], ENT_QUOTES);
	$post_update = htmlspecialchars($row['post_update'], ENT_QUOTES);	
	
}

$query="SELECT tag_id, tag_name, tag_blogitems FROM climate_tags WHERE tag_id = '$post_tag1_id'";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

					$post_tag1 = $row["tag_name"];
					$post_tag1_count = $row["tag_blogitems"];
	
				}
	
$query="SELECT tag_id, tag_name, tag_blogitems FROM climate_tags WHERE tag_id = '$post_tag2_id'";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

					$post_tag2 = $row["tag_name"];
					$post_tag2_count = $row["tag_blogitems"];
	
				}
				
$query="SELECT tag_id, tag_name, tag_blogitems FROM climate_tags WHERE tag_id = '$post_tag3_id'";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

					$post_tag3 = $row["tag_name"];
					$post_tag3_count = $row["tag_blogitems"];
	
				}
				
$query="SELECT blog_id, blog_sidebar, blog_posts FROM blogs_sources WHERE blog_id = '$post_source'";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

					$post_source_name = $row["blog_sidebar"];
					$post_source_count = $row["blog_posts"];
	
				}
				

echo ("

<h1 class=blog_header>Editing Blog Post</h1>
<p style=padding-bottom:15px><small>(Make sure to check that the blog you're creating a post for hasn't had a post in at least 30 days.)</small></p>

<form method=POST action=inc.admin.edit-post.php>
<input type=hidden name=edit_submit_post_id value='" . $post_id . "'>
<input type=hidden name=edit_submit_post_oldtag1 value='" . $post_tag1_id . "'>
<input type=hidden name=edit_submit_post_oldtag2 value='" . $post_tag2_id . "'>
<input type=hidden name=edit_submit_post_oldtag3 value='" . $post_tag3_id . "'>
<input type=hidden name=edit_submit_post_oldsource value='" . $post_source . "'>

<label>Post name <span class=label_note>(On the web page)</span></label><input style=margin-top:15px type=text name=edit_submit_post_name value='" . $post_name . "'>

<label>Page title <span class=label_note>(In web browser - limit 70 chars)</span></label>
<div class=textarea_wrapper><input id=pagetitle_input type=text name=edit_submit_post_title value='" . $post_title . "'></div>

<label>Page description <span class=label_note>(In the web browser - limit 150 chars)</span></label>
<div class=textarea_wrapper><textarea name=edit_submit_post_description id=description_textarea>" . $post_description . "</textarea></div>

<label>Summary <span class=label_note>(This is the excerpt shown on our Stack o' Blogs page)</span></label>
<textarea name=edit_submit_post_summary>" . $post_summary . "</textarea>


");

include("inc.admin-user.connect.php");

$query="SELECT blog_id, blog_sidebar, blog_posts FROM blogs_sources";
				$result=$db->query($query);

				echo ("<label style=margin-bottom:20px;margin-top:40px>Source:</label><select style=line-height:40px;margin-top:45px name=edit_submit_post_source><option value=" . $post_source . ">" . $post_source_name . " (" . $post_source_count . ")</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["blog_id"] . ">" . $row["blog_sidebar"] . " (" . $row["blog_posts"] . ")</option>");

				}
				
echo ("

</select>
<label class=label_extratop>Content  <span class=label_note>(Please read the directions to the left if you are unfamiliar with our required formatting)</span></label><br style=clear:both>
<textarea name=edit_submit_post_content id=new_post_content>" . $post_content . "</textarea>

");

include("inc.admin-user.connect.php");

$query="SELECT tag_id, tag_name, tag_blogitems FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);

				echo ("<label style=margin-top:40px>Tag 1:</label><select style=line-height:40px;margin-top:45px name=edit_submit_post_tag1><option value=" . $post_tag1_id . ">" . $post_tag1 . " (" . $post_tag1_count . ")</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_blogitems"] . ")</option>");

				}

$query="SELECT tag_id, tag_name, tag_blogitems FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);

				echo ("</select><label>Tag 2:</label><select style=line-height:40px;margin-top:15px name=edit_submit_post_tag2><option value=" . $post_tag2_id . ">" . $post_tag2 . " (" . $post_tag2_count . ")</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_blogitems"] . ")</option>");

				}
				
$query="SELECT tag_id, tag_name, tag_blogitems FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);

				echo ("</select><label>Tag 3:</label><select style=line-height:40px;margin-top:15px name=edit_submit_post_tag3><option value=" . $post_tag3_id . ">" . $post_tag3 . " (" . $post_tag3_count . ")</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_blogitems"] . ")</option>");

				}
				echo ("</select>");		

echo ("

<label style=margin-top:40px>Original post date <span class=label_note>(YYYY-MM-DD format, i.e. 2011-09-01)</span></label>
<input type=text name=edit_submit_post_date value='" . $post_date . "'>

<label style=margin-top:40px>Our post date <span class=label_note>(YYYY-MM-DD format, i.e. 2011-09-01)</span></label>
<input type=text name=edit_submit_post_update value='" . $post_update . "'>

<label style=margin-top:40px>Post URL <span class=label_note>(Link back to the individual post)</span></label>
<input type=text name=edit_submit_post_url value='" . $post_url . "'>

");

if($post_images == 0) {

echo ("

<label style=margin-top:40px>Enable images? <span class=label_note>(If you select yes make sure to upload your images from the 'Add Images' page right away)</span></label><br>
<label style=margin-top:0; class=article_radio>Yes</label><input class=article_radio_input type=radio name=edit_submit_post_images value=1>
<label style=margin-top:0; class=article_radio>No</label><input class=article_radio_input type=radio name=edit_submit_post_images value=0 checked>

");

}

else {
	
echo ("


<label style=margin-top:40px>Enable images? <span class=label_note>(If you select yes make sure to upload your images from the 'Add Images' page right away)</span></label><br>
<label style=margin-top:0; class=article_radio>Yes</label><input class=article_radio_input type=radio name=edit_submit_post_images value=1 checked>
<label style=margin-top:0; class=article_radio>No</label><input class=article_radio_input type=radio name=edit_submit_post_images value=0>

");	
	
	
	
}

// Initialize CKEDITOR


echo ("


<input style=margin-top:40px class=generic_admin_button type=submit value='Publish the post!'>
</form>
</div>

<script type='text/javascript'>

	CKEDITOR.replace( 'new_post_content' );
	
</script>	


");








// Initialize CKEDITOR

echo ("

<script type='text/javascript'>

	CKEDITOR2.replace( 'edit_post_content' );
	
</script>	

");

}


//
//
// New Blog
//
//


elseif($_GET["action"] == "new_blog") {

echo ("	
	

<h1 class=blog_header>Add a new blog</h1>
<p>If you found a new blog about Climate Change or a related topic that you would like to add you can do so here.</p>
<form method=POST action=inc.admin.new-blog.php>

<label>Blog Sidebar Title <span class=label_note>(This will show up in the sidebar so make it short)</label><br>
<input class=input_clear type=text name=new_submit_blog_sidebar>

<label>Blog Title <span class=label_note>(This is the title of the blog when viewing only posts by this blog)</label><br>
<div id=textarea_wrapper>
<input id=blogtitle_input class=input_clear type=text name=new_submit_blog_title>
</div>

<label>Blog URL <span class=label_note>(The Blog's homepage with http:// like http://www.realclimate.com)</label><br>
<input class=input_clear type=text name=new_submit_blog_url>

");

include("inc.admin-user.connect.php");
$query="SELECT tag_id, tag_name, tag_blogitems FROM climate_tags";
				$result=$db->query($query);

				echo ("<label>Primary Tag:</label><select style=line-height:40px;margin-top:15px name=new_submit_blog_tag><option>Select a Tag</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . "</option>");

				}


echo ("

</select>
<label>Blog Description <span class=label_note>(This is a description of the blog in our list of blogs)</label><br>
<div class=textarea_wrapper>
<textarea id=blogdescription_textarea name=new_submit_blog_description></textarea>
</div>

<label>Blog Stance <span class=label_note>(Is this blog strongly supportive of climate change, neutral, or against climate change?)</label><br>
<select name=new_submit_blog_stance>
<option>Select a stance</option>
<option value=For>+ Supportive</option>
<option value=Neutral>/ Neutral</option>
<option value=Against>- Against</option>
</select>

<label class=label_extratop>Make active? <span class=label_note>(Selecting no will not put the blog in the live page)</span></label><br>
<label style=margin-top:0; class=article_radio>Yes</label><input class=article_radio_input type=radio name=new_submit_blog_active value=1>
<label style=margin-top:0; class=article_radio>No</label><input class=article_radio_input type=radio name=new_submit_blog_active value=0>

<input id=submit class=generic_admin_button type=submit value='Submit new blog'>
</form>

");


}



//
//
// Choose Blog
//
//

elseif($_GET["action"] == "choose_blog") {

echo ("

<h1 class=news_header>Choose which blog's info to edit</h1>
<p style=padding-bottom:15px><small>(Blogs sorted alphabetically)</small></p>

");

include("inc.admin-user.connect.php");

$query="SELECT blog_id, blog_sidebar, blog_latest FROM blogs_sources ORDER BY blog_name ASC";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {
				if($row["blog_latest"] == 0000-00-00) {$blog_latest = "No posts";}
				else {$blog_latest = $row['blog_latest'];}

				echo ("<a class=choose_blog_link href=admin.php?console=blogs&action=edit_blog&blogid=" . $row["blog_id"] . ">" . $row["blog_sidebar"] . "</a><p class=choose_blog_date>last post: " . $blog_latest . "</p>");
				
				}







}


//
//
// Edit Blog
//
//


elseif($_GET["action"] == "edit_blog") {



include("inc.admin-user.connect.php");

$blog_id = $_GET['blogid'];

$query="SELECT blog_id, blog_sidebar, blog_name, blog_url, blog_description, blog_stance, blog_tag, blog_active FROM blogs_sources WHERE blog_id = '$blog_id'";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

				$blog_id = $row['blog_id'];
				$blog_sidebar = htmlspecialchars($row['blog_sidebar'], ENT_QUOTES);
				$blog_name = htmlspecialchars($row['blog_name'], ENT_QUOTES);
				$blog_url = $row['blog_url'];
				$blog_description = $row['blog_description'];
				$blog_stance = htmlspecialchars($row['blog_stance'], ENT_QUOTES);
				$blog_tag = $row['blog_tag'];
				$blog_active = $row['blog_active'];

				}
				
$query = "SELECT tag_name FROM climate_tags WHERE tag_id = '$blog_tag'";
$result=$db->query($query);
while($row=$result->fetch_array()) {
	$blog_tag_name = $row['tag_name'];
}

echo ("

<h1 class=blog_header>Editing the " . $blog_sidebar . " blog info</h1>
<p style=padding-bottom:15px><small>(Make any changes you need to then click the submit button at the bottom of the page.)</small></p>

<form method=POST action=inc.admin.edit-blog.php>
<input type=hidden name=edit_submit_blog_id value=" . $blog_id . ">
<label>Blog Sidebar Title <span class=label_note>(This will show up in the sidebar so make it short)</label><br>
<input class=input_clear type=text name=edit_submit_blog_sidebar value='" . $blog_sidebar . "'>

<label>Blog Title <span class=label_note>(This is the title of the blog when viewing only posts by that blog)</label><br>
<div id=textarea_wrapper>
<input id=blogtitle_input class=input_clear type=text name=edit_submit_blog_name value='" . $blog_name . "'>
</div>

<label>Blog URL <span class=label_note>(The Blog's homepage with http:// like http://www.realclimate.com)</label><br>
<input class=input_clear type=text name=edit_submit_blog_url value=" . $blog_url . ">

");

include("inc.admin-user.connect.php");
$query="SELECT tag_id, tag_name, tag_blogitems FROM climate_tags";
				$result=$db->query($query);

				echo ("<label>Primary Tag:</label><select style=line-height:40px;margin-top:15px name=new_submit_blog_tag><option>" . $blog_tag_name . "</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . "</option>");

				}


echo ("

</select>

<label>Blog Description <span class=label_note>(This is the description of the blog when viewing only posts by that blog)</label><br>
<div class=textarea_wrapper>
<textarea id=blogdescription_textarea name=edit_submit_blog_description>" . $blog_description . "</textarea>
</div>

<label>Blog Stance <span class=label_note>(Is this blog strongly supportive of climate change, neutral, or against climate change?)</label><br>
<select name=new_submit_blog_stance>
<option value=" . $blow_stance . ">" . $blog_stance . "</option>
<option value=For>+ Supportive</option>
<option value=Neutral>/ Neutral</option>
<option value=Against>- Against</option>
</select>

");

if($blog_active == 0) {

echo ("

<label class=label_extratop>Make active? <span class=label_note>(Selecting no will not put the blog in the live page)</span></label><br>
<label style=margin-top:0; class=article_radio>Yes</label><input class=article_radio_input type=radio name=edit_submit_blog_live value=1>
<label style=margin-top:0; class=article_radio>No</label><input class=article_radio_input type=radio name=edit_submit_blog_live value=0 checked>

");

}

else {

echo ("

<label class=label_extratop>Make active? <span class=label_note>(Selecting no will not put the blog in the live page)</span></label><br>
<label style=margin-top:0; class=article_radio>Yes</label><input class=article_radio_input type=radio name=edit_submit_blog_live value=1 checked>
<label style=margin-top:0; class=article_radio>No</label><input class=article_radio_input type=radio name=edit_submit_blog_live value=0>

");

}

echo ("

<input id=submit class=generic_admin_button type=submit value='Submit edit blog'>
</form>

");








}



//
//
// Edit Tags
//
//

elseif($_GET["action"] == "edit_tags") {
	
	

echo ("


<h1 class=news_header>Edit Blog Topics</h1>
<p style=padding-bottom:15px><small>(You can enable or disable up to 10 tags at a time. The number of posts tagged with that topic are in parentheses. So far you have edited <span id=tag_counter>0</span> tags.)</small></p>
<form method=POST action=inc.admin.edit-blog-tags.php>
<input class=generic_admin_button type=submit value='Submit your edits'>

");


include ("inc.admin-user.connect.php");

$query = ("SELECT * FROM climate_tags ORDER by tag_name ASC");
$result = $db->query($query);

while($row = $result->fetch_array()) {

$tag_id = $row["tag_id"];
$tag_name = $row["tag_name"];
$tag_news = $row['tag_blogs'];
$tag_count = $row["tag_blogitems"];

if($tag_news == 1) {

echo ("

<p class=blog_tag_edit><a class=blog_tag_trigger title=1 href=# id=" . $tag_id . ">Deactivate</a>" . $tag_name . " <small>(" . $tag_count . ")</small></p>

");

}

else {
	
echo ("

<p class=blog_tag_edit><a class=blog_tag_trigger title=0 href=# id=" . $tag_id . ">Activate</a>" . $tag_name . " <small>(" . $tag_count . ")</small></p>

");

}	

}


echo ("

</form>

");



}


//
//
// New Images
//
//


elseif($_GET["action"] == "new_images") {
	
	
$upload_image_limit = 5; // How many images you want to upload at once?




echo ("

<h1>Upload new images</h1>
<p style=padding-bottom:15px><small>(You can edit simultaneously upload up to 5 images.)</small></p>

");

$i = 1;
	while($i <= $upload_image_limit){
		$form_img .= '<label style=margin-top:50px><strong>Image '.$i.': </strong></label><input style=margin-top:50px type="file" name=image' . $i . '>
		<label style=margin-top:4px>Image '. $i . ' name: </label><input type=text name=new_submit_image_name' . $i . '>
		<label style=margin-top: 4px>Image '. $i . ' description: </label><input type=text name=new_submit_image_description' . $i . '>
		<label style=margin-top: 4px>Image '. $i . ' source: </label><input type=text name=new_submit_image_source' . $i . '>
		
		
		';
	
	$i++;
	}




echo ("

		<form method=POST enctype=multipart/form-data action=inc.admin.new-blog-images.php>
		<select id=check_select name=new_submit_images_post><option value='N'>Choose a post to upload images for</option>
");

include ("inc.admin-user.connect.php");
$query = ("SELECT post_id, post_name, post_update FROM blogs_posts ORDER by post_update DESC");
$result = $db->query($query);

while($row = $result->fetch_array()) {
	
	echo ("
	
		<option value=" . $row['post_id'] . ">" . $row['post_name'] . " (" . $row['post_update'] . ")</option>
	
	");
	
}

echo ("</select>" . $form_img . "

			<input name=Submit class=generic_admin_button type=submit value='Upload Images!' style=margin-top:50px >
		</form>

		

");


}



//
//
// Choose Images
//
//


elseif($_GET["action"] == "choose_images") {
	
echo ("

<h1>Choose which blog post's images you want to edit</h1>
<p style=padding-bottom:15px><small>(Sorted chronologically)</small></p>

");

include("inc.admin-user.connect.php");

$query="SELECT post_id, post_name, post_update FROM blogs_posts ORDER BY post_update DESC";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

				echo ("<a class=choose_post_link href=admin.php?console=blogs&action=edit_images&postid=" . $row["post_id"] . ">" . $row["post_name"] . "</a><p class=choose_post_date>posted: " . $row["post_update"] . "</p>");
				
				}

	

	
	
}


//
//
// Edit Images
//
//


elseif($_GET["action"] == "edit_images") {
	

include("inc.admin-user.connect.php");

$image_post = $_GET['postid'];

$query="SELECT post_id, post_name FROM blogs_posts WHERE post_id = '$image_post'";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

				$post_name = $row['post_name'];
					
				}
	
	
	
echo ("

<h1>Edit images for '" . $post_name . "'</h1>
<p style=padding-bottom:15px><small>(You can edit one image at a time. If you need to change an image you must delete it and then re-upload it.)</small></p>
<div id=editing_images>

");



include ("inc.admin-user.connect.php");

$query = ("SELECT * FROM blogs_images WHERE image_post = '$image_post' ORDER BY image_order ASC");
$result=$db->query($query);

$image_number = 0;

while($row=$result->fetch_array()) {

$image_description = htmlspecialchars($row['image_description'], ENT_QUOTES);
$image_source = htmlspecialchars($row['image_source'], ENT_QUOTES);

echo ("
<form method=POST action=inc.admin.edit-blog-images.php>
<div id=image" . $image_number . ">

<img class=editable_image id=image_edit" . $image_number . " src=http://www.climatepedia.org/beta/newclimate/images_blog/" . $row['image_path'] . ">
<input type=hidden name=edit_submit_image_path value=" . $row['image_path'] . ">

<a class=editable_image_link target=blank href=http://www.climatepedia.org/beta/newclimate/images_blog/" . $row['image_path'] . ">Link to full-size version</a><p style=clear:none;padding-left:5px;line-height:20px;margin-top:0><small>(opens in a new tab)</small></p>
<p style=clear:left;padding-right:5px><strong>Description:</strong> </p><p id=image" . $image_number . "_description class=editable_image_description>" . $image_description . "</p>
<p style=clear:left;padding-right:5px><strong>Source:</strong> </p><p id=image" . $image_number . "_source class=editable_image_source>" . $image_source . "</p>
<a id=edit_image". $image_number . "_trigger style=margin-top:5px title=" . $row['image_id'] . " class=editable_image_trigger href=image" . $image_number . ">&uarr; Edit this image</a>
<a id=delete_image". $image_number . "_trigger style=margin-bottom:30px;margin-top:5px class=delete_image_trigger href=" . $row["image_id"] . "><span style=color:red>X </span>Delete this image</a>

</div>
</form>
");

$image_number++;

}

echo ("
</div>

");
	

	
	
}





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

$(".blog_tag_trigger").click(function() {
	
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


// Editing images script

$(".editable_image_trigger").live("click", function(){
	
	window.the_image_id = $(this).attr("title");
	window.the_image = $(this).attr("href").replace(/'/g, "&#39;");
	window.the_description = $("#" + window.the_image + "_description").text().replace(/'/g, "&#39;");
	window.the_source = $("#" + window.the_image + "_source").text();
	
	$("#" + window.the_image + "_description").replaceWith("<input id=description_input_" + window.the_image + " type=text name=edit_submit_image_description value='" + window.the_description + "'>");
	$("#" + window.the_image + "_source").replaceWith("<input id=source_input_" + window.the_image + " name=edit_submit_image_source type=text value='" + window.the_source + "'>");
	
	$(this).after("<input id=editing_image_id name=edit_submit_image_id type=hidden value=" + window.the_image_id + ">");
	$(this).after("<input id=submit_image_edits class=generic_admin_button type=submit value='Submit your changes'>");
	$("#edit_" + window.the_image + "_trigger").replaceWith("<a style=margin-top:5px;margin-bottom:30px id=stop_edit_" + window.the_image + "_trigger href=# class=stop_edit>&uarr; Stop editing this image</a>");
	
	
	
	return false;

});

$(".stop_edit").live("click", function(){
	
	$("#description_input_" + window.the_image).replaceWith("<p id=" + window.the_image + "_description  class=editable_image_source>" + window.the_description + "</p>");
	$("#source_input_" + window.the_image).replaceWith("<p id=" + window.the_image + "_source  class=editable_image_description>" + window.the_source + "</p>");
	
	$("#editing_image_id").remove();
	$("#submit_image_edits").remove();
	$("#stop_edit_" + window.the_image + "_trigger").replaceWith("<a style=margin-top:5px id=edit_" + window.the_image + "_trigger href=" + window.the_image + " class=editable_image_trigger>&uarr; Edit this image</a>");
	return false;
	

});



$(".delete_image_trigger").click(function(){
	
	window.button_clicked = $(this).attr("id")
	window.image_deleting = $(this).attr("href");

	function show_confirm()
		{		
			var r=confirm("Are you sure you want to delete this image?");
			if (r==true)
  		{

		$("#" + window.button_clicked).html("<span style=color:red>!! The image above will be deleted when you click the button below</span>");
		$("#" + window.button_clicked).after("<input type=hidden name=edit_submit_delete_image value=" + window.image_deleting + ">");
		$("#" + window.button_clicked).after("<input id=submit_image_edits class=generic_admin_button type=submit value='Submit your changes'>");
		return false;

  		}

	else
  		
  		{

		return false;

  		}
  		
		}
		
	show_confirm();
	
	return false;
	
});





</script>



</div> <!-- closes off admin_news -->
</div> <!-- closes off admin_command -->
</div> <!-- closes off admin_right -->