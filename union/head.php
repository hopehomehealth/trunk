<script type="text/javascript" src="/ajax/jquery-1.7.2.js"></script>  
<script type="text/javascript" src="/static/js/cloota.js"></script> 

<div class="site_nav">
	<div class="site_nav_inner">
		<div id="user_login_info">
			<ul class="login_menu clearfix">
				<li><a  href="/member/login" target="_blank">��¼</a>|</li>
				<li><a  href="/member/register" target="_blank">ע��</a></li>
			</ul>
		</div>
		<ul class="detail_menu clearfix">
			<li><a href="/seller/" target="_blank" style="color:#ff8800;">�̼ҵ�¼</a></li>
			<li><a href="/member/?cmd=<?=base64_encode('order.php')?>"  class="" target="_blank" >�ҵĶ���</a></li> 
			<li><a href="javascript: addfavorite()" >�����ղ�</a></li>   
			<li><a class="phone" href="javascript:void(0)" ><?=$g_profile['union_tel']?></a></li>
		</ul>
	</div>
</div> 

<script type="text/javascript">
var user_login_info = document.getElementById("user_login_info");

if(user_login_info){
    user_login_info.innerHTML=getLoginInfo(); 
}

function addEventHandler(obj,eventName,fun){
    var fn = fun;
    if(obj.attachEvent){
        obj.attachEvent('on'+eventName,fn);
    }else if(obj.addEventListener){
        obj.addEventListener(eventName,fn,false);
    }
}
addEventHandler(window,"load",function(){
    weixinShow_top();
    showColleBox();
});

function myAddPanel(title, url, desc) {
    if (document.all) {
        if (navigator.appName == "Microsoft Internet Explorer") {
            try {
                window.external.addFavorite(url, title);
            } catch (e1) {
                try {
                    window.external.addToFavoritesBar(url, title);
                } catch (e2) {
                    alert('�����ղ�ʧ�ܣ������ֹ����롣');
                }
            }
        }
    } else if (window.external) {
        try {
            window.sidebar.addPanel(title, url, desc);
        } catch (e3) {
            alert("���������֧������ܣ��밴Ctrl+Dֱ���ղ����ǣ�");
        }
    } else {
        alert('�����ղ�ʧ�ܣ������ֹ����롣')
    }
}

function weixinShow_top() {
        var weixinbox = document.getElementById("topWeiXin");
        var wxImg = document.getElementById("wxImg").getAttribute("data-src");
        if(weixinbox){
            weixinbox.onmouseover = function() {
                weixinbox.className = "topWeiXin on";
                document.getElementById("wxImg").src = wxImg;

            },
            weixinbox.onmouseout = function() {
                weixinbox.className = "topWeiXin";
            }
        };

}

function showColleBox() {
        var collebox = document.getElementById("vipnameBox");
        var vipname=document.getElementById("vipname");
        if(collebox){
            collebox.onmouseover = function() {
                collebox.className = "vipname_box on";
                vipname.className = "vipname float_tt";

            },
            collebox.onmouseout = function() {
                collebox.className = "vipname_box";
                vipname.className = "vipname float_tt";
                vipname.className = "vipname";
            }
        };

}
</script>

<link href="/images/plat_head_w.css" rel="stylesheet" type="text/css" />

<div class="head_bg">
	<div class="head">
		<div class="logo clearfix"> <a class="logo_a" href="/"> <img src="/images/logo.png" style="height:50px"> </a> <a class="logo_b" href="./">��������</a> </div>
		<div class="fr plat_tab" style="">
			<ul id="tags" class="clearfix">
				<li <?if($is_index==true){?>class="selectTag"<?}?>><a href="./">��ҳ</a> </li>
				<li <?if($is_info==true){?>class="selectTag"<?}?>><a href="info.php">��������</a></li>
			</ul>
		</div>
	</div>
</div>
 
<div id="banner" class="banner_retail"> 
	<a href='javascript:void()' >
		<div class="banner_list" style="background-image: url(/images/join_banner.jpg);"></div>
	</a>  
</div>