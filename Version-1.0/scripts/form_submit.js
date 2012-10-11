
$(function() {
	$('.error').hide();
	$("#form-submit").live('click', function() {
		// validate and process form here
		
		$('.error').hide();
			var name = $("input#submitname").val();
				if (name == "") {
					$("span#name_error").show();
					$("input#submitname").focus();
					return false;
				}
			var email = $("input#email").val();
				if (email == "") {
					$("span#email_error").show();
					$("input#email").focus();
					return false;
				}
			var message = $("#message").val();
				if (message == "") {
					$("span#message_error").show();
					$("#message").focus();
					return false;
				}

		$.ajax({
			type: "POST",
			url: "send_email.php",
			data: "name=" + name +"& email=" + email +"& message=" + message,
			success: function() {
					$('#formwrapper').html("<div id='thankyou'></div>");
					$('#thankyou').html("<h2>Email Sent!</h2>")
					.append("<p>Thank you! I'll get back to you within a day or two.</p>")
					.hide()
					.fadeIn(1500, function() {

					
					});
			}
		});
		return false;
			
			
			
	});
});
