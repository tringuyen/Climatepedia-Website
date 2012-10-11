<?php
// Administrative options and functions

$userip = $_SERVER['REMOTE_ADDR'];
$today = date("Y-m-d");

// To do: set dynamic page titles and meta descriptions










?>




<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<title>Discuss | Climatepedia</title>


<link rel="stylesheet" type="text/css" href="css/discussion.css" />
<script type="text/javascript" src="http://www.climatepedia.org/scripts/jquery-1.4.4.min.js"></script><script type="text/javascript" src="http://www.climatepedia.org/scripts/dropdown.js"></script>
<script type="text/javascript"src="http://www.climatepedia.org/scripts/jquery-ui-1.8.11.custom.min.js"></script>
<link rel="stylesheet" type="text/css"href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/themes/base/jquery-ui.css"/>
<script type="text/javascript" src="http://www.climatepedia.org/ckeditor/ckeditor.js"></script>



<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-21357845-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();


// Set default current_page as dashboard, which will be changed if they go anywhere else

window.current_page = "dashboard.php";

$(document).ready(function() {
	var theLoc = $('#nav2').position().top;
	$(window).scroll(function() {
		if(theLoc >= $(document).scrollTop()) {
			if($('#nav2').hasClass('fixed')) {
				$('#nav2').removeClass('fixed');
			}
		} else { 
			if(!$('#nav2').hasClass('fixed')) {
				$('#nav2').addClass('fixed');
			}
		}
	});

});


</script>
</head>
<body>
<img id="background" src="css/images/earthlight.jpg" alt="" >
<div id="wrapper">



<?php require_once ('http://www.climatepedia.org/inc.nav.php') ?>


<div id="pagecontent">

<div id="discussbottom">
<div id="nav2">
<p id="backforward">
<a href="" id="back_button" ></a>
<a href="" id="forward_button" ></a>
<a href="" id="refresh_button" ></a>
</p>
<p id="options">
<a href="">Ask a Professor</a>
|
<a href="">Suggest a Thread</a>
|
<a href="">Your Discussions</a>
|
<a href="">Help</a>
</p>
</div>
<div id="leftrightwrapper">
<div id="left">

<!-- Home Topics -->
<div class="category" id="home">
<div class="categoryheader">Home</div>
<div class="topic lightblue news_topic" id="dashboardtopic">
<a class="dashboard topictitle" id="dashboardlink" href="discussion.php">Discussion Dashboard</a> <br>
<p class="topicdescr">Homepage of the Discussion</p>
</div>
</div>

<!-- Community Topics -->
<div class="category" id="category_community">
<div class="categoryheader">Community</div>
<?php
require ('connect.php');


$query="SELECT topic_title, topic_id, topic_descr, topic_cat FROM topics WHERE topic_cat='5'";

$result=$db->query($query);


while($row = $result->fetch_array()) {

$topicid = $row['topic_id'];
$topicdescr = $row['topic_descr'];


echo "<div class='topic community_topic' id=topic" . $topicid . "wrapper><a class=topictitle id=$topicid href=discussion.php?topic=" . strip_tags($topicid) . '>'. stripslashes($row['topic_title']) . '</a><br><p class=topicdescr>' . stripslashes($topicdescr) .  '</p></div>';

}

?>
</div>

<!-- Professor Topics -->
<div class="category" id="category_news">
<div class="categoryheader">Professors</div>
<?php
require ('connect.php');


$query="SELECT topic_title, topic_id, topic_descr, topic_cat FROM topics WHERE topic_cat='8'";

$result=$db->query($query);


while($row = $result->fetch_array()) {

$topicid = $row['topic_id'];
$topicdescr = $row['topic_descr'];


echo "<div class=topic id=topic" . $topicid . "wrapper class=news_topic><a class=topictitle id=$topicid href=discussion.php?topic=" . strip_tags($topicid) . '>'. stripslashes($row['topic_title']) . '</a><br><p class=topicdescr>' . stripslashes($topicdescr) .  '</p></div>';

}

?>
</div>

<!-- General Topics -->
<div class="category" id="category_general">
<div class="categoryheader">General</div>
<?php
require ('connect.php');


$query="SELECT topic_title, topic_id, topic_descr, topic_cat FROM topics WHERE topic_cat='0'";

$result=$db->query($query);


while($row = $result->fetch_array()) {

$topicid = $row['topic_id'];
$topicdescr = $row['topic_descr'];

echo "<div class=topic id=topic" . $topicid . "wrapper class=news_topic><a class=topictitle id=$topicid href=discussion.php?topic=" . strip_tags($topicid) . '>'. stripslashes($row['topic_title']) . '</a><br><p class=topicdescr>' . stripslashes($topicdescr) .  '</p></div>';

}

?>
</div>


<!-- News Topics -->
<div class="category" id="category_news">
<div class="categoryheader">News</div>
<?php
require ('connect.php');


$query="SELECT topic_title, topic_id, topic_descr, topic_cat FROM topics WHERE topic_cat='6'";

$result=$db->query($query);


while($row = $result->fetch_array()) {

$topicid = $row['topic_id'];
$topicdescr = $row['topic_descr'];


echo "<div class=topic id=topic" . $topicid . "wrapper class=news_topic><a class=topictitle id=$topicid href=discussion.php?topic=" . strip_tags($topicid) . '>'. stripslashes($row['topic_title']) . '</a><br><p class=topicdescr>' . stripslashes($topicdescr) .  '</p></div>';

}

?>
</div>

<!-- Energies Topics -->
<div class="category" id="category_energies">
<div class="categoryheader">Energies</div>
<?php
require ('connect.php');


$query="SELECT topic_title, topic_id, topic_descr, topic_cat FROM topics WHERE topic_cat='7'";

$result=$db->query($query);


while($row = $result->fetch_array()) {

$topicid = $row['topic_id'];
$topicdescr = $row['topic_descr'];


echo "<div class='topic energy_topic' id=topic" . $topicid . "wrapper><a class=topictitle id=$topicid href=discussion.php?topic=" . strip_tags($topicid) . '>'. stripslashes($row['topic_title']) . '</a><br><p class=topicdescr>' . stripslashes($topicdescr) .  '</p></div>';

}

?>

</div>

<!-- Opinion Topics -->
<div class="category" id="category_opinion">
<div class="categoryheader">Opinion</div>
<?php
require ('connect.php');


$query="SELECT topic_title, topic_id, topic_descr, topic_cat FROM topics WHERE topic_cat='4'";

$result=$db->query($query);


while($row = $result->fetch_array()) {

$topicid = $row['topic_id'];
$topicdescr = $row['topic_descr'];


echo "<div class=topic id=topic" . $topicid . "wrapper class=opinion_topic><a class=topictitle id=$topicid href=discussion.php?topic=" . strip_tags($topicid) . '>'. stripslashes($row['topic_title']) . '</a><br><p class=topicdescr>' . stripslashes($topicdescr) .  '</p></div>';

}

?>

</div>






<script type="text/javascript" >

$('.topictitle').click(function(){
	
// Script for clicking on a navigation item from the left bar
// add light blue "current" class, check if we're going to the dashboard or a topic, load in that content, and set back location

	
	var justclicked = $(this).attr('id');
	
	if(justclicked != replytopic) {
	
	
	var replytopic = $(this).attr('id');

	$('.topic').removeClass('lightblue');
	
	$(this).parent().toggleClass('lightblue');
	
	}
	
	if ($(this).is('.dashboard')) {
	
	$('#ajaxloader').show();
	$('#back_button').css({"opacity" : "1"});
	
if(typeof(previous_page2) !== 'undefined') {window.previous_page3 = previous_page2;}
if(typeof(previous_page1) !== 'undefined') {window.previous_page2 = previous_page1;}
window.previous_page1 = current_page;
	
	$('#right').fadeOut('fast', function() {
		
	window.current_page = "dashboard.php";

	$('#right').load("dashboard.php #right", function () {
	
	$('#right').fadeIn('fast');
	
	$('#ajaxloader').hide();
		
		});
		
		});
		}

	else {



if(typeof(previous_page2) !== 'undefined') {window.previous_page3 = previous_page2;}
if(typeof(previous_page1) !== 'undefined') {window.previous_page2 = previous_page1;}
window.previous_page1 = current_page;

	$('#ajaxloader').show();
	$('#back_button').css({"opacity" : "1"});

	$('#right').fadeOut('fast', function() {

	window.current_page = "discussion.php?topic=" + replytopic;

	$('#right').load("discussion.php?topic=" + replytopic + " #right", function () {
	
	$('#right').fadeIn('fast');
	
	$('#ajaxloader').hide();	
		
		});
	});
	}
	
	return false;
});

</script>

<script type="text/javascript" >

// Script for back/forward/refresh buttons

$('#back_button').click(function(){
	

	$('#forward_button').css({"opacity" : "1"});
	

	$('#ajaxloader').show();
	$('#right').fadeOut('fast', function() {
		
		$('#right').load(previous_page1 + " #right", function() {
			
			var current_holder = current_page;
			var previous_holder = previous_page1;
			window.forward_page1 = current_holder;
			window.current_page = previous_holder;			
			
			$('#right').fadeIn('fast');
			
			$('#back_button').css({"opacity" : ".5"});
	
			$('#ajaxloader').hide();	
		
		});
	
	});
	
return false;
	
});

$('#forward_button').click(function(){
	
	$('#back_button').css({"opacity" : "1"});
	
	$('#ajaxloader').show();
	$('#right').fadeOut('fast', function() {
		
		$('#right').load(forward_page1 + " #right", function() {
	
			var current_holder = current_page;
			var previous_holder = forward_page1;
			window.previous_page1 = current_holder;
			window.current_page = previous_holder;			
			
			$('#right').fadeIn('fast');
			
			$('#forward_button').css({"opacity" : ".5"});
	
			$('#ajaxloader').hide();	
		
		});
	
	});
	
return false;
	
	
});

$('#refresh_button').click(function() {
	
	$('#ajaxloader').show();
	$('#right').fadeOut('fast', function() {
	
	$('#right').load(current_page + " #right", function() {
	
			$('#right').fadeIn('fast');
	
			$('#ajaxloader').hide();	
		
		});
	
	});
	
return false;
	
});	
	






</script>



<div id="minimize" title="Click to minimize/maximize the left bar">
<div id="arrow" class="expanded"></div>
</div>

<script type="text/javascript" >

$('#minimize').click(function() {
	
	if($('#left').width() > 160) {
	
	$('#left').animate({'width':'17px'});
	$('.category').hide();
	$('#rightwrapper').animate({'width':'958px'});
	$('.topicpost').animate({'width':'923px'});
	$('.reply').animate({'width':'928px'});
	$('.replycontent').animate({'width':'798px'});
	$('.childreply').animate({'width':'858px'});
	$('.childreplywrapper').animate({'width':'878px'});
	$('#arrow').removeClass('expanded');
	$('#arrow').addClass('minimized');
	}
	
	else {
		
	$('#rightwrapper').animate({'width':'780px'});
	$('.reply').animate({'width':'750px'});
	$('.topicpost').animate({'width':'745px'});
	$('.replycontent').animate({'width':'630px'});
	$('.childreply').animate({'width':'680px'});
	$('.childreplywrapper').animate({'width':'700px'});
	$('#left').animate({'width':'195px'});
	$('.category').show();
	$('#arrow').removeClass('minimized');
	$('#arrow').addClass('expanded');
		
	}
	
	
});

</script>

</div>


<div id="rightwrapper">
<div id="ajaxloader"></div>

<div id="shadow"></div>
<div id="right">

<!-- Code for grabbing thread replies -->



<?php


$pagetopic=htmlspecialchars($_GET["topic"]);

// Check if we're on a topic thread

if(isset($_GET["topic"])) {

// We're on the list of threads, show the threads that go with the topic we're on

echo ('<div id=thread_list><div id=thread_list_top_wrapper><div id=thread_list_top><p id=threads_conversation>Conversation</p><p id=threads_category>Category</p><p id=threads_replies>Replies</p></div></div><div id=thread_list_bottom>');

$query="SELECT threads.thread_id, threads.thread_topic, threads.thread_title, threads.thread_replies, topics.topic_title, topics.topic_id FROM threads, topics WHERE '$pagetopic'=threads.thread_topic AND threads.thread_topic=topics.topic_id";

$result = $db->query($query);

while($row = $result->fetch_array()) {

echo ('<div class=thread><a href=discussion.php?thread=' . strip_tags($row['thread_id']) . ' id=' . $row['thread_id'] . ' class=thread_title>' . $row['thread_title'] . '</a><p class=thread_category>' . $row['topic_title'] . '</p><p class=thread_replies>' . $row['thread_replies'] . '</p></div>');

}

echo ('</div></div>');

}

elseif(isset($_GET["thread"])) {

// We're on a thread, so get the replies to that thread

$pagethread = $_GET["thread"];

$query = "SELECT threads.thread_id, threads.thread_topic, threads.thread_title, threads.thread_author, threads.thread_post, topics.topic_id, topics.topic_title FROM threads, topics WHERE '$pagethread'=threads.thread_id AND threads.thread_topic=topics.topic_id";

$result = $db->query($query);

while($row = $result->fetch_array()) {
	
$threadpostcontent = $row['thread_post'];
$threadpostauthor = $row['thread_author'];
$threadposttitle = $row['thread_title'];

echo ("<div class=topicpost><h2 class=openingpostheader>$threadposttitle</h2>"

 . "<div class=openingpostauthor></div>"

 . "<div class=openingpostcontent>"
 
 . nl2br($threadpostcontent) . "</div>"

 . "<div class=openingpostreply>Reply!</div></div>"



);

}

$query="SELECT replies.reply_content, replies.reply_avatar, replies.reply_date, replies.reply_id, replies.reply_children, avatars.avatar_name FROM replies LEFT JOIN avatars ON replies.reply_avatar = avatars.avatar_id WHERE '$pagethread'=reply_thread AND reply_parent = '0'";

$result = $db->query($query);

while($row = $result->fetch_array()) {

$replycontent = $row['reply_content'];
$avatarname = $row['avatar_name'];
$avatar = $row['reply_avatar'];
$date = $row['reply_date'];
$replyid = $row['reply_id'];
$replychildren = $row['reply_children'];

echo ('<div class=reply id=' . "reply$replyid" . '><div class=replyheader><span class=authorinfo><h5 class=avatarname>'

. $avatarname

. '</h5><p class=wrote> wrote:</p></span><p class=replydate>'

. $date

. '</p></div>'

. '<div class=replyauthor><img src="avatars/'

. $avatar

. '.jpg" class="avatarimage"></div><div class=replycontent>'

. nl2br($replycontent)

 . '</div><div class=replybottom><a href=#avatar_anchor class=replyreply id='

. $replyid

. '>Reply!</a><div class=voting><a href="#reply" class=like id='

. $replyid 

. '>12 Votes up</a><a href="#reply" class=dislike id='

. $replyid

. '>3 Votes down</a></div><p class=postshere>Posts on this thread: 10</p><p class=poststotal>Posts total: 204</p></div>'



);

if($replychildren >= 1) {
	
$querychild="SELECT replies.reply_content, replies.reply_avatar, replies.reply_date, replies.reply_id, avatars.avatar_name FROM replies LEFT JOIN avatars ON replies.reply_avatar = avatars.avatar_id WHERE '$replyid'=reply_parent";

$resultchild = $db->query($querychild);

echo '<div class=childreplywrapper>';

while($rowchild = $resultchild->fetch_array()) {

$childcontent = $rowchild['reply_content'];
$childavatarname = $rowchild['avatar_name'];
$childavatar = $rowchild['reply_avatar'];
$childdate = $rowchild['reply_date'];
$childid = $rowchild['reply_id'];

echo ('<div class=childreply id=' . "reply$childid" . '><div class=replyheader><span class=authorinfo><h5 class=avatarname>'

. $childavatarname

. '</h5><p class=wrote> wrote:</p></span><p class=replydate>'

. $childdate

. '</p></div>'


. '<div class=replyauthor><img src="avatars/'

. $childavatar

. '.jpg" class="avatarimage"></div>'

. '<div class=replycontent>'

. nl2br($childcontent)

 . '</div><div class=replybottom><a href=#avatar_anchor class=replyreply id='

. $replyid

. '>Reply!</a><div class=voting><a href="#reply" class=like id='

. $childid 

. '>3 Votes up</a><a href="#reply" class=dislike id='

. $childid

. '>1 Votes down</a></div><p class=postshere>Posts on this thread: 10</p><p class=poststotal>Posts total: 204</p></div></div>'



);


}

echo '</div>';

}

echo '</div>';

}

}

else {
	
// Show discussion dashboard

require_once ('dashboard.php');

}



?>

<script type="text/javascript" >

$('.thread_title').live("click", function() {
	
if(typeof(previous_page2) !== 'undefined') {window.previous_page3 = previous_page2;}
if(typeof(previous_page1) !== 'undefined') {window.previous_page2 = previous_page1;}
window.previous_page1 = current_page;	

	window.reply_thread = $(this).attr('id');
	
	var replythread = $(this).attr('id');

	$('#ajaxloader').show();
	$('#back_button').css({"opacity" : "1"});
	$('#forward_button').css({"opacity" : ".5"});

	$('#right').fadeOut('fast', function() {
		
		window.current_page = "discussion.php?thread=" + replythread;

	$('#right').load("discussion.php?thread=" + replythread + " #right", function () {
	
	$('#right').fadeIn('fast');
	
	$('#ajaxloader').hide();		
		
		});
	});

	
	return false;
});

</script>


<script type="text/javascript" >

$('.like').live("click", function() {
	
	$.post("addvote.php", {reply: $(this).attr("id"), rating: '1', <?php print("ip: '$userip'"); ?>});

	$(this).parent().fadeOut('fast', function() {
	$(this).html("<p>You're saving the world, one opinion at a time.</p>");
	$(this).fadeIn('fast');
	
	});


return false;

});


$('.dislike').live("click", function() {
	
	var reply_id = $(this).attr("id");
	
	$.post("addvote.php", {reply: reply_id, rating: '0', <?php print("ip: '$userip'"); ?>});

	$(this).parent().fadeOut('fast', function() {
	$(this).html("<p>You're saving the world, one opinion at a time.</p>");
	$(this).fadeIn('fast');
	
	});


return false;

});



</script>






</div>
</div>
</div>
</div>
</div>








</div>





<?php require_once('avatar.php'); ?>

<div id="hidden_stuff"><a id="replying_anchor" name="replying_anchor"></a>
<input type="hidden" value="<?php echo $_GET['thread']; ?>">
<img src="css/images/back-button-hover.png" alt="" >
<img src="css/images/forward-button-hover.png" alt="" >
<img src="css/images/refresh-button-hover.png" alt="" >

</div>
</body>




</html>






