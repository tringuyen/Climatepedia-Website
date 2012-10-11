CKEDITOR.plugins.add('ajaxsave',
{
init: function(editor)
{
var pluginName = 'ajaxsave';


editor.addCommand( pluginName,
{
exec : function( editor )
{
alert( "Executing a command for the editor name - " + editor.checkDirty() );

var replycontent = escape(CKEDITOR.instances.replycontent.getData());

function CKupdate(){
for ( instance in CKEDITOR.instances )
    CKEDITOR.instances[instance].updateElement();
    CKEDITOR.instances[instance].setData('');
}


		$.ajax({
			type: "POST",
			url: "create_reply.php",
			data: "replycontent=" + replycontent + "&replyavatar=" + reply_avatar + "&replytopic=" + reply_topic + "&replychild=" + reply_child + "&replyto=" + reply_id,
			success: function() {
						$('#resizeDiv').fadeTo('slow', 0, function() {
		
		$('#resizeDiv').css('z-index', '0');
		$('#selectavatar').fadeIn();
		$('#reply_form').fadeTo('slow', 0);
		alert(reply_id);
		
		
		
		
		});
		
		$("<div class=childreply><div class=replyheader><img src='avatars/" + reply_avatar + ".jpg'></div><div class=replycontent><p>" + decodeURIComponent(replycontent) + "</p></div><div class=replybottom><p>Thank you for your post!</p></div>").insertAfter("#reply" + reply_id);
		CKupdate();
		}
		});



alert('after ajax post');
},
canUndo : true
});

/*
editor.addCommand(pluginName, 
new CKEDITOR.dialogCommand(pluginName)

);
*/

editor.ui.addButton('Ajaxsave',
{
label: 'Save Ajax',
command: pluginName,
className : 'cke_button_save'
});
}
});
