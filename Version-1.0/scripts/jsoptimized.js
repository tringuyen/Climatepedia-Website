jQuery(document).ready(function(){

	jQuery("ul.subnav").parent().append("<span></span>"); //Only shows drop down trigger when js is enabled (Adds empty span tag after ul.subnav*)

	jQuery("ul.topnav li").mouseover(function() { //When trigger is clicked...

		//Following events are applied to the subnav itself (moving subnav up and down)
		jQuery(this).find("ul.subnav").slideDown('fast').show(); //Drop down the subnav on click

		jQuery(this).hover(function() {
		}, function(){
			jQuery(this).find("ul.subnav").slideUp('fast'); //When the mouse hovers out of the subnav, move it back up
		});

		//Following events are applied to the trigger (Hover events for the trigger)
		}).hover(function() {
			jQuery(this).addClass("subhover"); //On hover over, add class "subhover"
		}, function(){	//On Hover Out
			jQuery(this).removeClass("subhover"); //On hover out, remove class "subhover"
	});

});