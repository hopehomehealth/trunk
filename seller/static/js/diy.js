function hide_updater(){
	//var updater = document.getElementById('updater');
	//updater.style.display = 'none';
}
function open_updater(){
	var updater = document.getElementById('updater');
	updater.style.display = '';
}
function load_updater(e){
	var this_obj=e;
    var t=e.offsetTop;   
    var l=e.offsetLeft;   
    var height=e.offsetHeight;   
    while(e=e.offsetParent){
         t+=e.offsetTop;   
         l+=e.offsetLeft;   
    }

	this_obj.style.border = '1px red solid';
	var updater = document.getElementById('updater');
	updater.style.display = '';
	updater.style.left = l+"px"; 
	updater.style.top = t+"px";
	
	var updater_txt = document.getElementById('updater_txt');
	updater_txt.innerHTML = '±à¼­';

	var tag = this_obj.nodeName;
	var updater_url = document.getElementById('updater_url');
	if(tag=="IMG"){
		updater_url.value = "console/diy.php?type=img&src="+this_obj.src;
	}
	if(tag=="DIV"){
		updater_url.value = "console/diy.php?type=div&id="+this_obj.id;
	}
}
function exec_updater(){
	var updater_url = document.getElementById('updater_url');
	if(updater_url.value!=''){
		window.open(updater_url.value,"_blank","width=900,height=400,top=50,left=50,status=no,toolbar=no,scrollbars=yes,menubar=no,location=no,resizable=no");
	}
}
function show_updater(obj){
	open_updater();
 
	obj.onmouseover = function(){
		load_updater(obj); 
	}
	obj.onmouseout = function(){
		hide_updater();
	}
} 
function getElementsByClass(searchClass,node,tag) {
        var classElements = new Array();
        if ( node == null )
                node = document;
        if ( tag == null )
                tag = '*';
        var els = node.getElementsByTagName(tag);
        var elsLen = els.length;
        var pattern = new RegExp("(^|\\s)"+searchClass+"(\\s|$)");
        for (i = 0, j = 0; i < elsLen; i++) {
                if ( pattern.test(els[i].className) ) {
                        classElements[j] = els[i];
                        j++;
                }
        }
        return classElements;
}

var updater_html = '<div id="updater" style="position:absolute;top:0px;left:10px;width:30px;height:15px;z-index:10000;background-color:#00ffff;padding:2px;font-size:12px;"><input id="updater_url" type="hidden"><span style="color:red;cursor:pointer;" onclick="exec_updater()" id="updater_txt">DIY..</span></div>';

document.write(updater_html);
 
var obj_array= getElementsByClass('diy',document,'*');
var obj_len = obj_array.length;

for (i=0; i<obj_len; i++) {
	show_updater(obj_array[i]);
}