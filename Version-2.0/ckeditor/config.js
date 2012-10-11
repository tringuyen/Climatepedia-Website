/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	config.toolbar = 'MyToolbar';
	config.resize_enabled = true;
	config.scayt_autoStartup = true;
	config.format_tags = 'h2;h3;p';
	config.contentsCss = 'http://www.climatepedia.org/beta/newclimate/css/admin.knowledge.ckeditor.css';
	config.format_p = { element : 'p', attributes : { 'class' : 'normalPara' } };
	config.format_h2 = { element : 'h2', attributes : { 'class' : 'contentTitle2' } };
	config.format_h3 = { element : 'h3', attributes : { 'class' : 'contentTitle3' } };
	config.ignoreEmptyParagraph = true;
	config.bodyId = 'ckeditor_contents';
	config.enterMode = CKEDITOR.ENTER_BR;
	config.toolbar_MyToolbar = 
	
	[
	

		['Format','NumberedList','BulletedList','-','Blockquote','Bold','Italic','Underline','Strike','Subscript','Superscript'],
		['Link','Unlink','Table'],
		['Maximize', 'ShowBlocks','Find','Replace'],
   	['Cut','Copy','PasteText','Print','Scayt'],	


	  
	];

	
};
