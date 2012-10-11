<?php 

$content = $_POST['replycontent'];
$avatar = "1";
$topic = "10";
$author = "1";



include('connect.php');

$query = "INSERT INTO replies (reply_content, reply_date, reply_avatar, reply_by, reply_topic)
VALUES ('$content', NOW(), '$avatar', '$author', '$topic')";

$result=$db->query($query);



?>