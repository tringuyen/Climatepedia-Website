<?php

include("inc.admin-user.connect.php");
$article_id = $_POST['new_submit_news_id'];
$article_title = $db->real_escape_string($_POST['new_submit_news_title']);
$article_source = $db->real_escape_string($_POST['new_submit_news_source']);
$article_link = $db->real_escape_string($_POST['new_submit_news_link']);
$article_description = $db->real_escape_string($_POST['new_submit_news_description']);
$article_date = $db->real_escape_string($_POST['new_submit_news_date']);
$article_tag = $db->real_escape_string($_POST['new_submit_news_tag']);

$query = ("UPDATE news_articles SET article_title = '$article_title', article_source = '$article_source', article_link = '$article_link', article_description = '$article_description', article_date = '$article_date', article_tag = '$article_tag' WHERE article_id = '$article_id'");
$result=$db->query($query);

header("Location:http://www.climatepedia.org/beta/newclimate/admin.php?console=news&action=success&type=edit&query=news&title=" . $article_title);