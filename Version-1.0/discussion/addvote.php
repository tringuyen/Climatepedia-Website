<?php

include ('connect.php');

$postid = $_POST['reply'];
$ratingvalue = $_POST['rating'];
$userip = $_POST['ip'];

$query = "SELECT rating_ip FROM ratings WHERE rating_ip='$userip' AND post_id='$postid'";
$result = $db->query($query);

$numberrows = $result->num_rows;
	
	if($numberrows >= 1) {
	
	echo 'sorry, you can\'t thumbs up twice';
	
}

else {
	
	$query = "INSERT INTO ratings (post_id, rating_value, rating_ip) VALUES ('$postid','$ratingvalue','$userip')";
	$result = $db->query($query);

	if($ratingvalue >= 1) {

	$query = "UPDATE replies SET reply_up = reply_up+1 WHERE reply_id='$postid'";
	$result = $db->query($query);

	}

	else {

	$query = "UPDATE replies SET reply_down = reply_down+1 WHERE reply_id='$postid'";
	$result = $db->query($query);

	}

}
?>
