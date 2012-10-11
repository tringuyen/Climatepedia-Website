<?php 



$user=$_SESSION['admin'];




//  Set SEO variables



$seo_title = "Administration | Climatepedia";
$seo_keywords = "climatepedia administration";
$seo_description = "climatepedia administration";
$css_sheet = "admin";

$js1 = "";
$js2 = "scripts/topic_submit.js";
$js3 = "scripts/category_submit.js";




// load top template


require_once ('inc.header.php');



?>




<div id="pagecontent">


<div id="category_form">
<form name="category" action="">
<fieldset>
<label for="name" id="name_label" >Category Name</label>
<input type="text" name="name" id="name" size="30" value="" class="text-input" >
<label class="error" for="name" id="name_error">This field is required.</label>
<br>
<input type="submit" name="submit" class="button" id="cat-submit" value="Send" >
</fieldset>

</form>
</div>
<?php 

include('connect.php');

$query = "SELECT cat_id, cat_name FROM categories";
$result=$db->query($query);

$options="";

while ($row=mysqli_fetch_array($result)) {
	
	$id=$row["cat_id"];
	$category_name=$row["cat_name"];
	$options.="<option value=\"$id\">".$category_name.'</option>';
}


$query = "SELECT admin_id, admin_name FROM admin WHERE '$user'=admin_name";
$result = $db->query($query);
$userid = "";

while ($row=mysqli_fetch_array($result)) {
	
	$userid=$row["admin_id"];


}
?>


<div id="topic_form">
<form name="topic" action="">
<fieldset>
<span class="item">
<label for="title" id="title_label" >Topic Title</label>
<input type="text" name="title" id="title" size="30" value="" class="text-input" >
<label class="error" for="title" id="title_error">This field is required.</label>
</span>
<span class="item">
<label for="topic_category" id="topic_category_label" >Topic Category</label>
<select name="topic_category" id="topic_category">
<?php echo $options; ?>

</select>
<label class="error" for="topic_category" id="topic_category_error">This field is required.</label>
</span>
<span class="item">
<label for="author" id="author_label" >Topic Author: <?php echo"$user";?></label>
<input type="hidden" name="author" id="author" size="30" value="<?php print $userid; ?>" class="text-input" >
</span>
<br>
<span class="item">
<input type="submit" name="submit" class="button" id="topic-submit" value="Send" >
</span>
</fieldset>

</form>

</div>










<div id="forumposts">

<?php
include('connect.php');

$query="SELECT topic_title, topic_id FROM topics";

$result=$db->query($query);

$topics = "";

while($row = $result->fetch_array()) {

$topicid = $row['topic_id'];

echo "<a id='$topicid' href=forum.php?topic=" . strip_tags($topicid) . '>'. stripslashes($row['topic_title']) . '</a>';


}

?>

</div>


<script type="text/javascript" >







$('a').click(function(){
	
	
	var replytopic = $(this).attr('id');
	
	$('#replies').load("forum.php?topic=" + replytopic + " #contentreply").hide().fadeIn('slow');
return false;
});
</script>




<div id="reply_form">
<form id="replyform" action="create_reply.php" method="POST">
<label for="replycontent">Content</label>
<label class="error" id="replycontent_error">This is a required field.</label>
<textarea rows="5" name="replycontent" id="replycontent" ></textarea>
<input type="submit" value="send" id="reply-submit" name="reply-submit">
</form>
</div>

<script type="text/javascript" >
CKEDITOR.replace( 'replycontent',

{
	
	toolbar : 'MyToolbar'

});

</script>




<?php 








?>











<div id="replies">




<?php
$pagetopic=htmlspecialchars($_GET["topic"]);



$query="SELECT reply_content FROM replies WHERE '$pagetopic'=reply_topic";

$result = $db->query($query);

while($row = $result->fetch_array()) {

$replycontent = $row['reply_content'];

?>

<div id="contentreply">
<?php

echo htmlentities('<p>' . "$replycontent" . '</p>');

}

?>
</div>


</div>












</div>







</div>





</div>
</body>
</html>