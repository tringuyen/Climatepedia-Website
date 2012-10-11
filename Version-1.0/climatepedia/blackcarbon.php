<?php 

//  Set SEO variables



$seo_title = "Black Carbon | Climatepedia";
$seo_keywords = "";
$seo_description = "";
$css_sheet = "";
$js1 = "";
$js2 = "";
$js3 = "";


// load top template

require_once('inc.pediaheader.php') 

?>
<div id="content">

<div id="pagenav" class="pagenavclass">
<h4>Navigation</h4>
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
<li><a href="#employment" >Employment</a>
	<ol class="internal">
	<li><a href="#biggest" >Biggest Employers</a></li>
	<li><a href="#why" >Why Become One?</a></li>
	<li><a href="#outlook" >Employment Outlook</a></li>
	<li><a href="#salary" >Salary Information</a></li>
	<li><a href="#sectors" >Sectors</a></li>
	</ol>
</li>
<li><a href="#job" >The Job</a>
	<ol class="internal">
	<li><a href="#location" >Location</a></li>
	<li><a href="#life" >A Day in the Life</a></li>
	</ol>
</li>
<li><a href="#references" >References</a></li>
</ol>
</div>



<div id="articlecontent">

<h1>Black Carbon</h1>




<p>Black carbon, also known as black soot, is made from particulate matter (tiny particles) released during biomass and fossil fuel burning, among other things. It can alter global climate patterns by absorbing heat, melting ice and raising atmospheric temperatures in the arctic. Sources include diesel trucks, power plants, fireplaces, and industrial complexes from all over the world. </p>

<p>When ice is covered by black carbon, the ice reflects less sunlight due to a lower albedo. As a result, warming and subsequent melting of the ice ensues. With less ice cover, the arctic reflects less sunlight, resulting in more heating. </p>



<div id="image">

<img src="css/images/pedia/carbon.jpg" alt="" > <p> Courtesy of NASA </p>

</div>


<p class="source">
Sources: <br>

<a href="http://www.giss.nasa.gov/research/news/20050323/">www.giss.nasa.gov/research/news/20050323</a> <br>

 </p>

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


</body>




</html>

