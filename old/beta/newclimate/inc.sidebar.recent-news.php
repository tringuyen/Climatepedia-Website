<?php

include ("inc.main.connect.php");

if(!isset($page_tag)) {

$page_tag = 4;

}

$query = ("SELECT tag_id, tag_name FROM climate_tags WHERE tag_id = '$page_tag'");
$result=$db->query($query);
while($row=$result->fetch_array()) {

$page_keyword = $row['tag_name'];

}

$raw_keyword = strtolower($page_keyword);
$list_keyword = str_replace(" ", "-", $raw_keyword);

echo ("

			<h3 class=right_header>" . $page_keyword . " News</h3>
			<ul style='list-style-type:none'>

");


$query = ("SELECT item_title, item_date, item_keyword FROM news_feeds WHERE item_keyword = '$page_keyword' ORDER BY item_date DESC LIMIT $page_news_limit");
$result=$db->query($query);



while($row=$result->fetch_array()) {

echo ("

<li style='padding:4px 0;'><a href=/beta/newclimate/news/" . $list_keyword . ">" . $row['item_title'] . "</a></li>

");


}

echo ("</ul>");






?>