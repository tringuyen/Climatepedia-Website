<?php 

$name = $_POST['name'];

include('connect.php');

$query = "INSERT INTO categories (cat_name)
VALUES ('$name')";


$result=$db->query($query);


?>