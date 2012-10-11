<?php




// CODE FOR KEYWORDS

include("inc.admin-user.connect.php");
$query = ("SELECT tag_name FROM climate_tags");
$result=$db->query($query);

while($row=$result->fetch_array()) {
	
ob_start(); // Start the output buffer
require_once('magpie/rss_fetch.inc');
define('MAGPIE_CACHE_DIR', '/tmp/cbbnews4DEV2');

// keyword for database
$item_keyword = $row['tag_name'];
// keyword for search
$search_keyword = str_replace(" ", "+", $item_keyword);
// keyword for cache
$cache_keyword = str_replace(" ", "-", $item_keyword);


$magurl = "http://news.search.yahoo.com/rss?ei=UTF-8&p=" . $search_keyword;

$magrss = fetch_rss($magurl);
$magi = 0;



if (isset($magrss->items)) {
	foreach($magrss->items as $magitem) {

		// get source

    	$address= $magitem['link']; 
      $parsed_url = parse_url($address); 
		$true_link = $parsed_url['scheme'] . "://" . $parsed_url['host'];

		// get time

		$date_1 = strtotime($magitem['pubdate']);

		// store in database

		include ("inc.admin-user2.connect.php");
		$item_title = $db->real_escape_string($magitem['title']);
		$item_link = $db->real_escape_string($magitem['link']);
		$item_date = $date_1;
		$item_description = $db->real_escape_string($magitem['description']);
		$item_source = $db->real_escape_string($true_link);

		// check if it's already there
		$query2 = ("SELECT * FROM news_feeds WHERE item_title = '$item_title'");
		$result2 = $db2->query($query2);
		$item_number = $result2->num_rows;

		// if not, store it
		if($item_number < 1) {

			$query2 = ("INSERT INTO news_feeds (item_title, item_link, item_date, item_description, item_source, item_keyword) VALUES ('$item_title', '$item_link', '$item_date', '$item_description', '$item_source', '$item_keyword')");
			$result2=$db2->query($query2);
			
			$query2 = ("UPDATE climate_tags SET tag_newsitems=tag_newsitems+1 WHERE tag_name = '$item_keyword'");
			$result2=$db2->query($query2);
			
			}

		$magi++;
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

}

// CODE FOR SPECIFIC FEED SOURCES

include("inc.admin-user.connect.php");
$query = ("SELECT source_sidebar, source_url, source_name FROM news_sources");
$result=$db->query($query);

while($row=$result->fetch_array()) {
	
ob_start(); // Start the output buffer
require_once('magpie/rss_fetch.inc');
define('MAGPIE_CACHE_DIR', '/tmp/cbbnews4DEV2');

// keyword for database
$item_keyword = $row['source_sidebar'];
$source_name = $row['source_name'];


// keyword for cache
$cache_keyword = str_replace(" ", "-", $item_keyword);


$magurl = $row['source_url'];

$magrss = fetch_rss($magurl);
$magi = 0;



if (isset($magrss->items)) {
	foreach($magrss->items as $magitem) {

		// get source

    	// $address= $magitem['link']; 
      // $parsed_url = parse_url($address); 
		// $true_link = $parsed_url['scheme'] . "://" . $parsed_url['host'];

		// get time

		$date_1 = strtotime($magitem['pubdate']);

		// store in database

		include ("inc.admin-user2.connect.php");
		$item_title = $db2->real_escape_string($magitem['title']);
		$item_link = $db2->real_escape_string($magitem['link']);
		$item_date = $date_1;
		$item_description = $db2->real_escape_string($magitem['description']);

		// check if it's already there
		$query2 = ("SELECT * FROM news_feeds WHERE item_title = '$item_title'");
		$result2 = $db2->query($query2);
		$item_number = $result2->num_rows;

		// if not, store it
		if($item_number < 1) {

			$query2 = ("INSERT INTO news_feeds (item_title, item_link, item_date, item_description, item_source, item_keyword) VALUES ('$item_title', '$item_link', '$item_date', '$item_description', '$source_name', '$item_keyword')");
			$result2=$db2->query($query2);
			
			$query2 = ("UPDATE news_sources SET source_used=source_used+1 WHERE source_sidebar = '$item_keyword'");
			$result2=$db2->query($query2);
			
			}

		$magi++;
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

}


// CODE FOR SPECIFIC FEED SOURCES

include("inc.admin-user.connect.php");
$query = ("SELECT source_sidebar, source_url, source_name FROM news_sources");
$result=$db->query($query);

while($row=$result->fetch_array()) {
	
ob_start(); // Start the output buffer
require_once('magpie/rss_fetch.inc');
define('MAGPIE_CACHE_DIR', '/tmp/cbbnews4DEV2');

// keyword for database
$item_keyword = $row['source_sidebar'];


// keyword for cache
$cache_keyword = str_replace(" ", "-", $item_keyword);


$magurl = $row['source_url'];

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
		if($magitem['description'] == "") {
		
		$item_description = $db2->real_escape_string($magitem['atom_content']);
		
		}
		
		else {
			
		$item_description = $db2->real_escape_string($magitem['description']);

		}

		// check if it's already there
		$query2 = ("SELECT * FROM news_items WHERE item_title = '$item_title'");
		$result2 = $db2->query($query2);
		$item_number = $result2->num_rows;

echo $item_number;

		// if not, store it
		if($item_number < 1) {

			$query2 = ("INSERT INTO news_items (item_title, item_link, item_date, item_description, item_source) VALUES ('$item_title', '$item_link', '$item_date', '$item_description', '$item_keyword')");
			$result2=$db2->query($query2);
			
			$query2 = ("UPDATE news_sources SET source_used=source_used+1 WHERE source_title = '$item_keyword'");
			$result2=$db2->query($query2);
			
			}

		$magi++;
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

}



?>