<?php 

$title = $_POST['title'];
$author = $_POST['author'];
$category = $_POST['category'];


include('connect.php');

$query = "INSERT INTO topics (topic_title, topic_cat, topic_author)
VALUES ('$title', '$category', '$author')";

$result=$db->query($query);


?>