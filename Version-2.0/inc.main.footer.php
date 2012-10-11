




















<div id="footer">
<div id="footer_internal">
<?php if($location == "podium") {include("inc.main.podium-disclaimer.php");} ?>
<p id="footer_copy">Copyright &copy; 2011 Climatepedia.org <img height="90px" src="/css/images/green-initiative.png"></p>
<p id="footer_links"><a href="/organization/about-climatepedia">About</a> | <a href="" >Contact</a> | <a href="" >Privacy Policy</a></p>
</div>

</div>
<script type="text/javascript" >

// site-wide scripts

$("#focus_feedback").click(function(){
	
	if ($("#feedback_form").length > 0) {
	
	if($('#feedback_form').is(':visible')){
		$(this).removeClass("feedback_button_active");
		$('#feedback_form').hide();
	}
	
	else {		
		$(this).addClass("feedback_button_active");
		$("#feedback_form").show();
	}
		
	}
	
	else {
		
	$("#focus_sort").after("<div id=feedback_form><form id=contact_form type=POST><label for=name>Name: <span class=error id=name_error >This field is required.</span></label><input name=submitname id=submitname class=fieldclass type=text><label for=email>Your email address: <span class=errorid=email_error >This field is required.</span></label><input name=email id=email class=fieldclass type=text><label for=message>Message: <span class=error id=message_error >This field is required.</span></label><textarea rows=1 name=message id=message class=fieldclass></textarea><input type=submit id=form-submit value=send class=fieldclass></form></div>");

	}

	


	return false;
	

});

	
$('html').click(function() {
	$("#focus_feedback").removeClass("feedback_button_active");
	$('#feedback_form').hide();
});

$('#focus_feedback').click(function(event){
	event.stopPropagation();
});
	
$('#contact_form').click(function(event){
	event.stopPropagation();
});





</script>
</html>