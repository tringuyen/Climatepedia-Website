<?php 

//  Set SEO variables



$seo_title = "Information Database | Climatepedia";
$seo_keywords = "global warming, climate change, renewable energy, geothermal energy";
$seo_description = "A database of information on a huge variety of topics related to climate change, from renewable energy to geoengineering and emissions trading.";
$css_sheet = "";
$js1 = "";
$js2 = "";
$js3 = "";


// load top template

require_once('inc.pediaheader.php') 

?>


<div id="content">
<h1>Introduction to Climate Change</h1>
<a name="overview"></a>
<div id="pagenav" class="pagenavclass">
<h4>Article Contents</h4>
<ol>
<li><a href="#overview" >Overview</a></li>
<li><a href="#profession" >Climatology as a Profession</a>
	<ol class="internal"><li><a href="#interviews" >Climatologist Interviews</a></li></ol></li>
<li><a href="#education" >Education</a>
	<ol class="internal">
	<li><a href="#highschool" >High School</a></li>
	<li><a href="#bachelors" >Undergraduate Study</a></li>
	<li><a href="#masters" >Graduate Study</a></li>
	<li><a href="#phd" >Doctoral Study</a></li>
	<li><a href="#universities" >Universities</a></li>
	</ol>
</li>
<li><a href="#preparation" >Employment Preparation</a>
	<ol class="internal">
	<li><a href="#experience" >Getting Experience</a></li>
	<li><a href="#internships" >Internships</a></li>
	<li><a href="#qualities" >Desired Qualities</a></li>
	<li><a href="#tips" >Application Tips</a></li>
	<li><a href="#where" >Where to Start Looking</a></li>
	</ol>
</li>
<li><a href="#references" >References</a></li>
</ol>
</div>

<div id="articlecontent">


<p>Albedo describes the reflectivity of an object. Albedo is usually quantified by the amount of energy reflected divided by the amount of energy received.  For example, black shirts warm faster than white shirts because they have a lower albedo. This concept is closely related to the earths climate and energy balance in a variety of ways. </p> 

<p>Ice is one of the earths most reflective surfaces (high albedo), whereas oceans are one of the least reflective (low albedo). When more ice is on the earths surface, more energy is reflected out to space. Conversely, when more ocean and forest is on the earths surface, more energy is retained. </p>
<p>Albedo is just one of the complexities in climate modeling. Models must gauge how factors that affect the earths reflectivity will respond to fluctuations in temperature. For example, how much warming might result from less ice cover? </p>

<h5>Consider the following two cases:</h5>

<p><em>Warming scenario:</em> Consider a warm period that causes ice to melt. All else equal, this lowers the earths reflectivity resulting in more heating. The increased heating could cause more melting of ice and a warming cycle. </p>
<p><em>Cooling scenario:</em> Consider a cold period that causes water to freeze to ice. All else equal this increases the earths reflectivity resulting in more cooling. This increased cooling could cause more freezing and a cooling cycle.  </p>
<p>Other players that affect the earths albedo are aerosols, black carbon, urbanization (more concrete), and vegetation. </p>

<div id="image">

<img src="css/images/pedia/alaska.jpg" alt="" > <p> Image of Alaska, in all of its natural beauty. </p>

</div>

<p class="source">Source: <a href="http://www.weather.nps.navy.mil/~psguest/polarmet/clichange/content.html">www.weather.nps.navy.mil/~psguest/polarmet/clichange/content </a></p>

</div>
</div>
</div>

</div>

<script type="text/javascript" >
                        var theLoc = $('#pagenav').offset().top;
    	$(window).scroll(function() {
		if(theLoc >= $(document).scrollTop()) {
			if($('#pagenav').hasClass('fixed')) {
				$('#pagenav').removeClass('fixed');
			}
		} else { 
			if(!$('#pagenav').hasClass('fixed')) {
				$('#pagenav').addClass('fixed');
			}
		}
	});








</script>
<div id="preloader">

</div>
</body>




</html>

