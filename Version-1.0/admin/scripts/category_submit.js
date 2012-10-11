
$(function() {
	$('.error').hide();
	$("#cat-submit").click(function() {
		// validate and process form here
		
		$('.error').hide();
			var name = $("input#name").val();
				if (name == "") {
					$("label#name_error").show();
					$("input#name").focus();
					return false;
				}
				
		
		//alert (dataString);return false;
		$.ajax({
			type: "POST",
			url: "create_cat.php",
			data: "name=" + name,
			success: function() {
					$('#category_form').html("<div id='message'></div>");
					$('#message').html("<h2>Admin Form Submitted!</h2>")
					.append("<p>Category Successfully Created.</p>")
					.hide()
					.fadeIn(1500, function() {
						$('#message').append("<img id='checkmark' src='css/images/check.png' />");
					});
			}
		});
		return false;
			
			
			
	});
});
