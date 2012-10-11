
$(function() {
	$('.error').hide();
	$("#topic-submit").click(function() {
		// validate and process form here
		
		$('.error').hide();
			var title = $("input#title").val();
				if (title == "") {
					$("label#title_error").show();
					$("input#title").focus();
					return false;
				}
			var author = $("input#author").val();
			var category = $("select#topic_category").val();

		$.ajax({
			type: "POST",
			url: "create_topic.php",
			data: "title=" + title +"& author=" + author +"& category=" + category,
			success: function() {
					$('#topic_form').html("<div id='message'></div>");
					$('#message').html("<h2>Admin Form Submitted!</h2>")
					.append("<p>Topic Successfully Created.</p>")
					.hide()
					.fadeIn(1500, function() {
						$('#message').append("<img id='checkmark' src='css/images/check.png' />");
					alert(category);
					
					});
			}
		});
		return false;
			
			
			
	});
});
