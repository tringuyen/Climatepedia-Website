<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
	<title><?php print $seo_title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="<?php print $seo_keywords; ?>" />
	<meta name="description" content="<?php print $seo_description; ?>" />
	<link rel="stylesheet" type="text/css" href="css/climatepedia.css" />
	<link rel="stylesheet" type="text/css" href="http://www.climatepedia.org/css/global.css" />
	<?php if(!empty($css_sheet)) {
		echo "<link rel='stylesheet' type='text/css' src='$css_sheet' />";
		
	}
	?>
<script type="text/javascript" src="http://www.climatepedia.org/scripts/jquery-1.4.4.min.js"></script><script type="text/javascript" src="http://www.climatepedia.org/scripts/dropdown.js"></script>
<script type="text/javascript" src="http://www.climatepedia.org/scripts/ajax.js"></script>
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


<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-21357845-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
<img id="background" src="http://www.climatepedia.org/discussion/css/images/earthlight.jpg" alt="" >
<div id="wrapper">



<?php require_once ('http://www.climatepedia.org/inc.nav.php') ?>
<div id="separator"></div>
<?php require_once ('http://www.climatepedia.org/climatepedia/inc.pedianav.php') ?>


<div id="pagecontent">
