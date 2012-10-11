<script>
	$().ready(function() {
		var $scrollingDiv = $("#stickynav");
 
		$(window).scroll(function(){			
			$scrollingDiv
				.stop()
				.animate({"marginTop": ($(window).scrollTop() + 30) + "px"}, "slow" );			
		});
	});
</script>
