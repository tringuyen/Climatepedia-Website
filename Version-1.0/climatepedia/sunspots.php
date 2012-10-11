<?php 

//  Set SEO variables



$seo_title = "Sunspots | Climatepedia";
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

<h1>Sun Spots</h1>



<p>Sunspots are temporary cool portions on the suns surface that are associated with increased magnetic activity. This magnetic activity is known to disrupt satellites and radio communications. However, a magnetic field surrounding earth protects us from these effects. The frequency and location of sunspots occur over an eleven year cyclic period. No discernible connection has been made between sunspots and global temperatures. </p>




<div id="image">

<img src="css/images/pedia/sunearth.jpg" alt="" > <p> Courtesy of NASA </p>

</div>

<div id="image">

<img src="css/images/pedia/sunspots.jpg" alt="" > <p> Zoomed view of a sunspot, courtesy of NASA </p>

</div>

<p class="source">
Sources: <br>

<a href="http://tuftsjournal.tufts.edu/2010/03_1/professor/01/">www.tuftsjournal.tufts.edu/2010/03_1/professor/01/</a> <br>

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

