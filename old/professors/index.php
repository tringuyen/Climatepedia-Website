<!DOCTYPE html>

<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<title>Professors | Climatepedia</title>
<link rel="stylesheet" type="text/css" href="css/professors.css" />
<link rel="stylesheet" type="text/css" href="http://www.climatepedia.org/css/global.css" />
<script type="text/javascript" src="http://www.climatepedia.org/scripts/jquery-1.4.4.min.js"></script><script type="text/javascript" src="http://www.climatepedia.org/scripts/dropdown.js"></script>
<script type="text/javascript"
    src="http://maps.google.com/maps/api/js?sensor=true">
</script>
<script type="text/javascript">
  function initialize() {
    var latlng = new google.maps.LatLng(34.073863, -118.437998);
    var myOptions = {
      zoom: 2,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.HYBRID
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  

	layer = new google.maps.FusionTablesLayer(545326);
	layer.setMap(map);

	
	

}



</script>



<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-21357845-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body onload="initialize()">

<div id="wrapper">



<?php require_once ('http://www.climatepedia.org/inc.nav.php') ?>



<div id="content">
<div id="pagetitle">
<h1>Professor Network</h1>
</div>
<div id="map_canvas"></div>
<div id="list">

<table summary="" >
<tr id="header">
<td>Name</td>
<td>University</td>
<td>Research</td>
</tr>
<tr class="TRo professor">
<td>Ramond J. Walker</td>
<td>University of California, Los Angeles</td>
<td>Space Weather</td>
</tr>
<tr class="TRe professor">
<td>Hoopla</td>
<td>University of London, England</td>
<td>Global Warming</td>
</tr>
<tr class="TRo professor">
<td>Habin B. Moore</td>
<td>University of Australia, Sydney</td>
<td>Physical Chemistry</td>
</tr>
</table>



</div>


</div>

<div id="footer"></div>

</div>


</body>




</html>

