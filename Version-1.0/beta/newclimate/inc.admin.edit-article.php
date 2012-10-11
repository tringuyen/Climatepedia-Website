<?php

include("inc.admin-user.connect.php");

$article_id = $db->real_escape_string($_POST['edit_submit_id']);
$article_name = $db->real_escape_string($_POST['edit_submit_name']);
$page_title =  $db->real_escape_string($_POST['edit_submit_title']);
$page_meta =  $db->real_escape_string($_POST['edit_submit_description']);
$article_url =  $db->real_escape_string($_POST['edit_submit_url']);
$article_contents =  $db->real_escape_string($_POST['edit_submit_contents']);
$article_toc =  $db->real_escape_string($_POST['edit_submit_toc']);
$article_tag1 =  $db->real_escape_string($_POST['edit_submit_tag1']);
$article_tag2 =  $db->real_escape_string($_POST['edit_submit_tag2']);
$article_tag3 =  $db->real_escape_string($_POST['edit_submit_tag3']);
$article_oldtag1 =  $db->real_escape_string($_POST['edit_submit_oldtag1']);
$article_oldtag2 =  $db->real_escape_string($_POST['edit_submit_oldtag2']);
$article_oldtag3 =  $db->real_escape_string($_POST['edit_submit_oldtag3']);
$article_images =  $db->real_escape_string($_POST['edit_submit_images']);
$article_draft =  $db->real_escape_string($_POST['edit_submit_draft']);
$article_discussion = 2;
$article_approval = 0;

// insert article draft 
$query = ("INSERT INTO pedia_versions (version_article, version_name, version_url, version_pagetitle, version_pagemeta, version_contents, version_toc, version_tag1, version_tag2, version_tag3, version_discussion, version_images) VALUES ('$article_id', '$article_name', '$article_url', '$page_title', '$page_meta', '$article_contents', '$article_toc', '$article_tag1', '$article_tag2','$article_tag3', '$article_discussion', '$article_images')");

$result=$db->query($query);

// insert article final 
$query = ("UPDATE pedia_articles SET article_name='$article_name', article_pagetitle='$page_title', article_pagemeta='$page_meta', article_contents='$article_contents', article_toc='$article_toc', article_tag1='$article_tag1', article_tag2='$article_tag2', article_tag3='$article_tag3', article_images='$article_images', article_draft='$article_draft', article_approval='$article_approval' WHERE article_id='$article_id'");

$result=$db->query($query);


// check if we have to update climate tag counts

if($article_oldtag1 !== $article_tag1) {
	
$query = ("UPDATE climate_tags SET tag_count=tag_count+1 WHERE tag_id = '$article_tag1'");
$result=$db->query($query);

$query = ("UPDATE climate_tags SET tag_count=tag_count-1 WHERE tag_id = '$article_oldtag1'");
$result=$db->query($query);

}

if($article_oldtag2 !== $article_tag2) {
	
$query = ("UPDATE climate_tags SET tag_count=tag_count+1 WHERE tag_id = '$article_tag2'");
$result=$db->query($query);

$query = ("UPDATE climate_tags SET tag_count=tag_count-1 WHERE tag_id = '$article_oldtag2'");
$result=$db->query($query);

}

if($article_oldtag1 !== $article_tag3) {
	
$query = ("UPDATE climate_tags SET tag_count=tag_count+1 WHERE tag_id = '$article_tag3'");
$result=$db->query($query);

$query = ("UPDATE climate_tags SET tag_count=tag_count-1 WHERE tag_id = '$article_oldtag3'");
$result=$db->query($query);

}


// create article page


header("Location:http://www.climatepedia.org/beta/newclimate/admin.php?console=knowledge&action=success&type=edit&query=article&resource=" . $article_name . "&url=" . $article_url);








?>

