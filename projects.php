<html>

<head>
<title> Climatepedia - Projects </title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/main.css" />
<link rel="stylesheet" type="text/css" href="css/projects.css" />

<?php
	$dbhost = "localhost";
	$dbuser = "climatepedia";
	$dbpwd = "2aJq5NNstWD7c7hN";
	$con = mysql_connect($dbhost, $dbuser, $dbpwd);
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	  
	mysql_select_db("climatepedia_database", $con);
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
				<li> <a href="glossary.html">GLOSSARY</a></li>
				<li> <a href="contact.html">CONTACT</a></li>
			</ul>
		</div>

		<!-- Content
		==================================================-->
		<h3> Articles </h3>
		<HR/>

		<?php
			$result = mysql_query("SELECT * FROM Featured_Articles ORDER BY Date ASC");

			while ($row = mysql_fetch_array($result))
			{
				echo '<p><a href="' . $row['article_link'] . '">' . $row['title'] . '</a></p>'; 
			}

		?>
</div>

</body>

</html>