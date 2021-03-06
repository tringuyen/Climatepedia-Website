<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title> Climatepedia </title>

<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/main.css" />
<link rel="stylesheet" type="text/css" href="css/index.css" />

<script src="js/jquery-1.8.2.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="js/jsOAuth-1.3.6.js"></script>
<script src="js/climatepedia_twitter_feed_reader.js"></script>
<script>
      !function ($) {
        $(function(){
          // carousel demo
          $('#myCarousel').carousel()
        })
      }(window.jQuery)
</script>

<?php
	include ("inc.db.connection.php");
?>

</head>

<body>

<div id="main-container">
	<div id="main-content">
		<!-- Main Logo 
		==================================================-->
		<div id="main-logo">
			<a href="index.php"><img src="images/global/main_logo.jpg"></a>
		</div>

		<!-- Navigation Bar 
		==================================================-->
		<div id="nav-bar">
			<ul id="nav-list" class="nav-links">
				<li> <a href="about.html">ABOUT</a></li>
				<li> <a href="projects.php">PROJECTS</a></li>
				<li> <a href="signatories.php">SIGNATORIES</a></li>
				<li> <a href="glossary.php">GLOSSARY</a></li>
				<li> <a href="contact.html">CONTACT</a></li>
			</ul>
		</div>

		<!-- Hero Item 
		=================================================-->
		<div id="hero-item">
			<!-- Carousel -->
			<div id="myCarousel" class="carousel slide">
				<!-- Carousel items -->
				<div class="carousel-inner">
				<?php
					$result = mysql_query("SELECT * FROM hero_items ORDER BY Date DESC, id DESC LIMIT 5");

					for ($i=0; $i<5; $i++)
					{
						$row = mysql_fetch_array($result);
						if ($row)
						{
							if ($i == 0)
							{
								// Active item
								echo '<div class="active item">' . "\n";
							}
							else
							{
								// Normal item
								echo '<div class="item">' . "\n";
							}
							if(isset($row['link']))
								echo '<a href="'.$row['link'].'">';
							echo '<img class="carousel-item" src="data/hero_items/image-' . $row['image_path'] . '">' . "\n";
							if(isset($row['link']))
								echo '</a>';
							echo '<div class="carousel-caption">' . "\n";
							echo '<h4>';
							echo $row['Thumbnail_Title'];
							echo '</h4>' . "\n";
							//echo '<p>' . $row['Thumbnail_Text'] . '</p>' . "\n";
							echo '</div>' . "\n";

							echo '</div>' . "\n";
						}
						else
						{
							break;
						}
					}

				echo "</div>\n";

				// Carousel Navigation
				if ($i > 1)
				{
					echo '
					<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
					<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>';
				}
				?>
				
			</div> 
		</div>

		<!-- Main Information 
		==================================================-->
		<div id="main-info-cont">
			<!-- Featured Projects -->
			<div id="feat-proj-cont">
				<a href="projects.php"><span class="main-page-header main-fp">
					FEATURED PROJECTS
				</span></a>

				<div class="main-grey-divider"></div>

				
				<?php
				$result = mysql_query('SELECT * FROM featured_articles ORDER BY Date DESC LIMIT 2');

				while($row = mysql_fetch_array($result))
				{
					// Featured Project #1
					echo '<div class="fp-item-cont">';

						echo '<div class="fp-item-image"><img class="article_banner" src="data/featured_articles/image_banner-' . $row['image_banner_path']  . '"></div>';
	                    echo '<div class="fp-item-header">';
	                        echo $row['title'];
	                    echo '</div>';
	                    echo '<div class="fp-item-text">';
	                    	echo $row['description'] . '<a href="' . $row['article_link'] . '">READ MORE</a>';
	                    echo '</div>';
					echo '</div>';
				}
				
				?>
			</div>
			<!-- End Featured Projects -->
			
			<!-- Latest Updates 
			==================================================-->
			<div id="updates-cont">
				<a href="http://twitter.com/Climatepedia" target="_blank">
				<span class="main-page-header main-updates">
					LATEST UPDATES
				</span>
				</a>
				
				<div class="main-grey-divider"></div>

				<!-- Latest Updates Content (Tweets) -->
				<div id="tweets">
					<?php
						require 'php/tmhOAuth.php';
						$tmhOAuth = new tmhOAuth(array(
						  'consumer_key'    => '8gH7EfcOztORxNzrNrd6rA',
						  'consumer_secret' => 'lXxFsUzwiOFADcolvEIaRXojdQ3WwD4Lj3CjkPEedk',
						  'user_token'      => '916388383-2FAVgtYo7pzXeJuvKPmeshG10zhSaWXcb3aHtYi9',
						  'user_secret'     => 'LqyBs0c1xTqaMO9p7wU4j3DqN3qX3ebbuYWhT4fOXU',
						  'curl_ssl_verifypeer' => false
						));

						// Get since_id from database
						$since_id = '1';
						$result = mysql_query('SELECT ID FROM tweets ORDER BY ID DESC LIMIT 1');
						if ($row = mysql_fetch_array($result))
						{
							$since_id = $row['ID'];
						}
						// Make a request to Twitter for latest tweets
						$code = $tmhOAuth->request('GET', $tmhOAuth->url('1.1/statuses/user_timeline'), 
							array('screen_name' => 'Climatepedia', 'count' => '30', 'since_id' => $since_id));

						if ($code == 200) {
						  $results = json_decode(utf8_decode($tmhOAuth->response['response']), true);
						  // Add any new tweets from Twitter feed
						  for($i = 0; $i < sizeof($results); ++$i)
						  {
						  	$res = $results[$i];
						  	$id_str = mysql_real_escape_string($res['id_str']);
						  	$text = str_replace("'", "&apos;", $res['text']);
						  	$url =  'http://twitter.com/' . $res['user']['id_str'] . '/status/' . $id_str;
						  	$image_url =  mysql_real_escape_string($res['user']['profile_image_url']);
						  	$result = mysql_query("INSERT INTO tweets (ID, Text, URL, Image_Url)
						  							VALUES ('$id_str', '$text', '$url', '$image_url')");
						  }
						} 

						// Display all the 5 latest tweets
						$result = mysql_query('SELECT * FROM tweets ORDER BY ID DESC LIMIT 8');
						while ($row = mysql_fetch_array($result))
						{
							echo '<div style="overflow: hidden">';
							
							echo '<div class="updates-icon">';
							echo '<a href="http://twitter.com/Climatepedia"><img class="round-corners" src="' . 
										$row['Image_Url'] . '" height="30" width="30"></a>';
							echo '</div>';
							echo '<div class="updates-content">';
							echo '<a href="' . $row['URL'] . '">' . $row['Text'] . '</a>';
							echo '</div>';

							echo '</div>';
							echo '<div class="updates-grey-divider"></div>';
						}			

					?>
				</div>
			</div>
			<!-- End Latest Updates -->
		</div>
		<!-- End Main Information -->

		<!-- Grey Divider -->
		<div class="main-grey-divider mid-page-divider"></div>

		<!-- Misc Items 
		==================================================-->
		<div id="misc-info-cont">
			<!-- Misc Item #1 -->
			<div class="misc-item-cont-left">
				<a href="photos.php">
				<img class="misc-item-image" src="images/misc_items/photos.jpg">
				</a>
				<div class="misc-item-header main-fp">
					PHOTO PROJECT
				</div>
				<div class="misc-item-text">
					Pictures of people with their climate change thoughts, questions, or opinions.
				</div>
			</div>

			<!-- Misc Item #2 -->
			<div class="misc-item-cont-center">
				<a href="tips.php">
				<img class="misc-item-image" src="images/misc_items/tips.jpg">
				</a>
				<div class="misc-item-header main-fp">
					TIPS
				</div>
				<div class="misc-item-text">
					A list of conservation strategies ranging from energy to water.
				</div>
			</div>
			
			<!-- Misc Item #3 -->
			<div class="misc-item-cont-right">
				<a href="events.php">
				<img class="misc-item-image" src="images/misc_items/events.jpg">
				</a>
				<div class="misc-item-header main-fp">
					Events at UCLA!
				</div>
				<div class="misc-item-text">
					Check out upcoming Climatepedia events!
				</div>
			</div>
		</div>
		<!-- End Misc Items -->


	</div>
</div>
</body>

</html>
