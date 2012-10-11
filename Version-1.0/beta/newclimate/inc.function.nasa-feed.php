<?php

// CODE FOR NASA Images

	
ob_start(); // Start the output buffer
require_once('magpie/rss_fetch.inc');
define('MAGPIE_CACHE_DIR', '/tmp/cbbnews4DEV2');

// keyword for database
$item_keyword = "NASA Earth Observatory Natural Hazard Images";


// keyword for cache
$cache_keyword = str_replace(" ", "-", $item_keyword);


$magurl = "http://earthobservatory.nasa.gov/Feeds/rss/nh.rss";

$magrss = fetch_rss($magurl);
$magi = 0;



if (isset($magrss->items)) {
	foreach($magrss->items as $magitem) {

		// get source

    	// $address= $magitem['link']; 
      // $parsed_url = parse_url($address); 
		// $true_link = $parsed_url['scheme'] . "://" . $parsed_url['host'];

		// get time

		if($magitem['pubdate'] == "") {

		$date_1 = strtotime($magitem['published']);
		
		}
		
		else {
			
		$date_1 = strtotime($magitem['pubdate']);			
			
		}
		


		// store in database

		include ("inc.admin-user2.connect.php");
		$item_title = $db2->real_escape_string($magitem['title']);
		$item_link = $db2->real_escape_string($magitem['link']);
		$item_date = $date_1;
		$item_description = $db2->real_escape_string($magitem['atom_content']);

		// check if it's already there
		$query2 = ("SELECT * FROM news_items WHERE item_title = '$item_title' AND item_source = '$item_keyword'");
		$result2=$db2->query($query2);
		$result_count = $result2->num_rows;
		echo $result_count;
		if($result_count < 1) {

			$query2 = ("INSERT INTO news_items (item_title, item_link, item_date, item_description, item_source) VALUES ('$item_title', '$item_link', '$item_date', '$item_description', '$item_keyword')");
			$result2=$db2->query($query2);
			
			$query2 = ("UPDATE news_sources SET source_used=source_used+1 WHERE source_sidebar = '$item_keyword'");
			$result2=$db2->query($query2);
		
		$magi++;

		}
	}
} else {
	print "<p>Newsfeed temporarily unavailable.</p>";
}

echo "<!-- Generated ".date("F j, Y, g:i a")." -->\n";

// Cache the output to a file
$cachefile = "news-cache/news-". $cache_keyword . "-cache.html";
$fp = fopen($cachefile, 'w');
fwrite($fp, ob_get_contents());
fclose($fp);
ob_end_flush(); // Send the output to the browser
ob_flush();





?>