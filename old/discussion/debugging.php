<?php
require ('connect.php');

$query="SELECT cat_id, cat_name FROM categories";
$result=$db->query($query);


while($row = $result->fetch_array()) {

echo "<div class=category id=category" . $row['cat_id'] . "<div><h2>" . $row['cat_name'] . "</h2>";


$query2="SELECT topic_title, topic_id, topic_descr, topic_cat FROM topics WHERE topic_cat="$row['cat_id']"";
$result2=$db->query($query2);

while($row2 = $result2->fetch_array()) {

echo "div class=topic id=topic" . $row2['topic_id'] . "<div>" . $row2['topic_id'] . "</div>";

}

echo "</div>";






}

?>