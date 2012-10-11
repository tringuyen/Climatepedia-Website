<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
	<title><?php print $seo_title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="keywords" content="<?php print $seo_keywords; ?>" />
	<meta name="description" content="<?php print $seo_description; ?>" />
	<link rel="stylesheet" type="text/css" href="css/global.css" />
	<link rel="stylesheet" type="text/css" href="css/<?php print $css_sheet ?>.css" />
	<script type="text/javascript" src="http://www.climatepedia.org/scripts/jquery-1.4.4.min.js"></script>
	<script type="text/javascript" src="http://www.climatepedia.org/scripts/dropdown.js"></script>
	<script type="text/javascript" src="http://www.climatepedia.org/ckeditor/ckeditor.js"></script>
	<?php if(!empty($js1)) {
		echo "<script type='text/javascript' src='$js1'></script>";
		
	}
	?>
	<?php if(!empty($js2)) {
		echo "<script type='text/javascript' src='$js2'></script>";
		
	}
	?>
	<?php if(!empty($js3)) {
		echo "<script type='text/javascript' src='$js3'></script>";
		
	}
	?>


</head>




<body>
<div id="wrapper">
<div id="navbar">
<div id="logo">
<a href="http://www.climatepedia.org/" ><img src="http://www.climatepedia.org/css/images/logo4layers.gif" alt="Climate Change Climatepedia" id="logopic"/></a>

</div>



<ul class="topnav">
    <li>
    	<a href="http://www.climatepedia.org/">Jump to</a>
    	<ul class="subnav">
    	      <li><a href="http://www.climatepedia.org/">Home</a></li>
            <li><a href="#">Discussion</a></li>
            <li><a href="http://www.climatepedia.org/climatepedia/">Climatepedia</a></li>
            <li><a href="http://www.climatepedia.org/blog/">Blog</a></li>
            <li><a href="http://www.climatepedia.org/media/">Media</a></li>
     
        </ul>
    </li>
    <li>
        <a href="http://www.climatepedia.org/about/">About</a>
    </li>
    <li>
        <a href="http://www.climatepedia.org/professors/">Professors</a>
        <ul class="subnav">
            <li><a href="#">How to Get Involved</a></li>
            <li><a href="http://www.climatepedia.org/professors/">Our Network of Professors</a></li>
        </ul>
    </li>
    <li><a href="#">How to help</a></li>
    <li><a href="http://www.climatepedia.org/connect/">Connect</a>
    <ul class="subnav">
            <li><a href="http://www.climatepedia.org/connect/">Contact Us</a></li>
            <li><a href="#">Facebook</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">RSS Feed</a></li>
        </ul>
    
    </li>

</ul>






<div id="locationbar">
<p><?php print date("F j, Y, g:i a", time()-7200);?> PST | <a href="" >Check out the discussion.</a></p>

</div>
<div id="searchbar">
<div id="searchbtn"></div><div id="searchbox"></div>
</div>

</div>







