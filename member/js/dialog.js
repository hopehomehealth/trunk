function member_dialog(v_url, v_w, v_h, v_title){  
	var frm_htm = '<iframe id="member_frm" name="member_frm" frameborder="0" scrolling="auto" width="100%" height="400"></iframe>';
	$('#member_child_box').html(frm_htm); 
	
	v_w = 950;
	v_h = 500;

	//document.getElementById('member_frm').width			= v_w-20;
	document.getElementById('member_frm').height		= v_h; 
 
	var rnd = '';
	if(v_url.indexOf('?')!=-1){
		rnd = '&nocache='+Math.random();
	} else {
		rnd = '?nocache='+Math.random();
	}
 
	document.getElementById('member_frm').src			= v_url+rnd; 
	document.getElementById('page_cover').style.display = 'block';
	document.getElementById('memberbox').style.display	= 'block';
	
}
function member_dialog_close(){
	document.getElementById('page_cover').style.display = 'none';
	document.getElementById('memberbox').style.display	= 'none';	
}