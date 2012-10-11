<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<title>Discuss | Climatepedia</title>


<link rel="stylesheet" type="text/css" href="css/discussion.css" />
<script type="text/javascript" src="http://www.climatepedia.org/scripts/jquery-1.4.4.min.js"></script><script type="text/javascript" src="http://www.climatepedia.org/scripts/dropdown.js"></script>





<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-21357845-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>

<div id="wrapper">



<?php require_once ('http://www.climatepedia.org/inc.nav.php') ?>


<div id="pagecontent">
<div id="einstein"></div>
<div id="discusstop">

<div id="pagetitle">
<h1>Climate Change Discussion</h1>
</div>
<div id="new">
<p>New to the discussion? Click here to find out what it's all about.</p>
</div>
<div id="highlights">
<p>Recent post highlights:</p>
</div>
<div id="recentposts">

<div class="recentpost">


</div>
<div class="recentpost">

</div>
<div class="recentpost">

</div>
</div>
</div>
<div id="discussbottom">
<div id="nav2">
<p id="area">Which Area?:</p>
<p><a href="">Professor Q&A</a></p>
<p><a href="" >Community Discussion</a></p>
</div>
<div id="left">

<?php
require ('connect.php');

$query="SELECT topic_title, topic_id FROM topics";

$result=$db->query($query);

$topics = "";

while($row = $result->fetch_array()) {

$topicid = $row['topic_id'];

echo "<a id='$topicid' href=discussion.php?topic=" . strip_tags($topicid) . '>'. stripslashes($row['topic_title']) . '</a>';

}

?>

<script type="text/javascript" >

$('a').click(function(){
	
	
	var replytopic = $(this).attr('id');
	
	$('#right').load("discussion.php?topic=" + replytopic + " #right").hide().fadeIn('slow');
return false;
});

</script>







</div>



<div id="right">


<?php
$pagetopic=htmlspecialchars($_GET["topic"]);

$query="SELECT reply_content FROM replies WHERE '$pagetopic'=reply_topic";

$result = $db->query($query);

while($row = $result->fetch_array()) {

$replycontent = $row['reply_content'];






echo nl2br('<p>' . "$replycontent" . '</p>');

}

?>







</div>



</div>









</div>
</div>












</body>




</html>






