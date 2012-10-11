<?php


// convert format
if(isset($_GET['keyword'])) {
	$pagekeyword = $_GET['keyword'];
	$pagekeyword = str_replace("-", " ", $pagekeyword);

}

else {
	
	$pagekeyword = "highlights";
	$_GET['keyword'] = "highlights";
}



include ("inc.main.news.php");





















?>