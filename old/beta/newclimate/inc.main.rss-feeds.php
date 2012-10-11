<?php


include("inc.main.connect.php");

$sql_raw = $page_number * 20;
$sql_limit = $sql_raw - 20;

// check type

if($pagekeyword == "highlights") {

// first get total number for page builder
$query = ("SELECT * FROM news_articles");
$result=$db->query($query);
$page_builder_number = $result->num_rows;	

// then get posts depending on page

// check if we're sorting
if($sort_special == 1) {
	
$query = ("SELECT * FROM news_articles ORDER BY article_title $feed_sort LIMIT $sql_limit, 20");
$result=$db->query($query);
	
}

else {
	
	
$query = ("SELECT * FROM news_articles ORDER BY article_date $feed_sort LIMIT $sql_limit, 20");
$result=$db->query($query);

}

echo ("<p id=news_intro>Viewing Climatepedia's selected news. Click on a topic or source to view the raw news stream.</p>");

while($row=$result->fetch_array()) {

$year = substr($row['article_date'],0,4);
		$month = substr($row['article_date'],4,2);
		$day = substr($row['article_date'],6,2);
		$nice_date = date("D M d, Y",mktime(0,0,0,$month,$day,$year));

echo ("

<div class=news_entry>
<h3 class=news_title><a target=_blank href=" . $row['article_link'] . ">" . $row['article_title'] . "</a></h3>
<p class=news_meta><span class=news_source>" . $row['article_source'] . "</span> - <span class=news_date>" . $nice_date . "</span></p>
<p class=news_description>" . $row['article_description'] . "</p>
</div>

");

}

}

elseif($query_type == "keyword") {

// first get total number for page builder
$query = ("SELECT * FROM news_feeds WHERE item_keyword = '$pagekeyword'");
$result=$db->query($query);
$page_builder_number = $result->num_rows;	

// then get posts depending on page

// check if we're sorting

if($sort_special == 1) {
	
$query = ("SELECT * FROM news_feeds WHERE item_keyword = '$pagekeyword' ORDER BY item_title $feed_sort LIMIT $sql_limit, 20");
$result=$db->query($query);

}

else {
	
$query = ("SELECT * FROM news_feeds WHERE item_keyword = '$pagekeyword' ORDER BY item_date $feed_sort LIMIT $sql_limit, 20");
$result=$db->query($query);

}

echo ("<p id=news_intro>Viewing a raw news stream.</p>");

while($row=$result->fetch_array()) {


echo ("

<div class=news_entry>
<h3 class=news_title><a target=_blank href=" . $row['item_link'] . ">" . $row['item_title'] . "</a></h3>
<p class=news_meta><span class=news_source>" . $row['item_source'] . "</span> - <span class=news_date>" . date("D - M d, Y", $row['item_date']) . "</span></p>
<p class=news_description>" . $row['item_description'] . "</p>
</div>

");

}



}

else {

// first get total number for page builder
$query = ("SELECT * FROM news_items WHERE item_source = '$pagekeyword'");
$result=$db->query($query);
$page_builder_number = $result->num_rows;	

// then get posts depending on page

// check if we're sorting
if($sort_special == 1) {
$query = ("SELECT * FROM news_items WHERE item_source = '$pagekeyword' ORDER BY item_title $feed_sort LIMIT $sql_limit, 20");
$result=$db->query($query);
}

else {
$query = ("SELECT * FROM news_items WHERE item_source = '$pagekeyword' ORDER BY item_date $feed_sort LIMIT $sql_limit, 20");
$result=$db->query($query);
	
}
	
	
while($row=$result->fetch_array()) {
	
// check if description is too long, if it is cut it short at the closest word to 1001 characters


if($pagesource_images == 0) {
// strip tags to keep from cutting off in the middle of a tag and breaking formatting
$item_description = strip_tags($row['item_description'], '<p><div><img>');
$item_description = preg_replace("/<img[^>]+\>/i", "", $item_description); 
$item_description = preg_replace("/<br[^>]+\>/i", "", $item_description); 


if(strlen($item_description) > 2000) {
	
$item_description = preg_replace("/\s+?(\S+)?$/", " <a style=text-decoration:underline href=" . $row['item_link'] . " target=_blank>...</a>", substr($item_description, 0, 1001));

}

}

else {
	
	$item_description = $row['item_description'];
	
}
	
// code for Yale's popwin image thing, bastards.
if($pagekeyword == "Yale Environment 360") {
	
?>
<script type="text/javascript" >

function popwin (n,w,h){   day = new Date();  id = day.getTime();    eval("page" + id + " = window.open(n, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=" + w + ",height=" + h + "');");}

</script>
	
<?php

}

// code for Yale's date, bastards.

if($row['item_date'] == 0) {

$the_date = "";
	
}

else {
	
$the_date = " - " . date("D - M d, Y", $row['item_date']);

}
echo ("<p id=news_intro>Viewing a raw news stream.</p>");
echo ("

<div class=news_entry>
<h3 class=news_title><a target=_blank href=" . $row['item_link'] . ">" . $row['item_title'] . "</a></h3>
<p class=news_meta><span class=news_source>" . $pagesource_name . "</span> <span class=news_date>" . $the_date . "</span></p>
<div class=news_description>" . $item_description . "</div>
</div>

");
	
	

}
	
}
	
// build pagination navigation

echo ("<div id=pages_nav><p>Page | </p>");
$number_of_pages = ceil($page_builder_number / 20);
$page_builder_i = 1;
while($page_builder_i <= $number_of_pages) {
	// check whether we're sorting
	if(isset($_GET['sort'])) {
	echo ("
	
	<a href=/beta/newclimate/news/" . $_GET['keyword'] . "/page/" . $page_builder_i . "&sort=" . $_GET['sort'] . " class=page_link>" . $page_builder_i . "</a>
	
	");
	}
	else {
	echo ("
	
	<a href=/beta/newclimate/news/" . $_GET['keyword'] . "/page/" . $page_builder_i . " class=page_link>" . $page_builder_i . "</a>
	
	");	
		
	}

$page_builder_i++;	
}
echo ("</div>");





?>