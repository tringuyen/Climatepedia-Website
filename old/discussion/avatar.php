<div id="reply_wrapper"></div>
<div id="reply_content_wrapper">
<a name="avatar_anchor" id="avatar_anchor"></a>
<div id="closeout">X</div>
<div id="directions">
<h3>Sign in or Select an Avatar and Join the Discussion!</h3>
<p></p>
</div>
<div id="returning_signin"></div>
<div id="new_signin"></div>
<div id="selectavatar">





</div>
</div>

<script type="text/javascript" >

$('.replyreply').live('click', function(){
	
	$('#reply_wrapper').fadeIn(600);
	$('#reply_content_wrapper').fadeIn(600);	
	
	window.reply_id = $(this).attr("id");
//	alert(reply_id);
	window.reply_child = 1;
//	alert(reply_child);
	
$('#reply' + reply_id).append($('#replying_anchor'));
	

	
});

$('.openingpostreply').live('click', function(){
	
	$('#reply_wrapper').fadeIn(600);
	$('#reply_content_wrapper').fadeIn(600);	
	
	window.reply_child = 0;
//	alert(reply_child);
	
$('.topicpost').before($('#replying_anchor'));
	

});






/* Closes reply form, resetting to defaults */

$('#closeout').live('click', function() {
	
	$('#reply_wrapper').hide();
	$('#reply_content_wrapper').hide();

});


/* Click to see more avatars from a category */

$('.more_button').live('click', function() {
	
	$(this).parent().parent().animate({'height' : '800px'});
	
return false;
	
});




/* They chose an avatar, now they get to reply */

$('.avatar').click(function() {
	
		window.reply_avatar = $(this).find("img").attr("id");
//		alert(reply_avatar);
		window.reply_name = $(this).find("img").attr("alt");
//		alert(reply_name);
	$('#reply_wrapper').fadeOut('fast');
	$('#reply_content_wrapper').fadeOut('fast');
	$('#replying_wrapper').remove();
	
	if(reply_child == 1){
	
	$('#reply' + reply_id).append('<div id=replying_wrapper><div id=replying_header><p>Please type your reply then press submit. <a href=""> Need help?</a></p></div><div id=replying_avatar><img src=avatars/' + reply_avatar + '.jpg></div><p class=replying_name>' + reply_name + '</p><div id=replying_middle><textarea id=replying_content></textarea></div><p id=replying_submit>Submit</p></div>');
		
		
		
		}
		
		
	else {
		
	$('.topicpost').after('<div id=topreplying_wrapper><div id=topreplying_header><p>Please type your reply then press submit. <a href=""> Need help?</a></p></div><div id=topreplying_avatar><img src=avatars/' + reply_avatar + '.jpg></div><p class=topreplying_name>' + reply_name + '</p><div id=topreplying_middle><form><textarea id=topreplying_content></textarea></form></div><p id=topreplying_submit>Submit</p></div>');
		
	}

});

/* Submitting a reply!! */

$('#replying_submit').live('click', function(){

		var replycontent = $('#replying_content').val();


		$.ajax({
			type: "POST",
			url: "create_reply.php",
			data: "replycontent=" + replycontent + "&replyavatar=" + reply_avatar + "&replythread=" + reply_thread + "&replychild=" + reply_child + "&replyto=" + reply_id,
			success: function() {



		$('#replying_content').remove();
		$('#replying_submit').remove();
		$('#replying_header').html('<p class=replying_thankyou>Thank you for your reply!</p><p class=replydate><?php echo $today; ?>');
		$('#replying_header').css({'color' : '#2259a8'});
		$('#replying_wrapper').css({'background' : '#f3f3f3'});
		$('.replying_name').css({'color' : '#2259a8'});
		$('#replying_middle').html('<p>' + replycontent + '</p>');

		}
		});

});


$('#topreplying_submit').live('click', function(){



		var replycontent = $('#topreplying_content').val();
		

		


		
		$.ajax({
			type: "POST",
			url: "create_reply.php",
			data: "replycontent=" + replycontent + "&replyavatar=" + reply_avatar + "&replythread=" + reply_thread + "&replyto=none",
			success: function() {

		$('#topreplying_content').remove();
		$('#topreplying_submit').remove();
		$('#topreplying_header').html('<p class=replying_thankyou>Thank you for your reply!</p><p class=replydate><?php echo $today; ?>');
		$('#topreplying_header').css({'color' : '#2259a8'});
		$('#topreplying_wrapper').css({'background' : '#f3f3f3'});
		$('.topreplying_name').css({'color' : '#2259a8'});
		$('#topreplying_middle').html('<p>' + unescape(replycontent) + '</p>');

		}
		});





});



</script>