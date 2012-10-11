<?php

echo ("

		<h3 class=right_header>Professor Posts</h3>
		<ul style='list-style-type:none'>
			
	");

include ("inc.main.connect.php");

$query = ("SELECT post_title, post_url, post_date FROM podium_posts ORDER BY post_date DESC LIMIT $professor_post_limit");
$result=$db->query($query);


while($row=$result->fetch_array()) {

echo ("

<li style='padding:4px 0;'><a href=/beta/newclimate/podium/" . $row['post_url'] . ">" . $row['post_title'] . "</a></li>

");



}


?>