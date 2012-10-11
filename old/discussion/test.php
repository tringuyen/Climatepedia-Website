<?php




$userip = $_SERVER['REMOTE_ADDR'];


?>
<head>
<script type="text/javascript" src="http://www.climatepedia.org/scripts/jquery-1.4.4.min.js"></script>

</head>



<form>
<input type="text" name="reply" id="reply">
<input type="text" name="rating" id="rating">
<?php echo "<input type=hidden value='$userip' name=ip id=ip>"; ?>
<a href="#like" class="like"><img src="css/images/up.png" alt="" ></a>

</form>

<script type="text/javascript" >


$('.like').click(function() {
	
	$.post("addvote.php", {reply: $("#reply").val(), rating: $("#rating").val(), ip: $("#ip").val()});

	$(this).text('liked!');



return false;

});


</script>