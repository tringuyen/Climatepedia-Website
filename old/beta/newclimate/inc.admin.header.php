<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?php echo("$admin_title");?></title>
<meta name="description" content="<?php echo $page_meta;?>">
<link rel="stylesheet" href="css/global.all.css" />
<link rel="stylesheet" href="css/global.admin.css" />
<?php if($css1 != "") {echo("<link rel='stylesheet' href='css/$css1' />");}?>
<?php if($css2 != "") {echo("<link rel='stylesheet' href='css/$css1' />");}?>
<?php if($css3 != "") {echo("<link rel='stylesheet' href='css/$css1' />");}?>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="http://www.climatepedia.org/scripts/jquery-1.5.min.js"></script>
<script type="text/javascript" src="http://www.climatepedia.org/beta/newclimate/js/jquery.textareaCounter.plugin.js"></script>
<script type="text/javascript" src="http://www.climatepedia.org/ckeditor/ckeditor.js"></script>
<script type="text/javascript" >
$(document).ready(function(){  
var options1 = {  
    'maxCharacterSize': 150,  
    'originalStyle': 'textarea_info',  
    'warningStyle': 'textarea_warning',  
    'warningNumber': 10,  
    'displayFormat': '#input Characters | #left Characters Left'  
};  
$('#description_textarea').textareaCount(options1);  

var options2 = {  
    'maxCharacterSize': 70,  
    'originalStyle': 'textarea_info',  
    'warningStyle': 'textarea_warning',  
    'warningNumber': 10,  
    'displayFormat': '#input Characters | #left Characters Left'  
};  
$('#pagetitle_input').textareaCount(options2);  

var options3 = {  
    'maxCharacterSize': 40,  
    'originalStyle': 'textarea_info',  
    'warningStyle': 'textarea_warning',  
    'warningNumber': 5,  
    'displayFormat': '#input Characters | #left Characters Left'  
};  
$('#blogtitle_input').textareaCount(options3);  


 
var options4 = {  
    'maxCharacterSize': 250,  
    'originalStyle': 'textarea_info',  
    'warningStyle': 'textarea_warning',  
    'warningNumber': 10,  
    'displayFormat': '#input Characters | #left Characters Left'  
};  
$('#blogdescription_textarea').textareaCount(options4); 
 
}); 
</script>
</head>
<div id="header">
<div id="sub_header1">
<a href="" id="admin_logo" >Climatepedia<br><span id="logo_center">Administration</span></a>
<img src="css/images/einstein.png" alt="" id="admin_mascot" >
<a href="admin.php?console=group&action=choose_page" id="main_admin_button" class="admin_header_button <?php if($section == 'main'){echo 'admin_nav_active';} ?>" >Group</a>
<a href="admin.php?console=podium&action=new_post" id="podium_admin_button" class="admin_header_button <?php if($section == 'podium'){echo 'admin_nav_active';} ?>" >Podium</a>
<!-- <a href="" id="crowd_admin_button" class="admin_header_button <?php if($section == 'crowd'){echo 'admin_nav_active';} ?>" >Crowd</a> -->
<a href="admin.php?console=news&action=new_news" id="news_admin_button" class="admin_header_button <?php if($section == 'news'){echo 'admin_nav_active';} ?>" >News</a>
<a href="admin.php?console=blogs&action=new_post" id="blogs_admin_button" class="admin_header_button <?php if($section == 'blogs'){echo 'admin_nav_active';} ?>" >Blogs</a>
<a href="admin.php?console=media&action=new_photos" id="media_admin_button" class="admin_header_button <?php if($section == 'media'){echo 'admin_nav_active';} ?>" >Media</a>
<a href="admin.php?console=knowledge&action=new_article" id="knowledge_admin_button" class="admin_header_button <?php if($section == 'knowledge'){echo 'admin_nav_active';} ?>" >Knowledge</a>
</div>

</div>
<div id="sub_header2">
</div>
<div id="admin_wrapper">
<div id="admin_body">









