<?php


session_start();

if(isset($_SESSION['admin'])) {
	
// load all functions

include ("inc.admin.functions.php");

// Set section and variables

$section = $_GET["console"];

// Include directions for each section

include("inc.admin.directions.php");

// variables for each section

if($section == "group") {
	
$admin_title = "Group Administration | Climatepedia";
$admin_section = "Group";
$css1 = "admin.group.css";
}

elseif($section == "knowledge") {

$admin_title = "Knowledge Administration | Climatepedia";
$admin_section = "Knowledgepedia";
$css1 = "admin.knowledge.css";
}

elseif($section == "news") {

$admin_title = "News Administration | Climatepedia";
$admin_section = "News";
$css1 = "admin.news.css";
}

elseif($section == "blogs") {

$admin_title = "Blogs Administration | Climatepedia";
$admin_section = "Blogs";
$css1 = "admin.blogs.css";
}

elseif($section == "podium") {

$admin_title = "Podium Administration | Climatepedia";
$admin_section = "Podium";
$css1 = "admin.podium.css";
}

elseif($section == "media") {

$admin_title = "Media Administration | Climatepedia";
$admin_section = "Media";
$css1 = "admin.media.css";
}


// include templates & section

include("inc.admin.header.php");
include("inc.admin." . $section . ".php");
include("inc.admin.footer.php");

}

else {
	
	echo ("You forgot to log in. Sorry, I won't tell you where to log in for security reasons.");
	
}

?>

