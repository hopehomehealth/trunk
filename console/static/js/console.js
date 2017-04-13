function dialog_notice(){ 
	/*
	$(function() {  
		$( "#notice_dialog" ).dialog({ 
			minHeight: 90,
			minWidth: 120,
			show: "blind"
		}); 
	}); 
	*/
	$('#alert_tip').fadeIn("slow");;  
} 

function dialog_edit(url){ 
	/*
	$(function() { 
		$( "#edit_dialog" ).dialog({  
			modal: true,
			buttons: {
				' ¹Ø±Õ ': function() {
				  $( this ).dialog( "close" );
				}
			},
			minWidth: 990,
			draggable:false
		}); 
	});
	*/
	document.getElementById('edit_frm').src=url+"&rnd="+Math.random();
	$('#edit_dialog').modal('show');
} 

function setWinHeight(obj)
{
	 var win=obj;
	 if (document.getElementById)
	 {
		  if (win && !window.opera)
		  {
		   if (win.contentDocument && win.contentDocument.body.offsetHeight)
			  win.height = win.contentDocument.body.offsetHeight + 20;
		   else if(win.Document && win.Document.body.scrollHeight)
			  win.height = win.Document.body.scrollHeight + 20;
		  }
	 }
}  