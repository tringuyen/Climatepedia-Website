<?php

?>
<div id="admin_left">
<div id="admin_actions">
<p>Actions</p>
<ul>
<li><a href="admin.php?console=podium&action=new_post" >New Post</a></li>
<li><a href="admin.php?console=podium&action=choose_post" >Edit Post</a></li>
<li><a href="admin.php?console=podium&action=new_images" >Add Images</a></li>
<li><a href="admin.php?console=podium&action=choose_images" >Edit Images</a></li>
<li><a href="admin.php?console=podium&action=new_professor" >New Professor</a></li>
<li><a href="admin.php?console=podium&action=choose_professor" >Edit Professor</a></li>
<li><a href="admin.php?console=podium&action=new_university" >New University</a></li>
<li><a href="admin.php?console=podium&action=choose_university" >Edit University</a></li>
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
<div id="admin_podium">
<?php 

// Check if the user just completed an action



if($_GET["action"] == "success") {

// Check if it was an edit

if($_GET["type"] == "edit") {



// Check if they edited a post

if($_GET["query"] == "post") {

$edit_post = urldecode($_GET['title']);
$edit_post_stripped = stripslashes($edit_post);
$post_url = $_GET['url'];

echo ("

<h1>You successfully edited a professor post!</h1>
<p>The post you edited was: <a target=_blank href=http://www.climatepedia.org/beta/newclimate/podium/" . $post_url . ">" . $edit_post_stripped . "</a>.</p>

");
	






}

// did they edit professor info?

elseif($_GET["query"] == "professor") {
	
	
$new_professor = urldecode($_GET['title']);
$new_professor_stripped = stripslashes($new_professor);

echo ("

<h1>You successfully edited a professor's info!</h1>
<p>The professor you edited was: " . $new_professor_stripped . ".</p>

");
	
}


// Check if they edited a university

elseif($_GET["query"] == "university") {

$edited_university = urldecode($_GET['title']);
$edited_university_stripped = stripslashes($edited_university);

echo ("

<h1>You successfully edited a university!</h1>
<p>The university you edited was: " . $edited_university_stripped . ". Your udpates should be showing now.</p>

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
$query = ("SELECT image_id, image_type, image_path, image_description, image_source  FROM podium_images WHERE image_id='$image_id'");
$result=$db->query($query);

while($row=$result->fetch_array()) {

$image_description = htmlspecialchars($row['image_description'], ENT_QUOTES);
$image_source = htmlspecialchars($row['image_source'], ENT_QUOTES);
$image_type = $row['image_type'];
if($image_type == 1) {
$folder = "professors";
}

elseif($image_type== 2) {
$folder = "universities";

}

elseif($image_type == 3) {
$folder = "posts";

}

echo ("

<img class=editable_image src=http://www.climatepedia.org/beta/newclimate/images_podium/" . $folder . "/" . $row['image_path'] . ">
<a class=editable_image_link target=blank href=http://www.climatepedia.org/beta/newclimate/images_podium/" . $folder . "/" . $row['image_path'] . ">Link to full-size version</a><p style=clear:none;padding-left:5px;line-height:20px;margin-top:0><small>(opens in a new tab)</small></p>
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
$post_url = $_GET['url'];

echo ("

<h1>You successfully added a professor post!</h1>
<p>The post you created was: <a target=_blank href=http://www.climatepedia.org/beta/newclimate/podium/" . $post_url . ">" . $new_post_stripped . "</a>.</p>

");
	




}


// Did they add a professor?

elseif($_GET["query"] == "professor") {
	
	
$new_professor = urldecode($_GET['title']);
$new_professor_stripped = stripslashes($new_professor);

echo ("

<h1>You successfully added a professor!</h1>
<p>The professor you added was: " . $new_professor_stripped . ".</p>

");
	
}

// did they add a university?

elseif($_GET['query'] == "university") {
	

$new_university = urldecode($_GET['title']);
$new_university_stripped = stripslashes($new_university);



echo ("

<h1>Congrats, your new university was added.</h1>
<p>The university's name is: " . $new_university_stripped . ".</p>

");




}

// did they add a professor image?

elseif($_GET['query'] == "professor_image") {
	
// check for plurality

$new_post = urldecode($_GET['title']);
$new_post_stripped = stripslashes($new_post);




echo ("

<h1>Congrats, your new image was uploaded.</h1>
<p>The new image was uploaded for the professor " . $new_post_stripped . ".</p>

");


}
	
	// did they add a university image?

elseif($_GET['query'] == "university_image") {
	
// check for plurality

$new_post = urldecode($_GET['title']);
$new_post_stripped = stripslashes($new_post);




echo ("

<h1>Congrats, your new image was uploaded.</h1>
<p>The new image was uploaded for " . $new_post_stripped . ".</p>

");


}

// did they add images?

elseif($_GET['query'] == "post_image") {
	
// check for plurality

$new_post = urldecode($_GET['title']);
$new_post_stripped = stripslashes($new_post);

if($_GET['total'] > 1) {

echo ("

<h1>Congrats, your new image was uploaded.</h1>
<p>You can view the new image in the post here: <a target=blank href=http://www.climatepedia.org/beta/newclimate/podium/" . $_GET['url'] . ">" . $new_post_stripped . "</a>. If you don't see your new image double-check that 'Enable images' is checked for your post in the 'Edit Post' menu.</p>

");

}

else {
	
echo ("

<h1>Congrats, your new images were uploaded.</h1>
<p>You can view the new images in the post here: <a target=blank href=http://www.climatepedia.org/beta/newclimate/podium/" . $_GET['url'] . ">" . $new_post_stripped . "</a>. If you don't see your new image double-check that 'Enable images' is checked for your post in the 'Edit Post' menu.</p>

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
// New Post
//
//


elseif($_GET["action"] == "new_post") {


echo ("

<h1 class=podium_header>Create New Professor Post</h1>
<p style=padding-bottom:15px><small>(Enter a new professor post - yippee!)</small></p>

<form method=POST action=inc.admin.new-professor-post.php>
<label>Post name <span class=label_note>(On the web page)</span></label><input style=margin-top:15px type=text name=new_submit_post_name>

<label>Page title <span class=label_note>(In web browser - limit 70 chars.)</span></label>
<div class=textarea_wrapper><input id=pagetitle_input type=text name=new_submit_post_title></div>

<label>Page description <span class=label_note>(In the web browser - limit 150 chars)</span></label>
<div class=textarea_wrapper><textarea name=new_submit_post_description id=description_textarea></textarea></div>

<label style=margin-top:40px>Post URL <span class=label_note>(Please read the help section to the left! Ex: climate-change-interview-with-roger-holbrix-marine-biogeochemist)</span></label>
<input type=text name=new_submit_post_url>

<label>Summary <span class=label_note>(This is the excerpt shown on our main professor posts page.)</span></label>
<textarea name=new_submit_post_summary></textarea>


");

include("inc.admin-user.connect.php");

$query="SELECT professor_id, professor_title, professor_firstname, professor_lastname FROM podium_professors ORDER BY professor_firstname ASC";
				$result=$db->query($query);

				echo ("<label style=margin-bottom:20px;margin-top:40px>Professor:</label><select style=line-height:40px;margin-top:45px name=new_submit_post_professor><option>Select professor</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["professor_id"] . ">" . $row["professor_title"] . " " . $row["professor_firstname"] . " " . $row["professor_lastname"] . "</option>");

				}
				
echo ("

</select>
<label class=label_extratop>Content  <span class=label_note>(Please read the directions to the left if you are unfamiliar with our required formatting)</span></label><br style=clear:both>
<textarea name=new_submit_post_content id=new_post_content></textarea>

");

include("inc.admin-user.connect.php");

$query="SELECT tag_id, tag_name, tag_professoritems FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);

				echo ("<label style=margin-top:40px>Tag 1:</label><select style=line-height:40px;margin-top:45px name=new_submit_post_tag1><option>Select Tag 1</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_professoritems"] . ")</option>");

				}

$query="SELECT tag_id, tag_name, tag_professoritems FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);

				echo ("</select><label>Tag 2:</label><select style=line-height:40px;margin-top:15px name=new_submit_post_tag2><option>Select Tag 2</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_professoritems"] . ")</option>");

				}
				
$query="SELECT tag_id, tag_name, tag_professoritems FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);

				echo ("</select><label>Tag 3:</label><select style=line-height:40px;margin-top:15px name=new_submit_post_tag3><option>Select Tag 3</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_professoritems"] . ")</option>");

				}
				echo ("</select>");		

echo ("

<label style=margin-top:40px>Post date <span class=label_note>(YYYY-MM-DD format, i.e. 2011-09-01)</span></label>
<input type=text name=new_submit_post_date>

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

<h1 class=news_header>Choose a Professor Post to Edit</h1>
<p style=padding-bottom:15px><small>(Sorted by most recent)</small></p>
");

include("inc.admin-user.connect.php");

$query="SELECT post_id, post_name, post_date FROM podium_posts ORDER BY post_date DESC";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

				echo ("<a class=choose_podium_link href=admin.php?console=podium&action=edit_post&post=" . $row["post_id"] . ">" . $row["post_name"] . "</a><p class=choose_podium_date>posted: " . $row["post_date"] . "</p>");
				
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
$query = ("SELECT * FROM podium_posts WHERE post_id = '$post_id'");
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
	$post_professor = htmlspecialchars($row['post_professor'], ENT_QUOTES);
	$post_url = htmlspecialchars($row['post_url'], ENT_QUOTES);
	$post_date = htmlspecialchars($row['post_date'], ENT_QUOTES);

	
}

$query="SELECT tag_id, tag_name, tag_professoritems FROM climate_tags WHERE tag_id = '$post_tag1_id'";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

					$post_tag1 = $row["tag_name"];
					$post_tag1_count = $row["tag_professoritems"];
	
				}
	
$query="SELECT tag_id, tag_name, tag_professoritems FROM climate_tags WHERE tag_id = '$post_tag2_id'";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

					$post_tag2 = $row["tag_name"];
					$post_tag2_count = $row["tag_professoritems"];
	
				}
				
$query="SELECT tag_id, tag_name, tag_professoritems FROM climate_tags WHERE tag_id = '$post_tag3_id'";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

					$post_tag3 = $row["tag_name"];
					$post_tag3_count = $row["tag_professoritems"];
	
				}
				
$query="SELECT professor_id, professor_title, professor_firstname, professor_lastname, professor_posts FROM podium_professors WHERE professor_id = '$post_professor'";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

					$post_professor_name = $row["professor_title"] . " " . $row['professor_firstname'] . " " . $row['professor_lastname'];
					$post_professor_count = $row["professor_posts"];
	
				}
				

echo ("

<h1 class=blog_header>Editing Professor Post</h1>
<p style=padding-bottom:15px><small>(Yippee!)</small></p>

<form method=POST action=inc.admin.edit-professor-post.php>
<input type=hidden name=edit_submit_post_id value='" . $post_id . "'>
<input type=hidden name=edit_submit_post_oldtag1 value='" . $post_tag1_id . "'>
<input type=hidden name=edit_submit_post_oldtag2 value='" . $post_tag2_id . "'>
<input type=hidden name=edit_submit_post_oldtag3 value='" . $post_tag3_id . "'>
<input type=hidden name=edit_submit_post_oldprofessor value='" . $post_professor . "'>
<input type=hidden name=edit_submit_post_url value='" . $post_url . "'>

<label>Post name <span class=label_note>(On the web page)</span></label><input style=margin-top:15px type=text name=edit_submit_post_name value='" . $post_name . "'>

<label>Page title <span class=label_note>(In web browser - limit 70 chars)</span></label>
<div class=textarea_wrapper><input id=pagetitle_input type=text name=edit_submit_post_title value='" . $post_title . "'></div>

<label>Page description <span class=label_note>(In the web browser - limit 150 chars)</span></label>
<div class=textarea_wrapper><textarea name=edit_submit_post_description id=description_textarea>" . $post_description . "</textarea></div>

<label>Summary <span class=label_note>(This is the excerpt shown on our main podium page)</span></label>
<textarea name=edit_submit_post_summary>" . $post_summary . "</textarea>


");

include("inc.admin-user.connect.php");

$query="SELECT professor_id, professor_title, professor_firstname, professor_lastname, professor_posts FROM podium_professors";
				$result=$db->query($query);

				echo ("<label style=margin-bottom:20px;margin-top:40px>Source:</label><select style=line-height:40px;margin-top:45px name=edit_submit_post_professor><option value=" . $post_professor . ">" . $post_professor_name . " (" . $post_professor_count . ")</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["professor_id"] . ">" . $row["professor_title"] . " " . $row['professor_firstname'] . $row['professor_lastname'] . " (" . $row["professor_posts"] . ")</option>");

				}
				
echo ("

</select>
<label class=label_extratop>Content  <span class=label_note>(Please read the directions to the left if you are unfamiliar with our required formatting)</span></label><br style=clear:both>
<textarea name=edit_submit_post_content id=new_post_content>" . $post_content . "</textarea>

");

include("inc.admin-user.connect.php");

$query="SELECT tag_id, tag_name, tag_professoritems FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);

				echo ("<label style=margin-top:40px>Tag 1:</label><select style=line-height:40px;margin-top:45px name=edit_submit_post_tag1><option value=" . $post_tag1_id . ">" . $post_tag1 . " (" . $post_tag1_count . ")</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_professoritems"] . ")</option>");

				}

$query="SELECT tag_id, tag_name, tag_professoritems FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);

				echo ("</select><label>Tag 2:</label><select style=line-height:40px;margin-top:15px name=edit_submit_post_tag2><option value=" . $post_tag2_id . ">" . $post_tag2 . " (" . $post_tag2_count . ")</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_professoritems"] . ")</option>");

				}
				
$query="SELECT tag_id, tag_name, tag_professoritems FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);

				echo ("</select><label>Tag 3:</label><select style=line-height:40px;margin-top:15px name=edit_submit_post_tag3><option value=" . $post_tag3_id . ">" . $post_tag3 . " (" . $post_tag3_count . ")</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_professoritems"] . ")</option>");

				}
				echo ("</select>");		

echo ("

<label style=margin-top:40px>Post date<span class=label_note> (YYYY-MM-DD format, i.e. 2011-09-01)</span></label>
<input type=text name=edit_submit_post_date value='" . $post_date . "'>

<label style=margin-top:40px>Post URL <span class=label_note>(Ask Alex if you need to change this)</span><br> " . $post_url . "</label>


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






}


//
//
// New Professor
//
//


elseif($_GET["action"] == "new_professor") {

echo ("	
	

<h1 class=blog_header>Add a new Professor</h1>
<p>You can create an entry for a new professor here.</p>
<form method=POST action=inc.admin.new-professor.php>

<label>Title <span class=label_note>(Dr., Mrs., Professor, Researcher, Master of the Universe, etc.)</label><br>
<input class=input_clear type=text name=new_submit_professor_title>

<label>First name <span class=label_note>(Please use a capital letter)</label><br>
<input class=input_clear type=text name=new_submit_professor_firstname>

<label>Last name <span class=label_note>(Please use a capital letter)</label><br>
<input class=input_clear type=text name=new_submit_professor_lastname>

");

include("inc.admin-user.connect.php");
$query="SELECT university_id, university_name FROM podium_universities";
				$result=$db->query($query);

				echo ("<label style=margin-top:10px>University:</label><select style=line-height:40px;margin-top:15px name=new_submit_professor_university><option>Select a University</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["university_id"] . ">" . $row["university_name"] . "</option>");

				}


echo ("

</select>

<label>Department</label><br>
<input class=input_clear type=text name=new_submit_professor_department>

<label>Bio <span class=label_note>(This is the bio that shows up in the directory for them)</label><br>
<textarea name=new_submit_professor_bio></textarea>

<label class=label_extratop>CV/Resume  <span class=label_note>(Optional)</span></label><br style=clear:both>
<textarea name=new_submit_professor_cv id=new_post_content></textarea>

<label>Specialty <span class=label_note>(To be shown in their directory listing. The tag below is for our internal database uses)</label><br>
<input class=input_clear type=text name=new_submit_professor_specialty>

");

include("inc.admin-user.connect.php");
$query="SELECT tag_id, tag_name FROM climate_tags";
				$result=$db->query($query);

				echo ("<label style=margin-top:10px>Specialty tag:</label><select style=line-height:40px;margin-top:15px name=new_submit_professor_tag><option>Select a tag</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . "</option>");

				}


echo ("

</select>

<label>Do they have their own picture? <span class=label_note>(If you select no it will pull their university's image instead.)</label><br>
<label style=margin-top:0; class=article_radio>Yes</label><input class=article_radio_input type=radio name=new_submit_professor_images value=1>
<label style=margin-top:0; class=article_radio>No</label><input class=article_radio_input type=radio name=new_submit_professor_images value=0>

<label class=label_extratop>Make active? <span class=label_note>(Selecting no will not put the professor in the directory)</span></label><br>
<label style=margin-top:0; class=article_radio>Yes</label><input class=article_radio_input type=radio name=new_submit_professor_active value=1>
<label style=margin-top:0; class=article_radio>No</label><input class=article_radio_input type=radio name=new_submit_professor_active value=0>

<input id=submit class=generic_admin_button type=submit value='Submit new professor'>
</form>

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
// Choose Professor
//
//

elseif($_GET["action"] == "choose_professor") {

echo ("

<h1 class=news_header>Choose which professor's info to edit</h1>
<p style=padding-bottom:15px><small>(Professors sorted alphabetically)</small></p>

");

include("inc.admin-user.connect.php");

$query="SELECT podium_professors.professor_id, podium_professors.professor_title, podium_professors.professor_firstname, podium_professors.professor_lastname, podium_professors.professor_university, podium_universities.university_id, podium_universities.university_abbr FROM podium_professors LEFT JOIN podium_universities ON podium_professors.professor_university = podium_universities.university_id ORDER BY podium_professors.professor_firstname ASC";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

				echo ("<a class=choose_podium_link href=admin.php?console=podium&action=edit_professor&professorid=" . $row["professor_id"] . ">" . $row["professor_title"] . " " . $row['professor_firstname'] . " " . $row['professor_lastname'] . "</a><p class=choose_podium_date>" . $row['university_abbr'] . "</p>");
				
				}

}


//
//
// Edit Professor
//
//


elseif($_GET["action"] == "edit_professor") {



include("inc.admin-user.connect.php");

$professor_id = $_GET['professorid'];

$query = ("SELECT * FROM podium_professors WHERE professor_id = '$professor_id'");
$result=$db->query($query);

while($row=$result->fetch_array()) {
	
	$professor_title = htmlspecialchars($row['professor_title'], ENT_QUOTES);
	$professor_firstname = htmlspecialchars($row['professor_firstname'], ENT_QUOTES);
	$professor_lastname = htmlspecialchars($row['professor_lastname'], ENT_QUOTES);
	$professor_university = $row['professor_university'];
	$professor_department = htmlspecialchars($row['professor_department'], ENT_QUOTES);
	$professor_cv = $row['professor_cv'];
	$professor_bio = htmlspecialchars($row['professor_bio'], ENT_QUOTES);
	$professor_images = $row['professor_picture'];
	$professor_specialty = htmlspecialchars($row['professor_specialty'], ENT_QUOTES);
	$professor_tag = $row['professor_tag'];
	$professor_active = $row['professor_active'];
	$professor_title = htmlspecialchars($row['professor_title'], ENT_QUOTES);
	$professor_url = $row['professor_url'];

}


$query = "SELECT tag_id, tag_name FROM climate_tags WHERE tag_id = '$professor_tag'";
$result=$db->query($query);
while($row=$result->fetch_array()) {
	$professor_tag_name = $row['tag_name'];
}

$query = "SELECT university_id, university_name FROM podium_universities WHERE university_id = '$professor_university'";
$result=$db->query($query);
while($row=$result->fetch_array()) {
	$professor_university_name = $row['university_name'];
}





echo ("

<h1 class=blog_header>Edit a Professor</h1>
<p>You can edit an entry for a professor here.</p>
<form method=POST action=inc.admin.edit-professor.php>

<input type=hidden value='" . $professor_id . "' name=edit_submit_professor_id>
<input type=hidden value='" . $professor_university . "' name=edit_submit_professor_olduniversity>
<input type=hidden value='" . $professor_tag . "' name=edit_submit_professor_oldtag>

<label>Title <span class=label_note>(Dr., Mrs., Professor, Researcher, Master of the Universe, etc.)</label><br>
<input class=input_clear type=text name=edit_submit_professor_title value='" . $professor_title . "'>

<label>First name <span class=label_note>(Please use a capital letter)</label><br>
<input class=input_clear type=text name=edit_submit_professor_firstname value='" . $professor_firstname . "'>

<label>Last name <span class=label_note>(Please use a capital letter)</label><br>
<input class=input_clear type=text name=edit_submit_professor_lastname value='" . $professor_lastname . "'>

");

include("inc.admin-user.connect.php");
$query="SELECT university_id, university_name FROM podium_universities";
				$result=$db->query($query);

				echo ("<label style=margin-top:10px>University:</label><select style=line-height:40px;margin-top:15px name=edit_submit_professor_university><option value='" . $professor_university . "'>" . $professor_university_name . "</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["university_id"] . ">" . $row["university_name"] . "</option>");

				}


echo ("

</select>

<label>Department</label><br>
<input class=input_clear type=text name=edit_submit_professor_department value='" . $professor_department . "'>

<label>Bio <span class=label_note>(This is the bio that shows up in the directory for them)</label><br>
<textarea name=edit_submit_professor_bio>" . $professor_bio . "</textarea>

<label class=label_extratop>CV/Resume  <span class=label_note>(Optional)</span></label><br style=clear:both>
<textarea name=edit_submit_professor_cv id=new_post_content>" . $professor_cv . "</textarea>

<label>Specialty <span class=label_note>(To be shown in their directory listing. The tag below is for our internal database uses)</label><br>
<input class=input_clear type=text name=edit_submit_professor_specialty value='" . $professor_specialty . "'>

");

include("inc.admin-user.connect.php");
$query="SELECT tag_id, tag_name FROM climate_tags";
				$result=$db->query($query);

				echo ("<label style=margin-top:10px>Specialty tag:</label><select style=line-height:40px;margin-top:15px name=edit_submit_professor_tag><option value=" . $professor_tag . ">" . $professor_tag_name . "</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . "</option>");

				}


echo ("

</select>

");

if($professor_images == 0) {
	
echo ("
	
<label>Do they have their own picture? <span class=label_note>(If you select no it will pull their university's image instead.)</label><br>
<label style=margin-top:0; class=article_radio>Yes</label><input class=article_radio_input type=radio name=edit_submit_professor_images value=1>
<label style=margin-top:0; class=article_radio>No</label><input class=article_radio_input type=radio name=edit_submit_professor_images value=0 checked>
	
");
	
	
}

else {
	
echo ("
	
<label>Do they have their own picture? <span class=label_note>(If you select no it will pull their university's image instead.)</label><br>
<label style=margin-top:0; class=article_radio>Yes</label><input class=article_radio_input type=radio name=edit_submit_professor_images value=1 checked>
<label style=margin-top:0; class=article_radio>No</label><input class=article_radio_input type=radio name=edit_submit_professor_images value=0>
	
");
	
	
}

if($professor_active == 0) {
	
echo ("

<label class=label_extratop>Make active? <span class=label_note>(Selecting no will not put the professor in the directory)</span></label><br>
<label style=margin-top:0; class=article_radio>Yes</label><input class=article_radio_input type=radio name=edit_submit_professor_active value=1>
<label style=margin-top:0; class=article_radio>No</label><input class=article_radio_input type=radio name=edit_submit_professor_active value=0 checked>


");
	
	
}

else {
	
echo ("

<label class=label_extratop>Make active? <span class=label_note>(Selecting no will not put the professor in the directory)</span></label><br>
<label style=margin-top:0; class=article_radio>Yes</label><input class=article_radio_input type=radio name=edit_submit_professor_active value=1 checked>
<label style=margin-top:0; class=article_radio>No</label><input class=article_radio_input type=radio name=edit_submit_professor_active value=0>

");
	

}

echo ("

<label>Url <span class=label_note>(Ask Alex if you need to change this)</span> " . $professor_url . "</label><br>
<input id=submit class=generic_admin_button type=submit value='Submit professor edit'>
</form>

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
// New University
//
//


elseif($_GET["action"] == "new_university") {

echo ("	
	

<h1 class=blog_header>Add a new University</h1>
<p>You can create an entry for a new university here.</p>
<form method=POST action=inc.admin.new-university.php>

<label>Name <span class=label_note>(This will be the display name.)</label><br>
<input class=input_clear type=text name=new_submit_university_name>

<label>Abbreviation <span class=label_note>(If it has one. If not enter in the normal name again.)</label><br>
<input class=input_clear type=text name=new_submit_university_abbr>

<label>Location <span class=label_note>(Just city, state (and country if international))</label><br>
<input class=input_clear type=text name=new_submit_university_location>

<label>Website <span class=label_note>(Include the full http://www...)</label><br>
<input class=input_clear type=text name=new_submit_university_web>

<label>Do we have an image/logo? <span class=label_note>(If you select yes please upload ASAP. If you select no please take care of it soon!)</label><br>
<label style=margin-top:0; class=article_radio>Yes</label><input class=article_radio_input type=radio name=new_submit_university_images value=1>
<label style=margin-top:0; class=article_radio>No</label><input class=article_radio_input type=radio name=new_submit_university_images value=0>

<input id=submit class=generic_admin_button type=submit value='Submit new university'>
</form>

");


}


//
//
// Choose a University
//
//

elseif($_GET["action"] == "choose_university") {

echo ("

<h1 class=news_header>Choose which university's info to edit</h1>
<p style=padding-bottom:15px><small>(Universities sorted alphabetically)</small></p>

");

include("inc.admin-user.connect.php");

$query="SELECT university_id, university_name, university_abbr FROM podium_universities ORDER BY university_name ASC";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

				echo ("<a class=choose_podium_link href=admin.php?console=podium&action=edit_university&universityid=" . $row["university_id"] . ">" . $row["university_name"] . "</a><p class=choose_podium_date>(" . $row['university_abbr'] . ")</p>");
				
				}

}


//
//
// Edit University
//
//


elseif($_GET["action"] == "edit_university") {

$university_id = $_GET['universityid'];

include ("inc.admin-user.connect.php");
$query = ("SELECT university_id, university_name, university_abbr, university_location, university_web, university_images FROM podium_universities WHERE university_id = '$university_id'");
$result = $db->query($query);

while($row=$result->fetch_array()) {

	$university_name = htmlspecialchars($row['university_name'], ENT_QUOTES);
	$university_abbr = htmlspecialchars($row['university_abbr'], ENT_QUOTES);
	$university_location = htmlspecialchars($row['university_location'], ENT_QUOTES);
	$university_web = htmlspecialchars($row['university_web'], ENT_QUOTES);
	$university_images = $row['university_images'];
}


echo ("	
	

<h1 class=blog_header>Edit a University</h1>
<p>You can edit an entry for a university here.</p>
<form method=POST action=inc.admin.edit-university.php>

<input type=hidden value=" . $university_id . " name=edit_submit_university_id>
<label>Name <span class=label_note>(This will be the display name.)</label><br>
<input class=input_clear type=text name=edit_submit_university_name value='" . $university_name . "'>

<label>Abbreviation <span class=label_note>(If it has one. If not enter in the normal name again.)</label><br>
<input class=input_clear type=text name=edit_submit_university_abbr value='" . $university_abbr . "'>

<label>Location <span class=label_note>(Just city, state (and country if international))</label><br>
<input class=input_clear type=text name=edit_submit_university_location value='" . $university_location . "'>

<label>Website <span class=label_note>(Include the full http://www...)</label><br>
<input class=input_clear type=text name=edit_submit_university_web value='" . $university_web . "'>

");

if($university_images == 0) {

echo ("

<label>Do we have an image/logo? <span class=label_note>(If you select yes please upload ASAP. If you select no please take care of it soon!)</label><br>
<label style=margin-top:0; class=article_radio>Yes</label><input class=article_radio_input type=radio name=edit_submit_university_images value=1>
<label style=margin-top:0; class=article_radio>No</label><input class=article_radio_input type=radio name=edit_submit_university_images value=0 checked>


");


}

else {
	
echo ("

<label>Do we have an image/logo? <span class=label_note>(If you select yes please upload ASAP. If you select no please take care of it soon!)</label><br>
<label style=margin-top:0; class=article_radio>Yes</label><input class=article_radio_input type=radio name=edit_submit_university_images value=1 checked>
<label style=margin-top:0; class=article_radio>No</label><input class=article_radio_input type=radio name=edit_submit_university_images value=0>


");
	
	
}

echo ("

<input id=submit class=generic_admin_button type=submit value='Submit new university'>
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
// Choose Image Type
//
//



elseif($_GET["action"] == "new_images") {
	
	echo ("
	
	<h1>Choose the type of image you want to upload</h1>
	<a class=choose_podium_link href=/beta/newclimate/admin?console=podium&action=new_post_images>Images to go with a professor's post</a><br>
	<a class=choose_podium_link href=/beta/newclimate/admin?console=podium&action=new_professor_images>A picture of a professor for his directory profile</a><br>
	<a class=choose_podium_link href=/beta/newclimate/admin?console=podium&action=new_university_images>University images/logos</a>
	
	");
}	




//
//
// New Professor Image
//
//
	
elseif($_GET["action"] == "new_professor_images") {	
	
$upload_image_limit = 1; // How many images you want to upload at once?

echo ("

<h1>Upload new professor images</h1>
<p style=padding-bottom:15px><small>(If the professor you're uploading an image for already has a picture then delete that before uploading a new one.)</small></p>

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

		<form method=POST enctype=multipart/form-data action=inc.admin.new-professor-images.php>
		<select id=check_select name=new_submit_images_post><option value='N'>Choose a professor to upload an image for</option>
");

include ("inc.admin-user.connect.php");
$query = ("SELECT professor_id, professor_title, professor_firstname, professor_lastname FROM podium_professors ORDER by professor_firstname ASC");
$result = $db->query($query);

while($row = $result->fetch_array()) {
	
	echo ("
	
		<option value=" . $row['professor_id'] . ">" . $row['professor_title'] . " " . $row['professor_firstname'] . " " . $row['professor_lastname'] . "</option>
	
	");
}

echo ("

</select>" . $form_img . "

			<input name=Submit class=generic_admin_button type=submit value='Upload Images!' style=margin-top:50px >
		</form>

");
}






//
//
// New University Images
//
//

elseif($_GET["action"] == "new_university_images") {	
	
$upload_image_limit = 1; // How many images you want to upload at once?




echo ("

<h1>Upload a new university image</h1>
<p style=padding-bottom:15px><small>(If the university you're uploading an image for already has a picture then delete that before uploading a new one.)</small></p>

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

		<form method=POST enctype=multipart/form-data action=inc.admin.new-university-images.php>
		<select id=check_select name=new_submit_images_post><option value='N'>Choose a university to upload an image for</option>
");

include ("inc.admin-user.connect.php");
$query = ("SELECT university_id, university_name FROM podium_universities ORDER by university_name ASC");
$result = $db->query($query);

while($row = $result->fetch_array()) {
	
	echo ("
	
		<option value=" . $row['university_id'] . ">" . $row['university_name'] . "</option>
	
	");
	
}

echo ("

</select>" . $form_img . "

			<input name=Submit class=generic_admin_button type=submit value='Upload Images!' style=margin-top:50px >
		</form>

");

}






//
//
// New Post Images
//
//

elseif($_GET["action"] == "new_post_images") {	
	
$upload_image_limit = 5; // How many images you want to upload at once?

echo ("

<h1>Upload new images to a podium post</h1>
<p style=padding-bottom:15px><small>(You can simultaneously upload up to 5 images to a single post.)</small></p>

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

		<form method=POST enctype=multipart/form-data action=inc.admin.new-podium-images.php>
		<select id=check_select name=new_submit_images_post><option value='N'>Choose a post to upload an image for</option>
");

include ("inc.admin-user.connect.php");
$query = ("SELECT post_id, post_name, post_date FROM podium_posts ORDER by post_date DESC");
$result = $db->query($query);

while($row = $result->fetch_array()) {
	
	echo ("
	
		<option value=" . $row['post_id'] . ">" . $row['post_name'] . "</option>
	
	");
	
}

echo ("

</select>" . $form_img . "

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

<h1>Choose which type of Podium images you want to edit</h1>
	<a class=choose_podium_link href=/beta/newclimate/admin?console=podium&action=choose_post_images>Images to go with a professor's post</a><br>
	<a class=choose_podium_link href=/beta/newclimate/admin?console=podium&action=choose_professor_images>A picture of a professor for his directory profile</a><br>
	<a class=choose_podium_link href=/beta/newclimate/admin?console=podium&action=choose_university_images>University images/logos</a>

");

}



//
//
// Choose Post Images
//
//


elseif($_GET["action"] == "choose_post_images") {

echo ("

<h1>Choose which Podium post's images you want to edit</h1>
<p style=padding-bottom:15px><small>(Sorted chronologically by most recent.)</small></p>

");

include("inc.admin-user.connect.php");

$query="SELECT post_id, post_name, post_date FROM podium_posts ORDER BY post_date DESC";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

				echo ("<a class=choose_podium_link href=admin.php?console=podium&action=edit_post_images&postid=" . $row["post_id"] . ">" . $row["post_name"] . "</a><p class=choose_podium_date>posted: " . $row["post_date"] . "</p>");
				
				}

}






//
//
// Choose Professor Images
//
//


elseif($_GET["action"] == "choose_professor_images") {

echo ("

<h1>Choose which Professor images you want to edit</h1>
<p style=padding-bottom:15px><small>(Sorted by the professor's first name.)</small></p>

");

include("inc.admin-user.connect.php");

$query="SELECT podium_professors.professor_id, podium_professors.professor_title, podium_professors.professor_firstname, podium_professors.professor_lastname, podium_professors.professor_university, podium_universities.university_id, podium_universities.university_name FROM podium_professors LEFT JOIN podium_universities ON podium_professors.professor_university = podium_universities.university_id ORDER BY podium_professors.professor_firstname ASC";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

				echo ("<a class=choose_podium_link href=admin.php?console=podium&action=edit_professor_images&professorid=" . $row["professor_id"] . ">" . $row['professor_title'] . " " . $row['professor_firstname'] . " " . $row['professor_lastname'] . "</a><p class=choose_podium_date>" . $row["university_name"] . "</p>");
				
				}

}




//
//
// Choose University Images
//
//


elseif($_GET["action"] == "choose_university_images") {

echo ("

<h1>Choose which University's images you want to edit</h1>
<p style=padding-bottom:15px><small>(Sorted alphabetically by the university's name.)</small></p>

");


include("inc.admin-user.connect.php");

$query="SELECT university_id, university_name FROM podium_universities ORDER BY university_name ASC";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

				echo ("<a class=choose_podium_link href=admin.php?console=podium&action=edit_university_images&universityid=" . $row["university_id"] . ">" . $row["university_name"] . "</a>");
				
				}

}



//
//
// Edit Post Images
//
//


elseif($_GET["action"] == "edit_post_images") {
	

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

$query = ("SELECT * FROM podium_images WHERE image_type = '3' AND image_parent = '$image_post' ORDER BY image_order ASC");
$result=$db->query($query);

$image_number = 0;

while($row=$result->fetch_array()) {

$image_description = htmlspecialchars($row['image_description'], ENT_QUOTES);
$image_source = htmlspecialchars($row['image_source'], ENT_QUOTES);

echo ("
<form style=float:left;clear:left method=POST action=inc.admin.edit-podium-images.php>
<div id=image" . $image_number . ">

<img class=editable_image id=image_edit" . $image_number . " src=http://www.climatepedia.org/beta/newclimate/images_podium/posts/" . $row['image_path'] . ">
<input type=hidden name=edit_submit_image_path value=" . $row['image_path'] . ">

<a class=editable_image_link target=blank href=http://www.climatepedia.org/beta/newclimate/images_podium/posts/" . $row['image_path'] . ">Link to full-size version</a><p style=clear:none;padding-left:5px;line-height:20px;margin-top:0><small>(opens in a new tab)</small></p>
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
// Edit Professor Images
//
//


elseif($_GET["action"] == "edit_professor_images") {
	

include("inc.admin-user.connect.php");

$image_post = $_GET['professorid'];

$query="SELECT professor_id, professor_title, professor_firstname, professor_lastname FROM podium_professors WHERE professor_id = '$image_post'";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

				$post_name = $row['professor_title'] . " " . $row['professor_firstname'] . " " . $row['professor_lastname'];
					
				}
	
	
	
echo ("

<h1>Edit images for '" . $post_name . "'</h1>
<p style=padding-bottom:15px><small>(You can edit one image at a time. If you need to change an image you must delete it and then re-upload it.)</small></p>
<div id=editing_images>

");



include ("inc.admin-user.connect.php");

$query = ("SELECT * FROM podium_images WHERE image_type = '1' AND image_parent = '$image_post' ORDER BY image_order ASC");
$result=$db->query($query);

$image_number = 0;

while($row=$result->fetch_array()) {

$image_description = htmlspecialchars($row['image_description'], ENT_QUOTES);
$image_source = htmlspecialchars($row['image_source'], ENT_QUOTES);

echo ("
<form style=float:left;clear:left method=POST action=inc.admin.edit-professor-images.php>
<div id=image" . $image_number . ">

<img class=editable_image id=image_edit" . $image_number . " src=http://www.climatepedia.org/beta/newclimate/images_podium/professors/" . $row['image_path'] . ">
<input type=hidden name=edit_submit_image_path value=" . $row['image_path'] . ">

<a class=editable_image_link target=blank href=http://www.climatepedia.org/beta/newclimate/images_podium/professors/" . $row['image_path'] . ">Link to full-size version</a><p style=clear:none;padding-left:5px;line-height:20px;margin-top:0><small>(opens in a new tab)</small></p>
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
// Edit University Images
//
//


elseif($_GET["action"] == "edit_university_images") {
	

include("inc.admin-user.connect.php");

$image_post = $_GET['universityid'];

$query="SELECT university_id, university_name FROM podium_universities WHERE university_id = '$image_post'";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

				$post_name = $row['university_name'];
					
				}
	
	
	
echo ("

<h1>Edit images for '" . $post_name . "'</h1>
<p style=padding-bottom:15px><small>(You can edit one image at a time. If you need to change an image you must delete it and then re-upload it.)</small></p>
<div id=editing_images>

");



include ("inc.admin-user.connect.php");

$query = ("SELECT * FROM podium_images WHERE image_type = '2' AND image_parent = '$image_post' ORDER BY image_order ASC");
$result=$db->query($query);

$image_number = 0;

while($row=$result->fetch_array()) {

$image_description = htmlspecialchars($row['image_description'], ENT_QUOTES);
$image_source = htmlspecialchars($row['image_source'], ENT_QUOTES);

echo ("
<form style=float:left;clear:left method=POST action=inc.admin.edit-university-images.php>
<div id=image" . $image_number . ">

<img class=editable_image id=image_edit" . $image_number . " src=http://www.climatepedia.org/beta/newclimate/images_podium/universities/" . $row['image_path'] . ">
<input type=hidden name=edit_submit_image_path value=" . $row['image_path'] . ">

<a class=editable_image_link target=blank href=http://www.climatepedia.org/beta/newclimate/images_podium/universities/" . $row['image_path'] . ">Link to full-size version</a><p style=clear:none;padding-left:5px;line-height:20px;margin-top:0><small>(opens in a new tab)</small></p>
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