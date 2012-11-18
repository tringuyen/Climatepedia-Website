<html>

<head>
<base href="http://climatepedia.org/Climatepedia-Website/" />
<?php
	include ("inc.db.connection.php");
	$term_id = $_GET["term_id"];
?>

<title> Climatepedia - Glossary </title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/main.css" />


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
		<div id="content">
			<?php
				$result = mysql_query("SELECT * FROM glossary WHERE ID = $term_id");
				$row = mysql_fetch_array($result);
				echo '<h3>' . $row['Item_Name'] . '</h3>';
				echo '<HR/>';
				echo $row['Item_Text'];
				
			?>
		</div>
</div>

</body>

</html>