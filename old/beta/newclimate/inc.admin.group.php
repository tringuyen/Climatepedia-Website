<?php

?>
<div id="admin_left">
<div id="admin_actions">
<p>Actions</p>
<ul>
<li><a href="admin.php?console=group&action=choose_page" >Edit Group Pages</a></li>
</ul>
</div>
<div id="admin_directions">
<p id="directions_header">Help</p>
<?php if($_GET["action"] == "choose_page") {
	
	echo $new_news_directions;
	
}

elseif($_GET["action"] == "edit_page") {
	
	echo $choose_news_directions;
	
}


?>

</div>


</div>
<div id="admin_right">
<div id="admin_command">
<div id="admin_group">
<?php 

// Check if the user just completed an action



if($_GET["action"] == "success") {

// Check if it was an edit

if($_GET["type"] == "edit") {



// Check if they edited a group page

if($_GET["query"] == "page") {

$edit_page = urldecode($_GET['title']);
$edit_page_stripped = stripslashes($edit_page);

echo ("

<h1>You successfully edited a page!</h1>
<p>The page you edited was: <a target=_blank href=/beta/newclimate/organization/" . $_GET['url'] . ">" . $edit_page_stripped . "</a>.</p>

");


}

// Catch error

else {

echo ("<p>There appears to have been an error, please go back and try again. Sorry about that.</p>");


}

} // Closes off "edit" check

// Check if they created a new something

elseif($_GET["type"] == "new") {




// Did they create a feed?

if($_GET["query"] == "feeds") {

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
// Choose Group Page
//
//


elseif($_GET["action"] == "choose_page") {

echo ("

<h1 class=news_header>Choose a Group Page to Edit</h1>
<p style=padding-bottom:15px><small>(Sorted alphabetically by name)</small></p>
");

include("inc.admin-user.connect.php");

$query="SELECT page_id, page_name, page_update FROM group_pages ORDER BY page_name ASC";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

				echo ("<a class=choose_group_link href=admin.php?console=group&action=edit_page&pageid=" . $row["page_id"] . ">" . $row["page_name"] . "</a><p class=choose_group_date>last update: " . $row["page_update"] . "</p>");
				
				}

}





//
//
// Edit Pages
//
//

elseif($_GET["action"] == "edit_page") {
	
include("inc.admin-user.connect.php");

$page_id = $_GET['pageid'];

$query="SELECT * FROM group_pages WHERE page_id = '$page_id'";
				
				$result=$db->query($query);
					
				while($row = $result->fetch_array()) {

				$page_title = $row['page_title'];
				$page_description = $row['page_description'];
				$page_name = $row['page_name'];
				$page_content = $row['page_content'];
				$page_update = $row['page_update'];
				$page_url = $row['page_url'];
				
				}
	
	
	
echo ("

<h1 class=news_header>Editing the " . $page_name . " group page</h1>
<p style=padding-bottom:15px><small>(If you need advanced formatting changes or URL changes tell Alex)</small></p>
<form method=POST action=inc.admin.edit-page.php>

<input type=hidden name=edit_submit_page_id value=" . $page_id . ">
<input type=hidden name=edit_submit_page_url value=" . $page_url . ">
<label>Page title <span class=label_note>(In web browser - limit 70 chars)</span></label>
<div class=textarea_wrapper><input id=pagetitle_input type=text name=edit_submit_page_title value='" . $page_title . "'></div>

<label>Page description <span class=label_note>(In the web browser - limit 250 chars)</span></label>
<div class=textarea_wrapper><textarea name=edit_submit_page_description id=blogdescription_textarea>" . $page_description . "</textarea></div>

<label>Page name <span class=label_note>(This displays on the web page as the title, keep it short)</span></label>
<div class=textarea_wrapper><input id=pagetitle_input type=text name=edit_submit_page_name value='" . $page_name . "'></div>

<label class=label_extratop>Content  <span class=label_note></span></label><br style=clear:both>
<textarea name=edit_submit_page_content id=new_post_content>" . $page_content . "</textarea>

<label>Page URL <span class=label_note>(Contact Alex to change this)</span> " . $page_url . "</label>



<input style=margin-top:40px class=generic_admin_button type=submit value='Publish your changes!'>
</form>



<script type='text/javascript'>

	CKEDITOR.replace( 'new_post_content' );
	
</script>	

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
	
	
	
	
	
});






</script>



</div> <!-- closes off admin_news -->
</div> <!-- closes off admin_command -->
</div> <!-- closes off admin_right -->