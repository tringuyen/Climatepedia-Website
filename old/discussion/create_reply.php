<?php 

$content = $_POST['replycontent'];
$avatar = $_POST['replyavatar'];
$thread = $_POST['replythread'];
$reply_to = $_POST['replyto'];
$author = "1";

// Check whether it is a reply to the main topic or to an person's reply


if(isset($_POST['replychild'])) {

include('connect.php');

$query = "INSERT INTO replies (reply_content, reply_date, reply_avatar, reply_by, reply_thread, reply_children, reply_parent)
VALUES ('$content', NOW(), '$avatar', '$author', '$thread', '0', '$reply_to')";

$result=$db->query($query);

$query = "UPDATE replies SET reply_children= '1' WHERE reply_id = '$reply_to'";
$result=$db->query($query);




}

else {

include('connect.php');

$query = "INSERT INTO replies (reply_content, reply_date, reply_avatar, reply_by, reply_thread)
VALUES ('$content', NOW(), '$avatar', '$author', '$thread')";

$result=$db->query($query);

}


?>
