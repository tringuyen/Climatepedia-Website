<?php

if($_GET['345334a9fs88324d'] == "345435l9sf99453793459" && $_GET['82353995'] == "4645649445237445") {

echo "Welcome!";

?>

<form method="POST" action="inc.admin.authenticate.php">
<input type="text" name="submit_username">
<input type="password" name="submit_password">
<input type="submit">
</form>

<?php


}

elseif($_GET['error'] == "true") {
	
	echo "There was an error logging you in, please try again";

}

else {

echo "Bastard!";

}	

?>