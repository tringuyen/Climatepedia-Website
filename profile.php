<html>

<head>
<base href="//localhost" />
<?php
	include ("inc.db.connection.php");
	$profile_id = $_GET["profile_id"];
?>

<title> Climatepedia - Signatories </title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/main.css" />
<link rel="stylesheet" type="text/css" href="css/profile.css" />


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

		<!-- Content
		==================================================-->
		<div id="content">
			<?php
				$result = mysql_query("SELECT * FROM Signatories WHERE ID = $profile_id");
				$row = mysql_fetch_array($result);
				echo '<h3>' . $row['First_Name'] . ' ' . $row['Last_Name'] . '</h3>';
				echo '<HR/>';
				echo '<div class="profile-content">';
					echo '<img class="profile-img" src="' . $row['Image_Link'] . '">';

					echo '<div class="profile-info">';
					echo '<b>Institution</b>: ' . $row['Institution'] . '<br/><br/>';
					echo '<b>Title</b>: ' . $row['Position'] . '<br/><br/>';
					echo '<b>Degree</b> ' . $row['Degree'] . '<br/><br/>';
					echo '<b>Expertise</b>: ' . $row['Area'] . '<br/><br/>';
					echo '<b>Webpage</b>: <a href="' . $row['Webpage'] . '">' . $row['Webpage'] . '</a><br/><br/>';
					echo '</div>';
				echo '</div>';
				echo '<br/>';
				if ( !empty($row['Statement']) )
				{
					echo '<b>Summary</b>: ' . $row['Statement'] . '<br/>';
				}
			?>
		</div>
</div>

</body>

</html>