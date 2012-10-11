<?php
include("inc.admin-user.connect.php");
$article_title = $db->real_escape_string($_POST['new_submit_news_title']);
$article_source = $db->real_escape_string($_POST['new_submit_news_source']);
$article_link = $db->real_escape_string($_POST['new_submit_news_link']);
$article_description = $db->real_escape_string($_POST['new_submit_news_description']);
$article_date = $db->real_escape_string($_POST['new_submit_news_date']);
$article_tag = $db->real_escape_string($_POST['new_submit_news_tag']);

$query = ("INSERT INTO news_articles (article_title, article_source, article_link, article_description, article_date, article_tag) VALUES ('$article_title', '$article_source', '$article_link', '$article_description', '$article_date', '$article_tag')");
$result=$db->query($query);

// update climate tag counts
$query = ("UPDATE climate_tags SET tag_count=tag_count+1 WHERE tag_id = '$article_tag'");
$result=$db->query($query);


header("Location:http://www.climatepedia.org/beta/newclimate/admin.php?console=news&action=success&type=new&query=news&title=" . $article_title);

?>