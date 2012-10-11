<?php 

//  Set SEO variables



$seo_title = "Administration | Climatepedia";
$seo_keywords = "climatepedia administration";
$seo_description = "climatepedia administration";
$css_sheet = "login";

$js1 = "";
$js2 = "";
$js3 = "";




// load top template


require_once ('inc.header.php');



?>

<div id="pagecontent">

<?php 

$val = $_GET['error'];

if(isset($val)) {
	
	echo 'Wrong login information!';
	
}

?>

<h1>Please Log In!</h1>
<form method="post" action="auth.php">
<label for="user">Username</label>
<input type="text" name="user" id="user">
<br>
<br>
<label for="pass">Password</label>
<input type="password" name="pass" id="pass">
<input type="submit" value="submit" name="submit">
</form>







</div>





</div>
</body>
</html>