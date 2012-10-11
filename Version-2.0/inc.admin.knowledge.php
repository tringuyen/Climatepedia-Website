<?php

?>
<div id="admin_left">
<div id="admin_actions">
<p>Actions</p>
<ul>
<li><a href="admin.php?console=knowledge&action=new_article" >New Article</a></li>
<li><a href="admin.php?console=knowledge&action=choose_article" >Edit Articles</a></li>
<li><a href="admin.php?console=knowledge&action=new_tags" >New Tag</a></li>
<li><a href="admin.php?console=knowledge&action=edit_tags" >Edit Tags</a></li>
<li><a href="admin.php?console=knowledge&action=new_images" >New Images</a></li>
<li><a href="admin.php?console=knowledge&action=choose_images" >Edit Images</a></li>
</ul>
</div>
<div id="admin_directions">
<p id="directions_header">Help</p>
<?php if($_GET["action"] == "new_article") {
	
	echo $new_article_directions;
	
}

elseif($_GET["action"] == "choose_article") {
	
	echo $choose_article_directions;
	
}

elseif($_GET["action"] == "edit_article") {
	
	echo $edit_article_directions;
	
}

elseif($_GET["action"] == "new_tags") {
	
	echo $new_tag_directions;
	
}

elseif($_GET["action"] == "edit_tags") {
	
	echo $edit_tag_directions;
	
}

elseif($_GET["action"] == "new_images") {
	
	echo $new_images_directions;
	
}

elseif($_GET["action"] == "choose_images") {
	
	echo $choose_images_directions;
	
}

elseif($_GET["action"] == "edit_images") {
	
	echo $edit_images_directions;
	
}


elseif($_GET["action"] == "success") {
	
	echo $success_directions;	
	
}

?>

</div>


</div>
<div id="admin_right">
<?php 

// Check if the user just completed an action

if($_GET["action"] == "success") {

// Check if it was an edit

if($_GET["type"] == "edit") {

$resource = urldecode($_GET["resource"]);
$edited_resource = stripslashes($resource);

echo ("

<div id=new_article>
<h1>Congrats, your " . $edited_resource . " edit was submitted.</h1>

");

// Check if they edited an article

if($_GET["query"] == "article") {



echo ("<p>You can view the updated article here: <a target=blank href=http://www.climatepedia.org/" . $_GET["url"] . ".php>" . $edited_resource . "</a>.</p>");

}

// Check if they edited the tags

if($_GET["query"] == "tags") {
	
$total_edits = $_GET['total'] + 1;

// Did they only edit one tag? (singular v.s. plural verbage changes)

if($total_edits < 2) {
	
	$tag_name = urldecode($_GET['tag0']);
	$edited_tag_name = stripslashes($tag_name);
	
	echo ("<p>You updated 1 tag.<br><br>The new name of the tag you edited is: " .  $edited_tag_name);
	
}

// If not then they edited more than one, use plural

else {

echo ("<p>You updated " . $total_edits . " tags total. The new names of the tags you edited are:<br><br> ");

$tag_total = 0;

while($tag_total <= $_GET['total']) {

$edited_tag = urldecode($_GET['tag' . $tag_total]);
$edited_tag_stripped = stripslashes($edited_tag);


echo ($edited_tag_stripped . "<br>");

$tag_total++;

}

}

echo ("

</p>");

}





// check if they edited some images

if($_GET["query"] == "images") {

// check if they altered images (v.s. deleting later)

if($_GET["function"] == "alter") {

$image_id = $_GET["id"];

echo ("<div id=editing_images><p>The updated information is shown below</p>");

include ("inc.admin-user.connect.php");
$query = ("SELECT image_id, image_path, image_description, image_source  FROM pedia_images WHERE image_id='$image_id'");
$result=$db->query($query);

while($row=$result->fetch_array()) {

$image_description = htmlspecialchars($row['image_description'], ENT_QUOTES);
$image_source = htmlspecialchars($row['image_source'], ENT_QUOTES);


echo ("

<img class=editable_image src=http://www.climatepedia.org/images_pedia/" . $row['image_path'] . ">
<a class=editable_image_link target=blank href=http://www.climatepedia.org/images_pedia/" . $row['image_path'] . ">Link to full-size version</a><p style=clear:none;padding-left:5px;line-height:20px;margin-top:0><small>(opens in a new tab)</small></p>
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

echo ("

</div>

");

}

// Check if they created a new something

elseif($_GET["type"] == "new") {

echo ("

<div id=new_article>


");

// Did they create a new article?

if($_GET["query"] == "article") {


echo ("

<h1>Congrats, your new " . urldecode($_GET["resource"]) . " article was created.</h1>
<p>You can view the new article here: <a target=blank href=http://www.climatepedia.org/" . $_GET["url"] . ".php>" . urldecode($_GET["resource"]) . "</a>.</p>");

}


// Did they create new tags?

if($_GET["query"] == "tags") {
	
$total_edits = $_GET['total'] + 1;

if($total_edits < 2) {
	
	echo ("
	
	<h1>Congrats, your new Tag was created.</h1>
	<p>You created 1 tag.<br><br>The new name of the tag you created is: " .  urldecode($_GET['tag0']));
	
}

else {

echo ("

<h1>Congrats, your new Tags were created.</h1>
<p>You created " . $total_edits . " tags total. The names of the tags you created are:<br><br> ");

$tag_total = 0;

while($tag_total <= $_GET['total']) {

echo (urldecode($_GET['tag' . $tag_total]) . "<br>");

$tag_total++;

}

}

echo ("

</p>");

}

if($_GET["query"] == "images") {

// check for plurality

if($_GET['total'] > 1) {

echo ("

<h1>Congrats, your new image was uploaded.</h1>
<p>You can view the new image in the article here: <a target=blank href=http://www.climatepedia.org/" . $_GET['url'] . ".php>Updated article</a>. If you don't see your new image double-check that 'Enable images' is checked in the 'Edit Articles' menu.</p>

");

}

else {
	
echo ("

<h1>Congrats, your new images were uploaded.</h1>
<p>You can view the new image in the article here: <a href=http://www.climatepedia.org/" . $_GET['url'] . ".php>View the article you updated</a>. If you don't see your new image double-check that 'Enable images' is checked in the 'Edit Articles' menu.</p>

");


}



echo ("

</div>

");


}

} // closes off "new" check


} // closes off "success" check




if($_GET["action"] == "new_article") {


echo ("

<div id=new_article>
<h1>Create New Article</h1>
<form method=POST action=inc.admin.new-article.php>

<label>Name <span class=article_note>(On the web page)</span></label><input type=text name=new_submit_name>

<label>Page Title <span class=article_note>(In web browser - limit 70 chars) <a id=toggle_new_article_title_example href=#>Click to show an example</a></span></label><div class=textarea_wrapper><input id=pagetitle_input type=text name=new_submit_title></div>
<label id=new_article_title_example class=new_article_hidden>Page Title Example: 'About Nuclear Energy | Science, Economics, and Social Impact'</label>

<label>Page Description <span class=article_note>(In the web browser - limit 150 chars) <a id=toggle_new_article_description_example href=#>Click to show an example</a></span></label><div class=textarea_wrapper><textarea name=new_submit_description id=description_textarea></textarea></div>
<label id=new_article_description_example class=new_article_hidden>Page Description Example: 'Learn about a breadth of nuclear energy topics, from the technology behind it to the impact it has on society.'</label>

<label class=label_extrabottom>URL <span class=article_note>(no spaces, should be 'about-title')</span></label><input id=url_input type=text name=new_submit_url>

");

include("inc.admin-user.connect.php");

$query="SELECT tag_id, tag_name, tag_count FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);

				echo ("<label>Tag 1:</label><select name=new_submit_tag1><option>Select Tag 1</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_count"] . ")</option>");

				}

$query="SELECT tag_id, tag_name, tag_count FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);

				echo ("</select><label>Tag 2:</label><select name=new_submit_tag2><option>Select Tag 2</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_count"] . ")</option>");

				}
				
$query="SELECT tag_id, tag_name, tag_count FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);

				echo ("</select><label>Tag 3:</label><select name=new_submit_tag3><option>Select Tag 3</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_count"] . ")</option>");

				}
				echo ("</select>");		


echo ("<label class=label_extratop>Content  <span class=article_note>(Please read the directions to the left if you are unfamiliar with our required formatting)</span></label><br style=clear:both>
<textarea name=new_submit_contents id=new_article_content></textarea>


<label class=new_toc_buttons><a href=# id=new_article_build_toc>Step 1: Build table of contents</a><span id=build_note class=toc_note>(This will create an editable Table of Contents below.)</span></label>
<div id=new_article_toc><label id=toc_label class=label_extratop>Table of Contents <span class=article_note>(Click 'Build table of contents' to begin)</span><div id=toc_hidden_wrapper></div></label><div id=toc_list_wrapper></div></div>

<div id=new_article_completed_toc_wrapper></div>

<div id=complete_toc_wrapper></div>

<textarea name=new_submit_toc id=final_toc type=hidden></textarea>

<label class=label_extratop>Enable images? <span class=article_note>(Only select yes if adding images now. You can add images from the Add Images action bar)</span></label><br>
<label class=article_radio>Yes</label><input class=article_radio_input type=radio name=new_submit_images value=1>
<label class=article_radio>No</label><input class=article_radio_input type=radio name=new_submit_images value=0>

<label class=label_extratop>Push live now? <span class=article_note>(Selecting no will save the article in draft mode)</span></label><br>
<label class=article_radio>Yes</label><input class=article_radio_input type=radio name=new_submit_draft value=0>
<label class=article_radio>No</label><input class=article_radio_input type=radio name=new_submit_draft value=1>

<input id=new_article_submit type=submit value=Submit>
</form>
</div>

");

echo ("

<script type='text/javascript'>

	CKEDITOR.replace( 'new_article_content' );
	
</script>	
	
	
");


}

elseif($_GET["action"] == "choose_article") {

echo ("

<div id=new_article>
<h1>Choose an Article to Edit</h1>
<p style=padding-bottom:15px><small>(Sorted alphabetically)</small></p>
");

include("inc.admin-user.connect.php");

$query="SELECT article_id, article_name, article_edit FROM pedia_articles ORDER BY article_name ASC";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

				echo ("<a class=choose_article_link href=admin.php?console=knowledge&action=edit_article&article=" . $row["article_id"] . ">" . $row["article_name"] . "</a><p class=choose_article_date>last update: " . date("D M d, Y", strtotime($row["article_edit"])) . "</p>");
				
				}


echo ("

</div>

");



}

elseif($_GET["action"] == "edit_article") {
	
$article_id = $_GET["article"];
	
include("inc.admin-user.connect.php");
	
$query="SELECT * FROM pedia_articles WHERE article_id = '$article_id'";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

					$article_name = htmlspecialchars($row["article_name"], ENT_QUOTES);
					$article_url = $row["article_url"];
					$article_pagetitle = $row["article_pagetitle"];
					$article_pagemeta = $row["article_pagemeta"];
					$article_contents = $row["article_contents"];
					$article_toc = $row["article_toc"];
					$article_tag1_id = $row["article_tag1"];
					$article_tag2_id = $row["article_tag2"];
					$article_tag3_id = $row["article_tag3"];
					$article_images = $row["article_images"];
					$article_draft = $row["article_draft"];
					$article_approval = $row["article_approval"];
					$article_edit = $row["article_edit"];
						
				}
	
$query="SELECT * FROM climate_tags WHERE tag_id = '$article_tag1_id'";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

					$article_tag1 = $row["tag_name"];
					$article_tag1_count = $row["tag_count"];
	
				}
	
$query="SELECT * FROM climate_tags WHERE tag_id = '$article_tag2_id'";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

					$article_tag2 = $row["tag_name"];
					$article_tag2_count = $row["tag_count"];
	
				}
				
$query="SELECT * FROM climate_tags WHERE tag_id = '$article_tag3_id'";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

					$article_tag3 = $row["tag_name"];
					$article_tag3_count = $row["tag_count"];
	
				}
	
	
echo ("	
	
<div id=new_article>
<h1>Editing " . $article_name . "</h1>
<form method=POST action=inc.admin.edit-article.php>

<label>Name <span class=article_note>(On the web page)</span></label><input name=edit_submit_name type=text value='" . $article_name . "'>

<label>Page Title <span class=article_note>(In web browser - limit 70 chars) <a id=toggle_new_article_title_example href=#>Click to show an example</a></span></label><div class=textarea_wrapper><input id=pagetitle_input name=edit_submit_title type=text value='" . $article_pagetitle . "'></div>
<label id=new_article_title_example class=new_article_hidden>Page Title Example: 'About Nuclear Energy | Science, Economics, and Social Impact'</label>

<label>Page Description <span class=article_note>(In the web browser - limit 150 chars) <a id=toggle_new_article_description_example href=#>Click to show an example</a></span></label><div class=textarea_wrapper><textarea name=edit_submit_description id=description_textarea>" . $article_pagemeta . "</textarea></div>
<label id=new_article_description_example class=new_article_hidden>Page Description Example: 'Learn about a breadth of nuclear energy topics, from the technology behind it to the impact it has on society.'</label>

<label class=label_extrabottom>URL <span class=article_note>(cannot be changed)</span> " . $article_url . "</label>

");


$query="SELECT tag_id, tag_name, tag_count FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);

				echo ("<label>Tag 1:</label><select name=edit_submit_tag1><option value=" . $article_tag1_id . ">" . $article_tag1 . " (" . $article_tag1_count . ")</option>");
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_count"] . ")</option>");

				}

				echo ("</select><label>Tag 2:</label><select name=edit_submit_tag2><option value=" . $article_tag2_id . ">" . $article_tag2 . " (" . $article_tag2_count . ")</option>");
					
				$query="SELECT tag_id, tag_name, tag_count FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_count"] . ")</option>");

				}

				echo ("</select><label>Tag 3:</label><select name=edit_submit_tag3><option value=" . $article_tag3_id . ">" . $article_tag3 . " (" . $article_tag3_count . ")</option>");
					
				$query="SELECT tag_id, tag_name, tag_count FROM climate_tags ORDER BY tag_name ASC";
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {
					
				echo ("<option value=" . $row["tag_id"] . ">" . $row["tag_name"] . " (" . $row["tag_count"] . ")</option>");

				}
				echo ("</select>");		


echo ("<label class=label_extratop>Content  <span class=article_note>(Please read the directions to the left if you are unfamiliar with our required formatting)</span></label><br style=clear:both>
<textarea name=edit_submit_contents id=new_article_content>" . $article_contents . "</textarea>

<label class=new_toc_buttons><a href=# id=new_article_build_toc>Step 1: Edit table of contents</a><span id=build_note class=toc_note>(This will create a new editable table of contents from the headings in the article above.)</span></label>
<div id=new_article_toc><label id=toc_label class=label_extratop>Table of Contents <span class=article_note>(Click 'Build table of contents' to create a new version)</span><div id=toc_hidden_wrapper></div></label><div id=toc_list_wrapper></div></div>

<div id=new_article_completed_toc_wrapper style=display:block><label>Final:</label><div id=knowledge_contents>" . $article_toc . "</div></div>

<div id=complete_toc_wrapper></div>

<label class=label_extratop>Enable images? <span class=article_note>(Only select yes if adding images right now. You can add images from the Add Images action bar)</span></label><br>
");

if($article_images == 1) {
	
echo ("

<label class=article_radio>Yes</label><input class=article_radio_input type=radio name=edit_submit_images value=1 checked>
<label class=article_radio>No</label><input class=article_radio_input type=radio name=edit_submit_images value=0>

");

}

else {
	
echo ("

<label class=article_radio>Yes</label><input class=article_radio_input type=radio name=edit_submit_images value=1>
<label class=article_radio>No</label><input class=article_radio_input type=radio name=edit_submit_images value=0 checked>

");

}


echo ("
<input name=edit_submit_id type=hidden value=" . $article_id . ">
<input name=edit_submit_oldtag1 type=hidden value=" . $article_tag1_id . ">
<input name=edit_submit_oldtag2 type=hidden value=" . $article_tag2_id . ">
<input name=edit_submit_oldtag3 type=hidden value=" . $article_tag3_id . ">
<input name=edit_submit_url type=hidden value='" . $article_url . "'>
");

 	
 echo ("<label class=label_extratop>Push the article live? <span class=article_note>(Selecting no will save the article in draft mode)</span></label><br>
<label class=article_radio>Yes</label><input class=article_radio_input type=radio name=edit_submit_draft value=0>
<label class=article_radio>No</label><input class=article_radio_input type=radio name=edit_submit_draft value=1>
");





echo("<textarea name=edit_submit_toc id=final_toc type=hidden>" . $article_toc . "</textarea>
<input id=edit_article_submit type=submit value='Submit your edits'>
</form>
</div>
	
");


echo ("

<script type='text/javascript'>

	CKEDITOR.replace( 'new_article_content' );
	
</script>	
	
");


}

//
//
// Edit tags
//
//

elseif($_GET["action"] == "edit_tags") {

echo ("

<div id=new_article>
<h1>Click on a tag to edit its name</h1>
<p style=padding-bottom:15px><small>(You can simultaneously edit up to 10 tags, each tag name is followed by the number of times it's been used)</small></p>
<form method=POST action=inc.admin.edit-tags.php>
<input class=generic_admin_button type=submit value='Submit your edits'>

");


include ("inc.admin-user.connect.php");

$query = ("SELECT * FROM climate_tags ORDER by tag_name ASC");
$result = $db->query($query);

while($row = $result->fetch_array()) {

$tag_id = $row["tag_id"];
$tag_name = $row["tag_name"];
$tag_count = $row["tag_count"];

echo ("

<a class=tag_list href=admin.php?console=knowledge&action=edit_tags&result=" . $tag_id . " id=" . $tag_id . ">" . $tag_name . "</a><p style=float:left;clear:none;line-height:40px;height:40px;padding-left:5px><small>(" . $tag_count . ")</small></p>

");

}


echo ("

</form>

");

}


//
//
// Create new tags
//
//


elseif($_GET["action"] == "new_tags") {

echo ("

<div id=new_article>
<h1>Click 'create new tag' to begin</h1>
<p style=padding-bottom:15px><small>(You can edit simultaneously create up to 10 tags, click submit when you're done. It is not required to fill out all of the boxes you create.)</small></p>
<form method=POST action=inc.admin.new-tags.php>
<a class=generic_admin_button id=create_tag style=height:30px;line-height:30px href=#>Create new tag</a>
<p style=color:red;float:left;clear:left;height:20px;line-height:20px;padding-top:10px;padding-bottom:10px; id=tag_warning></p>
<input class=generic_admin_button type=submit value='Submit new tags'>
</form>

");

}

//
//
// Create new images
//
//


elseif($_GET["action"] == "new_images") {

$upload_image_limit = 5; // How many images you want to upload at once?




echo ("

<div id=new_article>
<h1>Upload new images</h1>
<p style=padding-bottom:15px><small>(You can edit simultaneously submit up to 5 images, click submit when you're done.)</small></p>

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

		<form method=POST enctype=multipart/form-data action=inc.admin.new-images.php>
		<select id=check_select name=new_submit_images_article><option value='N'>Choose an article to upload images for</option>
");

include ("inc.admin-user.connect.php");
$query = ("SELECT article_id, article_name FROM pedia_articles ORDER by article_name ASC");
$result = $db->query($query);

while($row = $result->fetch_array()) {
	
	echo ("
	
		<option value=" . $row['article_id'] . ">" . $row['article_name'] . "</option>
	
	");
	
}

echo ("</select>" . $form_img . "

			<input name=Submit class=generic_admin_button type=submit value='Upload Images!' style=margin-top:50px >
		</form>

		

");




}

//
//
// Choose an article's images to edit
//
//

elseif($_GET["action"] == "choose_images") {
	
echo ("

<div id=new_article>
<h1>Choose which article's images you want to edit</h1>
<p style=padding-bottom:15px><small>(Choose an article)</small></p>

");

include("inc.admin-user.connect.php");

$query="SELECT article_id, article_name, article_edit FROM pedia_articles ORDER BY article_name ASC";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

				echo ("<a class=choose_article_link href=admin.php?console=knowledge&action=edit_images&articleid=" . $row["article_id"] . ">" . $row["article_name"] . "</a><p class=choose_article_date>last update: " . $row["article_edit"] . "</p>");
				
				}


echo ("

</div>

");
	

	
	
}

//
//
// Edit images
//
//

elseif($_GET["action"] == "edit_images") {
	
include("inc.admin-user.connect.php");

$image_article = $_GET['articleid'];

$query="SELECT article_id, article_name FROM pedia_articles WHERE article_id = '$image_article'";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

				$article_name = $row['article_name'];
					
				}
	
	
	
echo ("

<div id=new_article>
<h1>Edit images for " . $article_name . "</h1>
<p style=padding-bottom:15px><small>(You can edit one image at a time. If you need to change an image you must delete it and then re-upload it.)</small></p>
<div id=editing_images>

");



include ("inc.admin-user.connect.php");

$query = ("SELECT * FROM pedia_images WHERE image_article = '$image_article' ORDER BY image_order ASC");
$result=$db->query($query);

$image_number = 0;

while($row=$result->fetch_array()) {

$image_description = htmlspecialchars($row['image_description'], ENT_QUOTES);
$image_source = htmlspecialchars($row['image_source'], ENT_QUOTES);

echo ("
<form method=POST action=inc.admin.edit-images.php>
<div id=image" . $image_number . ">

<img class=editable_image id=image_edit" . $image_number . " src=http://www.climatepedia.org/images_pedia/" . $row['image_path'] . ">
<input type=hidden name=edit_submit_image_path value=" . $row['image_path'] . ">

<a class=editable_image_link target=blank href=http://www.climatepedia.org/images_pedia/" . $row['image_path'] . ">Link to full-size version</a><p style=clear:none;padding-left:5px;line-height:20px;margin-top:0><small>(opens in a new tab)</small></p>
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



?>

<!-- page scripts -->
<script type="text/javascript" >

$(document).ready(function(){
	
// Show examples script

$("#toggle_new_article_title_example").click(function(){
	
	$("#new_article_title_example").fadeIn();
	$("#toggle_new_article_title_example").text("Example below");

	return false;	
	
});	

$("#toggle_new_article_description_example").click(function(){
	
	$("#new_article_description_example").fadeIn();
	$("#toggle_new_article_description_example").text("Example below");

	return false;	
	
});	

	
});


// Build table of contents script

$("#new_article_build_toc").click(function(){

	$("#new_article_toc .article_note").fadeOut();
	$("#build_note").text("(You can reset the Table of Contents by clicking this again)");
	$("#toc_hidden_wrapper").html("<div id=toc_hidden></div>");
	$("#toc_list_wrapper").html("<ol id=toc_super_list></ol>");
	$("#complete_toc_wrapper").html("<label class=new_toc_buttons><a href=# id=complete_article_toc>Step 2: Complete table of contents</a><span class=toc_note>(Do this before submitting. You can do this multiple times to make changes.)</span></label>");


	window.i_anchor = 0;
	
	$("iframe").contents().find("h2, h3").each(function(){
	
	test_text = $(this).text();
	$(this).before("<a name=link" + window.i_anchor + "></a>");
	
	if(test_text.match(/Heading/)) {
	
		return false;	
		
	}
	
	else {
		
	$(this).clone().attr({title: "link" + window.i_anchor}).appendTo("#toc_hidden");
	
	
	}
	
	window.i_anchor++;	
	
	});
	
	var i = 0;
	var i2 = 0.1;
	var increment = 0.1;

	$("#toc_hidden").find("h2, h3").each(function(){
		

		
	if($(this).is("h2")){
		
	i++;
		
	var my_element = i + " " + $(this).text();
	var anchor_link = $(this).attr("title");
	
	if($(this).next().is("h3")){
	
	
	$("<li title=" + anchor_link + " class=outer><input value='" + my_element + "'><ol class=internal id=inner" + i + "></ol></li>").appendTo("#toc_super_list");
		
	}
	
	else {

	$("<li title=" + anchor_link + " class=outer><input value='" + my_element + "'></li>").appendTo("#toc_super_list");
		
		
	}
	
	}
		
	if($(this).is("h3")){
		
	var my_element = i + i2 + " " + $(this).text();	
	var anchor_link = $(this).attr("title");
	
	i2 = i2 + increment;

	$("<li title=" + anchor_link + "><input value='" + my_element + "'></li>").appendTo("#inner" + i);
	
	}
		
	});



	return false;

});


$("#complete_article_toc").live("click",function() {
	$("#final_toc").html("");
	$("#new_article_completed_toc_wrapper").html("<label>Final:</label class=label_extratop><div id=knowledge_contents><p>Contents</p></div>");
	$("#toc_super_list").clone().removeAttr("id").appendTo("#knowledge_contents");
	$("#knowledge_contents .internal li").each(function() {
		
		var contents_list_item = $("input", this).val();
		var my_link = $(this).attr("title");
		
		$("input", this).replaceWith("<a href=#" + my_link + ">" + contents_list_item + "</a>");
		$(this).attr({title: "Jump down to" + contents_list_item});
	

	
	});

	$("#knowledge_contents .outer").each(function() {
		
		var contents_list_item = $("input", this).val();
		var my_link = $(this).attr("title");		
		
		$("input", this).replaceWith("<a href=#" + my_link + " class=top_level>" + contents_list_item + "</a>");
		$(this).attr({title: "Jump down to " + contents_list_item});
	

	
	});
	
	$("#new_article_completed_toc_wrapper").fadeIn();

	// the transmitting of the TOC depends entirely upon the jQuery .text() method converting the toc into html entities, and then the PHP htmlentities() function converting them back after submitting the form.
	$("#final_toc").text($("#knowledge_contents").html());
	
	return false;
});




// Edit tags script

window.tag_editing = 0; 

$(".tag_list").click(function() {
	
	var tag_text = $(this).text().replace(/'/g, "&#39;");;
	var tag_id = $(this).attr("id");
	
	$(this).after("<input type=hidden value=" + tag_id + " name=edit_submit_tag" + window.tag_editing + "_id>");	
	$(this).replaceWith("<input id=editing_tag_input" + window.tag_editing + " class=editing_tag type=text name=edit_submit_tag" + window.tag_editing + "_name value='" + tag_text + "'>");
	$("#editing_tag_input" + window.tag_editing).fadeIn();

	window.tag_editing++;
	return false;
	
	
	
});
	
	
// New tags script

window.new_tag_id = 0;

$("#create_tag").click(function() {
	
	if(window.new_tag_id <= 9) {

	$(this).after("<input id=new_tag_input" + window.new_tag_id + " class=editing_tag type=text name=new_submit_tag" + window.new_tag_id + ">");
	$("#new_tag_input" + window.new_tag_id).fadeIn();


	window.new_tag_id++;
	return false;
	
	}
	
	else {
		
	$("#tag_warning").html("Warning: you've reached the maximum number of simultaneous new tags");	
		
	return false;	
		
	}
	
	
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





</div>