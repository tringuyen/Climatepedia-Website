<?php

include("inc.main.connect.php");

// do paging code here


$sql_raw = $blog_page * 20;
$sql_limit = $sql_raw - 20;


// check if we're viewing an individual page or an aggregate

if(isset($_GET['postid'])) {
	
// yes, we're viewing a single post
	
$postid = $_GET['postid'];
	
$query = ("SELECT blogs_posts.post_id, blogs_posts.post_name, blogs_posts.post_content,blogs_posts.post_images, blogs_posts.post_source, blogs_posts.post_url, blogs_posts.post_date, blogs_posts.post_update, blogs_sources.blog_name FROM blogs_posts LEFT JOIN blogs_sources ON blogs_posts.post_source = blogs_sources.blog_id WHERE blogs_posts.post_id = '$postid'");
$result=$db->query($query);
	
while($row=$result->fetch_array()) {
	
$post_content = $row['post_content'];
$post_originaldate = strtotime($row['post_date']);
$post_originaldate = date("D M d, Y", $post_originaldate);
$post_date = strtotime($row['post_update']);
$post_date = date("D M d, Y", $post_date);
$post_images = $row['post_images'];
	
	
echo ("

<div class=post_entry>
<p class=back_link><a href=/beta/newclimate/blogs>&larr; Go back to the blog list</a></p>
<h2>" . $row['post_name'] . "</h2>
<p class=post_meta><span class=post_source>" . $row['blog_name'] . "</span><span class=post_date>" . $post_date . "</span></p>"

. $post_content .

"
<p class=post_original><strong>Originally posted " . $post_originaldate . ":</strong><br> <a target=_blank href=" . $row['post_url'] . ">" . $row['post_url'] . "</a></p>
<p class=back_link><a href=/beta/newclimate/blogs>&larr; Go back to the blog list</a></p>
</div>



");	
	
		
}




}

else {
	
// we're on the main page

if(isset($_GET['sort'])) {
	
// we're sorting	
if($_GET['sort'] == "newest") {	
	
	
// most recent first
$query = ("SELECT blogs_posts.post_id, blogs_posts.post_name, blogs_posts.post_summary, blogs_posts.post_source, blogs_posts.post_update, blogs_sources.blog_name FROM blogs_posts LEFT JOIN blogs_sources ON blogs_posts.post_source = blogs_sources.blog_id ORDER BY blogs_posts.post_update DESC LIMIT $sql_limit, 20");
$result=$db->query($query);
$page_builder_number = $result->num_rows;	

echo ("<p id=blog_intro>Click on a blog post's title to view the full post.</p>");

while($row=$result->fetch_array()) {

$post_id = $row['post_id'];
$post_name = htmlspecialchars($row['post_name']);
$post_summary = nl2br(htmlentities($row['post_summary']));
$post_source = $row['blog_name'];
$post_date = strtotime($row['post_update']);
$post_date = date("D M d, Y", $post_date);

echo ("

<div class=post_entry>
<h2><a href=http://www.climatepedia.org/beta/newclimate/blogs/post/" . $post_id . ">" . $post_name . "</a></h2>
<p class=post_meta><span class=post_source>" . $post_source . "</span><span class=post_date>" . $post_date . "</span></p>
<p>" . $post_summary . "</p>
<p class=back_link><a href=http://www.climatepedia.org/beta/newclimate/blogs/post/" . $post_id . ">Read the full post &rarr;</a></p>
</div>


");
}
	
	
	
}

elseif($_GET['sort'] == "oldest") {

// oldest first
$query = ("SELECT blogs_posts.post_id, blogs_posts.post_name, blogs_posts.post_summary, blogs_posts.post_source, blogs_posts.post_update, blogs_sources.blog_name FROM blogs_posts LEFT JOIN blogs_sources ON blogs_posts.post_source = blogs_sources.blog_id ORDER BY blogs_posts.post_update ASC LIMIT $sql_limit, 20");
$result=$db->query($query);
$page_builder_number = $result->num_rows;	
echo ("<p id=blog_intro>Click on a blog post's title to view the full post.</p>");
while($row=$result->fetch_array()) {

$post_id = $row['post_id'];
$post_name = htmlspecialchars($row['post_name']);
$post_summary = nl2br(htmlentities($row['post_summary']));
$post_source = $row['blog_name'];
$post_date = strtotime($row['post_update']);
$post_date = date("D M d, Y", $post_date);

echo ("

<div class=post_entry>
<h2><a href=http://www.climatepedia.org/beta/newclimate/blogs/post/" . $post_id . ">" . $post_name . "</a></h2>
<p class=post_meta><span class=post_source>" . $post_source . "</span><span class=post_date>" . $post_date . "</span></p>
<p>" . $post_summary . "</p>
<p class=back_link><a href=http://www.climatepedia.org/beta/newclimate/blogs/post/" . $post_id . ">Read the full post &rarr;</a></p>
</div>


");
}
	
	
	
	
	
}
	
elseif($_GET['sort'] == "alphabetical") {
	
$query = ("SELECT blogs_posts.post_id, blogs_posts.post_name, blogs_posts.post_summary, blogs_posts.post_source, blogs_posts.post_update, blogs_sources.blog_name FROM blogs_posts LEFT JOIN blogs_sources ON blogs_posts.post_source = blogs_sources.blog_id ORDER BY blogs_posts.post_name ASC LIMIT $sql_limit, 20");
$result=$db->query($query);
$page_builder_number = $result->num_rows;	
echo ("<p id=blog_intro>Click on a blog post's title to view the full post.</p>");
while($row=$result->fetch_array()) {

$post_id = $row['post_id'];
$post_name = htmlspecialchars($row['post_name']);
$post_summary = nl2br(htmlentities($row['post_summary']));
$post_source = $row['blog_name'];
$post_date = strtotime($row['post_update']);
$post_date = date("D M d, Y", $post_date);

echo ("

<div class=post_entry>
<h2><a href=http://www.climatepedia.org/beta/newclimate/blogs/post/" . $post_id . ">" . $post_name . "</a></h2>
<p class=post_meta><span class=post_source>" . $post_source . "</span><span class=post_date>" . $post_date . "</span></p>
<p>" . $post_summary . "</p>
<p class=back_link><a href=http://www.climatepedia.org/beta/newclimate/blogs/post/" . $post_id . ">Read the full post &rarr;</a></p>
</div>


");
}
	
	
	
	
}

elseif($_GET['sort'] == "inverse") {
	
$query = ("SELECT blogs_posts.post_id, blogs_posts.post_name, blogs_posts.post_summary, blogs_posts.post_source, blogs_posts.post_update, blogs_sources.blog_name FROM blogs_posts LEFT JOIN blogs_sources ON blogs_posts.post_source = blogs_sources.blog_id ORDER BY blogs_posts.post_name DESC LIMIT $sql_limit, 20");
$result=$db->query($query);
$page_builder_number = $result->num_rows;	
echo ("<p id=blog_intro>Click on a blog post's title to view the full post.</p>");
while($row=$result->fetch_array()) {

$post_id = $row['post_id'];
$post_name = htmlspecialchars($row['post_name']);
$post_summary = nl2br(htmlentities($row['post_summary']));
$post_source = $row['blog_name'];
$post_date = strtotime($row['post_update']);
$post_date = date("D M d, Y", $post_date);

echo ("

<div class=post_entry>
<h2><a href=http://www.climatepedia.org/beta/newclimate/blogs/post/" . $post_id . ">" . $post_name . "</a></h2>
<p class=post_meta><span class=post_source>" . $post_source . "</span><span class=post_date>" . $post_date . "</span></p>
<p>" . $post_summary . "</p>
<p class=back_link><a href=http://www.climatepedia.org/beta/newclimate/blogs/post/" . $post_id . ">Read the full post &rarr;</a></p>
</div>


");
}
	
	
	
	
}


	
}

else {

$query = ("SELECT blogs_posts.post_id, blogs_posts.post_name, blogs_posts.post_summary, blogs_posts.post_source, blogs_posts.post_update, blogs_sources.blog_name FROM blogs_posts LEFT JOIN blogs_sources ON blogs_posts.post_source = blogs_sources.blog_id ORDER BY blogs_posts.post_update DESC LIMIT $sql_limit, 20");
$result=$db->query($query);
$page_builder_number = $result->num_rows;	
echo ("<p id=blog_intro>Click on a blog post's title to view the full post.</p>");
while($row=$result->fetch_array()) {

$post_id = $row['post_id'];
$post_name = htmlspecialchars($row['post_name']);
$post_summary = nl2br(htmlentities($row['post_summary']));
$post_source = $row['blog_name'];
$post_date = strtotime($row['post_update']);
$post_date = date("D M d, Y", $post_date);

echo ("

<div class=post_entry>
<h2><a href=http://www.climatepedia.org/beta/newclimate/blogs/post/" . $post_id . ">" . $post_name . "</a></h2>
<p class=post_meta><span class=post_source>" . $post_source . "</span><span class=post_date>" . $post_date . "</span></p>
<p>" . $post_summary . "</p>
<p class=back_link><a href=http://www.climatepedia.org/beta/newclimate/blogs/post/" . $post_id . ">Read the full post &rarr;</a></p>
</div>


");
}
}


// build pagination
echo ("<div id=pages_nav><p>Page | </p>");
$number_of_pages = ceil($page_builder_number / 20);
$page_builder_i = 1;
while($page_builder_i <= $number_of_pages) {
	// check whether we're sorting
	if(isset($_GET['sort'])) {
	echo ("
	
	<a href=/beta/newclimate/blogs/page/" . $page_builder_i . "&sort=" . $_GET['sort'] . " class=page_link>" . $page_builder_i . "</a>
	
	");
	}
	else {
	echo ("
	
	<a href=/beta/newclimate/blogs/page/" . $page_builder_i . " class=page_link>" . $page_builder_i . "</a>
	
	");	
		
	}

$page_builder_i++;	
}
echo ("</div>");




}





?>