<html>

<head>
<title> Climatepedia - Signatories </title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/main.css" />
<link rel="stylesheet" type="text/css" href="css/signatories.css" />

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

		<!-- Content
		==================================================-->
		<div id="content">
			<h3> List of Signatories </h3>
			<HR/>
			
			<table border="0" style="width: 100%">
			<?php
				$result = mysql_query("SELECT * FROM Signatories ORDER BY First_Name ASC");
				$column = 0;

				while ($row = mysql_fetch_array($result))
				{
					if ($column == 0)
					{
						echo '<tr>';
					}
					echo '<td><p><a href="profiles/' . $row['ID'] . '/">' . $row['First_Name'] . ' ' . $row['Last_Name'] . '</a></p></td>'; 
					if ($column == 2)
					{
						echo '</tr>';
						$column = 0;
					}
					else
					{
						$column++;
					}
				}

			?>
			</table>
		</div>
</div>

</body>

</html>