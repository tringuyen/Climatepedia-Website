
$(function() {
	$('.error').hide();
	$("#reply-submit").click(function() {
		// validate and process form here
		
		$('.error').hide();
				if (CKEDITOR.instances.replycontent.getData() == '') {
					$("label#replycontent_error").show();
					$("#replycontent").focus();
					return false;
				}


					alert(CKEDITOR.instances.replycontent.getData());


		return false;
			
			
			
	});
});
