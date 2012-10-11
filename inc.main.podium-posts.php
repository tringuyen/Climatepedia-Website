<?php

if(isset($_GET['page'])) {
// set the page
$podium_page = $_GET['page'];

} else {
	
$podium_page = 1;

}

$sql_raw = $podium_page * 20;
$sql_limit = $sql_raw - 20;


//
//
// DIRECTORY SCRIPT
//
//

if(isset($_GET['directory'])) {

	if($_GET['directory'] == "single") {	

	echo ("<p id=section_note><a style=font-weight:100 href=/podium/network>&larr; Go back to the professor list</a></p>");

	// we're viewing a single professor
	
	$professor_id = $_GET['professor'];
	
		include ("inc.main.connect.php");
		$query = ("SELECT 
		
		podium_professors.professor_title, 
		podium_professors.professor_firstname, 
		podium_professors.professor_lastname, 
		podium_professors.professor_university, 
		podium_professors.professor_department, 
		podium_professors.professor_bio, 
		podium_professors.professor_cv, 
		podium_professors.professor_picture, 
		podium_professors.professor_specialty, 
		podium_professors.professor_tag, 
		podium_universities.university_id, 
		podium_universities.university_name,
		podium_universities.university_images
		FROM podium_professors LEFT JOIN podium_universities ON podium_professors.professor_university = podium_universities.university_id 
		WHERE podium_professors.professor_id = '$professor_id'");
		
		$result=$db->query($query);
		while($row=$result->fetch_array()) {
			
			$professor_name = $row['professor_title'] . " " . $row['professor_firstname'] . " " . $row['professor_lastname'];
			$professor_university = $row['university_name'];
			$professor_department = $row['professor_department'];
			$professor_specialty = $row['professor_specialty'];
			$professor_bio = nl2br($row['professor_bio']);
			$professor_cv = $row['professor_cv'];
			$professor_specialty = $row['professor_specialty'];	
			$university_id = $row['university_id'];		
			$page_tag = $row['professor_tag'];	
			
			if($row['professor_picture'] == 1) {
			
			$query = ("SELECT image_type, image_parent, image_path, image_description, image_source FROM podium_images WHERE image_type = '1' AND image_parent = '$professor_id'");
			$result=$db->query($query);
			while($row=$result->fetch_array()) {
			
				$image_path = "/images_podium/professors/" . $row['image_path'];
				$image_description = $row['image_description'];
				$image_source = $row['image_source'];
				
			}
			}
			
			elseif($row['university_images'] == 1) {
				// use university image
				
			$query = ("SELECT image_type, image_parent, image_path, image_description, image_source FROM podium_images WHERE image_type = '2' AND image_parent = '$university_id'");
			$result=$db->query($query);
			while($row=$result->fetch_array()) {
			
				$image_path = "/images_podium/universities/" . $row['image_path'];
				$image_description = $row['image_description'];
				$image_source = $row['image_source'];

				}
			}
				
			else {
				
				$image_path = "/css/images/climatepedia-logo.png";
				
			}
			
			
			
			echo ("
			<div class=profile_entry>
			<h2 class=professor_header>" . $professor_name . "</h2>
			<img align=left class=professor_image src='" . $image_path . "' alt=" . $image_description . ">
			<h3 class=profile_header>University: <span class=profile_info>" . $professor_university . "</span></h3>
			<h3 class=profile_header>Department: <span class=profile_info>" . $professor_department . "</span></h3>

			<h3 class=profile_header>Specialty: <span class=profile_info>" . $professor_specialty . "</span></h3>

			<h3 class=profile_header>Bio Summary:</h3>
			<p class=professor_bio style=padding-top:0px;>" . $professor_bio . "</p>
			</div>");
			
			if($professor_cv !== "") {		
			
			echo ("
			<div class=profile_entry id=profile_cv>
			<h3 class=profile_header>Curriculum Vitae:</h2>"
			
			. $professor_cv . "
			
			</div>
			
			");			
			
			}	
			
			echo ("
			<div class=profile_entry>
			<h3 class=profile_header>Post History:</h3>
			");
			
			
			$query = ("SELECT post_name, post_url, post_professor, post_date FROM podium_posts WHERE post_professor = '$professor_id'");
			$result=$db->query($query);
			while($row=$result->fetch_array()) {
			
			$post_date = strtotime($row['post_date']);
			$post_date = date("D M d, Y", $post_date);
			
			echo ("<h2 class=historyheader><a href=/podium/" . $row['post_url'] . ">" . $row['post_name'] . "</a><span class=historydate> - " . $post_date . "</span></h2>");
			
			}			
			
			echo ("			
			
			</div>
			");
		
		
		}
	
	}
	
	
	
	else {
	
	// we're viewing the professor list	
	echo ("<p id=section_note><a style=font-weight:100 href=/podium>&larr; Go back to the professor's podium</a></p>");
	if(isset($_GET['sort'])) {
		// we're sorting	
		
		if($_GET['sort'] == "first-name-alphabetical") {
		
		$sortby = "podium_professors.professor_firstname";
		$sorttype = "ASC";
		
		}
		
		elseif($_GET['sort'] == "first-name-inverse") {
		
		$sortby = "podium_professors.professor_firstname";
		$sorttype = "DESC";
		
		}
		
		elseif($_GET['sort'] == "last-name-alphabetical") {
		
		$sortby = "podium_professors.professor_lastname";
		$sorttype = "ASC";
		
		}
		
		elseif($_GET['sort'] == "last-name-inverse") {
		
		$sortby = "podium_professors.professor_lastname";
		$sorttype = "DESC";
		
		}
		
		
		
		
	}
	
	else {
		
		// we're not sorting
	
	$sortby = "podium_professors.professor_firstname";
	$sorttype = "ASC";

	}


	// we're viewing a single professor
	
	$professor_id = $_GET['professor'];
	
		include ("inc.main.connect.php");
		$query = ("SELECT 
		
		podium_professors.professor_id,
		podium_professors.professor_title, 
		podium_professors.professor_firstname, 
		podium_professors.professor_lastname, 
		podium_professors.professor_university, 
		podium_professors.professor_department, 
		podium_professors.professor_bio, 
		podium_professors.professor_picture, 
		podium_professors.professor_url,
		podium_universities.university_id, 
		podium_universities.university_name,
		podium_universities.university_images
		FROM podium_professors LEFT JOIN podium_universities ON podium_professors.professor_university = podium_universities.university_id 
		ORDER BY $sortby $sorttype");
		
		$result=$db->query($query);
		while($row=$result->fetch_array()) {
			
			$professor_id = $row['professor_id'];
			$professor_name = $row['professor_title'] . " " . $row['professor_firstname'] . " " . $row['professor_lastname'];
			$professor_university = $row['university_name'];
			$professor_department = $row['professor_department'];
			$professor_bio = $row['professor_bio'];
			$university_id = $row['university_id'];
			$professor_url = $row['professor_url'];
			
			if(strlen($professor_bio) > 200) {
	
			$professor_bio = preg_replace("/\s+?(\S+)?$/", " ... <a style=text-decoration:underline;font-weight:100 href=/podium/network/" . $professor_id . "/" . $professor_url . " title='Click to view the Climatepedia profile of " . $post_professor . ".'>More ></a>", substr($professor_bio, 0, 201));

			}
			
			
			if($row['professor_picture'] == 1) {
			
			include ("inc.main.connect2.php");
			$query2 = ("SELECT image_type, image_parent, image_path, image_description, image_source FROM podium_images WHERE image_type = '1' AND image_parent = '$professor_id'");
			$result2=$db2->query($query2);
			while($row2=$result2->fetch_array()) {
			
				$image_path = "/images_podium/professors/" . $row2['image_path'];
				$image_description = $row2['image_description'];
				$image_source = $row2['image_source'];
				
			}
			}
			
			elseif($row['university_images'] == 1) {
			include ("inc.main.connect2.php");
				// use university image
				
			$query2 = ("SELECT image_type, image_parent, image_path, image_description, image_source FROM podium_images WHERE image_type = '2' AND image_parent = '$university_id'");
			$result2=$db2->query($query2);
			while($row2=$result2->fetch_array()) {
			
				$image_path = "/images_podium/universities/" . $row2['image_path'];
				$image_description = $row2['image_description'];
				$image_source = $row2['image_source'];

				}
			}
				
			else {
				
				$image_path = "/css/images/climatepedia-logo.png";
				
			}
	

			echo ("
			
			<div class=professor_list_entry>
			<h2><a href=/podium/network/" . $professor_id . "/" . $professor_url . " target=_blank title='Click to view the Climatepedia profile of " . $post_professor . ".'>" . $professor_name . "</a></h2>
			<img class=professor_profile align=left width=80px src='" . $image_path . "'>
			<p class=entry_meta><span class=entry_university>" . $professor_university . "</span><span class=entry_date>" . $professor_department . "</span></p>
			<p class=professor_bio>" . $professor_bio . "</p>
			</div>
			");







	
	}
}
}










//
//
// SINGLE PAGE SCRIPT
//
//


elseif(isset($_GET['posturl'])) {

// we're viewing a specific post

$post_url = $_GET['posturl'];

echo ("<p id=section_note><a style=font-weight:100 href=/podium>&larr; Go back to the post list</a></p>");

include ("inc.main.connect.php");
$query = ("SELECT 

podium_posts.post_id,
podium_posts.post_name, 
podium_posts.post_url, 
podium_posts.post_summary, 
podium_posts.post_content, 
podium_posts.post_professor, 
podium_posts.post_tag1, 
podium_posts.post_date, 
podium_professors.professor_id, 
podium_professors.professor_title, 
podium_professors.professor_firstname, 
podium_professors.professor_lastname,
podium_professors.professor_university,
podium_professors.professor_picture,
podium_professors.professor_url,
podium_universities.university_id,
podium_universities.university_name,
podium_universities.university_images 
FROM (podium_posts LEFT JOIN podium_professors ON podium_posts.post_professor = podium_professors.professor_id) 
LEFT JOIN podium_universities ON podium_professors.professor_university = podium_universities.university_id 
WHERE podium_posts.post_url = '$post_url' 
ORDER BY podium_posts.post_date DESC LIMIT $sql_limit, 20");
$result=$db->query($query);

while($row=$result->fetch_array()) {


	$post_name = htmlspecialchars($row['post_name'], ENT_QUOTES);
	$post_content = $row['post_content'];
	$post_url = htmlspecialchars($row['post_url'], ENT_QUOTES);
	$professor_id = $row['post_professor'];
	$post_professor = $row['professor_title'] . " " . $row['professor_firstname'] . " " . $row['professor_lastname'];
	$post_university = $row['university_name'];
	$university_id = $row['university_id'];
	$post_date = strtotime($row['post_date']);
	$post_date = date("D M d, Y", $post_date);
	$professor_url = $row['professor_url'];
	$page_tag = $row['post_tag1'];



 if($row['professor_picture'] == 1) {
	// we have a professor picture
	
	include ("inc.main.connect2.php");
	$query2 = ("SELECT image_type, image_parent, image_path, image_description, image_source FROM podium_images WHERE image_type = '1' AND image_parent = '$professor_id'");
	$result2=$db2->query($query2);
	while($row2=$result2->fetch_array()) {
	
		
		echo ("<a href=/podium/network/" . $professor_id . "/" . $professor_url . " target=_blank title='Click to view the Climatepedia profile of " . $post_professor . ".'><img class=professor_profile width=80px align=left src=http://www.climatepedia.org/images_podium/professors/" . $row2['image_path'] . " ></a>");
	
	}	
 }

elseif($row['professor_picture'] == 0) {
	
	// we don't have a professor picture, check for a university one
	if($row['university_images'] == 1) {	
		// we do have a university one
	
	include("inc.main.connect2.php");
	$query2 = ("SELECT image_type, image_parent, image_path, image_description, image_source FROM podium_images WHERE image_type = '2' AND image_parent = '$university_id'");
	$result2=$db2->query($query2);
	while($row2=$result2->fetch_array()) {

		echo ("<img class=professor_profile width=80px align=left src=http://www.climatepedia.org/images_podium/universities/" . $row2['image_path'] . " >");
	
	}	
	}
	
	elseif($row['university_images'] == 0) {
		// we don't have a university one either
		
		echo ("<img class=professor_profile width=80px align=left src=http://www.climatepedia.org/css/images/climatepedia-logo.png>");
		
	
	}
	}

	echo ("
	<h2 class=post_header><a href=/podium/" . $post_url . ">" . $post_name . "</a></h2>
	<p class=entry_meta><span class=entry_professor><a href=/podium/network/" . $professor_id . "/" . $professor_url . " target=_blank title='Click to view the Climatepedia profile of " . $post_professor . ".'>" . $post_professor . "</a></span><br><span class=entry_university>" . $post_university . "</span> <span class=entry_date>" . $post_date . "</span></p>"
	. $post_content . "

	");




}

}



//
//
// SORTING SCRIPT
//
//


else {
	
if(isset($_GET['sortmethod'])) {
	
// we're sorting the main posts	
	
if($_GET['sortmethod'] == "oldest" ) {	
	
	$sorton = "post_date";
	$sorttype = "ASC";
	
}	
	
elseif($_GET['sortmethod'] == "alphabetical" ) {	
	
	$sorton = "post_name";
	$sorttype = "ASC";
	
	
}		

elseif($_GET['sortmethod'] == "inverse" ) {	
	
	$sorton = "post_name";
	$sorttype = "DESC";

	
}	
	
echo ("<p id=section_note>Viewing a list of recent professor posts. Click on a title to view the full post.</p>");
	
include ("inc.main.connect.php");
$query = ("SELECT 

podium_posts.post_name, 
podium_posts.post_url, 
podium_posts.post_summary, 
podium_posts.post_professor, 
podium_posts.post_date, 
podium_professors.professor_id, 
podium_professors.professor_title, 
podium_professors.professor_firstname, 
podium_professors.professor_lastname,
podium_professors.professor_university,
podium_professors.professor_picture,
podium_professors.professor_url,
podium_universities.university_id,
podium_universities.university_name,
podium_universities.university_images 
FROM (podium_posts LEFT JOIN podium_professors ON podium_posts.post_professor = podium_professors.professor_id) 
LEFT JOIN podium_universities ON podium_professors.professor_university = podium_universities.university_id 

ORDER BY podium_posts.$sorton $sorttype LIMIT $sql_limit, 20");

$result = $db->query($query);
while($row=$result->fetch_array()) {
	
	$post_name = htmlspecialchars($row['post_name'], ENT_QUOTES);
	$post_summary = htmlspecialchars($row['post_summary'], ENT_QUOTES);
	$post_summary = nl2br($post_summary);
	$post_url = htmlspecialchars($row['post_url'], ENT_QUOTES);
	$professor_id = $row['post_professor'];
	$post_professor = $row['professor_title'] . " " . $row['professor_firstname'] . " " . $row['professor_lastname'];
	$post_university = $row['university_name'];
	$university_id = $row['university_id'];
	$post_date = strtotime($row['post_date']);
	$post_date = date("D M d, Y", $post_date);
	$professor_url = $row['professor_url'];


	echo ("
	
	<div class=post_entry>

	
	
	");




 if($row['professor_picture'] == 1) {
	// we have a professor picture
	
	include ("inc.main.connect2.php");
	$query2 = ("SELECT image_type, image_parent, image_path, image_description, image_source FROM podium_images WHERE image_type = '1' AND image_parent = '$professor_id'");
	$result2=$db2->query($query2);
	while($row2=$result2->fetch_array()) {
	
		
		echo ("<a href=/podium/network/" . $professor_id . "/" . $professor_url . " target=_blank title='Click to view the Climatepedia profile of " . $post_professor . ".'><img class=professor_profile width=80px align=left src=http://www.climatepedia.org/images_podium/professors/" . $row2['image_path'] . " ></a>");
	
	}	
 }

elseif($row['professor_picture'] == 0) {
	
	// we don't have a professor picture, check for a university one
	if($row['university_images'] == 1) {	
		// we do have a university one
	
	include("inc.main.connect2.php");
	$query2 = ("SELECT image_type, image_parent, image_path, image_description, image_source FROM podium_images WHERE image_type = '2' AND image_parent = '$university_id'");
	$result2=$db2->query($query2);
	while($row2=$result2->fetch_array()) {

		echo ("<img class=professor_profile width=80px align=left src=http://www.climatepedia.org/images_podium/universities/" . $row2['image_path'] . " >");
	
	}	
	}
	
	elseif($row['university_images'] == 0) {
		// we don't have a university one either
		
		echo ("<img class=professor_profile width=80px align=left src=http://www.climatepedia.org/css/images/climatepedia-logo.png>");
		
	
	}
	}

	echo ("
	<h2 class=listheader><a href=/podium/" . $post_url . ">" . $post_name . "</a></h2>
	<p class=entry_meta><span class=entry_professor><a href=/podium/network/" . $professor_id . "/" . $professor_url . " target=_blank title='Click to view the Climatepedia profile of " . $post_professor . ".'>" . $post_professor . "</a></span><br><span class=entry_university>" . $post_university . "</span> <span class=entry_date>" . $post_date . "</span></p>
	<p class=entry_summary>" . $post_summary . "</p>
	<p class=continue_link><a href=/podium/" . $post_url . ">Read the full post &rarr;</a><p>
	</div>
	");

	
	
	
	
	
	
} // end while for each post		
	
	
	
	
	
	
	
	
	
	
	
	
}

else {
	
// just a raw, chronological posting	
	
echo ("<p id=section_note>Viewing a list of recent professor posts. Click on a title to view the full post.</p>");
	
include ("inc.main.connect.php");
$query = ("SELECT 

podium_posts.post_name, 
podium_posts.post_url, 
podium_posts.post_summary, 
podium_posts.post_professor, 
podium_posts.post_date, 
podium_professors.professor_id, 
podium_professors.professor_title, 
podium_professors.professor_firstname, 
podium_professors.professor_lastname,
podium_professors.professor_university,
podium_professors.professor_picture,
podium_professors.professor_url,
podium_universities.university_id,
podium_universities.university_name,
podium_universities.university_images 
FROM (podium_posts LEFT JOIN podium_professors ON podium_posts.post_professor = podium_professors.professor_id) 
LEFT JOIN podium_universities ON podium_professors.professor_university = podium_universities.university_id 

ORDER BY podium_posts.post_date DESC LIMIT $sql_limit, 20");

$result = $db->query($query);
while($row=$result->fetch_array()) {
	
	$post_name = htmlspecialchars($row['post_name'], ENT_QUOTES);
	$post_summary = htmlspecialchars($row['post_summary'], ENT_QUOTES);
	$post_summary = nl2br($post_summary);
	$post_url = htmlspecialchars($row['post_url'], ENT_QUOTES);
	$professor_id = $row['post_professor'];
	$post_professor = $row['professor_title'] . " " . $row['professor_firstname'] . " " . $row['professor_lastname'];
	$post_university = $row['university_name'];
	$university_id = $row['university_id'];
	$post_date = strtotime($row['post_date']);
	$post_date = date("D M d, Y", $post_date);
	$professor_url = $row['professor_url'];


	echo ("
	
	<div class=post_entry>

	
	
	");




 if($row['professor_picture'] == 1) {
	// we have a professor picture
	
	include ("inc.main.connect2.php");
	$query2 = ("SELECT image_type, image_parent, image_path, image_description, image_source FROM podium_images WHERE image_type = '1' AND image_parent = '$professor_id'");
	$result2=$db2->query($query2);
	while($row2=$result2->fetch_array()) {
	
		
		echo ("<a href=/podium/network/" . $professor_id . "/" . $professor_url . " target=_blank title='Click to view the Climatepedia profile of " . $post_professor . ".'><img class=professor_profile width=80px align=left src=http://www.climatepedia.org/images_podium/professors/" . $row2['image_path'] . " ></a>");
	
	}	
 }

elseif($row['professor_picture'] == 0) {
	
	// we don't have a professor picture, check for a university one
	if($row['university_images'] == 1) {	
		// we do have a university one
	
	include("inc.main.connect2.php");
	$query2 = ("SELECT image_type, image_parent, image_path, image_description, image_source FROM podium_images WHERE image_type = '2' AND image_parent = '$university_id'");
	$result2=$db2->query($query2);
	while($row2=$result2->fetch_array()) {

		echo ("<img class=professor_profile width=80px align=left src=http://www.climatepedia.org/images_podium/universities/" . $row2['image_path'] . " >");
	
	}	
	}
	
	elseif($row['university_images'] == 0) {
		// we don't have a university one either
		
		echo ("<img class=professor_profile width=80px align=left src=http://www.climatepedia.org/css/images/climatepedia-logo.png>");
		
	
	}
	}

	echo ("
	<h2 class=listheader><a href=/podium/" . $post_url . ">" . $post_name . "</a></h2>
	<p class=entry_meta><span class=entry_professor><a href=/podium/network/" . $professor_id . "/" . $professor_url . " target=_blank title='Click to view the Climatepedia profile of " . $post_professor . ".'>" . $post_professor . "</a></span><br><span class=entry_university>" . $post_university . "</span> <span class=entry_date>" . $post_date . "</span></p>
	<p class=entry_summary>" . $post_summary . "</p>
	<p class=continue_link><a href=/podium/" . $post_url . ">Read the full post &rarr;</a><p>
	</div>
	");

	
	
	
	
	
	
} // end while for each post	
	
	
	
} // end non-sorting post scripts
} // end all sorting scripts

?>