<?php

include("inc.admin-user.connect.php");

$article_name = $db->real_escape_string($_POST['new_submit_name']);
$page_title =  $db->real_escape_string($_POST['new_submit_title']);
$page_meta =  $db->real_escape_string($_POST['new_submit_description']);
$article_url =  $db->real_escape_string($_POST['new_submit_url']);
$article_contents =  $db->real_escape_string($_POST['new_submit_contents']);
$article_toc =  $db->real_escape_string($_POST['new_submit_toc']);
$article_tag1 =  $db->real_escape_string($_POST['new_submit_tag1']);
$article_tag2 =  $db->real_escape_string($_POST['new_submit_tag2']);
$article_tag3 =  $db->real_escape_string($_POST['new_submit_tag3']);
$article_images =  $db->real_escape_string($_POST['new_submit_images']);
$article_draft =  $db->real_escape_string($_POST['new_submit_draft']);
$article_discussion = 2;
$article_approval = 0;

// insert article 
$query = ("INSERT INTO pedia_articles (article_id, article_name, article_url, article_pagetitle, article_pagemeta, article_contents, article_toc, article_tag1, article_tag2, article_tag3, article_discussion, article_images, article_draft) VALUES ('$article_id', '$article_name', '$article_url', '$page_title', '$page_meta', '$article_contents', '$article_toc', '$article_tag1', '$article_tag2','$article_tag3', '$article_discussion', '$article_images', '$article_draft')");

$result=$db->query($query);
$article_id = $db->insert_id;

// update climate tag counts
$query = ("UPDATE climate_tags SET tag_count=tag_count+1 WHERE tag_id = '$article_tag1' OR tag_id = '$article_tag2' OR tag_id = '$article_tag3'");
$result=$db->query($query);



// create article page

$destination = $article_url . ".php";
$article_handle = fopen($destination, 'w') or die("can't open file");
$data = "<?php \n\n // Set page \n\n \$pageid = \"$article_id\"; \n\n // Knowledgepedia content \n\n include(\"inc.main.knowledge.php\"); \n\n ?>";
fwrite($article_handle, $data);
fclose($article_handle);

// save draft

$query = ("INSERT INTO pedia_versions (version_article, version_name, version_url, version_pagetitle, version_pagemeta, version_contents, version_toc, version_tag1, version_tag2, version_tag3, version_discussion, version_images) VALUES ('$article_id', '$article_name', '$article_url', '$page_title', '$page_meta', '$article_contents', '$article_toc', '$article_tag1', '$article_tag2','$article_tag3', '$article_discussion', '$article_images')");

$result=$db->query($query);


header("Location:http://www.climatepedia.org/admin.php?console=knowledge&action=success&type=new&query=article&resource=" . $article_name . "&url=" . $article_url);








?>

